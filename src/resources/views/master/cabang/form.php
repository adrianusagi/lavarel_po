<?php 
if(isset($form_data)) $form_data = (array) $form_data; else $form_data = array();
?>
<form class="form form-horizontal" id="form_purchase_request">
    <div class="form-body">
        <div class="row">
            <input type="hidden" class="form-control" id="id" name="id" value="<?php echo !empty($form_data['id']) ? $form_data['id'] : ''; ?>">
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
                    <label>Address</label>
                </div>
                <div class="col-md-7 form-group">
                    <input type="text" id="address" class="form-control" name="address" placeholder="Address" value="<?php echo !empty($form_data['address']) ? $form_data['address'] : ''; ?>">
                </div>
            </div>
            <div class="form-col">
                <div class="col-md-3">
                    <label>Phone</label>
                </div>
                <div class="col-md-7 form-group">
                    <input type="text" id="phone" class="form-control" name="phone" placeholder="Phone number" value="<?php echo !empty($form_data['phone']) ? $form_data['phone'] : ''; ?>">
                </div>
            </div>
        </div>
    </div>
</form>