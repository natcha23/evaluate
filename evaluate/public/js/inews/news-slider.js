
//var endpoint = APPLICATION_HOST + '/news/service/jsonrpc';
var endpoint = APPLICATION_HOST + "/data/mockup_all.json.php";

var Sliders = function () {

    // default sliders
    $("#default-slider").slider();

    // snap inc
    $("#snap-inc-slider").slider({
        value: 50,
        min: 0,
        max: 1000,
        step: 100,
        slide: function (event, ui) {
            $("#snap-inc-slider-amount").text("$" + ui.value);
        }
    });

    $("#snap-inc-slider-amount").text("$" + $("#snap-inc-slider").slider("value"));

    // range slider
    $("#slider-range").slider({
        range: true,
        min: 0,
        max: 500,
        values: [75, 300],
        slide: function (event, ui) {
            $("#slider-range-amount").text("$" + ui.values[0] + " - $" + ui.values[1]);
        }
    });

    $("#slider-range-amount").text("$" + $("#slider-range").slider("values", 0) + " - $" + $("#slider-range").slider("values", 1));

    //range max

    $("#slider-range-max").slider({
        range: "max",
        min: 1,
        max: 10,
        value: 2,
        slide: function (event, ui) {
            $("#slider-range-max-amount").text(ui.value);
        }
    });

    $("#slider-range-max-amount").text($("#slider-range-max").slider("value"));

    // range min
    $("#slider-range-min").slider({
        range: "min",
        value: 37,
        min: 1,
        max: 700,
        slide: function (event, ui) {
            $("#slider-range-min-amount").text("$" + ui.value);
        }
    });

    $("#slider-range-min-amount").text("$" + $("#slider-range-min").slider("value"));

    //
    // setup graphic EQ
    $( "#eq > span" ).each(function() {
    // read initial values from markup and remove that
        var value = parseInt( $( this ).text(), 10 );
        $( this ).empty().slider({
            value: value,
            range: "min",
            animate: true,
            orientation: "vertical"
        });
    });

    // bound to select

    var select = $( "#minbeds" );
    var slider = $( "<div id='slider'></div>" ).insertAfter( select ).slider({
        min: 1,
        max: 6,
        range: "min",
        value: select[ 0 ].selectedIndex + 1,
        slide: function( event, ui ) {
            select[ 0 ].selectedIndex = ui.value - 1;
        }
    });
    $( "#minbeds" ).change(function() {
        slider.slider( "value", this.selectedIndex + 1 );
    });

    // vertical slider
    $("#slider-vertical").slider({
        orientation: "vertical",
        range: "min",
        min: 0,
        max: 100,
        value: 60,
        slide: function (event, ui) {
            $("#slider-vertical-amount").text(ui.value);
        }
    });
    $("#slider-vertical-amount").text($("#slider-vertical").slider("value"));

    // vertical range sliders
    $("#slider-range-vertical").slider({
        orientation: "vertical",
        range: true,
        values: [17, 67],
        slide: function (event, ui) {
            $("#slider-range-vertical-amount").text("$" + ui.values[0] + " - $" + ui.values[1]);
        }
    });

    $("#slider-range-vertical-amount").text("$" + $("#slider-range-vertical").slider("values", 0) + " - $" + $("#slider-range-vertical").slider("values", 1));


}();

