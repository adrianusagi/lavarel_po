<?php

if (!function_exists('draw_table')) {
    function draw_table($table) {
        return view('templates/table', array('table' => $table))->render();
    }
}

if (!function_exists('queryToCol')) {
    function queryToCol($query, $rmCol = null, $aksi = false) {
        $col = str_ireplace('select', '', $query);
        $arr_q = preg_split('/from/i', $col);
        $arCol = explode(',', $arr_q[0]);
        $res = array();
        $i = -1;
        $isInsideFunc = false;
        $funcLevel = 0;
        foreach ($arCol as $a) {
            $a = trim($a);
            $tmp = $a;
            if (isStrContain($a, '(')) {
                $isInsideFunc = true;
                $funcLevel += substr_count($a, '(');
            }
            if (isStrContain($a, ')')) {
                $funcLevel -= substr_count($a, ')');
                if ($funcLevel == 0)
                    $isInsideFunc = false;
            }
            if (!$isInsideFunc) {
                if (isStrContain($a, '`')) {
                    $resTmp = substr($a, strpos($a, '`') + 1, (strpos($a, '`', strpos($a, '`') + 1) - strpos($a, '`')) - 1);
                } else
                if (isStrContain($a, ' ')) {
                    $tmp = explode(' ', $tmp);
                    $resTmp = trim(end($tmp));
                } else
                if (isStrContain($a, '.')) {
                    $tmp = explode('.', $tmp);
                    $resTmp = trim(end($tmp));
                } else {
                    $resTmp = $a;
                }

                if (!empty($rmCol) && is_array($rmCol) && count($rmCol) > 0) {
                    if (!in_array($resTmp, $rmCol)) {
                        $i++;
                        $res[$i] = $resTmp;
                    }
                } else {
                    $i++;
                    $res[$i] = $resTmp;
                }
            }
        }
        if ($aksi) {
        foreach ($res as $i => $val) {
            if (isStrContain($val, '[[') && isStrContain($val, ']]'))
                $res[$i] = substr($val, 2, -2);
        }
        }
        //if($aksi) $res[]='options-no-db';
        return $res;
    }
}

if (!function_exists('isStrContain')) {
    function isStrContain($str,$chr){
        if(empty($str) || empty($chr)) return false;
        else if(strpos($str,$chr) !== false) return true; else return false;
    }
}

if (!function_exists('extension_dependencies')) {
    function extension_dependencies($extensions, $filetype){
        $ext_available = array(
            'datatable' => array(
                'css' => 'https://cdn.datatables.net/2.3.7/css/dataTables.dataTables.min.css',
                'js' => 'https://cdn.datatables.net/2.3.7/js/dataTables.min.js',
            ),
            'select2' => array(
                'css' => 'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css',
                'js' => 'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js'
            ),
            'datepicker' => array(
                'css' => url('assets/plugins/datepicker/css/bootstrap-datepicker.min.css'),
                'js' => url('assets/plugins/datepicker/js/bootstrap-datepicker.min.js')
            )
        );

        $result = '';
        foreach($extensions as $ext){
            if(isset($ext_available[$ext])){
                if($filetype == 'css') $result .= '<link rel="stylesheet" href="'.$ext_available[$ext][$filetype].'">';
                else if($filetype == 'js') $result .= '<script src="'.$ext_available[$ext][$filetype].'"></script>';
            }
        }

        return $result;
    }
}

if (!function_exists('draw_modal')) {
    function draw_modal($modal) {
        return view('templates/modal', array('modal' => $modal))->render();
    }
}

if (!function_exists('insert_log')) {
    function insert_log($data = array()) {
        return array_merge($data, array(
            'created_app' => APP_ID,
            'created_by' => 'adrian',
            'created_date' => now()
        ));
    }
}

if (!function_exists('update_log')) {
    function update_log($data = array()) {
        return array_merge($data, array(
            'modified_app' => APP_ID,
            'modified_by' => 'adrian',
            'modified_date' => now()
        ));
    }
}

if (!function_exists('get_htmlSelectOptions')) {
    function get_htmlSelectOptions($data, $required=false, $encrypt=false, $urlencode=false){
        $data = [
            'data' => $data,
            'required' => $required,
            'encrypt' => $encrypt,
            'urlencode' => $urlencode
        ];

        return view('templates/sel_opt', $data)->render();
	}
}

if (!function_exists('number_to_currency')) {
    function number_to_currency($number,$symbol='Rp'){
        if (!is_numeric($number)) return $symbol.' -';
        return $symbol.number_format($number,2,",",".");
    }
}