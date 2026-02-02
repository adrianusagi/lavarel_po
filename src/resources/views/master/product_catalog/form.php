<?php 
if(isset($form_data)) $form_data = (array) $form_data; else $form_data = array();
?>
<form class="form form-horizontal" id="form_product_catalog">
    <div class="form-body">
        <div class="row">
            <input type="hidden" class="form-control" id="id" name="id" value="<?php echo !empty($form_data['id']) ? $form_data['id'] : ''; ?>">
            <div class="form-col mandatory">
                <div class="col-md-3">
                    <label>Code</label>
                </div>
                <div class="col-md-7 form-group">
                    <input type="text" id="code" class="form-control" name="code" placeholder="Code" required="required" value="<?php echo !empty($form_data['code']) ? $form_data['code'] : ''; ?>">
                </div>
            </div>
            <div class="form-col mandatory">
                <div class="col-md-3">
                    <label>Name</label>
                </div>
                <div class="col-md-7 form-group">
                    <input type="text" id="name" class="form-control" name="name" placeholder="Name" required="required" value="<?php echo !empty($form_data['name']) ? $form_data['name'] : ''; ?>">
                </div>
            </div>
            <div class="form-col">
                <div class="col-md-3">
                    <label>Category</label>
                </div>
                <div class="col-md-7 form-group">
                    <select id="category" class="form-control my-select2" name="category" data-value="<?php echo !empty($form_data['category']) ? $form_data['category'] : ''; ?>">
                        <?php if(isset($options) && !empty($options['category'])) echo $options['category'];?>
                    </select>
                </div>
            </div>
            <div class="form-col">
                <div class="col-md-3">
                    <label>Default Unit of Measure</label>
                </div>
                <div class="col-md-7 form-group">
                    <input type="text" id="default_uom" class="form-control" name="default_uom" placeholder="Default Unit of Measure" value="<?php echo !empty($form_data['default_uom']) ? $form_data['default_uom'] : ''; ?>">
                </div>
            </div>
            <div class="form-col">
                <div class="col-md-3">
                    <label>Last Purchase Price</label>
                </div>
                <div class="col-md-7 form-group">
                    <input type="text" id="last_price" class="form-control" name="last_price" placeholder="Last Purchase Price" data-type="money" data-value="<?php echo !empty($form_data['last_price']) ? $form_data['last_price'] : ''; ?>">
                </div>
            </div>
        </div>
    </div>
</form>