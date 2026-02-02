var purchase_order = {
    _mdl_input: '#modal_input',
    _mdl_view: '#modal_lihat',
    title: 'Purchase Order',
    dt: null,
    mdl_input: null,
    mdl_view: null,
    form_select_pr: null,
    form: null,
    view: function(ins){
        let _this = this;
        let params = JSON.parse(atob(urldecode($(ins).closest('.dropdown').attr('data-params'))));

        _this.mdl_view.find('.modal-title').html('Vew Purchase Order ' + params['PO Number']);
        
        _this.mdl_view.modal('show');
        _this.mdl_view.find('.modal-body').html('<div class="block-msg"><i class="fa-solid fa-circle-notch fa-spin"></i></div>');

        $.get(admin.page_url + '/view', params, function(respon){
            _this.mdl_view.find('.modal-body').html(respon);
        }).fail(function(){
        })
    },
    form_input_select_pr: function(ins = null){
        let _this = this;

        let params = {};
        if(ins == null){
            _this.mdl_input.find('.modal-title').html('Add New Purchase Order');
        } else {
            params = JSON.parse(atob(urldecode($(ins).closest('.dropdown').attr('data-params'))));
            _this.mdl_input.find('.modal-title').html('Edit Purchase Order with PO Number ' + params['PO Number']);
        }
        
        _this.mdl_input.modal('show');
        _this.mdl_input.find('.modal-body').html('<div class="block-msg"><i class="fa-solid fa-circle-notch fa-spin"></i></div>');
        _this.mdl_input.find('button').prop('disabled', 'disabled');

        $.get(admin.page_url + '/form_select_pr', params, function(respon){
            _this.mdl_input.find('.modal-body').html(respon);

            _this.form_select_pr = _this.mdl_input.find('form#form_select_pr').my_plugins().form();

            let pr_input = _this.mdl_input.find('input[name="purchase_request"]');
            if(typeof pr_input != 'undefined' && pr_input.length>0){
                let pr_id = pr_input.val();
                _this.form_input(pr_id);
            }

            _this.mdl_input.find('button').removeAttr('disabled');
        }).fail(function(){
            _this.mdl_input.find('.modal-footer button[data-aksi="mdl_close"]').removeAttr('disabled');
            _this.mdl_input.find('.modal-header button').removeAttr('disabled');
        })
    },
    form_input: function(ins){
        let _this = this;

        _this.mdl_input.find('.pr-based-form').remove();
        _this.mdl_input.find('.modal-body').append('<div class="block-msg"><i class="fa-solid fa-circle-notch fa-spin"></i></div>');
        _this.mdl_input.find('button').prop('disabled', 'disabled');

        let pr_id = null;
        if(typeof ins == 'string') pr_id = ins;
        else pr_id = $(ins).val();

        let params = {
            id: _this.mdl_input.find('input[name="id"]').val(),
            purchase_request: pr_id,
        }

        $.get(admin.page_url + '/form', params, function(respon){
            _this.mdl_input.find('.block-msg').remove();
            _this.mdl_input.find('.modal-body').append(respon);

            _this.form = _this.mdl_input.find('form#form_purchase_order').my_plugins().form();
            _this.table_po.init(_this.mdl_input.find('table').attr('id'));

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

            let form_data = _this.form_select_pr.serialize();
            form_data = object_merge(form_data, _this.form.serialize());
            form_data = object_merge(form_data, _this.table_po.serialize());

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
    table_po: {
        options: {},
        template: `<tr data-id="[id]" data-uniq="[uniq]">
                <td></td>
                <td>
                    <select class="form-control my-select2" id="product_catalog_[uniq]" name="product_catalog" data-value="[product_catalog]">
                        <option>-- Select product catalog --</option>
                        [option_product_catalog]
                    </select>
                    <input type="hidden" name="pr_item" value="[pr_item]">
                    [item]
                </td>
                <td>
                    <input type="text" id="qty" class="form-control" name="qty" placeholder="Number of quantity" required="required" value="[qty]">
                </td>
                <td>
                    <input type="text" id="uom" class="form-control" name="uom" placeholder="Is it pieces (pcs), boxes, hours (for services), or kg?" required="required" value="[uom]">
                </td>
                <td>
                    <input type="text" id="price" class="form-control" name="price" data-type="money" placeholder="A rough cost per unit" required="required" data-value="[price]">
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

            if(typeof values.price == 'undefined') values.price = values.est_price;
            if(typeof values.pr_item == 'undefined'){
                values.pr_item = values.id;
                values.id = null;
            } 

            values.uniq = uniqid();
            if(typeof values.item == 'string' && values.item.trim().length>0) values.item = '<label>'+values.item+'</label>';

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
            this.calc_item_total();
        },
        restore: function(){
            let _this = this;
            let value = this.table.attr('data-value').trim();

            if(typeof value != 'undefined' && value.length >0){
                let items = JSON.parse(urldecode(value)); console.log(items);
                if(typeof items == 'object' && items.length>0) items.forEach(function(item){
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
                let price = parseInt(tr.find('input[name="price"]').attr('data-value'));
                if(isNaN(price)) price = parseInt(tr.find('input[name="price"]').val());

                let total_amount = qty * price;
                if(isNaN(total_amount)) total_amount = 0;
                tr.find('[data-idx="total_amount"]').html(number_to_currency(total_amount));

                _this.calc_item_total();
            }, 100);
        },
        calc_item_total: function(){
            let _this = this;
            setTimeout(function(){
                let subtotal = 0;
                _this.table.find('tbody tr').each(function(){
                    let tr = $(this);
                    let qty = parseFloat(tr.find('input[name="qty"]').val());
                    let price = parseInt(tr.find('input[name="price"]').attr('data-value'));
                    if(isNaN(price)) price = parseInt(tr.find('input[name="price"]').val());

                    let total = qty * price;
                    if(isNaN(total)) total = 0;
                    
                    subtotal = subtotal + total;
                })
                _this.table.find('[data-idx="sub_total"]').attr('data-value', subtotal).html(number_to_currency(subtotal));
                _this.calc_vat();
            }, 100);
        },
        calc_vat: function(){
            let _this = this;
            let total = parseInt(_this.table.find('[data-idx="sub_total"]').attr('data-value'));
            let vat_percent = parseInt(_this.table.find('[name="vat_percent"]').val());

            let vat = vat_percent / 100 * total;
            if(isNaN(vat)) vat = 0;
            _this.table.find('[data-idx="vat"]').attr('data-value', vat).html(number_to_currency(vat));

            _this.calc_grand_total();
        },
        calc_grand_total: function(){
            let _this = this;
            
            let total = parseInt(_this.table.find('[data-idx="sub_total"]').attr('data-value'));
            let vat = parseInt(_this.table.find('[data-idx="vat"]').attr('data-value'));
            if(isNaN(vat)) vat = 0;
            let ship = parseInt(_this.table.find('[name="shipping_cost"]').attr('data-value'));
            if(isNaN(ship)) ship = 0;
            let other_cost = parseInt(_this.table.find('[name="other_cost"]').attr('data-value'));
            if(isNaN(other_cost)) other_cost = 0;

            let grand = total + vat + ship + other_cost;
            if(isNaN(grand)) grand = 0;
            _this.table.find('[data-idx="grand_total"]').attr('data-value', grand).html(number_to_currency(grand));
        },
        serialize: function(){
            let _this = this;
            let table_data = {
                sub_total: _this.table.find('[data-idx="sub_total"]').attr('data-value'),
                vat_percent: _this.table.find('[name="vat_percent"]').val(),
                vat: _this.table.find('[data-idx="vat"]').attr('data-value'),
                ship_cost: _this.table.find('[name="shipping_cost"]').attr('data-value'),
                other_cost: _this.table.find('[name="other_cost"]').attr('data-value'),
                grand_total: _this.table.find('[data-idx="grand_total"]').attr('data-value'),
                items: []
            };
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
                table_data.items.push(item);
            })
            return table_data;
        },
        get_product_catalog: function(ins){
            let id = $(ins).val();
            let tr = $(ins).closest('tr');
            $.get(admin.site_url + '/product_catalog/get', {id: id}, function(respon){
                let tr_id = tr.attr('data-id');
                if(tr_id.trim().length == 0){
                    tr.find('input[name="uom"]').val(respon.default_uom);
                    tr.find('input[name="price"]').attr('data-value', respon.last_price).val(respon.last_price).trigger('blur').trigger('change');
                }
            }, 'json').fail(function(){
            })
        },
        init: function(id){
            this.table = $('#'+id);
            this.options.product_catalog = urldecode($('meta[name="option_product_catalog"]').attr('content'));
            $('meta[name="option_product_catalog"]').remove();

            this.restore();

            this.table.find('input[data-type="money"]').each(function(){
                $(this).my_plugins().money();
            })
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
    purchase_order.init();
})
$('a[data-aksi="add_new"]').click(function(){
    purchase_order.form_input_select_pr();
})
$('body').on('select2:select', 'select[name="purchase_request"]', function(){
    purchase_order.form_input(this);
})
$('body').on('keyup', 'input[name="vat_percent"]', function(){
    purchase_order.table_po.calc_vat();
});
$('body').on('keyup', 'input[name="shipping_cost"],input[name="other_cost"]', function(){
    setTimeout(function(){
        purchase_order.table_po.calc_grand_total();
    }, 100)
});
$('body').on('change', 'input[name="shipping_cost"],input[name="other_cost"]', function(){
    setTimeout(function(){
        purchase_order.table_po.calc_grand_total();
    }, 100)
});
$('body').on('click', 'a[data-aksi="add_row"]', function(){
    purchase_order.table_po.add_row();
})
$('body').on('click', 'a[data-aksi="row-del"]', function(){
    purchase_order.table_po.remove_row(this);
})
$('body').on('keyup', 'input[name="qty"],input[name="price"]', function(){
    purchase_order.table_po.calc_total_amount(this);
})
$('body').on('change', 'input[name="qty"],input[name="price"]', function(){
    purchase_order.table_po.calc_total_amount(this);

})
$('body').on('select2:select', 'select[name="product_catalog"]', function(){
    purchase_order.table_po.get_product_catalog(this);
})
$(purchase_order._mdl_input).on('click', 'button[data-aksi="mdl_save"]', function(){
    purchase_order.form_save();
})
$('body').on('click', 'a[data-aksi="dtrow_lihat"]', function(){
    purchase_order.view(this);
})
$('body').on('click', 'a[data-aksi="dtrow_edit"]', function(){
    purchase_order.form_input_select_pr(this);
})
$('body').on('click', 'a[data-aksi="dtrow_delete"]', function(){
    let params = JSON.parse(atob(urldecode($(this).closest('.dropdown').attr('data-params'))));
    
    bootbox.confirm('Are you sure to delete ' + purchase_order.title + ' with PO Number <b>' + params['PO Number'] + '</b> ?', function (result){ 
        if(result) purchase_order.delete(params);
    });
})


