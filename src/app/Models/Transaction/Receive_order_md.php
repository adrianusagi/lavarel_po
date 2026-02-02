<?php 
namespace App\Models\Transaction;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Receive_order_md extends Model
{
    public static function get_query()
    {
        $sql = "SELECT
                rod.id,
                rod.wo_number AS `Work Order Number`,
                por.po_number AS `PO Number`,
                req.pr_number AS `PR Number`,
                DATE_FORMAT(rod.receipt_date, '%d %M %Y') AS `Receipt Date`,
                sup.name AS `Supplier`,
                rod.delivery_note AS `Delivery Note`,
                NULL AS `[[Menus]]`
            FROM
                ".DB_P2P."tb_p2p_tr_receive_order rod
            LEFT JOIN ".DB_P2P."tb_p2p_tr_purchase_order por ON rod.purchase_order = por.id
            LEFT JOIN ".DB_P2P."tb_p2p_rf_suppliers sup ON por.supplier = sup.id
            LEFT JOIN ".DB_P2P."tb_p2p_tr_purchase_request req ON por.purchase_request = req.id
            GROUP BY
                rod.id";
        return $sql;
    }

    public static function get_all()
    {
        $sql = self::get_query();
        return DB::select($sql);
    }

    public static function get_one($id)
    {
        return DB::table(DB_P2P.'tb_p2p_tr_receive_order')->where('id', $id)->first();
    }

    public static function get_one_formatted($id){
        $sql = "SELECT
	            rod.wo_number AS `Work Order Number`,
                DATE_FORMAT(rod.receipt_date, '%d %M %Y') AS `Receipt Date`,
                rod.receipt_by AS `Receipt By`,
                rod.delivery_note AS `Delivery Note`,
                rod.notes AS `Notes`
            FROM
                ".DB_P2P."tb_p2p_tr_receive_order rod
            WHERE
                rod.id = ?";
        $dbres = DB::select($sql, [$id]);
        if(is_array($dbres) && count($dbres) == 1) return (array) $dbres[0];
        else return false;
    }
    
    public static function get_items($purchase_order, $receive_id = null){
        $where = '';
        $placeholder = [$purchase_order];
        if(!empty($receive_id)){
            $where .= 'AND roitm.receive_order = ?';
            $placeholder[] = $receive_id;
        }

        $sql = "SELECT
                roitm.id,
                poitm.id AS `po_item_id`,
                CONCAT(prd.code,' | ', prd.name ) AS `item`,
                poitm.qty AS `ordered_qty`,
                roitm.qty AS `received_qty`,
                poitm.uom AS `uom`,
                roitm.`condition` AS `condition`
            FROM
                ".DB_P2P."tb_p2p_tr_po_items poitm
            INNER JOIN ".DB_P2P."tb_p2p_rf_product_catalog prd ON poitm.product_catalog = prd.id
            LEFT JOIN ".DB_P2P."tb_p2p_tr_ro_items roitm ON roitm.po_item = poitm.id
            WHERE
                poitm.purchase_order = ? ". $where;
        return DB::select($sql, $placeholder);
    }

    public static function get_items_formatted($id){
        $sql = "SELECT
                CONCAT(prd.code, ' | ', prd.name) AS `Product Catalog`,
                itmpo.qty AS `Orderd Qty`,
                itm.qty AS `Received Qty`,
                cond.label AS `Condition`
            FROM
                ".DB_P2P."tb_p2p_tr_ro_items itm
            INNER JOIN ".DB_P2P."tb_p2p_tr_po_items itmpo ON itm.po_item = itmpo.id
            INNER JOIN ".DB_P2P."tb_p2p_rf_product_catalog prd ON itmpo.product_catalog = prd.id
            LEFT JOIN ".DB_P2P."tb_p2p_rf_options cond ON itm.`condition` = cond.id
            AND cond.category = 'receive_condition'
            WHERE
                receive_order = ?";
        return DB::select($sql, [$id]);
    }

    public static function get_condition_options(){
        $sql = "SELECT
                id,
                label AS `caption`
            FROM
                ".DB_P2P."tb_p2p_rf_options
            WHERE
                category = 'receive_condition'
            AND is_active = 'YES'
            ORDER BY
                `ordering` ASC";
        return DB::select($sql);
    }

    public static function set_data($data)
    {
        $table = DB_P2P.'tb_p2p_tr_receive_order';
        $table_item = DB_P2P.'tb_p2p_tr_ro_items';

        if(empty($data['form_data'])) return array('isOk' => false, 'msg' => 'Invalid parameters');

        $is = true;
        $msg = null;

        $ro_id = null;

        /** Storing the purchase request data */
        $form_data = $data['form_data'];
        unset($form_data['items']);
        
        if(empty($form_data['id'])){
            $set = insert_log($form_data);
            
            $ro_id = DB::table($table)->insertGetId($set);
            if(empty($ro_id)){
                $is = false;
                $msg = 'Failed to inserting data to database';
            }
        } else {
            $ro_id = $form_data['id'];

            $set = update_log($form_data);
            $is = DB::table($table )->where('id', $form_data['id'])->update($set);
            if(!$is) $msg = 'Failed to updating data to database';
        }
        
        /** Storing the purchase request item */
        if($is && !empty($ro_id) && isset($data['form_data']['items']) && is_array($data['form_data']['items'])) foreach($data['form_data']['items'] as $item){
            $item['receive_order'] = $ro_id;
            
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

        return array('isOk' => $is, 'msg' => $msg);
    }

    public static function set_delete($id)
    {
        $is = DB::table(DB_P2P.'tb_p2p_tr_receive_order')->where('id', $id)->delete();
        return array('isOk' => $is, 'msg' => '');
    }
}