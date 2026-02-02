<?php 
if(isset($form_data)) $form_data = (array) $form_data; else $form_data = array();
?>
<form class="form form-horizontal" id="form_select_po">
    <div class="form-body">
        <div class="row">
            <input type="hidden" class="form-control" id="id" name="id" value="<?php echo !empty($form_data['id']) ? $form_data['id'] : ''; ?>">
            <div class="form-col mandatory">
                <div class="col-md-3">
                    <label>Purchase Order</label>
                </div>
                <div class="col-md-7 form-group">
                    <?php 
                    if(!empty($form_data['purchase_order'])){ ?>
                        <input type="hidden" class="form-control" id="purchase_order" name="purchase_order" value="<?php echo !empty($form_data['purchase_order']) ? $form_data['purchase_order'] : ''; ?>">
                        <label><?php echo $purchase_order['PO Number'].' | '.$purchase_order['Supplier'];?></label>
                    <?php } else { ?>
                        <select id="purchase_order" class="form-control my-select2" name="purchase_order" data-value="<?php echo !empty($form_data['purchase_order']) ? $form_data['purchase_order'] : ''; ?>" required="required">
                            <option>-- Select Purchase Order -- </option>
                            <?php if(isset($options) && !empty($options['purchase_order'])) echo $options['purchase_order'];?>
                        </select>
                    <?php } ?>
                    
                </div>
            </div>
        </div>
    </div>
</form>
