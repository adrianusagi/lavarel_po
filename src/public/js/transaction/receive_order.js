var receive_order = {
    _mdl_input: '#modal_input',
    _mdl_view: '#modal_lihat',
    title: 'Receive Order',
    dt: null,
    mdl_input: null,
    mdl_view: null,
    form_select_po: null,
    form: null,
    view: function(ins){
        let _this = this;
        let params = JSON.parse(atob(urldecode($(ins).closest('.dropdown').attr('data-params'))));

        _this.mdl_view.find('.modal-title').html('Vew Receive Order ' + params['Work Order Number']);
        
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
            _this.mdl_input.find('.modal-title').html('Add New Receive Order');
        } else {
            params = JSON.parse(atob(urldecode($(ins).closest('.dropdown').attr('data-params'))));
            _this.mdl_input.find('.modal-title').html('Edit Receive Order with PO Number ' + params['PO Number']);
        }
        
        _this.mdl_input.modal('show');
        _this.mdl_input.find('.modal-body').html('<div class="block-msg"><i class="fa-solid fa-circle-notch fa-spin"></i></div>');
        _this.mdl_input.find('button').prop('disabled', 'disabled');

        $.get(admin.page_url + '/form_select_po', params, function(respon){
            _this.mdl_input.find('.modal-body').html(respon);

            _this.form_select_po = _this.mdl_input.find('form#form_select_po').my_plugins().form();

            let po_input = _this.mdl_input.find('input[name="purchase_order"]');
            if(typeof po_input != 'undefined' && po_input.length>0){
                let po_id = po_input.val();
                _this.form_input(po_id);
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

        let po_id = null;
        if(typeof ins == 'string') po_id = ins;
        else po_id = $(ins).val();

        let params = {
            id: _this.mdl_input.find('input[name="id"]').val(),
            purchase_order: po_id,
        }

        if(params.purchase_order == '-- Select Purchase Order --'){
            _this.mdl_input.find('.fa-spin').remove();
            _this.mdl_input.find('.modal-footer button[data-aksi="mdl_close"]').removeAttr('disabled');
            _this.mdl_input.find('.modal-header button').removeAttr('disabled');
            return false;
        }

        $.get(admin.page_url + '/form', params, function(respon){
            _this.mdl_input.find('.block-msg').remove();
            _this.mdl_input.find('.modal-body').append(respon);

            _this.form = _this.mdl_input.find('form#form_purchase_order').my_plugins().form();
            _this.table_receive.init(_this.mdl_input.find('table').attr('id'));

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

            let form_data = _this.form_select_po.serialize();
            form_data = object_merge(form_data, _this.form.serialize());
            form_data = object_merge(form_data, _this.table_receive.serialize());

            $.post(admin.page_url, {form_data: form_data}, function(respon){
                if(respon.isOk){
                    bootstrap_toast('success', _this.title, 'New '+ _this.title + ' with Work Order Number ' + form_data.wo_number + ' added');
                    _this.dt_reload();
                    _this.mdl_input.modal('hide');
                } else {
                    bootstrap_toast('error', _this.title, 'Error for try to adding '+ _this.title + ' with Work Order Number ' + form_data.wo_number + '. ' + respon.msg);
                    _this.mdl_input.find('button').removeAttr('disabled');
                }

                btn_save.find('i.fa-spin').remove();
                btn_save.find('i.bi').show();
            }, 'json').fail(function(){
                btn_save.find('i.fa-spin').remove();
                btn_save.find('i.bi').show();
                _this.mdl_input.find('button').removeAttr('disabled');
                bootstrap_toast('error', _this.title, 'An error occurred while attempting to add '+ _this.title + ' with Work Order Number ' + form_data.wo_number + '. Unknow error');
            })
        }
    },
    delete: function(params){
        let _this = this;
        $.post(admin.page_url + '/delete', params, function(respon){
            if(respon.isOk){
                bootstrap_toast('success', _this.title, _this.title + ' with Work Order Number ' + params['Work Order Number'] + ' removed');
                _this.dt_reload();
            } else {
                bootstrap_toast('error', _this.title, 'Error for try to remove '+ _this.title + ' with Work Order Number ' + params['Work Order Number'] + '. ' + respon.msg);
            }
        }, 'json').fail(function(){
            bootstrap_toast('error', _this.title, 'An error occurred while attempting to delete '+ _this.title + ' with Work Order Number ' + params['Work Order Number'] + '. Unknow error');
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
    table_receive: {
        options: {},
        table: null,
        serialize: function(){
            let _this = this;
            let table_data = {
                items: []
            };
            this.table.find('tbody tr').each(function(){
                let item = {
                    id: $(this).attr('data-id'),
                    po_item: $(this).attr('data-po')
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
        init: function(id){
            this.table = $('#'+id);
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
    receive_order.init();
})
$('a[data-aksi="add_new"]').click(function(){
    receive_order.form_input_select_pr();
})
$('body').on('select2:select', 'select[name="purchase_order"]', function(){
    receive_order.form_input(this);
})

$(receive_order._mdl_input).on('click', 'button[data-aksi="mdl_save"]', function(){
    receive_order.form_save();
})
$('body').on('click', 'a[data-aksi="dtrow_lihat"]', function(){
    receive_order.view(this);
})
$('body').on('click', 'a[data-aksi="dtrow_edit"]', function(){
    receive_order.form_input_select_pr(this);
})
$('body').on('click', 'a[data-aksi="dtrow_delete"]', function(){
    let params = JSON.parse(atob(urldecode($(this).closest('.dropdown').attr('data-params'))));
    
    bootbox.confirm('Are you sure to delete ' + receive_order.title + ' with Wordk Order Number <b>' + params['Work Order Number'] + '</b> ?', function (result){ 
        if(result) receive_order.delete(params);
    });
})


