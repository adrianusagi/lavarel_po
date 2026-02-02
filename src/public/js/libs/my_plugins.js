(function ( $ ){
    $.fn.my_plugins = function(){
        this.datatable = function(options,colHide=[]){ 
            let selectorId = null; 
            let attrs = this[0].attributes; 
            if(typeof attrs.id != 'undefined') selectorId = attrs.id.value;
            if($('#' + selectorId).length > 0)
            	return $('#' + selectorId).datatable(options,colHide);
        }
        this.page = function(options=null){
            let selectorId = null; 
            let attrs = this[0].attributes; 
            if(typeof attrs.id != 'undefined') selectorId = attrs.id.value;
            if($('#' + selectorId).length > 0)
                return $('#' + selectorId).page(options);
        }
		this.form = function(options=null){
            let selectorId = null; 
            let attrs = this[0].attributes; 
            if(typeof attrs.id != 'undefined') selectorId = attrs.id.value;

            if($('#' + selectorId).length > 0)
				return $('#' + selectorId).form().init();
		}
		this.summernote = function(){
			if($(this).length == 0) return false;
			return $(this[0]).summernote({
				height:'200px',
				focus: false,
				dialogsInBody : true,
				toolbar:[
					['cleaner',['cleaner']],
					['style', ['style']],
					['0', ['undo','redo']],
					['1', ['bold','italic','underline','clear']],
					['2', ['fontname','fontsize','color']],
					['3', ['ol','ul','paragraph']],
					['4', ['table','link','picture','video','hr']],
					['5', ['fullscreen','codeview']]
				],
				oninit: function() {},
				onChange: function(contents, $editable) {},
				cleaner: {
					action: 'both', // both|button|paste 'button' only cleans via toolbar button, 'paste' only clean when pasting content, both does both options.
					icon: '<i class="note-icon"><svg xmlns="http://www.w3.org/2000/svg" id="libre-paintbrush" viewBox="0 0 14 14" width="14" height="14"><path d="m 11.821425,1 q 0.46875,0 0.82031,0.311384 0.35157,0.311384 0.35157,0.780134 0,0.421875 -0.30134,1.01116 -2.22322,4.212054 -3.11384,5.035715 -0.64956,0.609375 -1.45982,0.609375 -0.84375,0 -1.44978,-0.61942 -0.60603,-0.61942 -0.60603,-1.469866 0,-0.857143 0.61608,-1.419643 l 4.27232,-3.877232 Q 11.345985,1 11.821425,1 z m -6.08705,6.924107 q 0.26116,0.508928 0.71317,0.870536 0.45201,0.361607 1.00781,0.508928 l 0.007,0.475447 q 0.0268,1.426339 -0.86719,2.32366 Q 5.700895,13 4.261155,13 q -0.82366,0 -1.45982,-0.311384 -0.63616,-0.311384 -1.0212,-0.853795 -0.38505,-0.54241 -0.57924,-1.225446 -0.1942,-0.683036 -0.1942,-1.473214 0.0469,0.03348 0.27455,0.200893 0.22768,0.16741 0.41518,0.29799 0.1875,0.130581 0.39509,0.24442 0.20759,0.113839 0.30804,0.113839 0.27455,0 0.3683,-0.247767 0.16741,-0.441965 0.38505,-0.753349 0.21763,-0.311383 0.4654,-0.508928 0.24776,-0.197545 0.58928,-0.31808 0.34152,-0.120536 0.68974,-0.170759 0.34821,-0.05022 0.83705,-0.07031 z"/></svg></i>',
					keepHtml: true,
					keepTagContents: ['span'], //Remove tags and keep the contents
					badTags: ['applet', 'col', 'colgroup', 'embed', 'noframes', 'noscript', 'script', 'style', 'title', 'meta', 'link', 'head'], //Remove full tags with contents
					badAttributes: ['bgcolor', 'border', 'height', 'cellpadding', 'cellspacing', 'lang', 'start', 'style', 'valign', 'width', 'data-(.*?)'], //Remove attributes from remaining tags
					limitChars: 0, // 0|# 0 disables option
					limitDisplay: 'both', // none|text|html|both
					limitStop: false, // true/false
					notTimeOut: 850, //time before status message is hidden in miliseconds
					keepImages: true, // if false replace with imagePlaceholder
					imagePlaceholder: 'https://via.placeholder.com/200'
				},
			});
		}
        this.dropzone = function(){
            if($(this).length == 0) return false;
            let _dzconf = {};
            let dataconfig = $(this[0]).attr('data-config');
            if(typeof dataconfig != 'undefined' && dataconfig != null && dataconfig.length>0)
                _dzconf = JSON.parse(urldecode($(this[0]).attr('data-config')));

            _dzconf.init = function(){
                let tb = $(this.element).closest('div.dz_container').find('.dz_nestable_files').nestable({
                    maxDepth : 1
                });
                $(this.element).closest('div.dz_container').find('.dz_nestable_files ol li').each(function(){
                    $("#dz_file_"+$(this).attr('data-id')).fancybox({
                        helpers : { title : { type : 'over'}}
                    });
                });
                this.on('success',function(file, param){
                    let _file = JSON.parse(param);
                    let ol = $(this.element).closest('div.dz_container').find('.dz_nestable_files ol');
                    let li = $('<li>').addClass('dd-item dd-dz-item').attr('data-id',_file.id).append(
                        `<div class="dd-handle">
                        <i class="fa fa-ellipsis-v"></i>&nbsp;&nbsp;
                        <span><strong>`+_file.filename+`</strong>&nbsp;&nbsp;&nbsp; <small><i class="fa fa-calendar"></i>&nbsp;`+_file.uploaddate+`</small></span>
                        </div>
                        <a href="javascript:;" class="pull-right" style="margin-left:10px" data-aksi="dz_remove"><i class="fa-regular fa-trash-can icon20"></i></a>
                        <a href="javascript:;" class="pull-right hide" style="margin-left:10px" data-aksi="dz_undoremove"><i class="fa-solid fa-rotate-left icon20"></i></a>
                        <a id="dz_file_`+_file.id+`"class="pull-right" href="`+_file.url+`" title="`+_file.filename+`"><i class="fa-regular fa-eye icon20"></i></a>`);
                    ol.append(li[0].outerHTML);
        
                    $("#dz_file_"+_file.id).fancybox({
                        helpers : { title : { type : 'over'}}
                    });

                    if(typeof _dzconf.onsuccess_callback != 'undefined' && _dzconf.onsuccess_callback != null && typeof window[_dzconf.onsuccess_callback] == 'function') window[_dzconf.onsuccess_callback](file, param);
                })
            }
            
            return $(this[0]).dropzone(_dzconf);
        }
        this.datetimepicker = function(args = null){
            let selectorId = null; 
            let attrs = this[0].attributes; 
            if(typeof attrs.id != 'undefined') selectorId = attrs.id.value;
            if($('#' + selectorId).length > 0){
                let _val = $('#' + selectorId).find('input').val();
                if((args == null || typeof args.date == 'undefined') && _val != null && _val.length > 0){
                    if(args == null) args = {date: _val}
                    else args.date = _val;
                }
                return $('#' + selectorId).datetimepicker({
                    format: 'DD MMMM YYYY HH:mm', 
                    showTodayButton: true,
                    showClear: true, 
                    allowInputToggle: true, 
                    icons: {
                        time: "fa-regular fa-clock",
                        date: "fa-regular fa-calendar",
                        up: "fa-solid fa-angle-up",
                        down: "fa-solid fa-angle-down",
                        today: "fa-regular fa-calendar-plus"
                    },
                    date: (args != null && typeof args.date != 'undefined' ? args.date : null)
                });
            }
        }
        this.select2 = function(args = null){
            let selectorId = null;
            if(this.length > 0 && typeof this[0].attributes != 'undefined'){
                let attrs = this[0].attributes;
                if(typeof attrs.id != 'undefined') selectorId = attrs.id.value;

                var opt = $('#' + selectorId).attr('data-options');
                if(opt!=null) opt=JSON.parse(urldecode(opt));
                var isdefval = false;
                var _conf = $('#' + selectorId).attr('data-config');
                var conf = {};
                if(typeof _conf != 'undefined' && _conf != null) var conf = JSON.parse(urldecode(_conf));
                if($('#' + selectorId).find('option:not([value=""])').length==1 && $('#' + selectorId).attr('required')=='required'){
                    isdefval = true;
                }

                let _isModal = $('#' + selectorId).closest('.modal');
                if(typeof _isModal != 'undefined' && _isModal.length>0){
                    if(typeof opt != 'object') opt = {};
                    opt.dropdownParent = $('#'+_isModal.attr('id'));
                }

                let $sel = $('#' + selectorId).select2(opt);

                let _val = $sel.attr('data-value');

                if(isdefval) $sel.val($sel.find('option:not([value=""])').attr('value')).trigger('change.select2');
                else if($sel.attr('data-value') != '' && typeof _val != 'undefined'){
                    if(is_validJson(urldecode(_val)) && $sel.prop('multiple')) $sel.val(JSON.parse(urldecode(_val))).trigger('change.select2');
                    else if($sel.find('option[value="'+_val+'"]').length >0) $sel.val(_val).trigger('change.select2');
                }else $sel.val(null).trigger('change.select2');
            
                if(typeof conf.inited != 'undefined' && conf.inited != null && typeof window[conf.inited] == 'function'){
                    window[conf.inited]($('#' + selectorId));
                }
            }
        }
        this.menu_builder = function(args = null){
            return $(this[0]).nestable({});
        },
        this.teamsinput = function(args = null){
            return $(this[0]).nestable({maxDepth: 1});
        },
        this.datepicker = function(options=null){
            let selectorId = null;
            if(this.length > 0 && typeof this[0].attributes != 'undefined'){
                let attrs = this[0].attributes;
                if(typeof attrs.id != 'undefined') selectorId = attrs.id.value;

                if($('#' + selectorId).length>0 && !$('#' + selectorId).hasClass('inited')){
                    $_dp = $('#' + selectorId).datepicker({startView: 1,format:'dd/mm/yyyy',autoclose:true,todayBtn:'linked'});
                    if($('#' + selectorId).val().length>0)
                    $_dp.datepicker('update',date_jsFromMysql($('#' + selectorId).val()));
                    $(this.selector).addClass('inited');
                    return $_dp; 
                }
            }
        }
        this.timepicker = function(options=null){
            if($(this.selector).length>0){
            $_dp = $(this.selector).datetimepicker({format:'HH:mm',showClear:true,allowInputToggle:true});
            return $_dp; 
            }
        }
        this.switch = function(options=null){
            if($(this.selector).length>0)
            return $(this.selector).bootstrapToggle();
        }
        this.icheck = function(options=null){
            if($(this.selector).length>0 && $(this.selector).attr('type')=='radio')
            return $(this.selector).iCheck({radioClass:"iradio_flat-blue"});
            else if($(this.selector).length>0 && $(this.selector).attr('type')=='checkbox')
            return $(this.selector).iCheck({checkboxClass:"icheckbox_flat-blue"});
        }
        this.adminpanel = function(){
            if($(this.selector).length>0){
            $(this.selector).find('.panel').attr('data-panel-remove','false').attr('data-panel-title','false');
            return $(this.selector).closest('div').adminpanel().init(); 
            }
        }
        this.magnific = function(){
            $(this.selector).find('img').magnificPopup({
            type: 'image',
            callbacks: {
                beforeOpen: function(e) {
                $('body').addClass('mfp-bg-open');
    
                this.st.mainClass = 'mfp-zoomIn';
    
                this.contentContainer.addClass('mfp-with-anim');
                },
                afterClose: function(e) {
    
                setTimeout(function() {
                    $('body').removeClass('mfp-bg-open');
                    $(window).trigger('resize');
                }, 1000)
    
                },
                elementParse: function(item) {
                item.src = item.el.attr('src');
                },
            },
            overflowY: 'scroll',
            removalDelay: 200, //delay removal by X to allow out-animation
            prependTo: $('#content_wrapper')
            });
        }
        this.spinner = function(options = null){
            $(this.selector).spinner(options);
        }
        this.money = function(){
            var _val = $(this).attr('data-value');
            $(this).val(number_to_currency(_val));
        }
        this.optuserdefined = function(){
            if($(this.selector).length>0)
            return $(this.selector).nestable({maxDepth : 1,group:$(this.selector).attr('name')});
        }
        this.zukodoc = function(options=null){
            if($(this.selector).length>0)
            return $(this.selector).zukodoc(options);
        }
        this.imgpicker = function(options=null){
            let selectorId = null;
            if(this.length > 0 && typeof this[0].attributes != 'undefined'){
                let attrs = this[0].attributes;
                if(typeof attrs.id != 'undefined') selectorId = attrs.id.value;

                $('#' + selectorId).find('img').each(function(){
                    let _id = $(this).closest('.img-item').attr('data-id');
                    const myImage = document.getElementById($(this).attr('id'));
                    if (myImage) {
                        myImage.addEventListener('load', function() {
                            let img_width = $(this).width();
                            $(this).closest('div').find('span').css('width', img_width);

                            $("#cardfancy_" + _id).fancybox({
                                helpers : { title : { type : 'over'}}
                            });
                        });
                    }
                })
            }
        }
        this.itembuilder = function(options=null){
            let selectorId = null;
            if(this.length > 0 && typeof this[0].attributes != 'undefined'){
                let attrs = this[0].attributes;
                if(typeof attrs.id != 'undefined') selectorId = attrs.id.value;

                input_item_builder.init(selectorId);
            }
        }
        return this;
    }
  }(jQuery));
  
