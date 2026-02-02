<?php 
namespace App\Models\Transaction;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Purchase_request_md extends Model
{
    public static function get_query()
    {
        $sql = "SELECT
                prq.id AS `id`, 
                pr_number AS `PR Number`,
                requestor_name AS `Requestor Name`,
                requestor_dept AS `Requestor Dept`,
                SUM(itm.qty * itm.est_price) AS `Estimated Budget`,
                IFNULL(prsts.label, 'Waiting') AS `Status`,
                NULL AS `[[Menus]]`
            FROM
                ".DB_P2P."tb_p2p_tr_purchase_request prq
            LEFT JOIN ".DB_P2P."tb_p2p_tr_pr_items itm ON prq.id = itm.purchase_request
            LEFT JOIN ".DB_P2P."tb_p2p_rf_options prsts ON prq.status = prsts.id
            AND prsts.category = 'pr_status'
            GROUP BY
                prq.id";
        return $sql;
    }

    public static function get_all()
    {
        $sql = self::get_query();
        return DB::select($sql);
    }

    public static function get_one($id)
    {
        return DB::table(DB_P2P.'tb_p2p_tr_purchase_request')->where('id', $id)->first();
    }

    public static function get_one_formatted($id)
    {
        $sql = "SELECT
                pr_number AS `PR Number`,
                prq.requestor_name AS `Requestor Name`,
                prq.requestor_dept AS `Requestor Department`,
                cbg.name AS `Branch`,
                DATE_FORMAT(prq.date_of_request, '%d %M %Y') AS `Date of Request`,
                DATE_FORMAT(prq.date_needed, '%d %M %Y') AS `Date Needed`,
                purpose AS `Purpose`,
                ship_to AS `Ship To`,
                CONCAT(sup.name, ', ', IFNULL(sup.phone,''),', ',IFNULL(sup.office_address,'')) AS `Prefered Supplier`,
                sts.label AS `Status`
            FROM
                ".DB_P2P."tb_p2p_tr_purchase_request prq
            LEFT JOIN ".DB_P2P."tb_p2p_rf_cabang cbg ON prq.branch = cbg.id
            LEFT JOIN ".DB_P2P."tb_p2p_rf_suppliers sup ON prq.prefered_supplier = sup.id
            LEFT JOIN ".DB_P2P."tb_p2p_rf_options sts ON prq.status = sts.id
            AND sts.category = 'pr_status'
            WHERE
                prq.id = ?";
        $dbres = DB::select($sql, [$id]);
        if(is_array($dbres) && count($dbres) == 1) return (array) $dbres[0];
        else return false;
    }

    public static function get_items($id){
        return DB::table(DB_P2P.'tb_p2p_tr_pr_items')->where('purchase_request', $id)->get()->toArray();
    }

    public static function get_items_formatted($id){
        $sql = "SELECT
                CONCAT(prd.code,' | ', prd.name ) AS `Product Catalog`,
                itm.item AS `Description`,
                qty AS `Qty`,
                uom AS `Unit of Measure`,
                itm.est_price AS `Estimated Price`
            FROM
                ".DB_P2P."tb_p2p_tr_pr_items itm
            LEFT JOIN ".DB_P2P."tb_p2p_rf_product_catalog prd ON itm.product_catalog = prd.id
            WHERE
                itm.purchase_request = ?";
        return DB::select($sql, [$id]);
    }

    public static function get_status_options(){
        $sql = "SELECT
                id,
                label AS `caption`
            FROM
                ".DB_P2P."tb_p2p_rf_options
            WHERE
                category = 'pr_status'
            AND is_active = 'YES'
            ORDER BY
                `ordering` ASC";
        return DB::select($sql);
    }

    public static function get_options()
    {
        $sql = "SELECT
                prq.id,
                CONCAT(prq.pr_number, ' | ', IFNULL(requestor_name, ''), ' (', IFNULL(requestor_dept, ''),')') AS `caption`
            FROM
                ".DB_P2P."tb_p2p_tr_purchase_request prq
            LEFT JOIN ".DB_P2P."tb_p2p_rf_options prsts ON prq.status = prsts.id
            AND prsts.category = 'pr_status'
            WHERE
                prsts.tags LIKE '%[allow_po]%'
            ORDER BY
                prq.date_of_request";
        return DB::select($sql);
    }

    public static function set_data($data)
    {
        $table = DB_P2P.'tb_p2p_tr_purchase_request';
        $table_item = DB_P2P.'tb_p2p_tr_pr_items';

        if(empty($data['form_data'])) return array('isOk' => false, 'msg' => 'Invalid parameters');

        $is = true;
        $msg = null;

        $pr_id = null;

        /** Storing the purchase request data */
        $form_data = $data['form_data'];
        unset($form_data['items']);
        
        if(empty($form_data['id'])){
            $set = insert_log($form_data);
            
            $pr_id = DB::table($table)->insertGetId($set);
            if(empty($pr_id)){
                $is = false;
                $msg = 'Failed to inserting data to database';
            }
        } else {
            $pr_id = $form_data['id'];

            $set = update_log($form_data);
            $is = DB::table($table )->where('id', $form_data['id'])->update($set);
            if(!$is) $msg = 'Failed to updating data to database';
        }
        
        /** Storing the purchase request item */
        $keep_items = [];
        if($is && !empty($pr_id) && isset($data['form_data']['items']) && is_array($data['form_data']['items'])) foreach($data['form_data']['items'] as $item){
            $item['purchase_request'] = $pr_id;
            if($item['product_catalog'] == 'custom_product') $item['product_catalog'] = null;
            if(empty($item['id'])){
                $set = insert_log($item);

                $item_id = DB::table($table_item)->insertGetId($set);
                if(empty($item_id)){
                    $is = false;
                    $msg = 'Failed to register purchase request item ' . $set['item'];
                } else $keep_items[] = $item_id;
            } else {
                $item_id = $item['id'];
                $set = update_log($item);

                $is = DB::table($table_item)->where('id', $item_id)->update($set);
                if(!$is){
                    $msg = 'Failed to register purchase request item ' . $set['item'];
                } else $keep_items[] = $item_id;
            }
        }

        if($is) DB::table($table_item)->where('purchase_request', $pr_id)->whereNotIn('id', $keep_items)->delete();

        return array('isOk' => $is, 'msg' => $msg);
    }

    public static function set_delete($id)
    {
        $is = DB::table(DB_P2P.'tb_p2p_tr_purchase_request')->where('id', $id)->delete();
        return array('isOk' => $is, 'msg' => '');
    }
}