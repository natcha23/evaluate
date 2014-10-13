/**
 * base for upload (default is aspera plugin ja)
 * core is aspera plugin
 * 
 * @todo    support non aspera plugin such as file post, web dav
 * @author: rathasit@icesolution.com
 * @date:   2014-07-03
 */


// @todo configuration, sumlate settings

// global variable for aspera plugin
var asperaWeb = null;

var guid = (function() {
  function s4() {
    return Math.floor((1 + Math.random()) * 0x10000)
               .toString(16)
               .substring(1);
  }
  return function() {
    return s4() + s4() + '-' + s4() + '-' + s4() + '-' +
           s4() + '-' + s4() + s4() + s4();
  };
})();
	
// aspera function handler
// callback before window onload (aspera callback)
//
// @see aspera/asperaplugininstaller.js
var setup = function () {
	
    asperaWeb = new AW.Connect({id:'aspera_web_transfers'});
    asperaWeb.initSession(guid());
    asperaWeb.addEventListener('transfer', fileControls.handleTransferEvents);
    
    
    $(function() {
    	fileControls.setup();
    	fileControls.options.simulate && fileControls.simulate();
    });
};

var fileControls = {
	
	// configurtion
	debug: false,
	
	// flags
	startUploaded: false,
	endUploaded: false,
	
	startProgressing: false,
	
	error: false,
	message: '',
	
	// @see AW.Connect.TRANSFER_STATUS
	STATUS_CANCELLED : "cancelled",
	STATUS_COMPLETED : "completed",
	STATUS_FAILED : "failed",
	STATUS_INITIATING : "initiating",
	STATUS_QUEUED : "queued",
	STATUS_REMOVED : "removed",
	STATUS_RUNNING : "running",
	STATUS_WILLRETRY : "willretry",
	
	options: {
		useAsperaHandler: false,
		logTransferData: false,
		simulate: false,
		simulateDelay: 10
	},
	
	// elements
	processDetailsTemplateId: 'template-progress-details',
	formElementRule: '#fileupload',
	simulateElementRule: 'textarea:hidden',
	progressMeterRule: '#progress_meter',
	progressAllRule: '#progress-all',
	
	fileInfoPanelRule: '.panel.fileinfo',
	fileInfoFormRule: '.panel.fileinfo form',
	
	pathArray :    [],
	files :        [],
	data:          null,
	previousData:  null,
	currentNumber: 0,
	
	startUpload: function() {
		this.startUploaded = true;
		this._onStartUpload();
	},
	
	_onStartUpload: function() {
		
		// control ui in this
		
		var form = $(this.formElementRule);
		
//		var fileUploadButtonBar = form.find('.fileupload-buttonbar');
//		var blueimpFileupload = form.data().blueimpFileupload;
//		.add(blueimpFileupload.options.templatesContainer)

		// disable all buttons
		form
			.find('.btn:not(.reload)')
			.removeClass('btn-warning btn-danger btn-primary btn-success')
			.addClass('disabled')
			.unbind('click')
			.bind('click', function(e) {
				e.preventDefault();
				return false;
			});
	},
	
	_onUpload: function() {
		
		// @todo open modal end aspera upload
		
	},
	
	_onEndUploadError: function() {
		var me = this;
		
		var modalId = 'errorModal';
		var templateId = 'template-modal-error'
		var template = tmpl(templateId);
		
    	var html = template({
    		message: me.message || app._('File Transfer Errors'),
    		id: modalId
    	});
		
		$('body').append(html);
    	
    	var target = $('#' + modalId);
    	
    	target.modal('show');
    	
    	target.bind('hide.bs.modal', function() {
    		$(this).removeData('bs.modal');
    		
    		target.remove();
    	});
		
		target.off('click', '.btn[data-dismiss="modal"]');
		target.on('click', '.btn[data-dismiss="modal"]', function() {
			target.modal('hide');
		});
		
		return false;
	},
	
	_onEndUploadSuccess: function() {
		var me = this;
		
		var modalId = 'successModal';
		var templateId = 'template-modal-success'
		var template = tmpl(templateId);
		
    	var html = template({
    		message: me.message || app._('Your news has been created successfully'),
    		id: modalId
    	});
		
		$('body').append(html);
    	
    	var target = $('#' + modalId);
    	
    	target.modal('show');
    	
    	target.bind('hide.bs.modal', function() {
    		$(this).removeData('bs.modal');
    		target.remove();
    	});
		
		target.off('click', '.btn[data-dismiss="modal"]');
		target.on('click', '.btn[data-dismiss="modal"]', function() {
			target.modal('hide');
		});
		
		return false;
	},
	
	_onEndUpload: function() {
		
		// @todo save file
		//       news/news/save
//		console.log('_onEndUpload');
		
		var me = this;
		var data = {};
		
		//if (true) {
		if (me.error) {
			me._onEndUploadError();
			return;
		}
		
		// file info formData
		var infoForm = $(this.fileInfoFormRule);
		var objects = infoForm.serializeArray();
		$.each(objects, function() {
			data[this.name] = this.value;
		});
		
		if ($.type(this.data) != "null") {
			// file form data (transfer_spec make sure more than this.files)
			data.files = [];
			$.each(this.data.transfer_spec.paths, function(){
				data.files.push(me.basename(this.source));
			});
		};
		
//		console.log(formData, 'formData');
		
		var url = APPLICATION_HOST + '/news/news/save';
		$.ajax({
			type: "POST",
			url: url,
			data: data,
			success: function() {
				//console.log('success');
				me._onEndUploadSuccess();
			},
			error: function() {
				//console.log('error');
			},
			dataType: 'json'
		});
	},
	
	// simulate aspera transfer handler ja
	simulate: function() {
		
		this.startUpload();
		
		var responses = [];
		$(this.simulateElementRule).each(function() {
			var response = $.parseJSON($(this).val());
			responses.push(response);
		});
		
		//console.log(responses, 'responses');
		
		var delay = this.options.simulateDelay || 1000;
		var j = 0;
		for (var i=0;i<responses.length;i++) {
			
			var unit = (i + 1) * delay;
			window.setTimeout(function() {
				var obj = responses[j];
				//console.log(obj, 'delay ' + j.toString());
				
				fileControls.handleProgressMonitor(obj);
				j++;
			}, unit);
		};
	},
	
	basename: function(path) {
		return path.split(/[\\/]/).pop();
	},
	
	getNumber: function(data) {
    	var current_file = data.current_file || '';
    	
    	var number = 0;
    	var found = false;
    	current_file = current_file.replace(/\\/g,"/");
    	$.each(data.transfer_spec.paths, function() {
    		if (found) return;
    		
    		number++;
    		
    		// match / or \
    		var source = this.source.replace(/\\/g,"/");
    		
//        		console.log(source, 'source');
    		
    		if (source == current_file) {
    			found = true;
    		}
    	});
    	
    	if (!found) number = 0;
    	
    	return number;
    },
	
    // maybe pretty date or human time, realtime
    formatTime: function(value) {
    	value = value || '';
    	
    	if (!value.length) return value;
    	
    	// 2014-07-12T13:28:20
    	value = value.substr(11);
    	return value;
    },
    
    // maybe float . 2 digits
    formatPercentage: function(value) {
    	return parseInt(value * 100)
    },
    
    formatFileSize: function() {
    	return this.blueimpFileupload._formatFileSize.apply(this.blueimpFileupload, arguments);
    },
    
    i18n: function() {
    	return this.blueimpFileupload.options.i18n.apply(this.blueimpFileupload.options, arguments);
    },
    
    _renderTemplate: function() {
    	return this.blueimpFileupload._formatFileSize.apply(this.blueimpFileupload, arguments);
    },
    
    setup: function() {
    	
		// @see http://www.w3schools.com/js/js_strict.asp
		'use strict';
		
		var form = $(this.formElementRule);
		
		
		// don't use fileupload-buttonbar if aspera plugin loading
		// see on it was loaded completed
		form.find('.fileupload-buttonbar').removeClass('hide');
		
		
	    // Initialize the jQuery File Upload widget:
	    form.fileupload({
	        // Uncomment the following to send cross-domain cookies:
	        xhrFields: {withCredentials: true},
	        url: 'localhost/flatlab/assests/file-uploader/server/php/',
	        
	        // disable drop for aspera cannot suuport blob, real path needs for this plugin
	        // browser security
	        dropZone: $(),
	        
	        messages: {
	        	progressAllTitle: 'Uploading {number} of {total}: {percentage}% ({filename}: {filesize_written} of {filesize_expected})'
	        }
	    });
	    
	    var blueimpFileupload = form.data().blueimpFileupload;
	    
	    // keep obj for fileControls
	    this.blueimpFileupload = blueimpFileupload;
	    
	    var that = this;
	    
	    
	    //console.log(blueimpFileupload, 'blueimpFileupload');
	    //console.log(blueimpFileupload.element);
	    
	    // override .start button
	    // @see _initButtonBarEventHandlers
	    
	    var me = blueimpFileupload;
        var fileUploadButtonBar = me.element.find('.fileupload-buttonbar'),
        	filesList = me.options.filesContainer;
        
//	    console.log(me, 'me');
//	    console.log(fileUploadButtonBar, 'fileUploadButtonBar');
//	    console.log(filesList, 'filesList');
	    
	    var startButton = fileUploadButtonBar.find('.start');
//	    console.log(startButton, 'startButton');
	    
	    // change behavior of start button
	    me._off(startButton, 'click'); 
	    me._on(startButton, {
	    	click: function(e) {
	    		
	    		// validate info form
	    		$(that.fileInfoFormRule).validate();
	    		var valid = $(that.fileInfoFormRule).valid();
	    		if (!valid) {
	    			$.scrollTo(that.fileInfoPanelRule, 1000);
	    			return false;
	    		}
	    		
	    		// mark flag (startUploaded)
	    		that.startUpload();
	    		
	    		e.preventDefault();
	    		
	    		var pathArray = [];
	    		filesList.find('.start').each(function() {
	                var button = $(this),
	                template = button.closest('.template-upload'),
	                data = template.data('data');
	            
		            button.prop('disabled', true);
		            
		            // don't ajax submit na ja (use aspera plugin)
		            
		            /*
		            if (data && data.submit) {
		                data.submit();
		            }
		            //*/
	    			
	    			//console.log(data, 'data');
	    			
	    			var path = data.files[0].value;
	    			
	    			
	    			pathArray.push(path);
	    			
	    			//console.log(pathArray, 'pathArray');
	    			
	    		});
	    		
	    		
	    		if (pathArray.length) {
	    			fileControls.uploadFiles(pathArray);
	    		} else {
	    			
	    			// save without file
	        		that.endUploaded = true;
	        		that._onEndUpload();
	    		};
	    	}
	    });
	    
	    
		// change behavior file input onchange ja 
	    
	    //return;
		
	    if ($.support.fileInput) {
	        me._off(me.options.fileInput, 'change');
	        
	        //uploadButton.setAttribute('onclick', 'asperaWeb.showSelectFileDialog({success:fileControls.uploadFiles})');
	        
//	        console.log(me.options.fileInput, 'me.options.fileInput');
	        
//	        me.options.fileInput.change(function() {
//	        	console.log(3333);
//	        });
	        
	        // @todo aspera or not
	        // http://wizard.ae.krakow.pl/~jb/localio.html
	        
	        
	        me._on(me.options.fileInput, {
	        	click: function(e) {
	        		
	        		// prevent file input default behavior
	        		e.preventDefault();
	        		
	        		
	        		var callback = function(pathArray) {
	        			
	                    var that = this,
	                    data = {
	                        fileInput: me.options.fileInput,
	                        form: me.element
	                    };
	        			
	                    data.files = [];
	                    
	        			
	        			//console.log(pathArray, 'pathArray');
	        			//console.log(data, 'data');
	        			//console.log(window.asperaWeb, 'window.asperaWeb');
	        			
	        			$.each(pathArray, function() {
	        				var path = this;
	        				//console.log(path, 'path');
	        				
//	        		        lastModifiedDate: Tue Jul 08 2014 15:00:17 GMT+0700 (SE Asia Standard Time)
//	        		        name: "youtube-upload-page.png"
//	        		        size: 46449
//	        		        type: "image/png"
//	        		        webkitRelativePath: ""
	        				
	        				
	        				var name = path;
	        				name = name.split(/[\\/]/).pop();
	        				
	        				var file = {
		        		        lastModifiedDate: null,
		        		        name: name,
		        		        value: path,
		        		        size: 0,
		        		        type: "",
		        		        webkitRelativePath: ""	
	        				};
	        				
	        				data.files.push(file);
	        			});
	        			
                        if (me.options.replaceFileInput) {
                        	me._replaceFileInput(data.fileInput);
                        }
                        if (me._trigger(
                                'change',
                                $.Event('change', {delegatedEvent: e}),
                                data
                            ) !== false) {
                        	me._onAdd(e, data);
                        }
	        		};
	        		
	        		
	        		//window.asperaWeb.showSelectFileDialog({success:fileControls.uploadFiles});
	        		window.asperaWeb.showSelectFileDialog({success:callback});
	        	}
	        });
	    };
	    
	    
	    // modal "Clear All" event ja
	    
		var $el = $('#modalReload');
		$el.on('show.bs.modal', function(e) {
			
			var el = this;
			
			$(this)
			.find('.btn.confirm')
			.click(function(e) {
				$(el).modal('hide');
				
				that.removeTransfer();
				window.location.reload();
			});
		});
		
		// @todo window on unload
		$( window ).unload(function() {
			that.removeTransfer();
		});
    },
    
    removeTransfer: function() {
		// try to clear all transfer
    	
    	try {
    		var transferId = this.previousData.uuid;
    		
    		//console.log('removeTransfer');
    		//console.log(transferId);
    		
    		asperaWeb.removeTransfer(transferId);
    	} catch (e) {
    		
    	}
    },
    
    handleTransferEvents: function (event, obj) {
    	
    	//console.log(event, 'event');
    	
        switch (event) {
            case 'transfer':
            	
            	// for simulate use handleProgressMonitor()
            	// it's clause of process moniter in this here
            	
            	var me = fileControls;
            	
            	var useAsperaHandler = me.options.useAsperaHandler;
            	
            	if (useAsperaHandler) {
            		me.handleProgressMonitor(obj);
            	} else {
            		
            		if (me.startProgressing) return;
                	if (!me.startUploaded) return;
                	if (me.endUploaded) return;
                	
                	
                	var cookie = obj.transfer_spec.cookie,
                		token = obj.transfer_spec.token
                		
//            		console.log(obj, 'obj');
//            		var data = obj;
//            		break;
                		
                	var delay = 200;
                		
                		
                	var progress = function() {
                		var url = app.baseUrl('news/news/progress');
                		$.ajax({
                			type: "POST",
                			url: url,
                			data: {cookie: cookie, token: token},
                			success: function(result) {
//                				console.log('success');
//                				console.log(arguments);
                				
                				var rows = result.result || [];
                				$.each(rows, function() {
                					var data = $.extend({}, obj, this);
                					
//                					console.log(data, 'data');
                					
                					me.handleProgressMonitor(data);
                				});
                				
                				if (me.endUploaded) return;
                				
                				window.setTimeout(progress, delay);
                			},
                			error: function() {
                				//console.log('error');
                			},
                			dataType: 'json'
                		});
                	};
                		
                	me.startProgressing = true;
            		window.setTimeout(progress, delay);
            	}
            	
                break; 
        }
    },
    
    
    // @todo change this behavior on first callback that data has 'initiating'
    //       then use my setTimeout or setInterval for get response instead
    //       becuase handleTransferEvents() not perfect response handler ja
    //       it's cannot sent all files every 1000 ms
    handleProgressMonitor: function(data) {
    	var me = this;
    	
    	if (!this.startUploaded) return;
    	if (this.endUploaded) return;
    	
    	
    	// don't show status of previous upload (check uuid of this.previousData)
    	//console.log(data, 'data');
    	
    	
    	
    	
    	
    	
    	var text = JSON.stringify(data, null, 4);
    	
    	// debug mode ja
    	if (this.debug) {
    		$(this.progressMeterRule).text(text).removeClass('hide');
    	};

    	if (this.options.logTransferData) {
        	var textarea = $('<textarea></textarea>')
        		.appendTo(document.body)
        		.addClass('hide');
        	textarea[0].innerHTML = text;	
    	};
    	
    	this.data = data;
    	
//    	console.log(data, 'data');
    	
    	// occurs one time (check previosData)
    	if (fileControls.previousData == undefined) {
    		this._onUpload();
    	}
    	
    	this.progressall(data);
    	this.progress(data);
    	
    	this.previousData = data;
    	
    	// check finish occurs _onEndUpload
    	var number = this.getNumber(data);
    	var total = data.transfer_spec.paths.length;
    	var completed = (number == total) && (data.status == 'completed');
    	if (completed) {
    		
    		// @todo make sure all files are completed na ja   
    		var errorStatuses = [me.STATUS_CANCELLED, me.STATUS_FAILED, me.STATUS_REMOVED];
    		$.each(me.files, function() {
    			if (me.error) return;
    			
    			if ($.inArray(this.status, errorStatuses) != -1) {
    				me.error = true;
    				me.message = app._('File Transfer Errors');
    				return;
    			};
    			
    			completed = completed && (this.status == me.STATUS_COMPLETED);
    		});
    		
    		if (completed || me.error) {
        		this.endUploaded = true;
        		this._onEndUpload();
    		}
    	};
    },
    
    progressall: function(data) {
    	//console.log('progressall');
    	//console.log(data, 'data');
    	
    	var me = this;
    	
    	var filename = this.basename(data.current_file) || '';
    	var number = this.getNumber(data);
    	
    	var context = {
    		number: number,
    		total: data.transfer_spec.paths.length,
    		percentage: this.formatPercentage(data.percentage),
    		filename: filename,
    		filesize_expected: this.formatFileSize(parseInt(data.bytes_expected)),
    		filesize_written: this.formatFileSize(parseInt(data.bytes_written))
    	};
    	
    	$progressAll = $(this.progressAllRule);
    	
    	// change title
    	var title = this.i18n('progressAllTitle', context);
    	
    	//console.log(title, 'progressAllTitle');
    	var $header = $progressAll.find('header');
    	
    	// clear all elements
    	if (!$header.find('.text')) {
    		$header.html('<span class="text"></span>');
    	};
    	
    	// set text
    	$header.find('.text').text(title);
    	
    	// change progress bar
    	var percentageText = context.percentage.toString() + '%';
    	$progressAll.find('.progress-bar')
    		.attr('aria-valuenow', context.percentage)
    		.css('width', percentageText)
    		.find('.sr-only').text(percentageText + ' Complete');
    	
    	// add upload controller
    	// @date 2014-08-19
    	if (!$header.find('.upload-controller').length) {
        	var html = '<div class="pull-right upload-controller">' + 
				'<a href="javascript:;" class="pause"><i class="fa fa-pause"></i></a>' + 
				'<a href="javascript:;" class="play hide"><i class="fa fa-play"></i></a>' + 
			'</div>';
			$header.append(html);
    	}
    	
		$pause = $header.find('.pause');
		$play = $header.find('.play');
		
		// 
		// @see /inews/public/js/aspera/d3gcli72yxqn2z.cloudfront.net/connect/asperaweb-2.js
		var transferId = data.uuid;
		
		//console.log(transferId, 'transferId');
		//console.log(data, 'data');
		
		
		$pause.unbind('click');
		$pause.click(function(e) {
			//console.log('pause');
			
			asperaWeb.stopTransfer(transferId);
		
			$pause.addClass('hide');
			$play.removeClass('hide');
		});
		
		$play.unbind('click');
		$play.click(function(e) {
			//console.log('play');
			
			asperaWeb.resumeTransfer(transferId);
		
			$play.addClass('hide');
			$pause.removeClass('hide');
		});
    	
    	
    },
    
    _createFileData: function(data) {
    	var filename = this.basename(data.current_file) || '';
    	
    	
    	var fileData = {
    		filename: filename,
    		filesize_expected: this.formatFileSize(parseInt(data.bytes_expected)),
    		filesize_written: this.formatFileSize(parseInt(data.bytes_written)),
    		
    		// @fixed: how to find file lost
    		//filesize_lost: this.formatFileSize( (data.status == 'completed') ? (data.bytes_expected - data.bytes_written) : 0 ),
    		filesize_lost: this.formatFileSize(parseInt(data.bytes_lost)),
    		
    		
    		percentage: this.formatPercentage(data.percentage),
    		
    		start_time: this.formatTime(data.start_time),
    		end_time: this.formatTime(data.end_time),
    		status: data.status
    	};
    	
    	//console.log(fileData, '_createFileData()');
    	
    	return fileData;
    },
    
    progress: function(data) {
    	//console.log('progress');
    	//console.log(data, 'data');
    	
    	var number = this.getNumber(data);
    	
    	var current_file = data.current_file || '';
    	if (!current_file.length) return;
    	
    	if (number == 0) return;
    	
    	//console.log(number, 'number');
    	//console.log(this.currentNumber, 'this.currentNumber');
    	
    	// create mock files ja
    	if (number > this.currentNumber) {
    		
    		for (var i=this.currentNumber; i<number;i++) {
    			//console.log('create file ' + i.toString());
    			
    			// clone object and change attributes then sent to _createFileData(data)
    			// @desc mock data for users seen as data has been transfered completed 
    			var newData = $.extend({}, data);
    			newData.current_file = data.transfer_spec.paths[i].source;
    			newData.filesize_expected = 0;
    			newData.filesize_written = 0;
    			newData.filesize_lost = 0;
    			newData.percentage = 1;
    			newData.start_time = data.start_time;
    			newData.end_time = data.start_time;
    			newData.status = 'completed';
    			
    			var file = this._createFileData(newData);
    			
    			//console.log(file, 'create file > ');
    			
    			this.files.push(file);
    		};
    		
    		this.currentNumber = number;
    	} 
    	
    	// override invlaid completed status ja
    	// for change number case
    	if (number == this.currentNumber) {
    		
    		
    		
    		// update last file
    		var file = this._createFileData(data);
    		
    		//console.log(file, 'create file ==');
    		
    		this.files[this.files.length - 1] = file;
    	};
    	
    	// update before file proces
    	if (number < this.currentNumber) {
    		var file = this._createFileData(data);
    		
    		//console.log(file, 'create file <');
    		
    		this.files[number - 1] = file;
    	};
    	
    	var files = this.files;
    	
    	// template-progress-details
    	// render template for file details na ja
    	if (!this.processDetailsTemplate) {
    		this.processDetailsTemplate = tmpl(this.processDetailsTemplateId);
    	}
    	
    	var result = this.processDetailsTemplate({
    		files: files
    	});
    	//console.log(result, 'result');
    	
    	$progressDetails = $('#progress-details');
    	$progressDetails.find('tbody').html(result);
    },
	
    uploadFiles: function (pathArray) {
    	
    	this.pathArray = pathArray;
    	
//    	console.log('fileControls.uploadFiles');
//    	console.log(this);
//    	console.log(arguments, 'arguments');
    	
    	/*
        transferSpec = {
            "paths": [],
            "remote_host": "10.3.70.23",
            "remote_user": "pisitj",
            "remote_password": "123456",
            "direction": "send",
            //"target_rate_kbps" : 5000,
            "target_rate_kbps" : 50000,
            
            "resume" : "sparse_checksum",
            //"destination_root": "test/subfolder",
            "destination_root": ""
        };
        */
        
    	transferSpec = $.extend({}, window.transferSpec);
    	
//    	console.log(transferSpec, 'transferSpec');
    	
    	// reset paths ja
    	transferSpec.paths = [];
    	
    	//console.log(transferSpec, 'transferSpec');
    	
        connectSettings = {
            "allow_dialogs": "yes"
        };
     
        for (var i = 0, length = pathArray.length; i < length; i +=1) {
        	
//        	console.log(pathArray[i], 'pathArray[i]');
        	
        	var obj = {"source":pathArray[i]};
        	//obj.destination = 'abc.mp3';
        	
//        	console.log(obj, 'obj');
        	
            transferSpec.paths.push(obj); 
        }
        
         
        if (transferSpec.paths.length === 0) {
            return;
        }
        
        //document.getElementById('transfer_spec').innerHTML = JSON.stringify(transferSpec, null, "    ");
        
        asperaWeb.startTransfer(transferSpec, connectSettings);
    }
	
};