(function ( $ ){
    $.fn.form = function(){
      	let _this=this;
		let selector = null;
		this.init = function(){
			let selectorId = null; 
            let attrs = this[0].attributes; 
            if(typeof attrs.id != 'undefined') selectorId = attrs.id.value;
			if($('#' + selectorId).length > 0) _this.selector = '#' + selectorId;
			
			/** datepicker */
			$(this.selector).find(".my-date-picker, .my-daterange-picker").each(function(){
				$(_this.selector+' input[name="'+$(this).attr('name')+'"]').my_plugins().datepicker();           
			});
			/** timepicker */
			$(this.selector).find(".my-time-picker, div.my-timerange-picker").each(function(){
				$(this.selector).find('#'+$(this).attr('id')).my_plugins().timepicker();        
			});
            /** datetimepicker */
            $(_this.selector).find(".my-datetime-picker").each(function(){
                $(_this.selector+' #'+$(this).attr('id')).my_plugins().datetimepicker();           
            });
			/** switch */
			$(this.selector).find(".toggle").my_plugins().switch();
			/** icheck */
			$(this.selector).find('input[type="radio"].my-icheck').my_plugins().icheck();
			$(this.selector).find('input[type="checkbox"].my-icheck').my_plugins().icheck();
			/** select2 */
			$(_this.selector).find(".my-select2").each(function(){
				$(_this.selector+' #'+$(this).attr('id')).my_plugins().select2();
			})
			/** Dropzone */
			$(_this.selector).find(".dropzone").each(function(){
                $(this).my_plugins().dropzone();
			})
            /** Menu Builder */
			$(_this.selector).find(".menu_builder").each(function(){
                $(this).my_plugins().menu_builder();
			})
            /** Teams Input */
            $(_this.selector).find(".teamsinput").each(function(){
                $(this).my_plugins().teamsinput();
			})
			/** magnific */
			if($(this.selector).find('.my-magnific').length > 0)
				$(this.selector).find('.my-magnific').my_plugins().magnific();
			/** money */
			$(this.selector).find('input[data-type="money"]').each(function(){
				$(this).my_plugins().money();
			})
			/** spinner */
			//$(_this.selector).find(".ui-spinner-input").spinner({min:0});
			//$(_this.selector).find(".ui-spinner-input-persen").spinner({min:0,max:100});
			/** Summernote */
			$(_this.selector).find('div.my-summernote').each(function(){
				$(this).my_plugins().summernote();
			})
			/** User defined options */
			$(this.selector).find(".opt-user-defined").each(function(){
				$(this.selector).find('div.opt-user-defined[name="'+$(this).attr('name')+'"]').my_plugins().optuserdefined();
			})
			/** Zuko docs */
			$(this.selector).find('div.zuko-doc').my_plugins().zukodoc();

            $(this.selector).find('textarea').each(function(){
                let dataval = $(this).attr('data-value');
                if(typeof dataval == 'string'){
                    /** Restore html entities */
                    dataval = dataval.replaceAll('&qu-adr-ot;','&quot;');
                    dataval = urldecode(dataval);

                    let dataencode = $(this).attr('data-encode');
                    if(typeof dataencode == 'string' && dataencode == 'uriencode'){
                        dataval = decodeURI(dataval);
                    }

                    $(this).val(dataval);
                }
            })

            $(this.selector).find('.form-image-picker').each(function(){
                $(this).my_plugins().imgpicker();
            })

            $(this.selector).find('.form-item-builder').each(function(){
                $(this).my_plugins().itembuilder();
            })
			return _this;
		}
		this.validate = function(){
            if(_this.selector == null && typeof this[0] != 'undefined'){
                let selectorId = null; 
                let attrs = this[0].attributes; 
                if(typeof attrs.id != 'undefined') selectorId = attrs.id.value;
                if($('#' + selectorId).length > 0) _this.selector = '#' + selectorId;
            }
            
			let isHasError = false;
    		_this.reset_validate();

			/** Reqired checks */
			$(_this.selector).find('input,select,textarea,.dropzone,.my-summernote').each(function(){
				let _val = null;
				let _msg = null;
				if($(this).attr('required')!='required') return true;
				
				let frm_grp=$(this).closest('.form-col');

				if($(this).hasClass('my-daterange-picker')){
					_val=$(this).datepicker('getDate');
				}else if($(this).hasClass('my-date-picker')){
					_val=$(this).datepicker('getDate');
				}else if($(this).hasClass('dropzone')){
					_val=$(this).closest('.col-inp').find('.dz_nestable_files li.dd-dz-item:not(.dz_removed)').length;
				}else if($(this).hasClass('my-summernote')){
					if($(this).summernote('isEmpty')) _val= null; else _val = 'not null';
				}else if(in_array($(this).attr('type'),['radio'])){
					$(_this.selector).find('input[name="'+$(this).attr('name')+'"]').each(function(){
						if($(this).is(':checked')){
						_val=$(this).val();
						return false;
						}
					})
				}else if(in_array($(this).attr('type'),['checkbox'])){
					_val = null;
					var _minsel = parseInt($(this).attr('data-selected-min'));
					if(typeof _minsel == 'undefined' || _minsel == null || _minsel=='' || isNaN(_minsel)) _minsel = 1;
					var _nch = 0;
					$(_this.selector).find('input[name="'+$(this).attr('name')+'"]').each(function(){
						if($(this).is(':checked')){
						_nch++;
						}
					})
					if(_minsel<=_nch){ 
						_val=_nch;
					}else{
						_msg = "Pilih paling sedikit "+_minsel;
						_val = null;
					} 
				}else{
					_val=$(this).val();
				}
		
				if(_val==null || _val==''){
					isHasError=true;
					let frm_lbl='Field '+frm_grp.find('label').html()+' is required.';
					if(_msg!= null) frm_lbl = _msg; 
					
                    $(this).addClass('is-invalid');
                    $(this).closest('.form-group').append(`<div class="invalid-feedback">
                                    <i class="bx bx-radio-circle"></i>
                                    ` + frm_lbl + `
                                </div>`);
				}else{
					$(this).addClass('is-valid')
				}
			})
			
			/* HANDLE MAX SELECTED MULTIPLE SELECT2 */
			$(_this.selector).find('select').each(function(){
				let selmax = parseInt($(this).attr('data-selected-max'));
				if(typeof selmax!= 'undefined' && !isNaN(selmax)){
				let vlen = $(this).val().length;
				if(vlen != null && vlen>selmax){
					isHasError = true;
					let _msg = 'Pilih tidak lebih dari '+selmax+' pilihan';
					let frm_grp=$(this).closest('div.form-group');
					frm_grp.addClass('has-danger');
					if(frm_grp.find('.col-inp').find('.hlp-msg').length==0){
						let _lbl = '<div class="form-control-feedback hlp-msg">'+_msg+'</div>';

						if(frm_grp.find('.col-inp').find('.text-hint').length>0) frm_grp.find('.text-hint').before(_lbl);
						else frm_grp.find('.col-inp').append(_lbl);  
					}
				}
				}
			})

            /** JSON validator */
            $(_this.selector).find('[data-validate="json"]').each(function(){
                let _val = $(this).val();
                if(_val != null && _val.length > 0){
                    if(!is_validJson(_val)){
                        isHasError = true;
                        let frm_grp=$(this).closest('div.form-group');
					    frm_grp.addClass('has-danger');
                        let _lbl = '<div class="form-control-feedback hlp-msg">Invalid JSON string</div>';
                        
                        if(frm_grp.find('.col-inp').find('.text-hint').length>0) frm_grp.find('.text-hint').before(_lbl);
						else frm_grp.find('.col-inp').append(_lbl);
                    }
                }
            })
			
			if(isHasError){
			var _target=$(_this.selector).find('.has-danger:first'); 
	
			var is_inTab=$(_this.selector).closest('.tab-pane');
			if(is_inTab.hasClass('tab-pane')){
				openTab=is_inTab.attr('id');
				tab=is_inTab.closest('div.panel');
				tab.find('ul.nav li.active').removeClass('active');
				tab.find('div.tab-pane.active').removeClass('active');
	
				tab.find('a[href="#'+openTab+'"]').closest('li').addClass('active');
				tab.find('div#'+openTab).addClass('active');
			}
	
			var is_inModal=$(_this.selector).closest('.modal');
			if(is_inModal.hasClass('modal')){
				var scrollIn=is_inModal;
			}else{
				var scrollIn=$('html, body');
			}
	
			scrollIn.animate({
				scrollTop :$(_target).offset().top - 100
			},1000);
			}
			return !isHasError;
		}
		this.reset = function(){
			_this.reset_validate();
			_this.clear();
			_this.open_first_tab();
		}
		this.open_first_tab = function(){
			var is_inTab=$(this.selector).closest('.tab-pane');
			if(is_inTab.hasClass('tab-pane')){
			tab=is_inTab.closest('div.panel');
			tab.find('ul.nav li.active').removeClass('active');
			tab.find('div.tab-pane.active').removeClass('active');
	
			tab.find('ul.nav').find('li:first').addClass('active');
			tab.find('.tab-pane:first').addClass('active');
			}
		}
		this.reset_validate = function(){
			$(_this.selector).find('.is-invalid,.is-valid').removeClass('is-invalid').removeClass('is-valid');
			$(_this.selector).find('.invalid-feedback').remove();
		}
		this.clear = function(){
			$(this.selector).find('input,select,textarea,.my-summernote').each(function(){
                let _defval = $(this).attr('def-value');
                if(typeof _defval != 'undefined' && _defval != null && _defval != ''){
                    $(this).val(_defval);
                }else if($(this).hasClass('my-date-picker')){
                    $(this).datepicker('clearDates');
                }else if($(this).hasClass('my-select2')){
                    $(this).val(null).trigger('change');
                }else if($(this).hasClass('my-icheck')){
                    $(this).iCheck('uncheck');
                }else if($(this).hasClass('my-summernote')){
                    $(this).summernote('reset');
                }else if($(this).attr('type') == 'radio'){
                    $(this).removeAttr('checked');
                } else{
                    $(this).val('');
                }
			})
		}
		this.serialize = function(args = {}){
            if(_this.selector == null && typeof this[0] != 'undefined'){
                let selectorId = null; 
                let attrs = this[0].attributes; 
                if(typeof attrs.id != 'undefined') selectorId = attrs.id.value;
                if($('#' + selectorId).length > 0) _this.selector = '#' + selectorId;
            }

			var data={};
			$(_this.selector).find('input,select,textarea,div.dropzone,div.my-summernote,div.opt-user-defined,div.zuko-doc,div.form-container-dosbinglogbook,div.my-datetime-picker,div.menu_builder,.teamsinput,.form-image-picker,.form-item-builder').each(function(){
				_name=$(this).attr('name');
				if(typeof _name=='undefined') return;

				if(isStrContain(_name,'template') || $(this).hasClass('skip-basic-serialize')) return;
                if(typeof args == 'object' && typeof args.only_if_has_class == 'string' && args.only_if_has_class.length>0){
                    if($(this).hasClass(args.only_if_has_class)){

                    } else {
                        return;
                    }
                } else {
                    if($(this).parent().closest('.form-item-builder').length>0){
                        return;
                    }
                }
				
				if($(this).attr('data-type')=='money'){
					data[_name]=$(this).attr('data-value');
				}else if($(this).hasClass('my-timerange-picker')){
					_name=$(this).attr('data-attr');
					var $cnt = $(this).closest('div.col-inp');
					data[_name] = {start:null,end:null};
					$cnt.find('input').each(function(i){
					if(i==0) data[_name]['start'] = $(this).val();
					else data[_name]['end'] = $(this).val();  
					})
				}else if($(this).hasClass('my-daterange-picker')){
					_name=$(this).attr('data-attr');
					var $cnt = $(this).closest('div.col-inp');
					data[_name] = {start:null,end:null};
					$cnt.find('.my-date-picker').each(function(i){
					_date=$(this).datepicker('getDate');
					if(_date==null||isNaN(_date.getMonth())) val=null; else val=date_jsToMysql(new Date(_date));
					if(i==0) data[_name]['start'] = val;
					else data[_name]['end'] = val;  
					})
				}else if($(this).hasClass('my-date-picker')){
					_date=$(this).datepicker('getDate');
					if(_date==null||isNaN(_date.getMonth())) val=null; else val=date_jsToMysql(new Date(_date));
					data[_name]=val;
				}else if($(this).hasClass('my-datetime-picker')){
                    _date=$(this).data('DateTimePicker').date();
                    let val = null;
                    if(_date != null && typeof _date._d != 'undefined' && _date._d != null){
                        val = datetime_jsToMysql(new Date(_date._d));
                    }
					data[_name]=val;
                }else if($(this).hasClass('opt-user-defined')){
					var _val = [];
					$(this).find('.dd-item').each(function(){
						var _check = {};
						$(this).find('div.opt-checks').each(function(){
							_check[$(this).attr('data-name')] = ['']; 
							$(this).find('input[type="checkbox"]:checked').each(function(){
								_check[$(this).attr('data-name')].push($(this).attr('data-value'));
							})
						})
						_val.push({
							'id':$(this).attr('data-id'),
							'option':$(this).find('input[type="text"]').val(),
							'isAktif':$(this).find('input[type="text"]').attr('data-isaktif'),
							'tags':$(this).find('input[type="text"]').attr('data-tags'),
							'checks':_check,
						})
					})
					if(_val.length==0) _val = '';
					data[_name] = _val;    
				}else if($(this).hasClass('select-options-customopt')){
					var _opttags = $(this).find('option[value="'+$(this).val()+'"]').attr('data-tags');
					if(typeof _opttags != 'undefined' && _opttags != null && isStrContain(_opttags,'[opt_others_by_users]')){
						data[_name] = $(this).closest('.col-inp').find('input[type="text"]').val();
					}else data[_name] = $(this).val();
				}else if($(this).hasClass('toggle')){
					if($(this).is(':checked')) data[_name]=$(this).attr('data-true');
					else data[_name]=$(this).attr('data-false');
				}else if($(this).attr('type')=='radio'){
					if($(this).is(':checked')) data[_name]=$(this).val();
				}else if($(this).attr('type')=='checkbox'){
					if($(this).is(':checked')){
					if(typeof data[_name]=='undefined') data[_name]=[$(this).val()];
					else data[_name].push($(this).val())
					};
				}else if($(this).hasClass('dropzone')){
					var $cnt = $(this).closest('.dz_container');
					var file = [];
					$cnt.find('.dz_nestable_files ol li').each(function(){
					if($(this).hasClass('dz_removed')){
						//do nothing
					}else file.push($(this).attr('data-id'));
					})
					if(file.length > 0)
					data[_name] = file;
					else data[_name] = '[NULL]';
				}else if($(this).hasClass('my-summernote')){
					data[_name] = $(this).summernote('code');
				}else if($(this).hasClass('zuko-doc')){
					data[_name] = {id : $(this).attr('data-docid'), 'url': $(this).attr('data-docurl')};
				}else if($(this).hasClass('form-container-dosbinglogbook')){
					let __name = $(this).attr('data-name');
					let _data = [];
					$(this).find('.form-group').each(function(){
					let _dosbing = {};
					$(this).find('select').each(function(){
						_dosbing[$(this).attr('name')] = $(this).val();
					})
					_data.push(_dosbing);
					})
					data[__name] = _data;
				}else if($(this).hasClass('menu_builder')){
                    $(this).find('.dd-item').find('input').each(function(){
                        let __name = $(this).attr('name');
                        $(this).closest('.dd-item').attr('data-' + __name, $(this).val());
                    })
                    data[_name] = {menu_builder: $(this).nestable('serialize')};
                }else if($(this).hasClass('teamsinput')){
                    $(this).find('.dd-item').find('input').each(function(){
                        let __name = $(this).attr('name');
                        if($(this).attr('type') == 'checkbox'){
                            if($(this).is(':checked')) $(this).closest('.dd-item').attr('data-' + __name, 'true');
                        }else $(this).closest('.dd-item').attr('data-' + __name, $(this).val());
                    })
                    data[_name] = $(this).nestable('serialize');
                }else if($(this).hasClass('form-image-picker')){
                    let val = null;
                    
                    if($(this).find('.img-item').length > 0){
                        let maxlength = $(this).attr('maxlength');
                        let isMulti = false;
                        if(typeof maxlength != 'undefined' && maxlength != null && maxlength != ''){
                            maxlength = parseInt(maxlength);
                            if(typeof maxlength == 'number' && !isNaN(maxlength) && maxlength == 1){
                                $(this).find('.img-item').each(function(){
                                    val = $(this).attr('data-id');
                                })
                            } else isMulti = true;
                        } else isMulti = true;

                        if(isMulti){
                            val = [];
                            $(this).find('.img-item').each(function(){
                                val.push($(this).attr('data-id'));
                            })
                        }
                    }
                    
                    data[_name] = val;
                } else if($(this).hasClass('form-item-builder')){
                    let __name = _name;
                    
                    let _arr_vals = [];
                    $(this).find('.item-builder-item').each(function(){
                        let _itemid = $(this).attr('id');
                        let _values = _this.serialize({only_if_has_class: _itemid});
                        _arr_vals.push(_values);
                    }) 
                    data[__name] = JSON.stringify(_arr_vals);
                } else if(typeof $(this).attr('data-name-json') != 'undefined'){
                    let __name = $(this).attr('data-name-json');
                    if(typeof data[__name] == 'undefined') data[__name] = {};
                    data[__name][_name] = $(this).val();
                } else{
                    let _val = $(this).val();

                    let dataencode = $(this).attr('data-encode');
                    if(typeof dataencode == 'string' && dataencode == 'uriencode') _val = encodeURI(_val);

					data[_name] = _val
				}
		
				if($(this).prop('tagName')=='SELECT'){
					var $opt = $(this).find('option:selected');
					if(typeof $opt !== 'undefined' && $opt.length>0){
					$.each($opt.data(),function(i,val){
						if(i.substr(0,9).toLowerCase()=='serialize'){
							data[i.substr(9)] = val;
						}
					})  
					} 
				}
			})
			return data;
		}
		this.is_empty = function(){
			var _this=this;
			var data=this.serialize();
			var is=true;
			$.each(data,function(i,val){
			if(val==null || val=='' || $(this).attr('type')=='hidden'){
				//do nothing
			}else{
				if($(_this.selector).find('[name="'+i+'"]').attr('type')=='hidden'){
				// do nothing
				}else{
				is=false;
				return false;
				}
			}
			})
			return is;
		}
		this.setdata = function(data){
			var _this=this;
			this.clear();
			$.each(data,function(i,val){
                if(val!=null && val!=''){
                    var $inp=$(_this.selector).find('[name="'+i+'"]');
                    if($inp.hasClass('my-select2')){
                        if($inp.prop('multiple')){
                            $inp.val(JSON.parse(val)).trigger('change');
                        }else{
                            $inp.val(val).trigger('change');
                        }
                    } else if($inp.hasClass('my-date-picker')){
                        $inp.datepicker('update',new Date(val));
                    } else if($inp.hasClass('toggle')){
                        if($inp.attr('data-true')==val)
                            $inp.bootstrapToggle('on');
                        else $inp.bootstrapToggle('off');
                    } else if($inp.hasClass('my-icheck')){
                        $inp.iCheck('uncheck');
                        if(typeof val === 'object'){
                            $.each(val, function(_i,_v){
                            $(_this.selector).find('[name="'+i+'"][value="'+_v+'"]').iCheck('check');    
                            })
                        }else
                            $(_this.selector).find('[name="'+i+'"][value="'+val+'"]').iCheck('check');
                    } else if($inp.hasClass('my-summernote')){
                        $inp.summernote('code', val);
                    } else if($inp.attr('type') == 'radio'){
                        $(_this.selector).find('[name="' + i + '"]').each(function(){
                            if($(this).attr('value') == val){
                                $(this).prop('checked', true);
                            }
                        })
                    } else{
                        $inp.val(val);
                    }
                }
			})
		}
		return this;
    }
}(jQuery));
  
