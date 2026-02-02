<?php 
if(isset($form_data)) $form_data = (array) $form_data; else $form_data = array();

?>
<div class="accordion pr-based-form" id="po_detail">
    <div class="accordion-item">
        <h2 class="accordion-header" id="flush-po_detail">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                Detail of Purchase Order #<?php echo $purchase_order['PO Number']; ?>
            </button>
        </h2>
        <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-po_detail" data-bs-parent="#po_detail">
            <div class="accordion-body">
                <form class="form form-horizontal form-static">
                    <div class="form-body" style="padding-left: 100px">
                        <div class="row">
                            <?php if(isset($purchase_order) && is_array($purchase_order)) foreach($purchase_order as $col => $val){
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
    <div class="divider-text">Receive Order Form</div>
</div>

<form class="form form-horizontal pr-based-form" id="form_purchase_order">
    <div class="form-body">
        <div class="row">
            <div class="form-col mandatory">
                <div class="col-md-3">
                    <label>Work Order Number</label>
                </div>
                <div class="col-md-7 form-group">
                    <input type="text" id="wo_number" class="form-control" name="wo_number" placeholder="Work Order Number" required="required" value="<?php echo !empty($form_data['wo_number']) ? $form_data['wo_number'] : ''; ?>">
                </div>
            </div>
            <div class="form-col mandatory">
                <div class="col-md-3">
                    <label>Receive Date</label>
                </div>
                <div class="col-md-7 form-group">
                    <input type="text" id="receipt_date" class="form-control my-date-picker" name="receipt_date" required="required" value="<?php echo !empty($form_data['receipt_date']) ? $form_data['receipt_date'] : ''; ?>">
                </div>
            </div>
            <div class="form-col mandatory">
                <div class="col-md-3">
                    <label>Receipt By</label>
                </div>
                <div class="col-md-7 form-group">
                    <input type="text" id="receipt_by" class="form-control" name="receipt_by" placeholder="The person who receive" required="required" value="<?php echo !empty($form_data['receipt_by']) ? $form_data['receipt_by'] : ''; ?>">
                </div>
            </div>
            <div class="form-col mandatory">
                <div class="col-md-3">
                    <label>Delivery Note</label>
                </div>
                <div class="col-md-7 form-group">
                    <input type="text" id="delivery_note" class="form-control" name="delivery_note" placeholder="The reference number from the supplier's paper." required="required" value="<?php echo !empty($form_data['delivery_note']) ? $form_data['delivery_note'] : ''; ?>">
                </div>
            </div>
            <div class="form-col">
                <div class="col-md-3">
                    <label>Notes When Receive</label>
                </div>
                <div class="col-md-7 form-group">
                    <textarea id="notes" class="form-control" name="notes" data-value="<?php echo !empty($form_data['notes']) ? $form_data['notes'] : ''; ?>">
                    </textarea>
                </div>
            </div>
        </div>
    </div>

</form>

<table class="table masdet-table pr-based-form" id="table_<?php echo uniqid();?>">
    <thead>
        <tr>
            <th style="width: 50px">No</th>
            <th>Item</th>
            <th style="width: 150px">Orderd Qty</th>
            <th style="width: 150px">Received Qty</th>
            <th style="width: 150px">Unit of Measure</th>
            <th style="width: 200px">Condition</th>
        </tr>
    </thead>
    <tbody>
        <?php if(isset($items)) foreach($items as $i => $item){ 
            if(is_object($item)) $item = (array) $item;
            ?>
            <tr data-id="<?php echo $item['id'] ?>" data-po="<?php echo $item['po_item_id']; ?>">
                <td><?php echo ($i + 1) ?></td>
                <td><?php echo $item['item']; ?></td>
                <td><?php echo $item['ordered_qty']; ?></td>
                <td><input type="text" name="qty" class="form-control" value="<?php echo $item['received_qty']; ?>"></td>
                <td><?php echo $item['uom']; ?></td>
                <td>
                    <select name="condition" class="form-control">
                        <?php if(isset($options) && !empty($options['condition'])) echo $options['condition'];?>
                    </select>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>
