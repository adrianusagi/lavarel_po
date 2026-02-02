<?php 
if(isset($form_data)) $form_data = (array) $form_data; else $form_data = array();
?>
<form class="form form-horizontal" id="form_select_pr">
    <div class="form-body">
        <div class="row">
            <input type="hidden" class="form-control" id="id" name="id" value="<?php echo !empty($form_data['id']) ? $form_data['id'] : ''; ?>">
            <div class="form-col mandatory">
                <div class="col-md-3">
                    <label>Purchase Request</label>
                </div>
                <div class="col-md-7 form-group">
                    <?php 
                    if(!empty($form_data['purchase_request'])){ ?>
                        <input type="hidden" class="form-control" id="purchase_request" name="purchase_request" value="<?php echo !empty($form_data['purchase_request']) ? $form_data['purchase_request'] : ''; ?>">
                        <label><?php echo $purchase_request['PR Number'].' | '.$purchase_request['Requestor Name'].' ('.$purchase_request['Requestor Department'].')'?></label>
                    <?php } else { ?>
                        <select id="purchase_request" class="form-control my-select2" name="purchase_request" data-value="<?php echo !empty($form_data['purchase_request']) ? $form_data['purchase_request'] : ''; ?>" required="required">
                            <option>-- Select Purchase Request -- </option>
                            <?php if(isset($options) && !empty($options['purchase_request'])) echo $options['purchase_request'];?>
                        </select>
                    <?php } ?>
                    
                </div>
            </div>
        </div>
    </div>
</form>