(function ( $ ){
    $.fn.datatable = function(options, colHide=[]){
        let selector = null;

        let selectorId = null; 
        let attrs = this[0].attributes; 
        if(typeof attrs.id != 'undefined') selectorId = attrs.id.value;
        if($('#' + selectorId).length > 0){
            selector = '#'+selectorId;
        } else return false;

        let _dt = null;
        let _body = null;
        let _opt = object_merge(options,{
            buttons : [
            {extend: "print"},
            {extend: "copy"},
            {extend: "csv"},
            {extend: "excel"},
            {extend: "pdf"},
            {extend: "colvisRestore"},
            ],
            colReorder : true,
            columnDefs : [],
            aLengthMenu : [[10, 50, 100, 150, 200, 300, -1], [10, 50, 100, 150, 200, 300, "All"]],
        });
        let _n_toolsBtn = _opt.buttons.length;
      
        let that = this;
        this.colreorderorder = [];
        this.cols = [];
        this.holdDraw = false;
      
        if(typeof options != 'undefined') _opt.basic = options.basic || null;
      
        if(typeof options =='object' && typeof options.url == 'string'){
            _opt.serverSide = true;
            _opt.ajax = {
                url: options.url,
                data: function(d){
                    d.colreorder=that.colreorderorder;
        
                    if(typeof options.ajax_params == 'object')
                    d.app_params = options.ajax_params;
                    if(typeof options.ajax_params_selector == 'object'){
                        $.each(options.ajax_params_selector, function(idx, selector){
                            let _index = $(selector).attr('data-index');
                            if(typeof _index == 'undefined' || _index == null || _index == '' || _index.length == 0 )
                            _index = $(selector).attr('name');
                            d.app_params[_index] = $(selector).val();
                        })
                    }
                }
            }
        }
        if(typeof options =='object' && typeof options.order !== 'undefined'){
            _opt.order = options.order;
        }

        if(typeof options =='object' && typeof options.dt_max_colvis !== 'undefined'){
            _opt.dt_max_colvis = options.dt_max_colvis;
        }else _opt.dt_max_colvis = _page_info._configs.dt_max_colvis;
        
        /** Add column filter at footer */ 
        this.addColumnFilter = function(){
            $(selector).find('tfoot').html('<tr></tr>');
            let tfoot = $(selector).find('tfoot tr');
            $(selector).find('thead th').each(function(){
                let title = $(this).text();
                that.cols.push(title);
                if($(this).attr('data-dt') == 'dont-filter')
                    tfoot.append('<th></th>');
                else
                    tfoot.append('<th><input class="form-control" type="text" placeholder="Filter '+title+'" /></th>' );
            })
            that.addColvisBtn();
        }
    
        this.addColvisBtn = function(){
            let _col = '';
            $.each(that.cols,function(i,val){
                if(!in_array(val,colHide))
                    _col += '<a href="javascript:;" class="dropdown-item dt_btn_tools" data-aksi="'+(i+_n_toolsBtn)+'">'+val+'</a>';
            })

            if($(selector).closest('.m-portlet').find('.m-portlet__head .m-portlet__head-tools').length == 0)
                $(selector).closest('.m-portlet').find('.m-portlet__head').append(`<div class="m-portlet__head-tools">
                        <div class="btn-group" role="group"></div>
                    </div>`);
            $(selector).closest('.m-portlet').find('.m-portlet__head-tools .btn-group:first').append(`<div class="btn-group bg-dt-colvis" role="group">
                    <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa-regular fa-eye"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 45px, 0px);">
                        ` + _col + `
                    </div>
                </div>`);
            that.addToolsBtn();
        }

        /** Add tools button */ 
        this.addToolsBtn = function(){
            $(selector).closest('.m-portlet').find('.m-portlet__head .btn-group:first').append(`
                <div class="btn-group btn-dt-panel-head" role="group">
                    <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa-solid fa-screwdriver-wrench"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 45px, 0px);">
                        <a href="javascript:;" class="dropdown-item dt_btn_tools" data-aksi="dt_reload"><i class="fa-solid fa-rotate"></i>&nbsp; Refresh</a>
                        <a href="javascript:;" class="dropdown-item dt_btn_tools" data-aksi="5"><i class="fa fa-columns"></i>&nbsp; Reset Columns</a>
                        <a href="javascript:;" class="dropdown-item dt_btn_tools" data-aksi="1"><i class="fa-regular fa-copy"></i>&nbsp; Copy</a>
                        <a href="javascript:;" class="dropdown-item dt_btn_tools" data-aksi="0"><i class="fa-solid fa-print"></i>&nbsp; Print</a>
                        <a href="javascript:;" class="dropdown-item dt_btn_tools" data-aksi="2"><i class="fa-solid fa-file-csv"></i>&nbsp; Export CSV</a>
                        <a href="javascript:;" class="dropdown-item dt_btn_tools" data-aksi="3"><i class="fa-solid fa-file-excel"></i>&nbsp; Export Excel</a>
                        <a href="javascript:;" class="dropdown-item dt_btn_tools" data-aksi="4"><i class="fa-solid fa-file-pdf"></i>&nbsp; Export Pdf</a>
                        <a href="javascript:;" class="dropdown-item dt_btn_tools" data-aksi="dt_savedsetting"><i class="fa-regular fa-floppy-disk"></i>&nbsp; Save Setting</a>
                        <a href="javascript:;" class="dropdown-item dt_btn_tools" data-aksi="dt_resetsetting"><i class="fa-solid fa-broom"></i>&nbsp; Reset Setting</a>
                    </div>
                </div>`);
            that.handle_btn_color();
        }

        this.handle_btn_color = function(){
            /** the method used to adapt the button color if the panel header color changed */
            that.get_columnDef();
        }
        //Add colvis buttons
         
        this.get_columnDef = function(){
            $.each(that.cols,function(i,val){
            if(in_array(val,colHide)){
                _opt.columnDefs.push({targets:[i],visible:false});
            }else if(['aksi','menus'].includes(val.toLowerCase())){
                _opt.columnDefs.push({targets:[i],visible:true,orderable:false});
            }else if((i-colHide.length) < _opt.dt_max_colvis) {
                _opt.columnDefs.push({targets:[i],visible:true});
            } else {
                _opt.columnDefs.push({targets:[i],visible:false})
            }; 
            _opt.buttons.push({extend: "columnToggle", columns : i});
            })
            that.init();
        }
    
        this.colvisstate = function(){
            _dt.columns().flatten().each(function(i){ 
                let btn_colvis=$(selector).closest('.m-portlet').find('.bg-dt-colvis [data-aksi="'+ ( i + _n_toolsBtn ) + '"]');
                if(_dt.column(i).visible())
                    btn_colvis.removeClass('inactive');
                else btn_colvis.addClass('inactive');
            })
        },
    
        this.init = function(){
            _dt=$(selector).DataTable(_opt);
            if(_opt.basic) return false;
            
            _dt.columns().flatten().each( function ( colIdx ) {
                $( 'input', _dt.column(colIdx).footer() ).on( 'change', function () {
                    _dt.columns().every(function(i){
                        _dt.column(that.colreorderorder[i]).search($(this.footer()).find('input').val())
                    })
                    _dt.draw();
                });
            });
            _dt.on('preDraw', function(){
                if(that.holdDraw) return false;
                that._body.block();
            })
            _dt.on('draw',function(){
                that.colreorderorder = _dt.colReorder.order();
                //$(this.selector).find('input.toggle').my_plugins().switch();
        
                /** load user settings */ 
                //if(_dt.ajax.params().draw == 1) that.loadDtUserSetting();
                
                /** onDraw callback */
                if(typeof _opt.ondraw_callback != 'undefined' && _opt.ondraw_callback != null && typeof window[_opt.ondraw_callback] == 'function') window[_opt.ondraw_callback]();

                that._body.unblock();
            });
            _dt.on('column-visibility.dt',function(e, settings, column, state){
                _dt.columns.adjust().draw();
                let btn_colvis = $(selector).closest('.m-portlet').find('.bg-dt-colvis [data-aksi="'+(column+_n_toolsBtn)+'"]');
                if(state)
                    btn_colvis.removeClass('inactive');
                else btn_colvis.addClass('inactive');
            })
            _dt.on('column-reorder',function(e, settings, details){
                that.colreorderorder=_dt.colReorder.order();
            });
            
            $(selector).closest('.m-portlet').find('.m-portlet__head').on('click','a.dt_btn_tools', function(){
                let act=$(this).attr('data-aksi');
                if(act == 'dt_savedsetting') that.saveDtUserSetting();
                if(act == 'dt_resetsetting') that.resetDtUserSetting();
                if(act == 'dt_reload') that.reload();
                
                _dt.button(act).trigger();
                if(parseInt(act)>=_n_toolsBtn) return false;
            })
            that.colvisstate();
            this._dt  = _dt;
    
            this._body = $(selector+'_wrapper').my_plugins().page();

            $(selector+'_wrapper').addClass('dt-bootstrap4').removeClass('form-inline');
            
            this.loadDtUserSetting();
        }
        
        this.reload = function(){
            _dt.ajax.reload(null,false);
        }
    
        this.saveDtUserSetting = function(){
            let _cols = [];
            _dt.columns().every( function () {
                _cols.push({
                    index: that.colreorderorder[this.index()],
                    visible: this.visible(),
                    title: $(this.header()).html(),
                })
            });
            _settings = {
                'colVis': JSON.stringify(_cols),
                'colReorder': JSON.stringify(_dt.colReorder.order()),
                session: this.attr('data-session'),
            }
            $.post('/adminapp/dt_saveusersettings', _settings, function(respon){
                let _id = uniqid();
                that.closest('.panel').find('.panel-body').prepend(`<div class="alert alert-info pastel alert-dismissable text-center" id="`+_id+`">
                    <i class="fa fa-info pr10"></i>
                    <strong>Datatable user settings been saved.</strong>
                </div>`);
                setTimeout(function(){
                    $('div#'+_id).remove();
                },'3000');
            },'json').fail(function(){
    
            })
        }
    
        this.loadDtUserSetting = function(){
            that.holdDraw = false;
            $.get('/adminapp/dt_getusersettings',{session: this.attr('data-session')}, function(respon){
                that.holdDraw = true;
                if(respon){
                    $.each(respon.colVis, function(idx, val){
                        if(val.visible === true)
                            _dt.column( val.index ).visible( true );
                        else _dt.column( val.index ).visible( false);
                    })
                    _dt.colReorder.order( respon.colReorder );
                }
                that.holdDraw = false;
                _dt.ajax.reload(null,false);
            },'json').fail(function(){
                that.holdDraw = false;
            })
        }
    
        this.resetDtUserSetting = function(){
            $.post('/adminapp/dt_removeusersettings', {session: this.attr('data-session')}, function(respon){
            if(respon){
                location.reload();
            }
            },'json').fail(function(){
    
            })
        }
    
        this.columns_adjust = function(){
            this.css('width','100%');
            _dt.columns.adjust();
        }
    
        if(_opt.basic) this.init();
        else this.addColumnFilter();
        
    
        this.opt = options;
        return this;  
    }
}(jQuery));
  
