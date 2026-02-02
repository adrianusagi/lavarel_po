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