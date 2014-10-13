


//var endpoint = APPLICATION_HOST + '/news/service/jsonrpc';
var endpoint = APPLICATION_HOST + "/data/mockup_all.json.php";


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
			
//			$('form').validate();
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
			var element = $("#admin-category");
			
			this.dataTable = element;
			
			var dt = element.dataTable( {
				
				"aaSorting": [[ 0, "asc" ]],
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
	            	
	            	var response = service.getCategoryList(page, itemCountPerPage, criteria);

	            	// transform api data to this plguin
	            	var json = {
	            		aaData: [],
	            		iTotalDisplayRecords: response.result.totalItemCount,
	            		iTotalRecords: response.result.totalItemCount,
	            		sEcho: aoData[0].value
	            	};
	            	
	            	$.each(response.result.items, function() {
	            		var data = [];
	            		
	            		// title
	            		var title = this.title;
	            		
	            		// title_en
	            		var title_en = this.title_en;
	            		
	            		// buttons action
	            		var deleteUrl = APPLICATION_HOST + '/data/mockup_form.json.php?del=1&key=' + this.fileID;
	            		var buttons = 
	            			 
	            			'<button class="btn btn-primary btn-xs tooltips" data-action="save" data-toggle-x="modal" href="#formModal" ' +
	            				'data-original-title="Edit"><i class="fa fa-pencil"></i></button> ' +
	            			
	            			'<button class="btn btn-danger btn-xs tooltips" data-action="delete" data-toggle-x="modal" data-target="#confirmModal" ' +
	            				'id="modal-confirm" data-original-title="Delete" data-placement="left">' +
	            				'<i class="fa fa-trash-o"></i></button>';
	            		
	            		data.push(title);
	            		data.push(title_en);
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
		            	title: "required",
		                title_en: "required"
		            },
		            messages: {
		            	title: "Please enter title",
		            	title_en: "Please enter title english"
		            }
		     });
				
	        
			// Clear modal on page.
			$('body').on('hidden.bs.modal', '.modal', function () {
				$(this).removeData('bs.modal');
				
				/* Clear data on modal */
				var elid = $(this).find('[name=id]');
				var eltitle = $(this).find('[name=title]');
				var eltitle_en = $(this).find('[name=title_en]');
				
				elid.val('');
				eltitle.val('');
				eltitle_en.val('');
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
		
		save: function(data, target) {
			var me = this;
//			var comment = data.comment || '';
			var item = '';
			
			var id = data.id || '';
			var title = data.title || '';
			var title_en = data.title_en || '';
			
			var elid = target.find('[name=id]');
			var eltitle = target.find('[name=title]');
			var eltitle_en = target.find('[name=title_en]');
			
			elid.val(id);
			eltitle.val(title);
			eltitle_en.val(title_en);
			
			
			target.modal('show');
			
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
				target.find('.modal-title').text(app._('Add Category'));
				target.find(buttonRule).text(app._('Add Category'));
			} else {
				target.find('.modal-title').text(app._('Edit Category'));
				target.find(buttonRule).text(app._('Edit Category'));
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
					id: $.trim(elid.val()),
					title: $.trim(eltitle.val()),
					title_en: $.trim(eltitle_en.val())
				};
				
				$.extend(data, item);
				
				me.getService().saveCategory(item);
				me.load();
				
				return false;
			});
		},
		
		delete: function(data, target) {
			
			var me = this;
			
			// lang
			target.find('.modal-body').text(app._('Do you want to delete this category?'));
			
			target.modal('show');
			
			// close button
			target.off('click', '.btn[data-dismiss="modal"]');
			target.on('click', '.btn[data-dismiss="modal"]', function() {
				target.modal('hide');
			});
			
			target.off('click', '.btn.delete');
			target.on('click', '.btn.delete', function() {
				
				target.modal('hide');
				
				me.getService().deleteCategoryById(data.id);
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
			console.log('load process');
			
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

return;

var endpoint = APPLICATION_HOST + "/data/mockup_all.json.php";

$(document).ready(function () {
	
		var dt = $('#admin-category').dataTable( {
			  
		    	"aaSorting": [[ 1, "asc" ]],
		    	
		    	"iDisplayLength": 10,
		    	"bLengthChange": false,
		    	
		    	"bProcessing": true,
		    	"bServerSide": true,
			  	"sAjaxSource": endpoint,
			  	"bDeferRender": true,
			  	
			  	"sDom": 'l<"span12">rtip', 
			  	
			  	"fnServerParams": function ( aoData ) {
					 aoData.push( { "name": "pageName", "value": "category" } );
			  	},
			  	
			  	"aoColumnDefs": [
						// Define Columns header.
						{ "hidden-phone fa fa-picture-o": "Thumbnail",
							"aTargets": [0]
						},
						// Define Row Elements.
						{
			            	"fnRender": function ( oObj ) {
			                  		return oObj.aData[0];
							},
							
							"bUseRendered": true,
							"aTargets": [ 0 ]
						}
				],
				
				// Define Row Elements.
				"aoColumns": [
						null,
						null,
						{"bSortable": false}
				],
				
				"fnDrawCallback": function(){
					
			           //$(".dataTables_length").empty().prepend("<button data-toggle=\"modal\" data-target=\"#formModal\" class=\"btn btn-primary\" href=\"/data/mockup_form.json.php?\" id=\"modal-link\" >Add Category <i class=\"fa fa-plus\"></i></button>");
			           
			           /* Tooltips loading in dataTables. */
						$(".tooltips").tooltip();
				}
		      	   		      
		} );
		
		/* Unbind auto search. */
		$("div.dataTables_filter input").unbind();
		$('body').on( 'click', '#btnfilter', function (e) {
			
			dt.fnFilter($("div.dataTables_filter div.input-group input").val());
	    });
		
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