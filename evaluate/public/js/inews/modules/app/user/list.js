
//var endpoint = APPLICATION_HOST + '/news/service/jsonrpc';
var endpoint = APPLICATION_HOST + "/data/mockup_all.json.php";

//add require from group method
jQuery.validator.addMethod("require_permission_group", function(value, element, options) {
	var validator = this;
	var selector = options[1];
	
	var validOrNot = $(selector, element.form).filter(function() {
		return validator.elementValue(this);
	}).length >= options[0];
	
//	if(!$(element).data('being_validated')) {
//		var fields = $(selector, element.form);
//		fields.data('being_validated', true);
//		fields.valid();
//		fields.data('being_validated', false);
//	}
	return validOrNot;
}, jQuery.format("Please select 1 choice."));

//add require from group method
jQuery.validator.addMethod("require_role_group", function(value, element, options) {
	var validator = this;
	var selector = options[1];
	
	var validOrNot = $(selector, element.form).filter(function() {
		return validator.elementValue(this);
	}).length >= options[0];
	
	return validOrNot;
}, jQuery.format("Please select 1 choice."));


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
						{"sClass": "hidden-phone", "bSortable": true},
						{"bSortable": true},
						{"sClass": "hidden-phone", "bSortable": true},
						{"bSortable": true},
						{"bSortable": true},
						{"bSortable": false}
				],
	            
	         // fnServerData 
	            "fnServerData": function ( sUrl, aoData, fnCallback, oSettings ) {
	            	
	            	var page = Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength) + 1;
	            	var itemCountPerPage = oSettings._iDisplayLength;
	            	var criteria = me.getCriteria();
	            	
	            	/* Sorting column */
	            	var aoSorting 	= oSettings.aaSorting[0][0];
	            	var sSortDir 	= oSettings.aaSorting[0][1];
	            	var tableColumn = element.find($('th:eq('+ aoSorting +')'));
	            	var iSortCol 	= tableColumn[0].dataset.fieldname; 
	            	
	            	var sorted = {};
	            	
	            	sorted.sortcol = iSortCol;
	            	sorted.sortdir = sSortDir;
	            	$.extend(criteria, sorted);
	            	
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
	            		var province = this.province.name_en;
//	            		var province = this.province.name;
	            		
	            		// category
	            		var category = this.category.title_en;
