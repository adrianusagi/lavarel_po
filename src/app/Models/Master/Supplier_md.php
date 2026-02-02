<?php 
namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Supplier_md extends Model
{
    public static function get_query()
    {
        $sql = "SELECT
                id,
                code AS `Code`,
                Name,
                Category,
                Contact_Person AS `Contact Person`,
                Phone,
                NULL AS `[[Menus]]`
            FROM
                ".DB_P2P."tb_p2p_rf_suppliers
            ORDER BY
                Name";
        return $sql;
    }

    public static function get_all()
    {
        $sql = self::get_query();
        return DB::select($sql);
    }

    public static function get_one($id)
    {
        return DB::table(DB_P2P.'tb_p2p_rf_suppliers')->where('id', $id)->first();
    }

    public static function get_one_formatted($id)
    {
        $sql = "SELECT
                name AS `Name`,
                Code,
                tax_id AS `TAX ID (NPWP)`,
                category AS `Category`,
                sup.payment_terms AS `Payment Terms`,
                sup.contact_person AS `Contact Person`,
                email AS `Email`,
                phone AS `Phone`,
                office_address AS `Office Address`
            FROM
                ".DB_P2P."tb_p2p_rf_suppliers sup
            WHERE
                sup.id = ?";
        $dbres = DB::select($sql, [$id]);
        if(is_array($dbres) && count($dbres) == 1) return (array) $dbres[0];
        else return false;
    }

    public static function get_options()
    {
        $sql = "SELECT
                id,
                Name AS `caption`
            FROM
                ".DB_P2P."tb_p2p_rf_suppliers
            ORDER BY
                `caption`";
        return DB::select($sql);
    }

    public static function set_data($data)
    {
        $table = DB_P2P.'tb_p2p_rf_suppliers';

        if(empty($data['form_data'])) return array('isOk' => false, 'msg' => 'Invalid parameters');

        $is = null;
        $msg = null;

        $form_data = $data['form_data'];
        if(empty($form_data['id'])){
            $set = insert_log($form_data);
            
            $is = DB::table($table )->insert($set);
            if(!$is) $msg = 'Failed to inserting data to database';
        } else {
            $set = update_log($form_data);
            $is = DB::table($table )->where('id', $form_data['id'])->update($set);
            if(!$is) $msg = 'Failed to updating data to database';
        }

        return array('isOk' => $is, 'msg' => $msg);
    }

    public static function set_delete($id)
    {
        $is = DB::table(DB_P2P.'tb_p2p_rf_suppliers')->where('id', $id)->delete();
        return array('isOk' => $is, 'msg' => '');
    }
}