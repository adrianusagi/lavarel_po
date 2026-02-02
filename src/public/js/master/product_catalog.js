var product_catalog = {
    _mdl_input: '#modal_input',
    _mdl_view: '#modal_lihat',
    title: 'Product Catalog',
    dt: null,
    mdl_input: null,
    mdl_view: null,
    form: null,
    view: function(ins){
        let _this = this;
        let params = JSON.parse(atob(urldecode($(ins).closest('.dropdown').attr('data-params'))));

        _this.mdl_view.find('.modal-title').html('Vew Product Catalog' + params['Name']);
        
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
            _this.mdl_input.find('.modal-title').html('Add New ' + _this.title);
        } else {
            params = JSON.parse(atob(urldecode($(ins).closest('.dropdown').attr('data-params'))));
            _this.mdl_input.find('.modal-title').html('Edit ' + _this.title + ' ' + params['Name']);
        }
        
        _this.mdl_input.modal('show');
        _this.mdl_input.find('.modal-body').html('<div class="block-msg"><i class="fa-solid fa-circle-notch fa-spin"></i></div>');
        _this.mdl_input.find('button').prop('disabled', 'disabled');

        $.get(admin.page_url + '/form', params, function(respon){
            _this.mdl_input.find('.modal-body').html(respon);

            _this.form = _this.mdl_input.find('form#form_product_catalog').my_plugins().form();

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
            $.post(admin.page_url, {form_data: form_data}, function(respon){
                if(respon.isOk){
                    bootstrap_toast('success', _this.title, 'New '+ _this.title + ' ' + form_data.name + ' added');
                    _this.dt_reload();
                    _this.mdl_input.modal('hide');
                } else {
                    bootstrap_toast('error', _this.title, 'Error for try to adding '+ _this.title + ' ' + form_data.name + '. ' + respon.msg);
                    _this.mdl_input.find('button').removeAttr('disabled');
                }

                btn_save.find('i.fa-spin').remove();
                btn_save.find('i.bi').show();
            }, 'json').fail(function(){
                _this.mdl_input.find('button').removeAttr('disabled');
                bootstrap_toast('error', _this.title, 'An error occurred while attempting to add '+ _this.title + ' named ' + form_data.name + '. Unknow error');
            })
        }
    },
    delete: function(params){
        let _this = this;
        $.post(admin.page_url + '/delete', params, function(respon){
            if(respon.isOk){
                bootstrap_toast('success', _this.title, _this.title + ' named ' + params['Name'] + ' removed');
                _this.dt_reload();
            } else {
                bootstrap_toast('error', _this.title, 'Error for try to remove '+ _this.title + ' ' + params['Name'] + '. ' + respon.msg);
            }
        }, 'json').fail(function(){
            bootstrap_toast('error', _this.title, 'An error occurred while attempting to delete '+ _this.title + ' ' + params['Name'] + '. Unknow error');
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
    product_catalog.init();
})
$('a[data-aksi="add_new"]').click(function(){
    product_catalog.form_input();
})
$(product_catalog._mdl_input).on('click', 'button[data-aksi="mdl_save"]', function(){
    product_catalog.form_save();
})
$('body').on('click', 'a[data-aksi="dtrow_lihat"]', function(){
    product_catalog.view(this);
})
$('body').on('click', 'a[data-aksi="dtrow_edit"]', function(){
    product_catalog.form_input(this);
})
$('body').on('click', 'a[data-aksi="dtrow_delete"]', function(){
    let params = JSON.parse(atob(urldecode($(this).closest('.dropdown').attr('data-params'))));
    
    bootbox.confirm('Are you sure to delete ' + product_catalog.title + ' named <b>' + params['Name'] + '</b> ?', function (result){ 
        if(result) product_catalog.delete(params);
    });
})