//	            		var category = this.category.title;
	            		
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
			var validator = form.validate({
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
//		                province_id: "required",
		                cat_id: "required",
		                geo_superuser: "required",
		                
		                upload: {
		                    require_permission_group: [1, ".required-permission"]
	                 	},
	                 	download: {
	                 		require_permission_group: [1, ".required-permission"]
	                 	},
	                 	download_aspera: {
	                 		require_permission_group: [1, ".required-permission"]
	                 	},
	                 	
	                 	is_admin: {
	                 		require_role_group: [1, ".required-role"]
	                 	},
	                 	is_superuser: {
	                 		require_role_group: [1, ".required-role"]
	                 	}
	                 	
		            },
		            
		            messages: {
		            	user_name: "Please enter username",
		            	pwd_user: "Please enter password [Must contain at least 5 characters]",
			            rtpwd_user: "Please Re-type password",
			            fname: "Please enter firstname",
			            lname: "Please enter lastname",
			            geo_id: "Please choose geography",
//			            province_id: "Please choose province",
			            cat_id: "Please choose category",
			            geo_superuser: "Please choose geography",
//			            upload: "Please select 1 choice",
//			            download: "Please select 1 choice",
//			            download_aspera: "Please select 1 choice"
			            	
		            },
		            
//		            ignoreTitle: true,
//		            
//		            ignore: ".ignore",
		            
		            errorPlacement: function(error, element) {
		            	var nameEl = element[0].name;
		            	var groupArr = new Array( "upload", "download", "download_aspera", "is_admin", "is_superuser" );
		            	
		            	if( $.inArray(nameEl, groupArr) > -1 ) {
		            		
		            		var place = element.parent().parent().parent().find("div.error-required-place");
		            		
		            		place.empty();
		            		error.appendTo( place );
		            	} else {
		            		error.appendTo ( element.parent() );
		            	}
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
				
				/* Reset form */ 
				form[0].reset();
				
				/* Reset jquery validation */
				$("label.error").hide();
				$(".error").removeClass("error");
				$(".pwd-ignore").removeClass("pwd-ignore");
				
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
			
			var idEl = $(this).find('[name=user_id]');
			
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
				
				var form = $("form.cmxform");
				if(typeof id !== 'undefined') {
					
					$.validator.addClassRules({
						pwd_user: {
						    required: false
					  },
					  rtpwd_user: {
					    required: false
					   
					  }
						});
					
//					/* Reset jquery validation */
					var pwd_parent 	= $('#pwd_user').parent();
					var rtpwd_parent = $('#rtpwd_user').parent();
					
					pwd_parent.find("label.error").hide();
					$('#pwd_user').addClass("pwd-ignore").removeClass("error");
					
					rtpwd_parent.find("label.error").hide();
					$('#rtpwd_user').addClass("pwd-ignore").removeClass("error");
					
					$("form").data("validator").settings.ignore = ".pwd-ignore";
					
				}
				
				// validate form when it is submitted
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
//				console.log(data);return;
				
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
	

//console.log(1);


return;


var endpoint = APPLICATION_HOST + "/data/mockup_all.json.php";
var modalform = APPLICATION_HOST + "/data/mockup_form.json.php";

$(document).ready(function () {
	
		var dt = $("#admin-user").dataTable( {
			
				"aaSorting": [[ 1, "asc" ]],
	        	/* Length per page */
	        	"iDisplayLength": 10,
	        	
	        	/* Disable pagination range. */
	        	"bLengthChange": false,
	        	
	        	/* Filter or search. */	
	        	//"bFilter": false,
	        	
	        	/* Disable sort column. */
	        	//"bSort": false,
	        	
	        	"bProcessing": true,
	        	"bServerSide": true,
	   		  	"sAjaxSource": endpoint,
	   		  	"bDeferRender": true,
			  	
	   		  	"sDom": 'l<"span12">rtip', 
	   		 
	   		 	"fnServerParams": function ( aoData ) {
					aoData.push( { "name": "pageName", "value": "" } );
		  		},
		  		
		  		/* Define Row Elements. */
				"aoColumns": [
						{"bSortable": false, "sClass": "hidden-phone"}, 
						{"sClass": "hidden-phone" },
						null,
						{"sClass": "hidden-phone" },
						null,
						null,
						{"bSortable": false}
				],
				
		  		"oLanguage": {
	                "sLengthMenu": "_MENU_ records per page",
	                "oPaginate": {
	                    "sPrevious": "Prev",
	                    "sNext": "Next"
	                }
	            },
	            
	            "fnInitComplete"  : function () {
	            	
	            	/* Do something */
	            	
	            	$('.dpUser').datepicker( {
	                    format: 'mm-dd-yyyy'
	                } );
	            	
	            },
	            	
	            "fnDrawCallback": function() {
					
						/* Tooltips loading in dataTables. */
						$(".tooltips").tooltip();
	            }
	        
		} );
		
		/* Unbind auto search. */
		$("div.dataTables_filter input").unbind();
		$('body').on( 'click', '#btnfilter', function (e) {
			
			dt.fnFilter($("div.dataTables_filter div.input-group input").val());
	    });
		
		var d = new Date();
		var month = d.getMonth();
		var day = d.getDate();
		var year = d.getFullYear();
		//var date = $.datepicker.formatDate('dd-mm-yy', d);
		
		var hour = d.getHours();// - Returns the hour of the day (0-23).
		var minute = d.getMinutes();
		if (minute < 10) {
			minute = "0" + minute;
		}
		var time = hour + ":" + minute;
		
		$("body").on("shown.bs.modal", function (e) {
			
			$('.default-date-picker').datepicker({
	            format: 'yy-mm-dd'
	        });
			/* Set current date time default */
			$(".default-date-picker > input").val( date );

		} );
		
		/* Add Item Ajax */
		$("body").on( "click", "#btnSave" ,function() {
				/* Hidden modal */
				$("#formModal").modal("hide");
				// should use 'hidden' for bootstrap 2
				$("#formModal").on("hidden.bs.modal", function (e) {
					/* Call to load a new file */
					dt.fnReloadAjax( endpoint );
				});
			
		} );
		
	
		// Example call to load a new file
		//dt.fnReloadAjax( 'media/examples_support/json_source2.txt' );
		 
		// Example call to reload from original file
		//dt.fnReloadAjax();
		
		/* Delete Item Ajax */
		$("body").on( "click", "#btnYes" ,function() {
				var id 	= $(this).closest( ".modal" ).attr("id");
				var obj = $(this).closest( ".modal" );
				/* Hidden modal */
				$( obj ).modal("hide");
				// should use 'hidden' for bootstrap 2
				$( obj ).on("hidden.bs.modal", function (e) {
					/* Call to load a new file */
					dt.fnReloadAjax( endpoint );
				});
			
		} );
	

} );


})(jQuery);