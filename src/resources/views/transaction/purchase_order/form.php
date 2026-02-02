<?php 
if(isset($form_data)) $form_data = (array) $form_data; else $form_data = array();

?>
<div class="accordion pr-based-form" id="po_detail">
    <div class="accordion-item">
        <h2 class="accordion-header" id="flush-po_detail">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                Detail of Purchase Request #<?php echo $purchase_request['PR Number']; ?>
            </button>
        </h2>
        <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-po_detail" data-bs-parent="#po_detail">
            <div class="accordion-body">
                <form class="form form-horizontal form-static">
                    <div class="form-body" style="padding-left: 100px">
                        <div class="row">
                            <?php if(isset($purchase_request) && is_array($purchase_request)) foreach($purchase_request as $col => $val){
                                echo '
                                <div class="col-static col-md-2">
                                    <label>' . $col . '</label>
                                </div>
                                <div class="col-static col-md-9">
                                    <label><strong>' . $val . '</strong></label>
                                </div>';
                            } ?>
                        </div>
                    </div>
                </form>
                
            </div>
        </div>
    </div>
</div>

<div class="divider pr-based-form">
    <div class="divider-text">Purchase Order Form</div>
</div>

<form class="form form-horizontal pr-based-form" id="form_purchase_order">
    <div class="form-body">
        <div class="row">
            <div class="form-col mandatory">
                <div class="col-md-3">
                    <label>PO Number</label>
                </div>
                <div class="col-md-7 form-group">
                    <input type="text" id="po_number" class="form-control" name="po_number" placeholder="PO Number" required="required" value="<?php echo !empty($form_data['po_number']) ? $form_data['po_number'] : ''; ?>">
                </div>
            </div>
            <div class="form-col mandatory">
                <div class="col-md-3">
                    <label>PO Date</label>
                </div>
                <div class="col-md-7 form-group">
                    <input type="text" id="po_date" class="form-control my-date-picker" name="po_date" required="required" placeholder="The date the order is officially placed." value="<?php echo !empty($form_data['po_date']) ? $form_data['po_date'] : ''; ?>">
                </div>
            </div>
            <div class="form-col mandatory">
                <div class="col-md-3">
                    <label>Purchasing Agent</label>
                </div>
                <div class="col-md-7 form-group">
                    <input type="text" id="purchasing_agent" class="form-control" name="purchasing_agent" placeholder="The person who buys" required="required" value="<?php echo !empty($form_data['purchasing_agent']) ? $form_data['purchasing_agent'] : ''; ?>">
                </div>
            </div>
            <div class="form-col mandatory">
                <div class="col-md-3">
                    <label>Vendor / Supplier</label>
                </div>
                <div class="col-md-7 form-group">
                    <select id="supplier" class="form-control my-select2" name="supplier" data-value="<?php echo !empty($form_data['supplier']) ? $form_data['supplier'] : ''; ?>" required="required">
                        <?php if(isset($options) && !empty($options['supplier'])) echo $options['supplier'];?>
                    </select>
                </div>
            </div>
            <div class="form-col mandatory">
                <div class="col-md-3">
                    <label>Shipping Address</label>
                </div>
                <div class="col-md-7 form-group">
                    <textarea id="shipping_address" class="form-control" name="shipping_address" data-value="<?php echo !empty($form_data['shipping_address']) ? $form_data['shipping_address'] : ''; ?>" required="required">
                    </textarea>
                </div>
            </div>
            <div class="form-col mandatory">
                <div class="col-md-3">
                    <label>Shipping Method</label>
                </div>
                <div class="col-md-7 form-group">
                    <input type="text" id="ship_via" class="form-control" name="ship_via" value="<?php echo !empty($form_data['ship_via']) ? $form_data['ship_via'] : ''; ?>" required="required">
                </div>
            </div>
            <div class="form-col mandatory">
                <div class="col-md-3">
                    <label>Payment Due</label>
                </div>
                <div class="col-md-7 form-group">
                    <input type="text" id="payment_due" class="form-control my-date-picker" name="payment_due" required="required" value="<?php echo !empty($form_data['payment_due']) ? $form_data['payment_due'] : ''; ?>">
                </div>
            </div>
            <div class="form-col">
                <div class="col-md-3">
                    <label>Order Status</label>
                </div>
                <div class="col-md-7 form-group">
                    <select id="status" class="form-control my-select2" name="status" data-value="<?php echo !empty($form_data['status']) ? $form_data['status'] : ''; ?>">
                        <?php if(isset($options) && !empty($options['status'])) echo $options['status'];?>
                    </select>
                </div>
            </div>
            <div class="form-col">
                <div class="col-md-3">
                    <label>Note / Instruction / Special Treatment</label>
                </div>
                <div class="col-md-7 form-group">
                    <textarea id="note_instruction" class="form-control" name="note_instruction" data-value="<?php echo !empty($form_data['note_instruction']) ? $form_data['note_instruction'] : ''; ?>">
                    </textarea>
                </div>
            </div>
        </div>
    </div>

</form>

<table class="table masdet-table pr-based-form" id="table_<?php echo uniqid();?>" data-value="<?php echo (isset($items) && is_array($items) && count($items)>0) ? urlencode(json_encode($items)) : '';?> ">
    <thead>
        <tr>
            <th>No</th>
            <th style="width: 500px">Item</th>
            <th style="width: 100px">Qty</th>
            <th style="width: 150px">Unit of Measure</th>
            <th>Price</th>
            <th>Total</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
    </tbody>
    <tfoot>
        <tr>
            <th colspan="2">
                <a href="javascript:;" class="btn btn-outline-primary pr-based-form" data-aksi="add_row"><i class="bi bi-plus-square-fill icon-lg"></i>  Add Row</a>
            </th>
            <th colspan="3" class="text-right">Sub Total</th>
            <th colspan="2" data-idx="sub_total"></th>
        </tr>
        <tr>
            <th colspan="5" class="text-right">
                <span style="margin-top: 7px; display: inline-block;">VAT / TAX</span>
                <div class="form-group position-relative has-icon-right pull-right" style="width: 100px; margin-left: 10px">
                    <input type="text" class="form-control" name="vat_percent" value="<?php echo !empty($form_data['vat_percent']) ? $form_data['vat_percent'] : ''; ?>"> 
                    <div class="form-control-icon">
                        <i class="bi bi-percent"></i>
                    </div>
                </div>
            </th>
            <th colspan="2" data-idx="vat"></th>
        </tr>
        <tr>
            <th colspan="5" class="text-right">Shipping Cost</th>
            <th colspan="2">
                <input type="text" class="form-control" name="shipping_cost" data-type="money" data-value="<?php echo !empty($form_data['ship_cost']) ? $form_data['ship_cost'] : ''; ?>">
            </th>
        </tr>
        <tr>
            <th colspan="5" class="text-right">Handling Cost / Other Cost</th>
            <th colspan="2">
                <input type="text" class="form-control" name="other_cost" data-type="money" data-value="<?php echo !empty($form_data['other_cost']) ? $form_data['other_cost'] : ''; ?>">
            </th>
        </tr>
        <tr>
            <th colspan="5" class="text-right">Grand Total</th>
            <th colspan="2" class="grand_total" data-idx="grand_total"></th>
        </tr>
    </tfoot>
</table>

<meta name="option_product_catalog" content="<?php echo urlencode($options['product_catalog']); ?>">