(function ( $ ){
    $.fn.page = function(){
        let _this = this;
        let _selector = null;
        this.forms = {};
        
        let selectorId = null; 
        let attrs = this[0].attributes;
        if(typeof attrs.id != 'undefined') selectorId = attrs.id.value;
        if($('#' + selectorId).length > 0){
            _selector = '#'+selectorId;
        }

        this.panel = function(){
            this.find('.panel').attr('data-panel-remove','false').attr('data-panel-title','false');
            this.parent().adminpanel().init();
        }
        this.serialize = function(){
            let data = {};
            $('#' + selectorId).find('form').each(function(){
                let _id = $(this).attr('id');
                if(typeof _id != 'undefined') data[_id] = $('form#'+_id).form().serialize();
            })
            return data;
        }
        this.validate = function(){
            let res = true;
            $('#' + selectorId).find('form').each(function(){
                let _id = $(this).attr('id');
                let _res = $('form#'+_id).form().validate();
                if(res) res = _res;
            })
            return res;
        }
        this.block = function(){
            if($(_selector).hasClass('modal'))
                mApp.block($(_selector).find('.modal-body'), {animate: true}); 
            else
                mApp.block(_selector, {animate: true});
        }
        this.form_init = function(){
            this.find('form').each(function(idx, _frm){
                let frmid = $(_frm).attr('id');
                if(typeof frmid == 'string') _this.forms[frmid] = $('#'+frmid).my_plugins().form();
            })
        }
        this.unblock = function(){
            if($(_selector).hasClass('modal'))
                mApp.unblock($(_selector).find('.modal-body')); 
            else
                mApp.unblock(_selector);
        }
        this.disable_btn = function(btns='all'){
            if(btns=='all') btns=['close','save','saverole'];
            if(btns.includes('close')){
                $(_selector).find('button.btn[data-dismiss="modal"]').addClass('disabled').prop('disabled','disabled');
                $(_selector).find('button.close[data-dismiss="modal"]').hide();
            }
            if(btns.includes('save')){
                $(_selector).find('button.btn[data-aksi="simpan"]').addClass('disabled');
            }
            if(btns.includes('saverole')){
                $(_selector).find('button.btn[data-aksi="saverole"]').addClass('disabled');
            }
        }
        this.enable_btn = function(btns='all'){
            if(btns=='all') btns=['close','save','saverole'];
            if(btns.includes('close')){
                $(_selector).find('button.btn[data-dismiss="modal"]').removeClass('disabled').removeAttr('disabled');
                $(_selector).find('button.close[data-dismiss="modal"]').show();
            } 
            if(btns.includes('save')){
                $(_selector).find('button.btn[data-aksi="simpan"]').removeClass('disabled');
            }
            if(btns.includes('saverole')){
                $(_selector).find('button.btn[data-aksi="saverole"]').removeClass('disabled');
            }
        }
        this.mdl_open = function(options={title:'Blank Modal',clearbody:true}){
            $(_selector).find('.modal-title').html(options.title);
            if(options.clearbody)
                $(_selector).find('.modal-body').html('');
            $(_selector).modal('show');
            _this.disable_btn();
            _this.block();
        }
        this.mdl_hide = function(){
            $(_selector).modal('hide');
        }
        this.notify = function(type, title, msg){
            /** Possible type
             * success, danger, warning, info, primary, brand
             */
            let icon = null;
            let isProgress = false;
            let isAllowDismiss = true;
            let timer = 3000;
            let delay = 1000;

            if(type == 'error') type = 'danger';
            if(type == 'progress'){
                icon = 'fa-solid fa-hourglass-half fa-bounce';
                isProgress = true;
                type = 'primary';
                isAllowDismiss = false;
                timer = 1000000;
                delay = 10000;
            }

            if(type == 'danger'){
                icon =  'fa-solid fa-triangle-exclamation';
            } else if(type == 'success'){
                icon =  'fa-solid fa-check';
            } else if(type == 'warning'){
                icon =  'fa-solid fa-info';
            }

            let content ={
                title: title,
                message: msg,
                icon: 'icon '+ icon  
            }
            let notify = $.notify(content, { 
                type: type,
                allow_dismiss: isAllowDismiss,
                newest_on_top: true,
                mouse_over: true,
                showProgressbar: isProgress,
                spacing: 10,
                timer: timer,
                placement: {
                    from: 'top',
                    align: 'right'
                },
                offset: {
                    x: 30,
                    y: 60
                },
                delay: delay,
                z_index: 10000,
                animate: {
                    enter: 'animated jello',
                    exit: 'animated fadeOut'
                }
            });

            return notify;
        }
        this.confirm = function(msg, params, callback){
            bootbox.confirm({
                message: msg,
                buttons: {
                    confirm: {
                        label: `<i class="fa-solid fa-check icon-lg"></i>  Yes, I'm sure`,
                        className: 'btn-warning'
                    },
                    cancel: {
                        label: '<i class="fa-solid fa-xmark icon-lg"></i>  No, cancel it',
                        classname: 'btn-danger'
                    }
                },
                callback: function(result){
                    if(typeof window[callback] == 'function') window[callback](result, params);
                }
            });
        }
        return this;
    }
}(jQuery));

