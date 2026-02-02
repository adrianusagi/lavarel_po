var purchase_request = {
    _mdl_input: '#modal_input',
    _mdl_view: '#modal_lihat',
    title: 'Purchase Request',
    dt: null,
    mdl_input: null,
    mdl_view: null,
    form: null,
    view: function(ins){
        let _this = this;
        let params = JSON.parse(atob(urldecode($(ins).closest('.dropdown').attr('data-params'))));

        _this.mdl_view.find('.modal-title').html('Vew Purchae Requst ' + params['PR Number']);
        
        _this.mdl_view.modal('show');
        _this.mdl_view.find('.modal-body').html('<div class="block-msg"><i class="fa-solid fa-circle-notch fa-spin"></i></div>');

        $.get(admin.page_url + '/view', params, function(respon){
            _this.mdl_view.find('.modal-body').html(respon);
        }).fail(function(){
        })
    },
    form_input: function(ins = null){
        let _this = this;

        let params = {};
        if(ins == null){
            _this.mdl_input.find('.modal-title').html('Add New Purchase Request');
        } else {
            params = JSON.parse(atob(urldecode($(ins).closest('.dropdown').attr('data-params'))));
            _this.mdl_input.find('.modal-title').html('Edit Purchase Request with PR Number ' + params['PR Number']);
        }
        
        _this.mdl_input.modal('show');
        _this.mdl_input.find('.modal-body').html('<div class="block-msg"><i class="fa-solid fa-circle-notch fa-spin"></i></div>');
        _this.mdl_input.find('button').prop('disabled', 'disabled');

        $.get(admin.page_url + '/form', params, function(respon){
            _this.mdl_input.find('.modal-body').html(respon);

            _this.form = _this.mdl_input.find('form#form_purchase_request').my_plugins().form();
            _this.table_pr.init(_this.mdl_input.find('table').attr('id'));

            _this.mdl_input.find('button').removeAttr('disabled');
        }).fail(function(){
            _this.mdl_input.find('.modal-footer button[data-aksi="mdl_close"]').removeAttr('disabled');
            _this.mdl_input.find('.modal-header button').removeAttr('disabled');
        })
    },
    form_save: function(){
        let _this = this;
        if(_this.form.validate()){
            _this.mdl_input.find('button').prop('disabled', 'disabled');
            let btn_save = _this.mdl_input.find('button[data-aksi="mdl_save"]');
            btn_save.find('i.bi').hide();
            btn_save.prepend('<i class="fa-solid fa-circle-notch fa-spin icon-lg"></i>');

            let form_data = _this.form.serialize();
            form_data.items = _this.table_pr.serialize();

            $.post(admin.page_url, {form_data: form_data}, function(respon){
                if(respon.isOk){
                    bootstrap_toast('success', _this.title, 'New '+ _this.title + ' with PR Number ' + form_data.pr_number + ' added');
                    _this.dt_reload();
                    _this.mdl_input.modal('hide');
                } else {
                    bootstrap_toast('error', _this.title, 'Error for try to adding '+ _this.title + ' with PR Number ' + form_data.pr_number + '. ' + respon.msg);
                    _this.mdl_input.find('button').removeAttr('disabled');
                }

                btn_save.find('i.fa-spin').remove();
                btn_save.find('i.bi').show();
            }, 'json').fail(function(){
                btn_save.find('i.fa-spin').remove();
                btn_save.find('i.bi').show();
                _this.mdl_input.find('button').removeAttr('disabled');
                bootstrap_toast('error', _this.title, 'An error occurred while attempting to add '+ _this.title + ' with PR Number ' + form_data.pr_number + '. Unknow error');
            })
        }
    },
    delete: function(params){
        let _this = this;
        $.post(admin.page_url + '/delete', params, function(respon){
            if(respon.isOk){
                bootstrap_toast('success', _this.title, _this.title + ' with PR Number ' + params['PR Number'] + ' removed');
                _this.dt_reload();
            } else {
                bootstrap_toast('error', _this.title, 'Error for try to remove '+ _this.title + ' with PR Number ' + params['PR Number'] + '. ' + respon.msg);
            }
        }, 'json').fail(function(){
            bootstrap_toast('error', _this.title, 'An error occurred while attempting to delete '+ _this.title + ' with PR Number ' + params['PR Number'] + '. Unknow error');
        })
    },
    dt_init: function(){
        let _this = this;
        _this.dt = $('#main_dt').DataTable({
            columnDefs: [{ targets: [0], visible: false }]
        });
    },
    dt_reload: function(){
        let _this = this;
        $.get(admin.page_url + '/table', function(respon){
            $('#card_dt .card-body .row').html(respon);
            _this.dt_init();
        }).fail(function(){
            
        })
    },
    table_pr: {
        options: {},
        template: `<tr data-id="[id]" data-uniq="[uniq]">
                <td></td>
                <td>
                    <select class="form-control my-select2" id="product_catalog_[uniq]" name="product_catalog" data-value="[product_catalog]">
                        [option_product_catalog]
                        <optgroup label="Others">
                            <option value="custom_product" class="always-show">Add New Product Catalog</option>
                        </optgroup>
                    </select>
                    <input type="[item_type]" id="item" class="form-control mt5px" name="item" placeholder="Item name or description" required="required" value="[item]">
                </td>
                <td>
                    <input type="text" id="qty" class="form-control" name="qty" placeholder="Number of quantity" required="required" value="[qty]">
                </td>
                <td>
                    <input type="text" id="uom" class="form-control" name="uom" placeholder="Is it pieces (pcs), boxes, hours (for services), or kg?" required="required" value="[uom]">
                </td>
                <td>
                    <input type="text" id="est_price" class="form-control" name="est_price" data-type="money" placeholder="A rough cost per unit" required="required" data-value="[est_price]">
                </td>
                <td data-idx="total_amount">
                    
                </td>
                <td><a href="javascript:;" data-aksi="row-del"><i class="bi bi-trash"></i></a></td>
            </tr>`,
        table: null,
        add_row: function(values = {}){
            let _this = this;
            let _html = this.template;

            _html = _html.replace('[option_product_catalog]', _this.options.product_catalog);
            if(values.product_catalog == 'custom_product') _html = _html.replace('[item_type]', 'text');
            else _html = _html.replace('[item_type]', 'hidden');

            values.uniq = uniqid();

            _html = _html.replace(/\[(.*?)\]/g, function(match, key) {
                return values[key] || '';
            });

            _this.table.find('tbody').append(_html);

            _this.table.find('tr[data-uniq="'+values.uniq+'"] input[data-type="money"]').my_plugins().money();
            _this.table.find('select#product_catalog_'+values.uniq).my_plugins().select2();

            _this.row_number();

            return values.uniq;
        },
        remove_row: function(ins){
            $(ins).closest('tr').remove();
            this.row_number();
        },
        restore: function(){
            let _this = this;
            let value = this.table.attr('data-value').trim();

            if(typeof value != 'undefined' && value.length >0){
                let items = JSON.parse(urldecode(value));
                if(typeof items == 'object' && items.length>0) items.forEach(function(item){
                    if(item.product_catalog == null){
                        item.product_catalog = 'custom_product';
                    }
                    let uniq = _this.add_row(item);                  
                    _this.calc_total_amount(uniq);
                })
            }
        },
        row_number: function(){
            this.table.find('tbody tr').each(function(idx){
                $(this).find('td:first').html(idx + 1);
            })
        },
        calc_total_amount: function(ins = null){
            let _this = this;
            setTimeout(function(){
                let tr = null;
                if(typeof ins == 'string'){
                    tr = _this.table.find('tbody tr[data-uniq="'+ins+'"]');
                } else {
                    tr = $(ins).closest('tr');
                }

                let qty = parseFloat(tr.find('input[name="qty"]').val());
                let est_price = parseInt(tr.find('input[name="est_price"]').attr('data-value'));
                if(isNaN(est_price)) est_price = parseInt(tr.find('input[name="est_price"]').val());

                let total_amount = qty * est_price;
                if(isNaN(total_amount)) total_amount = 0;
                tr.find('[data-idx="total_amount"]').html(number_to_currency(total_amount));
            }, 100);
        },
        serialize: function(){
            let items = [];
            this.table.find('tbody tr').each(function(){
                let item = {
                    id: $(this).attr('data-id'),
                }

                $(this).find('input, select').each(function(){
                    let val = null;
                    if($(this).attr('data-type') == 'money') val = $(this).attr('data-value');
                    else val = $(this).val();

                    item[$(this).attr('name')] = val;
                })
                items.push(item);
            })
            return items;
        },
        get_product_catalog: function(ins){
            let id = $(ins).val();
            let tr = $(ins).closest('tr');
            $.get(admin.site_url + '/product_catalog/get', {id: id}, function(respon){
                let tr_id = tr.attr('data-id');
                if(tr_id.trim().length == 0){
                    tr.find('input[name="uom"]').val(respon.default_uom);
                    tr.find('input[name="est_price"]').attr('data-value', respon.last_price).val(respon.last_price).trigger('blur').trigger('change');
                }
            }, 'json').fail(function(){
            })
        },
        init: function(id){
            this.table = $('#'+id);
            this.options.product_catalog = urldecode($('meta[name="option_product_catalog"]').attr('content'));
            $('meta[name="option_product_catalog"]').remove();

            this.restore();
        }
    },
    init: function(){
        let _this = this;

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        _this.dt_init();
        _this.mdl_input = $(_this._mdl_input);
        _this.mdl_view = $(_this._mdl_view);
    }
}

