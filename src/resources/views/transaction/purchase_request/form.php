<?php 
if(isset($form_data)) $form_data = (array) $form_data; else $form_data = array();
?>
<form class="form form-horizontal" id="form_purchase_request">
    <div class="form-body">
        <div class="row">
            <input type="hidden" class="form-control" id="id" name="id" value="<?php echo !empty($form_data['id']) ? $form_data['id'] : ''; ?>">
            <div class="form-col mandatory">
                <div class="col-md-3">
                    <label>PR Number</label>
                </div>
                <div class="col-md-7 form-group">
                    <input type="text" id="pr_number" class="form-control" name="pr_number" placeholder="PR Number" required="required" value="<?php echo !empty($form_data['pr_number']) ? $form_data['pr_number'] : ''; ?>">
                </div>
            </div>
            <div class="form-col mandatory">
                <div class="col-md-3">
                    <label>Requestor Name</label>
                </div>
                <div class="col-md-7 form-group">
                    <input type="text" id="requestor_name" class="form-control" name="requestor_name" placeholder="Requestor Name" required="required" value="<?php echo !empty($form_data['requestor_name']) ? $form_data['requestor_name'] : ''; ?>">
                </div>
            </div>
            <div class="form-col mandatory">
                <div class="col-md-3">
                    <label>Requestor Dept</label>
                </div>
                <div class="col-md-7 form-group">
                    <input type="text" id="requestor_dept" class="form-control" name="requestor_dept" placeholder="Requestor Departement" required="required" value="<?php echo !empty($form_data['requestor_dept']) ? $form_data['requestor_dept'] : ''; ?>">
                </div>
            </div>
            <div class="form-col">
                <div class="col-md-3">
                    <label>Branch</label>
                </div>
                <div class="col-md-7 form-group">
                    <select id="branch" class="form-control my-select2" name="branch" data-value="<?php echo !empty($form_data['branch']) ? $form_data['branch'] : ''; ?>">
                        <?php if(isset($options) && !empty($options['branch'])) echo $options['branch'];?>
                    </select>
                </div>
            </div>
            <div class="form-col">
                <div class="col-md-3">
                    <label>Date of Request</label>
                </div>
                <div class="col-md-7 form-group">
                    <input type="text" id="date_of_request" class="form-control my-date-picker" name="date_of_request" placeholder="When was this PR created?" value="<?php echo !empty($form_data['date_of_request']) ? $form_data['date_of_request'] : ''; ?>">
                </div>
            </div>
            <div class="form-col">
                <div class="col-md-3">
                    <label>Date Needed</label>
                </div>
                <div class="col-md-7 form-group">
                    <input type="text" id="date_needed" class="form-control my-date-picker" name="date_needed" placeholder="By when does the requestor need the items?" value="<?php echo !empty($form_data['date_needed']) ? $form_data['date_needed'] : ''; ?>">
                </div>
            </div>
            <div class="form-col">
                <div class="col-md-3">
                    <label>Purpose / Reason</label>
                </div>
                <div class="col-md-7 form-group">
                    <input type="text" id="purpose" class="form-control" name="purpose" placeholder="Why is this being purchased?" value="<?php echo !empty($form_data['purpose']) ? $form_data['purpose'] : ''; ?>">
                </div>
            </div>
            <div class="form-col">
                <div class="col-md-3">
                    <label>Ship-to Location</label>
                </div>
                <div class="col-md-7 form-group">
                    <input type="text" id="ship_to" class="form-control" name="ship_to" placeholder="Where should the items be delivered?" value="<?php echo !empty($form_data['ship_to']) ? $form_data['ship_to'] : ''; ?>">
                </div>
            </div>
            <div class="form-col">
                <div class="col-md-3">
                    <label>Preferred Vendor / Supplier</label>
                </div>
                <div class="col-md-7 form-group">
                    <select id="prefered_supplier" class="form-control my-select2" name="prefered_supplier" data-value="<?php echo !empty($form_data['prefered_supplier']) ? $form_data['prefered_supplier'] : ''; ?>">
                        <?php if(isset($options) && !empty($options['supplier'])) echo $options['supplier'];?>
                    </select>
                </div>
            </div>
            <div class="form-col">
                <div class="col-md-3">
                    <label>Request Status</label>
                </div>
                <div class="col-md-7 form-group">
                    <select id="status" class="form-control my-select2" name="status" data-value="<?php echo !empty($form_data['status']) ? $form_data['status'] : ''; ?>">
                        <?php if(isset($options) && !empty($options['status'])) echo $options['status'];?>
                    </select>
                </div>
            </div>
        </div>
    </div>
</form>

<table class="table masdet-table" id="table_<?php echo uniqid();?>" data-value="<?php echo (isset($items) && is_array($items) && count($items)>0) ? urlencode(json_encode($items)) : '';?> ">
    <thead>
        <tr>
            <th>No</th>
            <th style="width: 500px">Item</th>
            <th style="width: 100px">Qty</th>
            <th style="width: 150px">Unit of Measure</th>
            <th>Estimated Price</th>
            <th>Total Amount</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>
<a href="javascript:;" class="btn btn-outline-primary" data-aksi="add_row"><i class="bi bi-plus-square-fill icon-lg"></i>  Add Row</a>
<meta name="option_product_catalog" content="<?php echo urlencode($options['product_catalog']); ?>">