function callback_triggerResize(){
    $('body').find('table.dataTable').each(function(){
        $(this).css('width','100%');
        $dt=$(this).DataTable();
        setTimeout(function() {
        $dt.columns.adjust().draw();
        }, 300)
        
    })
}
function callback_panelControlCreated(){

}
  var my_libs = {
      collect_form : function($form){
          var data={};
          $form.find('input,select,textarea').each(function(){
              var name=$(this).attr('name');
              var id=$(this).attr('id');
              if(name==null) var par=id; else var par=name;
              
              var val=null;
              if($(this).hasClass('date-picker')){
                  var date=new Date($(this).datepicker('getDate'));
                  if(isNaN(date.getMonth())) val=null;
                  else val=date.getFullYear()+'-'+(date.getMonth()+1)+'-'+date.getDate();
              }else val=$(this).val();
              
              data[par]=val;
          })
          return data;
      },
      collect_table : function($table){
          var data={};
          $table.find('tbody tr').each(function(){
              var _data={};
              $(this).find('input,select,textarea').each(function(){
                  if($(this).hasClass('date-picker')){
                      var date=new Date($(this).datepicker('getDate'));
                      if(isNaN(date.getMonth())) val=null;
                      else val=date.getFullYear()+'-'+(date.getMonth()+1)+'-'+date.getDate();
                      _data[$(this).attr('name')]=val;
                  }else
                  if(!$(this).hasClass('uncollectible'))
                      _data[$(this).attr('name')]=$(this).val();
              })
              data[$(this).attr('data-id')]=_data;
          })
          return data;
      },
      in_array : function(needle, haystack){
          var length = haystack.length;
          for(var i = 0; i < length; i++) {
              if(typeof haystack[i] == 'object') {
                  if(arrayCompare(haystack[i], needle)) return true;
              } else {
                  if(haystack[i] == needle) return true;
              }
          }
          return false;
      }
  }
