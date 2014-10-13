var endpoint = APPLICATION_HOST + "/data/mockup_all.json.php";
var modalpage = APPLICATION_HOST + "/data/mockup_form.json.php";

//global variable for aspera plugin
window.asperaWeb = null;

// aspera setup
var setup = function () {
	window.asperaWeb = new AW.Connect({id:'aspera_web_transfers'});
	window.asperaWeb.initSession("SimpleDownload");
	window.asperaWeb.addEventListener('transfer', fileControls.handleTransferEvents);
	
	// @todo if can download via aspera setting
	
	// start after aspera setup
	if (window.can_download_aspera) {
		(function($) {
			$(function() {
				Controller.init();
			})
		})(jQuery);
	}
};

var fileControls = {
	handleTransferEvents: function (event, obj) {
	    switch (event) {
	        case 'transfer':
	            //document.getElementById('progress_meter').innerHTML = JSON.stringify(obj, null, 4);
	            break; 
	    }
	},

	downloadFile: function (data) {
		
		transferSpec = $.extend({}, transferSpec, {
			direction: 'receive',
			allow_dialogs: true,
			resume: 'sparse_checksum'
		});
		
		// @todo by user or file settings
		transferSpec.target_rate_kbps = 50000;
		
		// reset
		transferSpec.paths = [];
		transferSpec.paths.push({source: data.asperaDownloadPath});
		
	    connectSettings = {
	        "allow_dialogs": "yes"
	    };
	    
//	    console.log(transferSpec, 'transferSpec');
//	    console.log(data, 'data');
 
	    //document.getElementById('transfer_spec').innerHTML =    JSON.stringify(transferSpec, null, "    ");
 
	    response = window.asperaWeb.startTransfer(transferSpec, connectSettings);
	}
};