var Controller = {
		
		init: function() {
			
			this.setup();
		},
		
		setup: function() {
			
			//Tooltips loading in datatables.
			$(".tooltips").tooltip();
			
			//console.log('before _setupDataTable()');
			this._setupDataTable();
			this._setupToolbar();
			this._setupModals();
		},
		
		getService: function() {
			if (this.service == undefined) {
				this.service =  jQuery.Zend.jsonrpc({url: APPLICATION_HOST + '/app/service/jsonrpc'});
			};
			return this.service;
		},
		
		_setupDataTable: function() {
			var me = this;
			var service = me.getService();
			var element = $("#admin-user");
			
			this.dataTable = element;
			
			var dt = element.dataTable( {
				
				"aaSorting": [[ 1, "asc" ]],
	        	/* Length per page */
	        	"iDisplayLength": app.defaults.itemCountPerPage,
	        	
	        	/* Disable pagination range. */
	        	"bLengthChange": false,
	        	
	        	"bProcessing": true,
	        	"bServerSide": true,
	   		  	"sAjaxSource": endpoint,
	   		  	"bDeferRender": true,
			  	
	   		  	"sDom": 'l<"span12">rtip', 
	   		 
	   		 	"fnServerParams": function ( aoData ) {
					aoData.push( { "name": "pageName", "value": "" } );
		  		},
		  		
		  		"oLanguage": {
	                "sLengthMenu": "_MENU_ records per page",
	                "oPaginate": {
	                    "sPrevious": "Prev",
	                    "sNext": "Next"
	                }
	            },
	            
	            /* Define Row Elements. */
				"aoColumns": [
						{"bSortable": false, "sClass": "hidden-phone"}, 
						{"sClass": "hidden-phone", "bSortable": false},
						{"bSortable": false},
						{"sClass": "hidden-phone", "bSortable": false},
						{"bSortable": false},
						{"bSortable": false},
						{"bSortable": false}
				],
	            
	         // fnServerData 
	            "fnServerData": function ( sUrl, aoData, fnCallback, oSettings ) {
	            	
	            	var page = Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength) + 1;
	            	var itemCountPerPage = oSettings._iDisplayLength;
	            	var criteria = me.getCriteria();
	            	
	            	var response = service.getUserList(page, itemCountPerPage, criteria);
	            	
	            	// transform api data to this plguin
	            	var json = {
	            		aaData: [],
	            		iTotalDisplayRecords: response.result.totalItemCount,
	            		iTotalRecords: response.result.totalItemCount,
	            		sEcho: aoData[0].value
	            	};
	            	
	            	$.each(response.result.items, function() {
	            		var data = [];
	            		var title = 'Undefined';
	            		var icon = 'fa-question';
	            		var style = 'style="width:11px;"';
	            			
	            		if ( this.upload ) {
	            			title = 'Upload';
	            			icon = 'fa-upload';
	            			style = '';
	            		} 
	            		
	            		if( this.download ) {
	            			title = 'Download';
	            			icon = 'fa-download';
	            			style = '';
	            		}
	            		
	            		if( this.upload && this.download ){
		            		title = 'Upload & Download';
		            		icon = 'fa-unsorted';
		            		style = 'style="width:11px;"';
	            		}
	            		
	            		// upload/download icon
	            		var permissionicon = '<span class="label label-info label-mini tooltips" data-original-title="' +title+ '"><i class="fa '+icon+ '" '+style+ '></i>';
	            		
	            		var isadminicon = '<span class="label label-info label-mini tooltips" data-original-title="Is admin"><i class="fa fa-flag" '+style+ '></i>';
	            		
	            		// username
	            		var username = this.user_name;
	            		
	            		// name
	            		var name = this.fname;
	            		
	            		// surname
	            		var surname = this.lname;
	            		
	            		// province
	            		var province = this.province.name;
	            		
	            		// category
	            		var category = this.category.title;
	            		
	            		// buttons action
	            		var deleteUrl = APPLICATION_HOST + '/data/mockup_form.json.php?del=1&key=' + this.fileID;
	            		var buttons = 
	            			 
	            			'<button class="btn btn-primary btn-xs tooltips" data-action="save" data-toggle-x="modal" href="#formModal" ' +
	            				'data-original-title="Edit"><i class="fa fa-pencil"></i></button> ' +
	            			 
	            			'<button class="btn btn-danger btn-xs tooltips" data-action="delete" data-toggle-x="modal" data-target="#confirmModal" ' +
	            				'id="modal-confirm" data-original-title="Delete" data-placement="left">' +
	            				'<i class="fa fa-trash-o"></i></button>';
	            		
	            		data.push(permissionicon);
	            		data.push(username);
	            		data.push(name);
	            		data.push(surname);
	            		data.push(province);
	            		data.push(category);
	            		data.push(buttons);
	            		
	            		json.aaData.push(data);
	            		
	            	});
	            	
	            	fnCallback( json );
	            	
	            	// set data value for query data
	            	$.each($(oSettings.nTBody).find('tr'), function(key) {
	            		$(this).data('value', response.result.items[key]);
	            	});
	            },
	            
	            "fnInitComplete"  : function () {
	            	
	            	/* Do something */
	            	
	            	me._onInitComplete();
	            	
	            },
	            	
	            "fnDrawCallback": function() {
					
						/* Tooltips loading in dataTables. */
	            		$(".tooltips", element).tooltip();
//						$(".tooltips").tooltip();
	            }
	        
		} );
			
			
		},
		
		_setupToolbar: function() {
			
			var me = this;
			
			/* Unbind auto search. */
			$("div.dataTables_filter input").unbind();
			//$('body').on( 'click', '#btnfilter', function (e) {
			$('body').on( 'click', '.btn.filter', function (e) {
				//dt.fnFilter($("div.table_filter input").val());
				
				me.load();
		    });	
			
			// keyword enter
			//console.log(this.dataTable, 'dataTable');
			$('input[name=keyword]').keypress(function(e) {
				var code = (e.keyCode ? e.keyCode : e.which);
				if (code == 13) {
					me.load();
				};
			});
			
		},
		
		_setupModals: function() {
			var me = this;
			var dt = this.dataTable;
			
			// setup validate form
			var form = $("form.cmxform");
			form.validate({
		            rules: {
		            	user_name: "required",
		            	pwd_user: {
		                    required: true,
		                    minlength: 5
		                },
		            	rtpwd_user: {
		                    required: true,
		                    minlength: 5,
		                    equalTo: "#pwd_user"
		                },
		                fname: "required",
		                lname: "required",
		                geo_id: "required",
		                province_id: "required",
		                cat_id: "required",
		                geo_superuser: "required"
		            },
		            messages: {
		            	user_name: "Please enter username",
		            	pwd_user: "Please enter password",
			            rtpwd_user: "Please Re-type password",
			            fname: "Please enter firstname",
			            lname: "Please enter lastname",
			            geo_id: "Please choose geography",
			            province_id: "Please choose province",
			            cat_id: "Please choose category",
			            geo_superuser: "Please choose geography"
		            } 
		     });
			
			$("body").on("shown.bs.modal", function (e) {
				/* Setup datepicker on modal */
				$('.default-date-picker').datepicker({
					format: 'yyyy-mm-dd'
		        });
				
				/* Set current date time default */
				//$(".default-date-picker > input").val( null );
				
				/* clear active expire date */
				$('#inactive').val('');
				
				$('body').on('click', '[name=is_expire]', function() { 
					var toggle = $(this).val();
					var expdate = $('[name=expire]').val();
					me.expireDateEffect( toggle );
				} );
				
				$('select[name=geo_id]').change(function () {
			        var geo = this.value;
			        me.provinceFilter(geo);
			        
			    });
				
				/* Select is admin or is superuser */
				$('input[name=is_admin]').click (function ()
				{
					if(this.checked==true) 
					{
						$('input[name=is_superuser]').prop('checked', false);
						$('select[name=is_superuser]').prop('checked', false);
						
						$('select[name=geo_superuser]').prop('disabled', true);
						$('select[name=geo_superuser]').addClass('disabled');
					} 
					else
					{
						
						// Do something.
					}
				});
				
				/* Select is admin or is superuser */
				$('input[name=is_superuser]').click (function ()
				{
					if(this.checked==true) 
					{
						$('input[name=is_admin]').prop('checked', false);
						
						$('select[name=geo_superuser]').removeAttr('disabled');
						$('select[name=geo_superuser]').removeClass('disabled');
					} 
					else
					{
						$('select[name=geo_superuser]').prop('disabled', true);
						$('select[name=geo_superuser]').addClass('disabled');
					}
				});
				
			} );
			
			// Clear modal on page.
			$('body').on('hidden.bs.modal', '.modal', function () {
				
				$(this).removeData('bs.modal');
				
				var elid = $(this).find('[name=user_id]');
				var eluser_name = $(this).find('[name=user_name]');
				var elfname = $(this).find('[name=fname]');
				var ellname = $(this).find('[name=lname]');
				var elpwd = $(this).find('[name=pwd_user]');
				var elrtpwd = $(this).find('[name=rtpwd_user]');
				var elupload = $(this).find('[name=upload]');
				var eldownload = $(this).find('[name=download]');
				var elaspera = $(this).find('[name=download_aspera]');
				var elis_admin = $(this).find('[name=is_admin]');
				var elis_superuser = $(this).find('[name=is_superuser]');
				var elgeo = $(this).find('[name=geo_superuser]');
				var elcat_id = $(this).find('[name=cat_id]');
				var elprovince_id = $(this).find('[name=province_id]');
				var elgeo_id = $(this).find('[name=geo_id]');
				var elexpire = $(this).find('[name=expire]');
				var elgeo_superuser = $(this).find('[name=geo_superuser]');
				
				elid.val('');
				eluser_name.val('');
				elfname.val('');
				ellname.val('');
				elpwd.val('');
				elrtpwd.val('');
				elupload.removeAttr('checked');
				eldownload.removeAttr('checked');
				elaspera.removeAttr('checked');
				elis_admin.removeAttr('checked');
				elis_superuser.removeAttr('checked');
				elgeo.val('');
				elcat_id.val('');
				elprovince_id.empty();
				elgeo_id.val('');
				elgeo_superuser.val('');
				elexpire.val('');
			});	
			
	    	// buttons
	    	//dt.on('click', 'button[data-toggle-x], a[data-toggle-x]', function() {
			$('body').on('click', 'button[data-toggle-x], a[data-toggle-x]', function() {
	    	
	    		var data = $(this).parents('tr:first').data('value') || {};
	    		var el = $(this);
	    		
	    		var target = el.attr('href') || '';
	    		if (!target.length) {
	    			target = el.data('target') || '';
	    		};
	    		
	    		if (!target.length) return;
	    		
	    		// action to method
	    		var action = el.data('action') || '';
	    		var method = app.toCamelCase(action);
	    		
	    		me[method](data, $(target));
	    	});
		},
		
		expireDateEffect: function(data) {
			
			var me = this;
			var elexpire = $('input[name=expire]');
			var elinactive = $('#inactive');
			var result;
			
			var user_id = $('body').find('[name=user_id]');
			
			var exp_val = elexpire.val();
			var inc_val = elinactive.val();
			var temp_exp = exp_val;
			
			var d = new Date();
			
			if( data && data != 0 ) {
				if( data != 1 ) {
					d = new Date(data*1);
				}
			} else {
					d = new Date();
			}

			var month = d.getMonth();
			var day = d.getDate();
			var year = d.getFullYear();
			var result = $.datepicker.formatDate('yy-mm-dd', d);
			
			if( data && data != 0 ) {
//				console.log('is expire');
				$('input:radio[id=is_expire]').prop('checked', true);
				$('input:radio[id=is_expire]').addClass('checked');
				
				$('#divActiveExpire').show();
				$('#divInActiveExpire').hide();
				
				var _expire = $('input[name=expire]').val();
				var _inactive = $('#inactive').val();
				
				if( _inactive ) {
					elexpire.val(_inactive);
				} else {
					elexpire.val(result);
					elinactive.val(result);
				}
				elinactive.val(_expire);
				
			} else {
				/* No expire | Time life */
				$('input:radio[id=no_expire]').prop('checked', true);
				var expire = elexpire.val();
				
				$('#divActiveExpire').hide();
				$('#divInActiveExpire').show();
				
				var _expire = $('input[name=expire]').val();
				var _inactive = $('#inactive').val();
				
				if(_expire) {
					elinactive.val(_expire);
				}  else {
					elexpire.val(result);
				}
			}
			
		},
		
		genUserExpireDate: function(data, target) {
			
			var me = this;
			var eldatepicker = $('.default-date-picker');
			var elexpire = $('input[name=expire]');
			var d = new Date(data*1);
			
			if(data == undefined) {
				data = 0;
			} 
			
			me.expireDateEffect(data);
			
		},
		
		provinceFilter: function(items) {
			var region = $('#region_' + items);
			var html = region[0].innerHTML;
			
			$('[name=province_id]').empty().append(html);
		},
		
		save: function(data, target) {
			
			var me = this;
			//console.log('get data before save',data);
			var elid = target.find('[name=user_id]');
			var eluser_name = target.find('[name=user_name]');
			var elfname = target.find('[name=fname]');
			var ellname = target.find('[name=lname]');
			var elpwd = target.find('[name=pwd_user]');
			var elrtpwd = target.find('[name=rtpwd_user]');
			var elexpire = target.find('[name=expire]');
			var eldownload = target.find('[name=download]');
			var elupload = target.find('[name=upload]');
			var elaspera = target.find('[name=download_aspera]');
			var elis_admin = target.find('[name=is_admin]');
			var elis_superuser = target.find('[name=is_superuser]');
			var elgeo_id = target.find('[name=geo_id]');
			var elprovince_id = target.find('[name=province_id]');
			var elcat_id = target.find('[name=cat_id]');
			var elgeo_superuser = target.find('[name=geo_superuser]');
			
			var id = data.user_id;
			var user_name = data.user_name;
			var fname = data.fname;
			var lname = data.lname;
			var pwd = data.pwd_user;
			var rtpwd = data.rtpwd_user;
			var expire = data.expire;
			var download = data.download;
			var upload = data.upload
			var aspera = data.download_aspera;
			var is_admin = data.is_admin;
			var is_superuser = data.is_superuser;
			var geo_id = data.geo_id;
			var province_id = data.province_id;
			var cat_id = data.cat_id;
			var geo_superuser = data.geo_superuser;
			
			elid.val(id);
			eluser_name.val(user_name);
			elfname.val(fname);
			ellname.val(lname);
			
			me.genUserExpireDate(expire, elexpire);

			if( download ) {
				eldownload.prop('checked', true);
			}
			
			if( upload ) {
				elupload.prop('checked', true);
			}
			
			if( aspera ) {
				elaspera.prop('checked', true);
			}
			
			if( is_admin ) {
				elis_admin.prop('checked', true);
				elis_admin.addClass('checked');
				
				elgeo_superuser.prop('checked', false);
				
				elgeo_superuser.prop('disabled', true);
				elgeo_superuser.addClass('disabled');
				
			} else {
				elgeo_superuser.prop('disabled', true);
				elgeo_superuser.addClass('disabled');
			}
			
			if( is_superuser) {
				elis_superuser.prop('checked', true);
				elis_superuser.addClass('checked');
				
				elis_admin.prop('checked', false);
				
				elgeo_superuser.prop('disabled', false);
				elgeo_superuser.removeClass('disabled');
			} else {
				elgeo_superuser.prop('disabled', true);
				elgeo_superuser.addClass('disabled');
			}
			
			if(!is_admin && !is_superuser) {
				elgeo_superuser.prop('disabled', true);
				elgeo_superuser.addClass('disabled');
			}
			
			elgeo_id.val(geo_id);
			if(geo_id) {
				me.provinceFilter(geo_id);
			}
			
			elprovince_id.val(province_id);
			
			elcat_id.val(cat_id);
			
			elgeo_superuser.val(geo_superuser);
			
			target.modal('show');
			
			// binde hide event on the preview modal
			target.bind('hide.bs.modal', function() {
				//$(this).removeData('bs.modal');
			});
			
			// close button on the title bar
			target.off('click', '.btn[data-dismiss="modal"]');
			target.on('click', '.btn[data-dismiss="modal"]', function() {
				target.modal('hide');
			});
			
			var buttonRule = '.btn.save';
			
			// set lang
			if ($.isEmptyObject(data)) {
				target.find('.modal-title').text(app._('Add User'));
				target.find(buttonRule).text(app._('Add User'));
			} else {
				target.find('.modal-title').text(app._('Edit User'));
				target.find(buttonRule).text(app._('Edit User'));
			}
			
			target.off('click', buttonRule);
			target.on('click', buttonRule, function(e) {
				
				// validate form when it is submitted
				var form = $("form.cmxform");
				var valid = form.valid();
				if ( !valid ) {
					return false;
				}
				
				e.preventDefault();
				
				target.modal('hide');
				
				var expire = $.trim(elexpire.val());
				var expiredate = expire;
				if($('#is_expire').prop('checked')) {
				
					if(expire) {
						
						var nexpire = expire + ' 00:00:00';
						
						var d = new Date(nexpire);
						var month = d.getMonth();
						var day = d.getDate();
						var year = d.getFullYear();
						var date = $.datepicker.formatDate('yy-mm-dd', d);
						
						expiredate = d.getTime().toString();
						
					}
					
				}
				else 
				{
					expiredate = 0;
				}
				var fileId = data.fileID;
				var item = {
						user_id: $.trim(elid.val()),
						user_name: $.trim(eluser_name.val()),
						fname: $.trim(elfname.val()),
						lname: $.trim(ellname.val()),
						user_pwd: $.trim(elpwd.val()),
						user_rtpwd: $.trim(elrtpwd.val()),
						expire: expiredate,
						download: eldownload.prop('checked'),
						upload: elupload.prop('checked'),
						download_aspera: elaspera.prop('checked'),
						is_admin: elis_admin.prop('checked'),
						is_superuser: elis_superuser.prop('checked'),
						geo_id: $.trim(elgeo_id.val()),
						province_id: $.trim(elprovince_id.val()),
						cat_id: $.trim(elcat_id.val())
						//geo_superuser: $.trim(elgeo_superuser.val())
					};
				
				// geography
				item.geo_superuser = [];
				if (item.is_superuser) {
					elgeo_superuser.find('option').each(function() {
						var el = $(this);
						if (el.is(':selected')) {
							item.geo_superuser.push(el.val());
						};
					});	
				};
				data = $.extend({}, data, item);
//				console.log(data);
//				return;
				me.getService().saveUser(data);
				me.load();				
				
				/* hidden datepicker */
				$('.default-date-picker').datepicker('hide');
			});
		},
		
		delete: function(data, target) {
			
			var me = this;
			
			target.modal('show');
			
			// close button
			target.off('click', '.btn[data-dismiss="modal"]');
			target.on('click', '.btn[data-dismiss="modal"]', function() {
				target.modal('hide');
			});
			
			target.off('click', '.btn.delete');
			target.on('click', '.btn.delete', function() {
				
				target.modal('hide');
				
				var fileId = data.user_id;
//				var operationId = data.id;
				me.getService().deleteUserById(data.user_id);
				
				me.load();
				
			} );
		},
		
		
		_onInitComplete: function() {
			var me = this;
			
			// ? after setup dataTable only
			//consoel.log('before _setupToolbar()');
//			this._setupToolbar();
		},
		
		//  find all criteria in this function ja
		getCriteria: function() {
			var me = this;
			
			var criteria = {};
			criteria.keyword = $('input[name=keyword]').val();
			
			return criteria;
		},
		
		load: function() {
			
			// @todo beforeLoad (loading)
			
			
			// @todo delay for fast click
//			console.log('load process');
			
			var me = this;
			var criteria = me.getCriteria();
//			console.log(criteria, 'criteria');
			
			me.dataTable.fnReloadAjax();
			
			// @todo after load
		}
};



(function($) {
	$(function() {
//		console.log(2);
		Controller.init();
	}) //jQuery
	
	
});