var App = function() {
    return {
        blockUI: function(target, options) {
            var el = $(target);

            options = $.extend(true, {
                opacity: 0.03,
                overlayColor: '#000000',
                state: 'brand',
                type: 'loader',
                size: 'lg',
                centerX: true,
                centerY: true,
                message: '',
                shadow: true,
                width: 'auto'
            }, options);

            var skin;
            var state;
            var loading;

            if (options.type == 'spinner') {
                skin = options.skin ? 'm-spinner--skin-' + options.skin : '';
                state = options.state ? 'm-spinner--' + options.state : '';
                loading = '<div class="m-spinner ' + skin + ' ' + state + '"></div';
            } else {
                skin = options.skin ? 'm-loader--skin-' + options.skin : '';
                state = options.state ? 'm-loader--' + options.state : '';
                size = options.size ? 'm-loader--' + options.size : '';
                loading = '<div class="m-loader ' + skin + ' ' + state + ' ' + size + '"></div';
            }

            if (options.message && options.message.length > 0) {
                var classes = 'm-blockui ' + (options.shadow === false ? 'm-blockui-no-shadow' : '');

                html = '<div class="' + classes + '"><span>' + options.message + '</span><span>' + loading + '</span></div>';

                var el = document.createElement('div');
                mUtil.get('body').prepend(el);
                mUtil.addClass(el, classes);
                el.innerHTML = '<span>' + options.message + '</span><span>' + loading + '</span>';
                options.width = mUtil.actualWidth(el) + 10;
                mUtil.remove(el);

                if (target == 'body') {
                    html = '<div class="' + classes + '" style="margin-left:-'+ (options.width / 2) +'px;"><span>' + options.message + '</span><span>' + loading + '</span></div>';
                }
            } else {
                html = loading;
            }

            var params = {
                message: html,
                centerY: options.centerY,
                centerX: options.centerX,
                css: {
                    top: '30%',
                    left: '50%',
                    border: '0',
                    padding: '0',
                    backgroundColor: 'none',
                    width: options.width
                },
                overlayCSS: {
                    backgroundColor: options.overlayColor,
                    opacity: options.opacity,
                    cursor: 'wait',
                    zIndex: '10'
                },
                onUnblock: function() {
                    if (el && el[0]) {
                        mUtil.css(el[0], 'position', '');
                        mUtil.css(el[0], 'zoom', '');
                    }                    
                }
            };

            if (target == 'body') {
                params.css.top = '50%';
                $.blockUI(params);
            } else {
                var el = $(target);
                el.block(params);
            }
        },

        /**
        * Un-blocks the blocked element 
        * @param {object} target jQuery element object
        */
        unblockUI: function(target) {
            if (target && target != 'body') {
                $(target).unblock();
            } else {
                $.unblockUI();
            }
        },

    }
}();

var my_plugins_template = {
    menu_builder_item : `<li class="dd-item">
        <div class="m-portlet m-portlet--bordered m-portlet--bordered-semi m-portlet--rounded">
            <div class="m-portlet__head dd-handle">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
                            <i class="fa-solid fa-up-down-left-right mr15"></i>
                            <span></span>
                        </h3>
                    </div>
                </div>
            </div>
            <div class="m-portlet__body">
                <div class="row">
                    <div class="col-lg-3 col-md-4 col-sm-12">
                        <input type="text" name="text" class="form-control m-input skip-basic-serialize" value="" >
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <div class="input-group m-input-group">
                            <div class="input-group-prepend"><span class="input-group-text">href</span></div>
                            <input type="text" name="href" class="form-control m-input skip-basic-serialize" value="" >
                        </div>
                    </div>
                    <div class="col-lg-5 col-md-4 col-sm-12">
                        <a href="javascript:;" class="btn btn-primary m-btn m-btn--icon pull-right" data-aksi="menu_builder_dd-item-rm"><i class="fa-regular fa-trash-can fsr1p6"></i></a>
                        <a href="javascript:;" class="btn btn-primary m-btn m-btn--icon pull-right mr5" data-aksi="menu_builder_dd-item-insert"><i class="fa-regular fa-square-plus fsr1p6"></i><i class="fa-solid fa-turn-down"></i></a>
                    </div>
                </div>
            </div>
        </div>`,
    teamsinput_item: `<li class="dd-item">
        <div class="m-portlet m-portlet--bordered m-portlet--bordered-semi m-portlet--rounded">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <span class="m-portlet__head-icon dd-handle">
                            <i class="fa-solid fa-up-down-left-right"></i>
                        </span>
                        <h3 class="m-portlet__head-text ml15"></h3>
                    </div>
                </div>
                <div class="m-portlet__head-tools">
                    <ul class="m-portlet__nav">
                        <li class="m-portlet__nav-item">
                            <a href="javascript:;" m-portlet-tool="reload" class="m-portlet__nav-link m-portlet__nav-link--icon" data-aksi="teamsinput_dd-item-insert"><i class="fa-regular fa-square-plus fsr1p6"></i><i class="fa-solid fa-turn-down"></i></a></a>
                        </li>	
                        <li class="m-portlet__nav-item">
                            <a href="javascript:;" m-portlet-tool="remove" class="m-portlet__nav-link m-portlet__nav-link--icon" data-aksi="menu_builder_dd-item-rm"><i class="fa-regular fa-trash-can fsr1p6"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="m-portlet__body">
                <div class="row">
                    <div class="col-lg-5 col-md-4 col-sm-12 mb10">
                        <div class="input-group m-input-group">
                            <input type="text" name="name" class="form-control m-input skip-basic-serialize" value="" >
                        </div>
                    </div>
                    <div class="col-lg-7 col-md-4 col-sm-12">
                        <div class="input-group m-input-group">
                            <div class="input-group-prepend"><span class="input-group-text">Photo</span></div>
                            <input type="text" name="image" class="form-control m-input skip-basic-serialize" value="" >
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-3 col-sm-12">
                        <div class="input-group m-input-group">
                            <div class="input-group-prepend"><span class="input-group-text">Role</span></div>
                            <input type="text" name="role" class="form-control m-input skip-basic-serialize" value="" >
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-1 col-sm-12">
                        <label class="m-checkbox m-checkbox--check-bold">
                            <input class="skip-basic-serialize" type="checkbox" name="newrow"> New row
                            <span></span>
                        </label>
                    </div>
                </div>
            </div>
        </div>`,
}
  
