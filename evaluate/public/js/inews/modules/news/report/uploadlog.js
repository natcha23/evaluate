
var endpoint = APPLICATION_HOST + "/data/report_log.json.php";

$(document).ready(function () {
	
	
		var dt = $('#report-upload-log').dataTable( {
			  
		    	"aaSorting": [[ 1, "asc" ]],
		    	
		    	"iDisplayLength": 10,
		    	"bLengthChange": false,
		    	
		    	"bProcessing": true,
		    	"bServerSide": true,
			  	"sAjaxSource": endpoint,
			  	"bDeferRender": true,
			  	
			  	"fnServerParams": function ( aoData ) {
			  		
					 aoData.push( { "name": "pageName", "value": "report-log" },
							 	  { "name": "from", "value": $('.dbp1').val() }
					 );
					 
			  	},
			  	
			  	"sDom": 'l<"span12">rtip', 
			  	
			  	
				"fnDrawCallback": function(){
					
						/* Do something */
						$(".dpd1").datetimepicker({
							format: 'dd-mm-yyyy hh:ii',
							"setDate": new Date(),
							"onClick": function(date) {
					            minDateFilter = new Date(date).getTime();
					            dt.fnDraw();
					        }
					    }).keyup(function(){
						        minDateFilter = new Date(this.value).getTime();
						        dt.fnDraw();
					    });
						
						$(".dpd2").datetimepicker({
							format: 'dd-mm-yyyy hh:ii',
							"onClick": function(date) {
					            minDateFilter = new Date(date).getTime();
					            dt.fnDraw();
					        }
					    }).keyup(function(){
						        minDateFilter = new Date(this.value).getTime();
						        dt.fnDraw();
					        
					    });
						
						/* Tooltips loading in dataTables. */
						$(".tooltips").tooltip();
						
				},
				
		} );
		
		var d = new Date();
		var month = d.getMonth();
		var day = d.getDate();
		var year = d.getFullYear();
		var date = $.datepicker.formatDate('dd-mm-yy', d);
		
		var hour = d.getHours();// - Returns the hour of the day (0-23).
		var minute = d.getMinutes();
		if (minute < 10) {
			minute = "0" + minute;
		}
		var time = hour + ":" + minute;
		/* Set current date time default */
		$(".dpd1").val(date + ' ' + time );
		$(".dpd2").val(date + ' ' + time );
		
		/* Unbind auto search. */
		$("div.dataTables_filter input").unbind();
		$('body').on( 'click', '#btnfilter', function (e) {
			
			dt.fnFilter($("div.table_filter input").val());
	    });
		
				
} );