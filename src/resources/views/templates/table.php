
<?php
/** Default configuration values */
$table_id = (!empty($table['id']) ? $table['id'] : 'main_dt');
$isResponsive = (!empty($table['is_responsive']) ? $table['is_responsive'] : true);
$format_cols = (!empty($table['formatting_cols']) ? $table['formatting_cols'] : []);

if(!empty($table['columns']) && count($table['columns'])>0){
    $tableclass = "";
    if($isResponsive === true) $tableclass .= 'responsive';

    $thead = '';
    foreach ($table['columns'] as $col) {
        if (isStrContain($col, '[<[') && isStrContain($col, ']>]')) continue;
        if (isStrContain($col, '[[') && isStrContain($col, ']]'))
            if($col == '[[All]]')
            $thead .= '
                <th data-dt="dont-filter">
                <div class="checkbox-custom mb5">
                    <input type="checkbox" id="'.$table_id.'_cball">
                    <label for="'.$table_id.'_cball">' . substr($col, 2, -2) . '</label>
                </div>
                </th>';
            else $thead .= '<th data-dt="dont-filter">' . substr($col, 2, -2) . '</th>';
        else
            $thead .= '<th>' . $col . '</th>';
    }

    $html = '
            <table class="table '.$tableclass.'" id="' . $table_id . '" style="width: 100%">
                <thead>
                    <tr>' . $thead . '</tr>
                </thead>
        <tfoot></tfoot>
                <tbody>';

    if(!empty($table['data']) && is_array($table['data']) && count($table['data'])>0){
        foreach($table['data'] as $row){
            $row = (array) $row;

            $params = [];
            if(!empty($table['key_cols']) && is_array($table['key_cols'])) foreach($table['key_cols'] as $key){
                if(!empty($row[$key])) $params[$key] = $row[$key];
            }
            $params = urlencode(base64_encode(json_encode($params)));

            $html .= '<tr>';
            foreach($row as $col => $val){
                if($col == '[[Menus]]') $val = '<div class="btn-group mb-1">
                                <div class="dropdown" data-params="'.$params.'">
                                    <button class="btn btn-primary dropdown-toggle me-1" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="bi bi-menu-down me-50"></i>
                                    </button>
                                    <div class="dropdown-menu" style="">
                                        <a class="dropdown-item" href="javascript:;" data-aksi="dtrow_lihat">
                                            <i class="bi bi-file-earmark-text icon-lg me050"></i> View
                                        </a>
                                        <a class="dropdown-item" href="javascript:;" data-aksi="dtrow_edit">
                                            <i class="bi bi-pencil icon-lg me050"></i> Edit
                                        </a>
                                        <a class="dropdown-item" href="javascript:;" data-aksi="dtrow_delete">
                                            <i class="bi bi-trash icon-lg me050"></i> Delete
                                        </a>
                                    </div>
                                </div>
                            </div>';

                else if(!empty($format_cols[$col]) && $format_cols[$col] == 'money'){
                    $val = number_to_currency($val);
                }
                $html .= '<td>'.$val.'</td>';
            }
            $html .= '</tr>';
        }
    }

    $html .= '</tbody>
            </table>';
    echo $html;
}
?>