// =============== HANDLE INPUT TYPE MONEY ====================================
$('body').on('focus','input[data-type="money"]',function(){
	var raw = $(this).attr('data-value');
	if(typeof raw == 'undefined' || raw ==null){
		$(this).val('');
	}else $(this).val(raw);
})
$('body').on('blur','input[data-type="money"]',function(){
	$(this).attr('data-value',$(this).val());
	$(this).val(number_to_currency($(this).val()));
})
$('body').on('keypress','input[data-type="money"]',function(event){
	return isNumberKey(event);
})
//=============================================================================
// =============== HANDLE DROPZONE CUSTOM ACTION ==============================
$('body').on('click','a[data-aksi="dz_remove"]',function(){
	var $li = $(this).closest('li');
	$li.addClass('dz_removed');
	$li.find('a[data-aksi="dz_undoremove"]').removeClass('hide');
	$(this).addClass('hide');
})
$('body').on('click','a[data-aksi="dz_undoremove"]',function(){
	var $li = $(this).closest('li');
	$li.removeClass('dz_removed');
	$li.find('a[data-aksi="dz_remove"]').removeClass('hide');
	$(this).addClass('hide');
})
//=============================================================================
// =============== HANDLE SELECT WITH CUSTOM OPTION ===========================
$('body').on('change','select.select-options-customopt',function(){
	var _opttags = $(this).find('option[value="'+$(this).val()+'"]').attr('data-tags');
	$(this).closest('.col-inp').find('input').remove();
	
	// HANDLE LABEL
	var label = $(this).closest('.form-group').find('.control-label').html();
	label = label.replace('<span class="label-required">*</span>','');
	
	// HANDLE REQUIRED ATTRIBUTE
	var req = "";
	var isReq = $(this).attr('required');
	if(typeof isReq != 'undefined' && isReq!= null && isReq == 'required') req = ' required="required"';
		
	if(typeof _opttags != 'undefined' && _opttags != null && isStrContain(_opttags,'[opt_others_by_users]')){
		$(this).closest('.col-inp').append('<input type="text" class="form-control mt5" placeholder="Tuliskan '+label+'" '+req+'>');
	}
})
//=============================================================================
// =============== HANDLE CHECKBOX ============================================
$('body').on('click', 'input[type="checkbox"][readonly]', function(){
    return false;
})
//=============================================================================
// =============== MODAL EXTENDED ACTION ======================================
$('body').on('show.bs.modal', '.modal',  function (event) {
    let mdl_layer = $('body').attr('data-modallayer');
    if(typeof mdl_layer == 'undefined' || mdl_layer == null || mdl_layer == '') mdl_layer = 1;
    else mdl_layer = parseInt(mdl_layer) + 1;
    
    $('body').attr('data-modallayer', mdl_layer );
})
$('body').on('hidden.bs.modal', '.modal',  function (event) {
    let mdl_layer = $('body').attr('data-modallayer');
    if(typeof mdl_layer == 'undefined' || mdl_layer == null || mdl_layer == ''){
        /** do nothing */
    } else mdl_layer = parseInt(mdl_layer) - 1;
    
    if(mdl_layer > 0) $('body').addClass('modal-open');

    $('body').attr('data-modallayer', mdl_layer );
})
// =============== HANDLE MENU BUILDER CUSTOM ACTION ==========================
$('body').on('click','a[data-aksi="menu_builder_add"]',function(){
	$(this).closest('.col-inp').find('.menu_builder').children('.dd-list').append(my_plugins_template.menu_builder_item);
})
$('body').on('keyup','.menu_builder input[name="text"]', function(){
    $(this).closest('.m-portlet').find('.m-portlet__head-title span').html($(this).val())
})
$('body').on('click','a[data-aksi="menu_builder_dd-item-insert"]', function(){
    $(this).closest('.dd-item').after(my_plugins_template.menu_builder_item);
})
$('body').on('click','a[data-aksi="menu_builder_dd-item-rm"]', function(){
    $(this).closest('.dd-item').remove();
})
//=============================================================================
// =============== TEAMS INPUT CUSTOM ACTION ==================================
$('body').on('keyup','.teamsinput input[name="name"]', function(){
    $(this).closest('.m-portlet').find('.m-portlet__head-title .m-portlet__head-text').html($(this).val())
})
$('body').on('click','a[data-aksi="teamsinput_add"]',function(){
	$(this).closest('.col-inp').find('.teamsinput').children('.dd-list').append(my_plugins_template.teamsinput_item);
})
$('body').on('click','a[data-aksi="teamsinput_dd-item-insert"]', function(){
    $(this).closest('.dd-item').after(my_plugins_template.teamsinput_item);
})
$('body').on('click','a[data-aksi="teamsinput_dd-item-rm"]', function(){
    $(this).closest('.dd-item').remove();
})
//=============================================================================
$('body').on('click', 'a[data-aksi="m-portlet__nav_collapse"]', function(){
	let state = null;
	let body = $(this).closest('.m-portlet').find('.m-portlet__body');
	let icon = $(this).find('i');
	if(icon.hasClass('la-angle-down')) state = 'closed'; else state = 'open';

	if(state == 'closed'){
		icon.removeClass('la-angle-down').addClass('la-angle-up');
		body.slideDown(400);
	} else {
		icon.removeClass('la-angle-up').addClass('la-angle-down');
		body.slideUp(400);
	}
})
//=============================================================================
// =============== IMAGE PICKER INPUT CUSTOM ACTION ===========================
var input_image_picker = {
    mdl: null,
    btn_loadmore: 'button[data-aksi="loadcardmore"]',
    input_id: null,
    template: {
        btn_alldata: `<button class="btn btn-secondary m-btn--wide"><i class="fa-regular fa-folder-open icon-lg" disabled="disabled"></i> All data been shown</button>`,
    },
    file_type: null,
    audio: null,
    load_modal: function(ins){
        let _this = this;

        if($(ins).closest('.form-image-picker').hasClass('form-audio-picker')) _this.file_type = 'audio';
        else _this.file_type = 'image';

        _this.input_id = $(ins).closest('.col-inp').attr('id');
        
        let selected = [];
        $(ins).closest('.col-inp').find('.img-item').each(function(){
            selected.push($(this).attr('data-id'));
        })

        if(_this.mdl == null){
            $(ins).closest('.form-group').find('.alert').remove();

            $.get('/adminapp/image_picker_dialog', function(respon){
                $('.m-content').append(respon);
                _this.mdl = $('#mdl_image_picker').my_plugins().page();
                _this.mdl.attr('data-selected-existing', encodeURI(JSON.stringify(selected)));
                _this.mdl.mdl_open({clearbody: true});

                _this.load_modal_content(ins);
            }).fail(function(){
                $(ins).after(`<div class="m-alert m-alert--icon alert alert-danger" role="alert">
                        <div class="m-alert__icon">
                            <i class="flaticon-danger"></i>
                        </div>
                        <div class="m-alert__text">
                            <strong>Error !</strong> Something wrong, please try again
                        </div>
                    </div>`);
            })
        } else {
            _this.mdl.attr('data-selected-existing', encodeURI(JSON.stringify(selected)));
            _this.mdl.mdl_open({clearbody: true});
            _this.load_modal_content(ins);
        }
    },
    load_modal_content: function(ins){
        let _this = this;

        $.get('/adminapp/image_picker_tab', {type: _this.file_type}, function(respon){
            _this.mdl.find('.modal-body').html(respon);

            let uploader = _this.mdl.find('form#galleries_uploadfiles').my_plugins().form();

            _this.render_card();

            _this.mdl.unblock();
            _this.mdl.enable_btn();
        }).fail(function(){
            
        })
    },
    load_card: function(){
        let _this = this;
        $.post('/adminapp/get_cards', {session: encodeURI(btoa(JSON.stringify(_this.cards_shown_ids()))), type: _this.file_type}, function(respon){
            if(respon == '[nomoredata]'){
                _this.mdl.find('.cards-control-bottom').append(_this.template.btn_alldata);
                _this.mdl.find(_this.btn_loadmore).remove();
            }else{
                _this.mdl.find('.cards-row').append(respon);
                _this.render_card();
            }
        }).fail(function(){
            _this.main_pnl.notify('error', _page_info.title, _page_info._msg.unknow_error);
        })
    },
    cards_shown_ids: function(){
        let ids = [];
        this.mdl.find('.image-card').each(function(){
            ids.push($(this).attr('data-id'));
        })
        return ids;
    },
    cards_prepend: function(fileId){
        let _this = this;
        
        $.post('/adminapp/get_cards', {session: encodeURI(btoa(JSON.stringify(_this.cards_shown_ids()))), type: _this.file_type, id: fileId}, function(respon){
            $('.cards-row').prepend(respon);
            _this.mdl.find('a[href="#m_image_picker_tabs_galery"]').click();
            _this.render_card();
        }).fail(function(){
            _this.main_pnl.notify('error', _page_info.title, _page_info._msg.unknow_error);
        })
    },
    render_card: function(){
        let _this = this;
        let card = _this.mdl.find('.lazyload:first');
        let _id = card.attr('data-id');
        let params = JSON.parse(atob(decodeURI(card.attr('data-params'))));

        let uri = null;
        if(typeof params.thumb != 'undefined' && params.thumb != null && params.thumb.length>0) uri = params.thumb;
        else uri = params.url;

        if(card.attr('data-type').includes('audio')){
            card.find('.m-portlet__body').html('<a href="javascript:;" data-src="' + params.url + '" class="picker-audio-player picker-audio-play"><i class="fa-solid fa-play"></i></a>');
            card.removeClass('lazyload');
        } else {
            card.find('.m-portlet__body').html('<a href="' + params.url + '" id="cardfancy_' + _id + '" class="cardfancy"><img src="' + uri + '"></a>');
            card.removeClass('lazyload');
        }
        
        $("#cardfancy_" + _id).fancybox({
            helpers : { title : { type : 'over'}}
        });

        if($('.lazyload').length>0){
            setTimeout(function(){
                _this.render_card();
            },300)
        } else {
            _this.mark_existing_selection();
        }
    },
    mark_existing_selection: function(){
        let _this = this;
        let selected = decodeURI(_this.mdl.attr('data-selected-existing'));
        if(typeof selected == 'string' && selected.length >0){
            let arr_ids = JSON.parse(selected);
            if(typeof arr_ids == 'object' && arr_ids.length>0){
                arr_ids.forEach(function(id){
                    _this.mdl.find('.image-card[data-fileid="'+id+'"]').addClass('selected');
                })
            }
        }
    },
    apply_changes: function(){
        let _this = this;
        let input = $('#' + _this.input_id);
        let inputname = input.attr('name');
        let selected = [];
        _this.mdl.find('.image-card.selected').each(function(){
            let filetype = $(this).attr('data-type');
            
            let src = null;
            if(filetype.includes('audio')) src = $(this).find('a.picker-audio-player').attr('data-src');
            else src = $(this).find('img').attr('src');
            
            let img = {
                id: $(this).attr('data-fileid'),
                src: src,
                filename: $(this).find('.m-portlet__head-text').html().trim(),
                filetype: filetype,
            }

            selected.push(img);
        })

        input.find('.img-item').remove();
        if(typeof selected == 'object' && selected.length > 0){
            selected.forEach(function(img){
                if(img.filetype.includes('audio')){
                    input.append(`<div class="img-item" data-id="` + img.id + `">
                            <a href="javascript:;" data-src="` + img.src + `" class="picker-audio-player picker-audio-play"><i class="fa-solid fa-play"></i></a>
                            <span class="img-filename">`+img.filename+`</span>
                        </div>`);
                } else {
                    input.append(`<div class="img-item" data-id="` + img.id + `">
                            <a href="` + img.src + `" id="cardfancy_` + img.id + `" class="cardfancy">
                                <img src="` + img.src + `" id="` + inputname + img.id + `">
                            </a>
                            <span class="img-filename">`+img.filename+`</span>
                        </div>`);

                    $("#cardfancy_" + img.id).fancybox({
                        helpers : { title : { type : 'over'}}
                    });
                }
            })
        }
        
        _this.mdl.mdl_hide();
    },
    playSound: function(ins){
        let audio_src = $(ins).attr('data-src');
        this.audio = new Audio(audio_src);
        this.audio.play();

        $(ins).removeClass('picker-audio-play').addClass('picker-audio-pause');
        $(ins).find('i').removeClass('fa-play').addClass('fa-pause');
    },
    pauseSound: function(ins){
        this.audio.pause();
        $(ins).removeClass('picker-audio-pause').addClass('picker-audio-play');
        $(ins).find('i').removeClass('fa-pause').addClass('fa-play');
    },
}
function inputimagepicker_onsuccess(file, param){
    if(typeof param == 'string') param = JSON.parse(param);
    input_image_picker.cards_prepend(param.id);
}
$('body').on('click', 'button[data-aksi="open_img_selector"]', function(){
    input_image_picker.load_modal(this);
})
$('body').on('click', '.image-card .m-portlet__head-caption', function(){
    let maxlength = $('#' + input_image_picker.input_id).attr('maxlength');
    if(typeof maxlength == 'string'){
        maxlength = parseInt(maxlength);
    }

    let imgcard = $(this).closest('.image-card');
    let cardsrow = imgcard.closest('.cards-row');
    cardsrow.find('.alert').remove();
    if(typeof maxlength == 'number' && !isNaN(maxlength) && maxlength == 1){
        if(imgcard.hasClass('selected')){
            imgcard.removeClass('selected');
        } else {
            cardsrow.find('.selected').removeClass('selected');
            imgcard.addClass('selected');
        }
    } else {
        if(typeof maxlength == 'number' && !isNaN(maxlength)){
            if(imgcard.hasClass('selected')){
                imgcard.removeClass('selected');
            } else {
                if(cardsrow.find('.selected').length < maxlength){
                    imgcard.addClass('selected');
                } else {
                    cardsrow.prepend(`<div class="col-lg-12">
                            <div class="m-alert m-alert--icon alert alert-danger" role="alert">
                                <div class="m-alert__icon">
                                    <i class="flaticon-danger"></i>
                                </div>
                                <div class="m-alert__text">
                                    <strong>Ups !</strong> Select maximum ` + maxlength + ` item
                                </div>
                            </div>
                        </div>`);
                }
            }
        } else {
            if(imgcard.hasClass('selected')) imgcard.removeClass('selected');
            else imgcard.addClass('selected');
        }
    }
})
$('body').on('click', '[data-aksi="loadcardmore"]', function(){
    input_image_picker.load_card();
})
$('body').on('click', '#mdl_image_picker button[data-aksi="simpan"]', function(){
    input_image_picker.apply_changes();
})
$('body').on('click', 'a.picker-audio-play', function(){
    input_image_picker.playSound(this);
})
$('body').on('click', 'a.picker-audio-pause', function(){
    input_image_picker.pauseSound(this);
})
//=============================================================================