var Controller = {
		
	init: function() {
		
		this.setup();
	},
	
	setup: function() {
		
	    // fn (may be was included by natacharee at layout.phtml)
	    $.fn.disableButton = function (opt) {
			if( opt ) {
				this.attr('disabled', 'disabled');
			} else {
				this.removeAttr('disabled');
			}
		};  
		
		//Tooltips loading in datatables.
		$(".tooltips").tooltip();
		
		//console.log('before _setupDataTable()');
		this._setupDataTable();
	},
	
	_onInitComplete: function() {
		var me = this;
		
		// ? after setup dataTable only
		//consoel.log('before _setupToolbar()');
		this._setupToolbar();
		this._setupSidebar();
		this._setupModals();
		
    	var deleteButton = $("#dt-del-files");
    	var fileSelected = $("#file-selected");
    	
    	var dt = me.dataTable;
    	
    	$('#check_all').click(function() {
    		
    		// @todo bind this event in pagination
    		me.checkAll(this.checked);
    	} );
    	
    	dt.on( 'click', '.mail-checkbox', function () {
    		me.updateSelctedFiles();
    	});
    	
    	deleteButton.click(function(e) {
    		var el = $(this);
    		
    		var target = el.attr('href') || '';
    		if (!target.length) {
    			target = el.data('target') || '';
    		};
    		
    		if (!target.length) return;
    		
    		// action to method
    		var action = el.data('action') || '';
    		var method = app.toCamelCase(action);
    		
    		var rows = dt.find('tr:has(:checked)');
    		
    		if (!rows.length) return false;
    		
    		var files = [];
    		$.each(rows, function() {
    			var value = $(this).data('value');
    			var file = {fileId: value.fileID, id: value.id};
    			files.push(file);
    		});
    		
    		me.multiDelete(files, $(target));

    		
    		return false;
    	});
	},
	
	updateSelctedFiles: function() {
		var me = this;
		var dt = me.dataTable;
    	var deleteButton = $("#dt-del-files");
    	var fileSelected = $("#file-selected");
    	
		var rowSelect = 0;
     	$('input', dt.fnGetNodes()).each( function(index, obj) {
     		if(obj.checked==true) {
     			rowSelect += 1;
     		}
     	} );
     
    	fileSelected.empty().html( rowSelect );
    	deleteButton.disableButton(rowSelect == 0);
	},
	
	checkAll: function(checked) {
		var me = this;
		var dt = me.dataTable;
    	var deleteButton = $("#dt-del-files");
    	var fileSelected = $("#file-selected");
		
		var checkall = checked;
		var rowSelect = dt.fnGetNodes().length;
		
		$( 'input', dt.fnGetNodes() ).each( function(index, obj) {
			 if(checkall==true) {
				 obj.checked = true;
				 
			 } else {
				 obj.checked = false;
				 rowSelect = 0;
			 }
		} );
		 
		fileSelected.empty().html( rowSelect );
		deleteButton.disableButton(rowSelect == 0);
	},
	
	_setupModals: function() {
		var me = this;
		var dt = this.dataTable;
		
		// Clear modal on page.
		$('body').on('hidden.bs.modal', '.modal', function () {
			$(this).removeData('bs.modal');
		});	
		
    	// buttons
    	dt.on('click', 'button[data-toggle-x], a[data-toggle-x]', function() {
    	
    		var data = $(this).parents('tr:first').data('value');
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
	
	downloadViaAspera: function(data) {
		//console.log('downloadViaAspera');
		fileControls.downloadFile(data);
	},
	
	downloadViaHttp: function(data) {
		window.location.href = data.downloadUrl;
	},
	
	downloadDetails: function(data) {
		window.location.href = data.detailDonwloadUrl;
	},
	
	comment: function(data, target) {
		var me = this;
		var comment = data.comment || '';
		var el = target.find('[name=comment]')
		el.val(comment);
		
		
		target.modal('show');
		
		// binde hide event on the preview modal
		target.bind('hide.bs.modal', function() {

		});
		
		// close button on the title bar
		target.off('click', '.btn[data-dismiss="modal"]');
		target.on('click', '.btn[data-dismiss="modal"]', function() {
			target.modal('hide');
		});
		
		
		
		var buttonRule = '.btn.save';
		target.off('click', buttonRule);
		target.on('click', buttonRule, function(e) {
			e.preventDefault();
			
			target.modal('hide');
			
			var fileId = data.fileID;
			var comment = el.val() || '';
			
			me.getService().saveComment(fileId, comment);
			
			data.comment = comment;
			
			return false;
		});
	},
	
	preview: function(data, target) {
//		console.log('preview');
//		console.log(data, 'data');
//		console.log(target, 'target');
		
		var me = this;
		
		
		// @todo check is video (flv) or image (jpg) or ... the other
		var extension = app.getFileExtension(data.previewFile);
		var is_video = (extension == 'flv');
		var is_image = (extension == 'jpg');
		
		
		if (target.length) target.remove();
		
		// add html to body
		var templateId = 'template-preview';
		var template = tmpl(templateId);
    	var html = template({
    		file: data,
    		is_video: is_video,
    		is_image: is_image
    	});
    	$(html).appendTo('body');
    	
    	target = $(target.selector);
		
    	// video jPlayer plugin
    	if (is_video) {
    		var video = $('#jquery_jplayer_1');
    		var swfPath = $('#' + templateId).data('swfpath') || '/js/jPlayer';
    		video.jPlayer({
	       		 cssSelectorAncestor: '#jp_container_1',
	       		 cssSelector: {
	       		  videoPlay: '.jp-video-play',
	       		  play: '.jp-play',
	       		  pause: '.jp-pause',
	       		  stop: '.jp-stop',
	       		  seekBar: '.jp-seek-bar',
	       		  playBar: '.jp-play-bar',
	       		  mute: '.jp-mute',
	       		  unmute: '.jp-unmute',
	       		  volumeBar: '.jp-volume-bar',
	       		  volumeBarValue: '.jp-volume-bar-value',
	       		  volumeMax: '.jp-volume-max',
	       		  playbackRateBar: '.jp-playback-rate-bar',
	       		  playbackRateBarValue: '.jp-playback-rate-bar-value',
	       		  currentTime: '.jp-current-time',
	       		  duration: '.jp-duration',
	       		  title: '.jp-title',
	       		  fullScreen: '.jp-full-screen',
	       		  restoreScreen: '.jp-restore-screen',
	       		  repeat: '.jp-repeat',
	       		  repeatOff: '.jp-repeat-off',
	       		  gui: '.jp-gui',
	       		  noSolution: '.jp-no-solution'
	       		 },
	       		ready: function() {
	       			$(this)
	       			.jPlayer("setMedia", {
	       				flv: data.previewFile,
	       				volume: 0.8,
	       				mute: false
	       				
	       			})
	       			.jPlayer('play');
	       		},
	       		loop: false,
	       		preload: "auto",
	       		solution: "flash, html", // Flash with an HTML5 fallback,
	       		supplied: "flv, webmv, ogv, m4v, mp4",
	       		swfPath: swfPath,
	               size: {
	                  //width: "540px",
	                  // height: "360px",
	                  cssClass: "jp-video-270p"
	               },
	               smoothPlayBar: true,
	               keyEnabled: true
        	});
        	
    	} else if (is_image) {
    		
    	}
    	
		target.modal('show');
		
		// binde hide event on the preview modal
		target.bind('hide.bs.modal', function() {
			if (is_video) {
				video.jPlayer('destroy');
			} else if (is_image) {
				
			}
		});
		
		// close button on the title bar
		target.off('click', '.btn[data-dismiss="modal"]');
		target.on('click', '.btn[data-dismiss="modal"]', function() {

		});
		
		// @todo 4 actions
		
		var showDetailPreview = function(show) {
			var c1 = show ? 'addClass' : 'removeClass';
			var c2 = show ? 'removeClass' : 'addClass';
			
			target.find('.video-preview,.image-preview')[c1]('hide');
			target.find('.detail-preview')[c2]('hide');
		};

		// view video
		target.off('click', '.btn.view-video');
		target.on('click', '.btn.view-video', function() {
			showDetailPreview(false);
		});
		
		// view detail
		target.off('click', '.btn.view-detail');
		target.on('click', '.btn.view-detail', function() {
			showDetailPreview(true);
		});
		
		// download video
		target.off('click', '.btn.download-video');
		target.on('click', '.btn.download-video', function() {
			me.downloadViaHttp(data);
//			target.modal('hide');
		});
		
		// download detail
		target.off('click', '.btn.download-detail');
		target.on('click', '.btn.download-detail', function() {
			me.downloadDetails(data);
			//target.modal('hide');
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
			
			var fileId = data.fileID;
			var operationId = data.id;
			
			me.getService().deleteFile(fileId, operationId);
			
			me.load();
			
		});
	},
	
	multiDelete: function(files, target) {
		var me = this;
		
		// lang
		if (files.length > 1) {
			var text = app._('Do you want to delete this files?')
		} else {
			var text = app._('Do you want to delete this file?')
		};
		
		target.find('.modal-body').text(text);
		
		target.modal('show');
		
		// close button
		target.off('click', '.btn[data-dismiss="modal"]');
		target.on('click', '.btn[data-dismiss="modal"]', function() {
			target.modal('hide');
		});
		
		target.off('click', '.btn.delete');
		target.on('click', '.btn.delete', function() {
			target.modal('hide');
			
			me.getService().deleteFiles(files);
			me.load();
		});
	},
	
	_setupSidebar: function() {
		
		var me = this;
		
		// left sidebar
	    $('.inbox-nav').dcAccordion({
	    	eventType: 'click',
	        autoClose: true,
	        saveState: true,
	        disableLink: true,
	        speed: 'slow',
	        showCount: false,
	        autoExpand: true,
	        classExpand: 'dcjq-current-parent'
	    });
	    
		/* Fire process on dataTables */
		$('body').on('click', 'ul.sub li:not(:has(.sub))', function (e, a) {
			
			// for descendants click occurs many event 
			// because it will be called parent element
			e.stopPropagation();
			
			// save element
			me.sidebarSelectedEl  = this;
			
//			console.log($(this).data('value'), 'li value');
			
			
			me.load();
	    });
		
	},
	
	_setupToolbar: function() {
		
		var me = this;
		
		// Add checkbox all list.
		var htmlMailOptions = "<div class=\"span12 mail-option\">" +
				"<div class=\"chk-all\"><input type=\"checkbox\" class=\"mail-checkbox mail-group-checkbox\" id=\"check_all\" value=\"uncheck\"> All</div>" +
				"<div class=\"chk-all hide\"><input type=\"checkbox\" name=\"hide_running_transfers\" class=\"mail-checkbox mail-group-checkbox\" value=\"1\"> Hide Running Transfers</div>" +
				"<div class=\"btn-group col-xs-6 pull-right position\"><div class=\"form-group pull-right\"><span id=\"file-selected\">0</span>  files&nbsp;&nbsp;" +
				"<button class=\"btn btn-white\" id=\"dt-del-files\" data-toggle-x=\"modal\" data-target=\"#confirmModal\" data-action=\"delete-all\"><i class=\"fa fa-trash-o text-info\"></i> Delete selected files</button>" +
				"</div>" +
				"</div>" +
			"</div>";
		
		// toolbar:  check all, hide running transfers, delete selected file bar
		$("div.span12").html( htmlMailOptions );
		
		/* Unbind auto search. */
		$("div.dataTables_filter input").unbind();
		$('body').on( 'click', '#btnfilter', function (e) {
			//dt.fnFilter($("div.table_filter input").val());
			
			me.load();
	    });	
		
		/* Default button delete select files */
		$("#dt-del-files").disableButton(true);
		
		
		// filter
		
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
		var element = $("#tbl-list")
		
		this.dataTable = element;
		
		var dt = element.dataTable( {
			
				"aaSorting": [[ 1, "asc" ]],
	        	/* Length per page */
	        	"iDisplayLength": app.defaults.itemCountPerPage,
	        	
	        	/* Disable pagination range. */
	        	"bLengthChange": false,
	        	
	        	/* Filter or search. */
	        	//"bFilter": false,
	        	
	        	/* Disable sort column. */
	        	"bSort": false,
	        	
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
	            
	            // fnServerData 
	            "fnServerData": function ( sUrl, aoData, fnCallback, oSettings ) {
	            	//console.log('fnServerData');
	            	//console.log(arguments, 'arguments');
	            	
//	            	window.setTimeout(function() {
//	            		dt.fnloadAjax();
//	            	}, 3000);
	            	
	            	var page = Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength) + 1;
	            	var itemCountPerPage = oSettings._iDisplayLength;
	            	var criteria = me.getCriteria();
	            	
	            	var response = service.getNewsList(page, itemCountPerPage, criteria);
//	            	console.log(response, 'response');
	            	
	            	// transform api data to this plguin
	            	
	            	var json = {
	            		aaData: [],
	            		iTotalDisplayRecords: response.result.totalItemCount,
	            		iTotalRecords: response.result.totalItemCount,
	            		sEcho: aoData[0].value
	            	};
	            	
	            	$.each(response.result.items, function() {
	            		var data = [];
	            		
	            		var checkbox = '<input type=\"checkbox\" class=\"mail-checkbox\">';
	            		
	            		// title
	            		var title = "<b>" + this.subject + "</b><br>" + "Description : " + this.description;
	            		
	            		// thumbnail
	            		var thumbnail = "<a class=\"pull-left thumb news-thumb\" data-toggle-x=\"modal\" " +
	            				"data-target=\"#displayModal\" data-action=\"preview\"><img src=\"" + this.thumbnailFile + "\"></a>";
	            		
	            		// info
	            		var comment = this.comment || 'No commnet';
	            		commnet = comment.replace(/&/g, "&amp;").replace(/>/g, "&gt;").replace(/</g, "&lt;").replace(/"/g, "&quot;");
	            		
	            		var info = '<div class=\"inews-icon\">' +
	            			'<a data-toggle-x=\"modal\" data-target=\"#commentModal\" data-action="comment">' + 
	            				'<i class=\"fa fa-comment text-info tooltips\" data-original-title=\"' + comment + '\" data-placement=\"top\"></i></a> ' + 
	            			'<a><i class=\"fa fa-file-text text-muted tooltips\" data-html=\"true\" ' + 
	            				'data-original-title="File: ' + this.originFilename + ' <br>Size: ' + this.fileSize + '" data-placement="top"></i></a> ' +
	            			'<a><i class="fa fa-user text-primary tooltips" data-original-title="Sender: ' + app.getUserDisplayName(this.journalist) + '" data-placement="top"></i></a> ' +
	            			'</div>';
	            		
	            		// date
	            		var date = this.times;
	            		
	            		// buttons
	            		var deleteUrl = APPLICATION_HOST + '/data/mockup_form.json.php?del=1&key=' + this.fileID;
	            		var buttons = 
	            			"<button class=\"btn btn-success btn-xs tooltips" + (!app.user.can_download_aspera ? " disabled" : "") + "\" data-action=\"download-via-aspera\" data-toggle-x=\"modal\" " +
	            				"href=\"#downloadModal\" data-original-title=\"Download via Aspera\"><i class=\"fa fa-cloud-download\"></i></button> " + 
	            			'<button class="btn btn-primary btn-xs tooltips ' + (!app.user.can_download ? " disabled" : "") + '" data-action="download-via-http" data-toggle-x="modal" href="#downloadModal" ' +
	            				'data-original-title="Download news media file"><i class="fa fa-download"></i></button> ' +
	            			'<button class=\"btn btn-warning btn-xs tooltips\"data-action=\"download-details\" data-toggle-x=\"modal\" href=\"#downloadModal\" ' +
	            				'data-original-title="Download news detail"><i class="fa fa-caret-square-o-down"></i></button> ' + 
	            			"<button class=\"btn btn-danger btn-xs tooltips\" data-action=\"delete\" data-toggle-x=\"modal\" data-target=\"#confirmModal\" " +
	            				"id=\"modal-confirm\" data-original-title=\"Delete this file\" data-placement=\"left\">" +
	            				"<i class=\"fa fa-trash-o\"></i></button>";
	            		
	            		data.push(checkbox);
	            		data.push(thumbnail);
	            		data.push(title);
	            		data.push(info);
	            		data.push(date);
	            		data.push(buttons);
	            		
	            		json.aaData.push(data);
	            	});
	            	
	            	fnCallback( json );
	            	
	            	// checkboxes
	            	$('#check_all')[0].checked = false;
	            	me.updateSelctedFiles();
	            	
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
	
	//  find all criteria in this function ja
	getCriteria: function() {
		var me = this;
		
		var criteria = {};
		criteria.startDate = $('input[name=from]').val();
		criteria.endDate = $('input[name=to]').val();
		criteria.keyword = $('input[name=keyword]').val();
		
		// running transfer
		var el =$('input[name=hide_running_transfers]');
		if (el.length) {
			criteria.hide_running_transfers = el[0].checked ? 1 : 0;
		}
		
		
		var sidebarSelectedEl = $(me.sidebarSelectedEl);
		if (sidebarSelectedEl.length) {
			var data = sidebarSelectedEl.data('value');
			//console.log(data, 'data');
			
			// catgegory or province
			
			var dataType = $.type(data);
			if (dataType == 'object') {
				
				if (sidebarSelectedEl.parents('.categories').length) {
					//console.log('IS CATEGORY');
					criteria.category_id = data.id;
					
				} else if (sidebarSelectedEl.parents('.provinces').length) {
					//console.log('IS PROVINCE');
					criteria.province_id = data.id;
				}
				
			} else if (dataType == 'string') {
				// ALL_CATEGORIES OR ALL_PROVINCES
				// don't set anything
			}
			
		}
		
//		console.log(criteria, 'criteria');
		
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


if (!(window.can_download_aspera || false)) {
	
	(function($) {
		$(function() {
			Controller.init();
		})
	})(jQuery);
};