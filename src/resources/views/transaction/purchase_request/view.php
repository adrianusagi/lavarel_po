<form class="form form-horizontal form-static">
    <div class="form-body">
        <div class="row">
            <?php if(isset($data) && is_array($data)) foreach($data as $col => $val){
                if(in_array($col, ['Last Purchase Price'])) $val = number_to_currency($val);
                
                echo '
                <div class="col-static col-md-3">
                    <label>' . $col . '</label>
                </div>
                <div class="col-static col-md-9">
                    <label><strong>' . $val . '</strong></label>
                </div>';
            } ?>
        </div>
    </div>
</form>
<table class="table mt-5">
    <thead>
        <tr>
            <th>No</th>
        <?php 
        if(isset($table) && !empty($table[0])) foreach($table[0] as $col => $val){
            echo '<th>'.$col.'</th>';
        }
        ?>
        </tr>
    </thead>
    <tbody>
        <?php 
        if(isset($table)) foreach($table as $i => $row){
            echo '<tr><td>'.($i + 1).'</td>';
            foreach($row as $col => $val){
                if(in_array($col, ['Estimated Price'])) $val = number_to_currency($val);
                echo '<td>'.$val.'</td>';
            }
            echo '</tr>';
        }
        ?>
    </tbody>
</table>