//=============================================================================
// =============== ITEM BUILDER INPUT CUSTOM ACTION ===========================
var input_item_builder = {
    template: {
        item: {},
    },
    add_item: function(ins){
        let _this = this;
        let _form = $(ins).closest('.form-item-builder');
        let _id = _form.attr('id');
        let _itemid = uniqid();
        _form.find('.item-builder-container').append(_this.template.item[_id].replaceAll('<[itemid]>', _itemid));

        _this.form_init(_id);
    },
    form_init: function(id){
        let _form = $('#'+id);
        _form.find('.item-builder-item').each(function(){
            let _itemid = $(this).attr('id');
            $(this).find('input,select,textarea,.form-image-picker').each(function(){
                $(this).addClass(_itemid);
            })

            $(this).find('.m-select2').each(function(){
                $(this).my_plugins().select2();
            })

            let _title = ''
            if($(this).find('input[name="title"]').length>0) _title = $(this).find('input[name="title"]').val();
            else if($(this).find('input[type="text"]:first').length>0) _title = $(this).find('input[type="text"]:first').val();
            
            $(this).find('.m-accordion__item-title').html(_title);
        })
    },
    init: function(id){
        let _this = this;
        let _form = $('#'+id);
        let _name = _form.attr('name');

        _this.template.item[id] = decodeURI(_form.attr('data-template'));
        _form.removeAttr('data-template');

        _this.form_init(id);

        _form.find('.item-builder-item:first').find('.m-accordion__item-head').removeClass('collapsed');
        _form.find('.item-builder-item:first').find('.m-accordion__item-body').addClass('show');
    }
}
$('body').on('click', 'button[data-aksi="item-builder-add"]', function(){
    input_item_builder.add_item(this);
})
$('body').on('change', '.item-builder-item input[name="title"]', function(){
    $(this).closest('.item-builder-item').find('.m-accordion__item-title').html($(this).val());
})
$('body').on('keyup', '.item-builder-item input[name="title"]', function(){
    $(this).closest('.item-builder-item').find('.m-accordion__item-title').html($(this).val());
})
$('body').on('click', '[data-aksi="item-builder-removeitem"]', function(){
    $(this).closest('.item-builder-item').remove();
})
$('body').on('click', '[data-aksi="item-builder-movedownitem"]', function(){
    alert('Under development, will be available soon');
})
$('body').on('click', '[data-aksi="item-builder-moveupitem"]', function(){
    alert('Under development, will be available soon');
})
//=============================================================================

var alwaysVisibleSelect2Matcher = function(params, data) {
    // 1. If no search term, return all data
    if ($.trim(params.term) === '') return data;

    // 2. Skip if no text
    if (typeof data.text === 'undefined') return null;

    // 3. ALWAYS SHOW the special option
    if (data.id === 'always-visible' || (data.element && $(data.element).hasClass('always-show'))) {
        return data;
    }

    // 4. Handle Optgroups (Children)
    if (data.children && data.children.length > 0) {
        var match = $.extend(true, {}, data);
        for (var i = data.children.length - 1; i >= 0; i--) {
            var child = data.children[i];
            var matches = myCustomMatcher(params, child);
            if (!matches) {
                match.children.splice(i, 1);
            }
        }
        if (match.children.length > 0) return match;
    }

    // 5. Standard text match
    if (data.text.toLowerCase().indexOf(params.term.toLowerCase()) > -1) {
        return data;
    }

    return null;
};