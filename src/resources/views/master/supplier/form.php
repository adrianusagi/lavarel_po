<?php 
if(isset($form_data)) $form_data = (array) $form_data; else $form_data = array();
?>
<form class="form form-horizontal" id="form_supplier">
    <div class="form-body">
        <div class="row">
            <input type="hidden" class="form-control" id="id" name="id" value="<?php echo !empty($form_data['id']) ? $form_data['id'] : ''; ?>">
            <div class="form-col mandatory">
                <div class="col-md-3">
                    <label>Name</label>
                </div>
                <div class="col-md-7 form-group">
                    <input type="text" id="name" class="form-control" name="name" placeholder="Suuplier company name" required="required" value="<?php echo !empty($form_data['name']) ? $form_data['name'] : ''; ?>">
                </div>
            </div>
            <div class="form-col">
                <div class="col-md-3">
                    <label>Code</label>
                </div>
                <div class="col-md-7 form-group">
                    <input type="text" id="code" class="form-control" name="code" placeholder="Supplier code" value="<?php echo !empty($form_data['code']) ? $form_data['code'] : ''; ?>">
                </div>
            </div>
            <div class="form-col">
                <div class="col-md-3">
                    <label>TAX ID (NPWP)</label>
                </div>
                <div class="col-md-7 form-group">
                    <input type="text" id="tax_id" class="form-control" name="tax_id" placeholder="Tax ID or NPWP number" value="<?php echo !empty($form_data['tax_id']) ? $form_data['tax_id'] : ''; ?>">
                </div>
            </div>
            <div class="form-col">
                <div class="col-md-3">
                    <label>Category</label>
                </div>
                <div class="col-md-7 form-group">
                    <input type="text" id="category" class="form-control" name="category" placeholder="What do they sell? (e.g., IT Hardware, Office Supplies, Consulting)." value="<?php echo !empty($form_data['category']) ? $form_data['category'] : ''; ?>">
                </div>
            </div>
            <div class="form-col">
                <div class="col-md-3">
                    <label>Payment Terms</label>
                </div>
                <div class="col-md-7 form-group">
                    <select id="payment_terms" class="form-control my-select2" name="payment_terms" data-value="<?php echo !empty($form_data['payment_terms']) ? $form_data['payment_terms'] : ''; ?>">
                        <option value="COD">COD</option>
                        <option value="Net 7">Net 7</option>
                        <option value="Net 15">Net 15</option>
                        <option value="Net 30">Net 30</option>
                    </select>
                </div>
            </div>
            <div class="form-col">
                <div class="col-md-3">
                    <label>Contact Person</label>
                </div>
                <div class="col-md-7 form-group">
                    <input type="text" id="contact_person" class="form-control" name="contact_person" placeholder="The name of your sales rep or account manager." value="<?php echo !empty($form_data['contact_person']) ? $form_data['contact_person'] : ''; ?>">
                </div>
            </div>
            <div class="form-col">
                <div class="col-md-3">
                    <label>Email</label>
                </div>
                <div class="col-md-7 form-group">
                    <input type="text" id="email" class="form-control" name="email" placeholder="Where the Purchase Order (PO) will be sent" value="<?php echo !empty($form_data['email']) ? $form_data['email'] : ''; ?>">
                </div>
            </div>
            <div class="form-col">
                <div class="col-md-3">
                    <label>Phone</label>
                </div>
                <div class="col-md-7 form-group">
                    <input type="text" id="phone" class="form-control" name="phone" placeholder="For follow-ups on delivery." value="<?php echo !empty($form_data['phone']) ? $form_data['phone'] : ''; ?>">
                </div>
            </div>
            <div class="form-col">
                <div class="col-md-3">
                    <label>Office Address</label>
                </div>
                <div class="col-md-7 form-group">
                    <input type="text" id="office_address" class="form-control" name="office_address" placeholder="The physical location for the Ship-to or Bill-to documents." value="<?php echo !empty($form_data['office_address']) ? $form_data['office_address'] : ''; ?>">
                </div>
            </div>
        </div>
    </div>
</form>