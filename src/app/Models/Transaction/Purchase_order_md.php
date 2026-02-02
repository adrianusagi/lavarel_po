<?php 
namespace App\Models\Transaction;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Purchase_order_md extends Model
{
    public static function get_query()
    {
        $sql = "SELECT
                por.id AS `id`, 
                po_number AS `PO Number`,
                grand_total AS `Grand Total`,
                DATE_FORMAT(payment_due, '%d %M %Y') AS `Payment Due`, 
                sup.name AS `Suppier`,
                IFNULL(posts.label, 'Draft') AS `Status`,
                NULL AS `[[Menus]]`
            FROM
                ".DB_P2P."tb_p2p_tr_purchase_order por
            LEFT JOIN ".DB_P2P."tb_p2p_rf_options posts ON por.status = posts.id
            AND posts.category = 'po_status'
            LEFT JOIN ".DB_P2P."tb_p2p_rf_suppliers sup ON por.supplier = sup.id
            GROUP BY
                por.id";
        return $sql;
    }

    public static function get_all()
    {
        $sql = self::get_query();
        return DB::select($sql);
    }

    public static function get_one($id)
    {
        return DB::table(DB_P2P.'tb_p2p_tr_purchase_order')->where('id', $id)->first();
    }

    public static function get_one_formatted($id)
    {
        $sql = "SELECT
                por.po_number AS `PO Number`,
                DATE_FORMAT(por.po_date, '%d %M %Y') AS `PO Date`,
                por.purchasing_agent AS `Purchasing Agent`,
                CONCAT(sup.name, ', ', IFNULL(sup.phone,''),', ',IFNULL(sup.office_address,'')) AS `Supplier`,
                por.shipping_address AS `Shipping Address`,
                por.ship_via AS `Ship Method`,
                por.note_instruction AS `Notes / Instruction`,
                porsts.label AS `Status`
            FROM
                ".DB_P2P."tb_p2p_tr_purchase_order por
            LEFT JOIN ".DB_P2P."tb_p2p_rf_suppliers sup ON por.supplier = sup.id
            LEFT JOIN ".DB_P2P."tb_p2p_rf_options porsts ON por.status = porsts.id
            AND porsts.category = 'po_status'
            WHERE
                por.id = ?";
        $dbres = DB::select($sql, [$id]);
        if(is_array($dbres) && count($dbres) == 1) return (array) $dbres[0];
        else return false;
    }

    public static function get_items($id){
        return DB::table(DB_P2P.'tb_p2p_tr_po_items')->where('purchase_order', $id)->get()->toArray();
    }

    public static function get_items_formatted($id){
        $sql = "SELECT
                CONCAT(prd.code, ' | ', prd.name ) AS `Product Catalog`,
                Qty,
                uom AS `Unit of Measure`,
                price AS `Price`
            FROM
                ".DB_P2P."tb_p2p_tr_po_items itm
            LEFT JOIN ".DB_P2P."tb_p2p_rf_product_catalog prd ON itm.product_catalog = prd.id
            WHERE
                itm.purchase_order = ?";
        return DB::select($sql, [$id]);
    }

    public static function get_options()
    {
        $sql = "SELECT
                por.id,
                CONCAT(por.po_number, ' | ', IFNULL(sup.name, '')) AS `caption`
            FROM
                ".DB_P2P."tb_p2p_tr_purchase_order por
            LEFT JOIN ".DB_P2P."tb_p2p_rf_options posts ON por.status = posts.id
            AND posts.category = 'po_status'
            LEFT JOIN ".DB_P2P."tb_p2p_rf_suppliers sup ON por.supplier = sup.id
            WHERE
                posts.tags LIKE '%[allow_po]%'
            ORDER BY
                por.po_date";
        return DB::select($sql);
    }

    public static function get_status_options(){
        $sql = "SELECT
                id,
                label AS `caption`
            FROM
                ".DB_P2P."tb_p2p_rf_options
            WHERE
                category = 'po_status'
            AND is_active = 'YES'
            ORDER BY
                `ordering` ASC";
        return DB::select($sql);
    }

    public static function set_data($data)
    {
        $table = DB_P2P.'tb_p2p_tr_purchase_order';
        $table_item = DB_P2P.'tb_p2p_tr_po_items';

        if(empty($data['form_data'])) return array('isOk' => false, 'msg' => 'Invalid parameters');

        $is = true;
        $msg = null;

        $po_id = null;

        /** Storing the purchase request data */
        $form_data = $data['form_data'];
        unset($form_data['items']);
        
        if(empty($form_data['id'])){
            $set = insert_log($form_data);
            
            $po_id = DB::table($table)->insertGetId($set);
            if(empty($po_id)){
                $is = false;
                $msg = 'Failed to inserting data to database';
            }
        } else {
            $po_id = $form_data['id'];

            $set = update_log($form_data);
            $is = DB::table($table )->where('id', $form_data['id'])->update($set);
            if(!$is) $msg = 'Failed to updating data to database';
        }
        
        /** Storing the purchase request item */
        $keep_items = [];
        if($is && !empty($po_id) && isset($data['form_data']['items']) && is_array($data['form_data']['items'])) foreach($data['form_data']['items'] as $item){
            if(empty($item['product_catalog']) || !is_numeric(($item['product_catalog']))) continue;

            $item['purchase_order'] = $po_id;
            
            if(empty($item['id'])){
                $set = insert_log($item);

                $item_id = DB::table($table_item)->insertGetId($set);
                if(empty($item_id)){
                    $is = false;
                    $msg = 'Failed to register purchase order item ' . $set['item'];
                } else $keep_items[] = $item_id;
            } else {
                $item_id = $item['id'];
                $set = update_log($item);

                $is = DB::table($table_item)->where('id', $item_id)->update($set);
                if(!$is){
                    $msg = 'Failed to register purchase order item ' . $set['item'];
                } else $keep_items[] = $item_id;
            }
        }

        if($is) DB::table($table_item)->where('purchase_order', $po_id)->whereNotIn('id', $keep_items)->delete();

        return array('isOk' => $is, 'msg' => $msg);
    }

    public static function set_delete($id)
    {
        $is = DB::table(DB_P2P.'tb_p2p_tr_purchase_order')->where('id', $id)->delete();
        return array('isOk' => $is, 'msg' => '');
    }
}