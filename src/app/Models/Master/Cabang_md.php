<?php 
namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Cabang_md extends Model
{
    public static function get_query()
    {
        $sql = "SELECT
                id,
                Name,
                Address,
                Phone,
                NULL AS `[[Menus]]`
            FROM
                ".DB_P2P."tb_p2p_rf_cabang";
        return $sql;
    }

    public static function get_all()
    {
        $sql = self::get_query();
        return DB::select($sql);
    }

    public static function get_one($id)
    {
        return DB::table(DB_P2P.'tb_p2p_rf_cabang')->where('id', $id)->first();
    }

    public static function get_one_formatted($id)
    {
        $sql = "SELECT
                cbg.name AS `Name`,
                cbg.address AS `Address`,
                cbg.phone AS `Phone`
            FROM
                ".DB_P2P."tb_p2p_rf_cabang cbg
            WHERE
                cbg.id = ?";
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
                ".DB_P2P."tb_p2p_rf_cabang
            ORDER BY
                `caption`";
        return DB::select($sql);
    }

    public static function set_data($data)
    {
        $table = DB_P2P.'tb_p2p_rf_cabang';

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
        $is = DB::table(DB_P2P.'tb_p2p_rf_cabang')->where('id', $id)->delete();
        return array('isOk' => $is, 'msg' => '');
    }
}