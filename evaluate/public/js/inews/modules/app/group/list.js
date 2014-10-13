
//var endpoint = APPLICATION_HOST + '/news/service/jsonrpc';
var endpoint = APPLICATION_HOST + "/data/mockup_all.json.php";

//add require from group method
jQuery.validator.addMethod("require_permission_group", function(value, element, options) {
	var validator = this;
	var selector = options[1];
	
	var validOrNot = $(selector, element.form).filter(function() {
		return validator.elementValue(this);
	}).length >= options[0];
	
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
		
		members: [],
		
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
		
		_setupAutocomplete: function() {
			/* Clear old tags input */
			$("div[id$='_tagsinput']").remove();
			
			var me = this;
			var elt = $("input.tagsinput");
			//var service = me.getService();
			//var criteria = me.getCriteria();
			
			// fake input
			//console.log($('#members_tag'));
			
			elt.tagsInput({
				'autocomplete_url': app.baseUrl('app/user/autocomplete'),
				'autocomplete':{selectFirst:false},
				'height':'100px',
				
				onAddTag: function(username) {
					//console.log(arguments, 'onAddTag');
					me.members.push(username);
					//console.log(me.members, 'me.members');
				},
				onRemoveTag: function(username) {
					//console.log(arguments, 'onRemoveTag');
					//console.log(me.members, 'me.members');
					var _members = [];
					
					$.each(me.members, function(key, value) {
						if (value != username) {
							_members.push(value);
						};
					});
					me.members = _members;
					
					//console.log(me.members, 'me.members');
				},
				onChange: function() {
					//console.log(arguments, 'onChange');
				}
			});
		},
		
		_setupDataTable: function() {
			var me = this;
			var service = me.getService();
			var element = $("#admin-group");
			
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
						{"bSortable": false}, 
						{"bSortable": false},
						{"bSortable": false},
						{"bSortable": false}
				],    
	            
	         // fnServerData 
	            "fnServerData": function ( sUrl, aoData, fnCallback, oSettings ) {
	            	
	            	var page = Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength) + 1;
	            	var itemCountPerPage = oSettings._iDisplayLength;
	            	var criteria = me.getCriteria();
	            	
	            	var response = service.getGroupList(page, itemCountPerPage, criteria);
	            	
	            	if(!response.result){
	            		var temp = {
	            				result: {
	            					items: response,
		            				totalItemCount: response.length
		            			}
	            		};
	            		
	            		response = $.extend({}, temp);
	            	}
	            	// transform api data to this plguin
	            	var json = {
	            		aaData: [],
	            		iTotalDisplayRecords: response.result.totalItemCount,
	            		iTotalRecords: response.result.totalItemCount,
	            		sEcho: aoData[0].value
	            	};
	            	
	            	//console.log(response.result.items, 'response.result.items');
	            	
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
	            		var permissionicon = '<span class="label label-info label-mini tooltips" data-original-title="' + 
	            			title+ '"><i class="fa '+icon+ '" '+style+ '></i></span>';
	            			
	            		if (this.is_admin) {
	            			var title = 'Admin';
	            			icon = 'fa-user';
	            			permissionicon += '  <span class="label label-info label-mini tooltips" data-original-title="' +
	            				title+ '"><i class="fa '+icon+ '" '+style+ '></i></span>';
	            		};
	            		
	            		// name
	            		var name = this.name;
	            		
	            		// member
	            		var member = this.members.length;
//	            		console.log('members' , this.members);
	            		
	            		// buttons action
	            		var deleteUrl = APPLICATION_HOST + '/data/mockup_form.json.php?del=1&key=' + this.fileID;
	            		var buttons = 
	            			 
	            			'<button class="btn btn-primary btn-xs tooltips" data-action="save" data-toggle-x="modal" href="#formModal" ' +
	            				'data-original-title="Edit"><i class="fa fa-pencil"></i></button> ' +
	            				
            				'<button class="btn btn-success btn-xs tooltips" data-action="member" data-toggle-x="modal" href="#memberModal" ' +
            					'data-original-title="Add members"><i class="fa fa-user"></i></button> ' +
	            			 
	            			'<button class="btn btn-danger btn-xs tooltips" data-action="delete" data-toggle-x="modal" data-target="#confirmModal" ' +
	            				'id="modal-confirm" data-original-title="Delete" data-placement="left">' +
	            				'<i class="fa fa-trash-o"></i></button>';
	            		
	            		data.push(permissionicon);
	            		data.push(name);
	            		data.push(member);
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
	            	
	            	$('.dpUser').datepicker( {
	                    format: 'mm-dd-yyyy'
	                } );
	            	
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
		            	name: "required",
		            	
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
		            	name: "Please enter name"
		            },
		            
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
			
			// Clear modal on page.
			$('body').on('hidden.bs.modal', '.modal', function () {
				
				$(this).removeData('bs.modal');
				
				/* Reset group form */
				form[0].reset();
				
				/* Reset jquery validation */
				$("label.error").hide();
				$(".error").removeClass("error");
				
				var memberObj = $('#member_multiselect');
				memberObj.multiSelect('refresh');
				
//				$("div[id$='_tagsinput']").remove();
				
			});	
			
	    	// buttons
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
		
		genSelectOptions: function(data, target) {
			
			target.empty();
			var html = '';
			for (var i = 0, len = data.length; i < len; ++i) {
			    html += '<option value="' + data[i] + '" selected>' + data[i] + '</option>';
			}           
			
			target.append(html);
		},
		
		genAutocomplete: function(data, target) {
			var me = this;
			var text = '';
			
			for (i = 0; i < data.length; i++) { 
			    //text += ',' + data[i].fname + '  ' + data[i].lname;
			    text = data[i].user_name;
			    
			    me.members.push(text);
			}
			
			target.val(text);
			me._setupAutocomplete();
		},
		
		save: function(data, target) {
			var me = this;
			
			//console.log(data, 'data');
			//console.log(target, 'target');
			
			// element
			var elid = target.find('[name=id]');
			var elname = target.find('[name=name]');
			
			var elupload = target.find('[name=upload]');
			var eldownload = target.find('[name=download]');
			var elaspera = target.find('[name=download_aspera]');
			
			var elis_admin = target.find('[name=is_admin]');
			var elis_superuser = target.find('[name=is_superuser]');
			var elgeo = target.find('[name=geo_superuser]');
			
			var elmember = target.find('[name=member]');
			
			// data
			var id = data.id || 0;
			var name = data.name || '';
			var upload = data.upload || '';
			var download = data.download || '';
			var aspera = data.download_aspera || '';
			var is_admin = data.is_admin || '';
			var is_superuser = data.is_superuser || '';
			var geo = data.geo_superuser || '';
			var members = data.members || [];
			
			//
			// reset form
			//
			elid.val("");
			elname.val("");
			
			elupload.prop("checked", false);
			eldownload.prop("checked", false);
			elaspera.prop("checked", false);
			
			elis_admin.prop("checked", false);
			elis_superuser.prop("checked", false);
			elgeo.prop("checked", false);
			
			elgeo.find('option').prop('selected', false);
			
			
			if (is_superuser) {
				elgeo.removeClass('disabled');
				elgeo.prop('disabled', false);	
			} else {
				elgeo.addClass('disabled');
				elgeo.prop('disabled', true);	
			};
			
			
			var membersEl = target.find('.form-group.members');
			membersEl.removeClass('hide');
			membersEl.addClass('hide');
			if (id) {
				membersEl.removeClass('hide');
			};
			
			
			// default values
			elid.val(id);
			elname.val(name);
			if(upload) {
				elupload.prop("checked", true);
			};
			if(download) {
				eldownload.prop("checked", true);
			};
			if(aspera) {
				elaspera.prop("checked", true);
			};
			if(is_admin) {
				elis_admin.prop("checked", true);
			};
			if(is_superuser) {
				elis_superuser.prop("checked", true);
			};
			
			if (is_superuser) {
				//console.log(geo, 'geo');
				elgeo.find('option').each(function() {
					var value = $(this).val().toString();
					
					//console.log(value, 'value');
					
					if ($.inArray(value, geo) != -1) {
						$(this).prop('selected', true);
						//console.log('yes');
					} else {
						//console.log('no');
					}
				});
			};

			//
			// behavior
			//
			//elgeo[is_superuser ? 'removeClass' : 'addClass']('disabled');
			elis_superuser.off('change');
			elis_superuser.on('change', function(e) {
				var checked = $(this).is(':checked');
				elgeo[checked ? 'removeClass' : 'addClass']('disabled');
				elgeo.prop('disabled', !checked);
				
				elis_admin.prop('checked', false);
			});
			
			if (is_superuser) {
				//elis_superuser.trigger('change');
			};
			
			elis_admin.off('change');
			elis_admin.on('change', function(e) {
				var checked = $(this).is(':checked');
				elis_superuser.prop('checked', false);
				
				elgeo.addClass('disabled');
				elgeo.prop('disabled', true);
			});
			
			if (is_admin) {
				//elis_admin.trigger('change');
			};
			
			//me.genSelectOptions(geo, elgeo);
			
			//if($.isArray(data.members) && (data.members.length > 0)) {
//			if (data.id) {
//				me.genAutocomplete(members, elmember);
//			};
			
			// binde hide event on the preview modal
			target.bind('hide.bs.modal', function() {
				$(this).removeData('bs.modal');
			});
			
			// close button on the title bar
			target.off('click', '.btn[data-dismiss="modal"]');
			target.on('click', '.btn[data-dismiss="modal"]', function() {
				target.modal('hide');
			});
			
			var buttonRule = '.btn.save';
			
			// set lang
			if ($.isEmptyObject(data)) {
				target.find('.modal-title').text(app._('Add Group'));
				target.find(buttonRule).text(app._('Add Group'));
			} else {
				target.find('.modal-title').text(app._('Edit Group'));
				target.find(buttonRule).text(app._('Edit Group'));
			};		
			
			
    		// validate info form
			var formEl = target.find('form');
			formEl.validate();
			
			target.off('click', buttonRule);
			target.on('click', buttonRule, function(e) {
				
				// validate form when it is submitted
				var form = $("form.cmxform");
				var valid = form.valid();
				if ( !valid ) {
					return false;
				}
				
				e.preventDefault();
				
	    		var valid = formEl.valid();
	    		if (!valid) {
	    			return false;
	    		}				
				
				target.modal('hide');
				
				var item = {
					name: elname.val(),
						
					upload: elupload.prop('checked'),
					download: eldownload.prop('checked'),
					download_aspera: elaspera.prop('checked'),
					
					is_admin: elis_admin.prop('checked'),
					is_superuser: elis_superuser.prop('checked')
				};
				
				// geography
				item.geo_superuser = [];
				if (item.is_superuser) {
					elgeo.find('option').each(function() {
						var el = $(this);
						if (el.is(':selected')) {
							item.geo_superuser.push(el.val());
						};
					});	
				};
				
				// members (visible)
				/* Don't edit members. */
//				if (id) {
//					item.members = me.members;
//				};
				
				item = $.extend({}, data, item);
//				console.log(item, 'item');
				
				me.getService().saveGroup(item);
				me.load();
				return false;
			});
			
			target.modal('show');
		},
		
		member: function(data, target) {
			var me = this;
			// element
			var idEl = target.find('[name=id]');
			// data
			var id = data.id || 0;
			var members = data.members;
			var user_id = [];
			var user_name = [];

			idEl.val(id);
			
			target.modal('show');
			
			$.each(members, function(key, value) {
				user_id[key] = members[key].user_id;
				user_name[key] = members[key].user_name;
			});
/*			
			$('#select-all').click(function(){
				memberObj.multiSelect('select_all');
				return false;
			});
			$('#deselect-all').click(function(){
				memberObj.multiSelect('deselect_all');
				return false;
			});
			*/
			/* Setup Multi select */
			var memberObj = $('#member_multiselect');
			memberObj.multiSelect({
				selectableOptgroup: true, /* can selected by group. */
		        selectableHeader: "<input type='text' class='form-control search-input' autocomplete='off' placeholder='search...'>",
		        selectionHeader: "<input type='text' class='form-control search-input' autocomplete='off' placeholder='search...'>",
		        afterInit: function (ms) {
		            var that = this,
		                $selectableSearch = that.$selectableUl.prev(),
		                $selectionSearch = that.$selectionUl.prev(),
		                selectableSearchString = '#' + that.$container.attr('id') + ' .ms-elem-selectable:not(.ms-selected)',
		                selectionSearchString = '#' + that.$container.attr('id') + ' .ms-elem-selection.ms-selected';
//
		            that.qs1 = $selectableSearch.quicksearch(selectableSearchString)
		                .on('keydown', function (e) {
		                    if (e.which === 40) {
		                        that.$selectableUl.focus();
		                        return false;
		                    }
		                });

		            that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
		                .on('keydown', function (e) {
		                    if (e.which == 40) {
		                        that.$selectionUl.focus();
		                        return false;
		                    }
		                });
		        },
		        afterSelect: function () {
		            this.qs1.cache();
		            this.qs2.cache();
		        },
		        afterDeselect: function () {
		            this.qs1.cache();
		            this.qs2.cache();
		        }
		    });
			
			/* Reset multi selecte */
			var form = $('.cmxform.member-form');
			form[0].reset();
		
//			memberObj.multiSelect('select', user_id);
			memberObj.multiSelect('select', user_name);
			memberObj.multiSelect('refresh');	
			
			// binde hide event on the preview modal
			target.bind('hide.bs.modal', function() {
				$(this).removeData('bs.modal');
			});
			
			// close button on the title bar
			target.off('click', '.btn[data-dismiss="modal"]');
			target.on('click', '.btn[data-dismiss="modal"]', function() {
				target.modal('hide');
			});
			
			var buttonRule = '.btn.save';
			var groupName = data.name || 'Undefined';
			// set lang
			if ($.isEmptyObject(data)) {
				target.find('.modal-title').text(app._('Add Member'));
				target.find(buttonRule).text(app._('Add Member'));
			} else {
				target.find('.modal-title').text(app._('Edit Member ( ' + groupName + ' )'));
				target.find(buttonRule).text(app._('Edit Member'));
			};
			
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
				
				var item = {
					id: $.trim(idEl.val())
				};
				// members
				item.members = [];
				var members = {};
				var selection = $('select#member_multiselect').val();
				$.each(selection, function(key, value) {
					if( value ) {
						item.members.push( value );
					}
				});	
				
				var result = $.extend({}, data, item);
				
				me.getService().saveGroup(result);
				me.load();
				
				return false;
			});
		},
				
		delete: function(data, target) {
			
			var me = this;
			
			// lang
			target.find('.modal-body').text(app._('Do you want to delete this group?'));
			
			target.modal('show');
			
			// close button
			target.off('click', '.btn[data-dismiss="modal"]');
			target.on('click', '.btn[data-dismiss="modal"]', function() {
				target.modal('hide');
			});
			
			target.off('click', '.btn.delete');
			target.on('click', '.btn.delete', function() {
				
				target.modal('hide');
				
				me.getService().deleteGroupById(data.id);
				me.load();
			});
		},
		
		
		_onInitComplete: function() {
			var me = this;
			
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
		Controller.init();
	})	

})(jQuery);