$(document).ready(function(){
    purchase_request.init();
})
$('a[data-aksi="add_new"]').click(function(){
    purchase_request.form_input();
})
$(purchase_request._mdl_input).on('click', 'button[data-aksi="mdl_save"]', function(){
    purchase_request.form_save();
})
$('body').on('click', 'a[data-aksi="dtrow_lihat"]', function(){
    purchase_request.view(this);
})
$('body').on('click', 'a[data-aksi="dtrow_edit"]', function(){
    purchase_request.form_input(this);
})
$('body').on('click', 'a[data-aksi="dtrow_delete"]', function(){
    let params = JSON.parse(atob(urldecode($(this).closest('.dropdown').attr('data-params'))));
    
    bootbox.confirm('Are you sure to delete ' + purchase_request.title + ' with PR Number <b>' + params['PR Number'] + '</b> ?', function (result){ 
        if(result) purchase_request.delete(params);
    });
})
$('body').on('click', 'a[data-aksi="add_row"]', function(){
    purchase_request.table_pr.add_row();
})
$('body').on('click', 'a[data-aksi="row-del"]', function(){
    purchase_request.table_pr.remove_row(this);
})
$('body').on('keyup', 'input[name="qty"],input[name="est_price"]', function(){
    purchase_request.table_pr.calc_total_amount(this);
})
$('body').on('change', 'input[name="qty"],input[name="est_price"]', function(){
    purchase_request.table_pr.calc_total_amount(this);

})
$('body').on('select2:select', 'select[name="product_catalog"]', function(){
    console.log($(this).val());
    if($(this).val() == 'custom_product'){
        $(this).closest('tr').find('input[name="item"]').attr('type', 'text');
    } else {
        $(this).closest('tr').find('input[name="item"]').attr('type', 'hidden').val('');
        purchase_request.table_pr.get_product_catalog(this);
    }
})