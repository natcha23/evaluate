var endpoint = APPLICATION_HOST + '/news/service/jsonrpc';

var Controller = {
		
	init: function() {
		
		this.setup();
	},
	
	setup: function() {
		
		//Tooltips loading in datatables.
		$(".tooltips").tooltip();
		
		//console.log('before _setupDataTable()');
		this._setupDataTable();
	},
	
	getService: function() {
		if (this.service == undefined) {
			this.service =  jQuery.Zend.jsonrpc({url: APPLICATION_HOST + '/news/service/jsonrpc'});
		};
		return this.service;
	},
		
	_setupDataTable: function() {
		var me = this;
		var service = me.getService();
		var element = $("#report-upload-log");
		
		this.dataTable = element;
		
//		console.log(app.defaults.itemCountPerPage, 'app.defaults.itemCountPerPage');
		
		var dt = element.dataTable( {
			
			"aaSorting": [[ 1, "asc" ]],
        	/* Length per page */
        	"iDisplayLength": app.defaults.itemCountPerPage,
        	
        	/* Disable pagination range. */
        	"bLengthChange": false,
        	
        	/* Filter or search. */
        	//"bFilter": false,
        	
        	/* Disable sort column. */
        	//"bSort": false,
        	
        	"bProcessing": false,
        	"bServerSide": true,
   		  	"sAjaxSource": endpoint,
   		  	"deferLoading": 57,
   		  	
   		  	"bDeferRender": true,
		  	
   		 	"fnServerParams": function ( aoData ) {
				aoData.push( { "name": "pageName", "value": "receive" } );
	  		},
	  		
	  		"oLanguage": {
                "sLengthMenu": "_MENU_ records per page",
                "oPaginate": {
                    "sPrevious": "Prev",
                    "sNext": "Next"
                }
            },
        
            /* Default is 'lfrtip' 
             * [l-lengthchange, f-filter, r-processing, t-table, i-info, p-pagination] 
             */
            "sDom": 'l<"span12">rtip', 
            
            /* Define Row Elements. */
			"aoColumns": [
					{"sClass": "hidden-phone", "bSortable": true},
					{"bSortable": true},
					{"sClass": "hidden-phone", "bSortable": true},
					{"bSortable": true},
					{"bSortable": true}
			],
            
            // fnServerData 
            "fnServerData": function ( sUrl, aoData, fnCallback, oSettings ) {
            	//console.log('fnServerData');
            	//console.log(arguments, 'arguments');
            	
//            	window.setTimeout(function() {
//            		dt.fnloadAjax();
//            	}, 3000);
            	
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
            	
            	var response = service.getUploadLogList(page, itemCountPerPage, criteria);
            	console.log(response, 'response');
            	
            	// transform api data to this plguin
            	
            	var json = {
            		aaData: [],
            		iTotalDisplayRecords: response.result.totalItemCount,
            		iTotalRecords: response.result.totalItemCount,
            		sEcho: aoData[0].value
            	};
            	
            	
            	$.each(response.result.items, function() {
            		var data = [];
            		
            		// ip
            		var ip = this.journalistIP;
            		
            		// time
            		var time = this.times;
            		
            		// journalist
            		var journalist = this.journalist.fname + ' ' + this.journalist.lname;
            		
            		// subject
            		var subject = this.subject;
            		
            		// filename
            		var filename = this.originFilename;
            		
            		data.push(ip);
            		data.push(time);
            		data.push(journalist);
            		data.push(subject);
            		data.push(filename);
            		
            		json.aaData.push(data);
            	});
            	
            	console.log(json, 'json');
            	
            	fnCallback( json );
            	
            	// set data value for query data
            	$.each($(oSettings.nTBody).find('tr'), function(key) {
            		$(this).data('value', response.result.items[key]);
            	});
            },
            
            "fnInitComplete"  : function () {
            	me._onInitComplete();
            },
            
            "fnPreDrawCallback": function() {
            	// @todo loading ?
            	
            },
            	
            "fnDrawCallback": function() {
					/* Tooltips loading in dataTables. */
					$(".tooltips", element).tooltip();
            }
        
		} );
		
	},
	
	_setupToolbar: function() {
		var me = this;
		
		$('input[name="from"], input[name="to"]').datetimepicker({
			//format: 'dd-mm-yyyy hh:ii',
			format: 'yyyy-mm-dd hh:ii',
			"onClick": function(date) {
	            //minDateFilter = new Date(date).getTime();
			}
		});
		
		// keyword enter
		//console.log(this.dataTable, 'dataTable');
		$('input[name=keyword]').keypress(function(e) {
			var code = (e.keyCode ? e.keyCode : e.which);
			if (code == 13) {
				me.load();
			};
		});
		
		$('body').on( 'click', '#btnfilter', function (e) {
			//dt.fnFilter($("div.table_filter input").val());
			
			me.load();
	    });	
	},
	
	_onInitComplete: function() {
		var me = this;
		
		// ? after setup dataTable only
		//consoel.log('before _setupToolbar()');
		this._setupToolbar();
	},
	
	//  find all criteria in this function ja
	getCriteria: function() {
		var me = this;
		
		var criteria = {};
		criteria.startDate = $('input[name=from]').val();
		criteria.endDate = $('input[name=to]').val();
		criteria.keyword = $('input[name=keyword]').val();
		
		return criteria;
	},
	
	load: function() {
		
		// @todo beforeLoad (loading)
		
		
		// @todo delay for fast click
//		console.log('load process');
		
		var me = this;
		var criteria = me.getCriteria();
//		console.log(criteria, 'criteria');
		
		me.dataTable.fnReloadAjax();
		
		//console.log(me.dataTable, 'me.dataTable');
		
		// @todo after load
	}
};

(function($) {
	$(function() {
		Controller.init();
	})
})(jQuery);