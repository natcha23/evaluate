/**
 * $Id$ ajaxcontent.js $
 *
 *
 */

var AjaxContent = {
    name :'AjaxContent',
    varsion : '1.04RC1',

	proxy: "",
	container : null,
	htmlTemplate : null,
	overlay : true,
	showLoadding: true,

	contentType: "text/xml",
	charSet: "utf-8",

	subfix : "-container",
	responseXML: null,
	responseText: "",
	status: 0,

	init: function(options) {
	    if(options && options.constructor == Object) {
	        $.extend(AjaxContent,options);
	    }

        $.ajaxSetup({global: true,type: "POST"});


        if(typeof AjaxContent.container == "string") {
            AjaxContent.container = $("#"+AjaxContent.container+AjaxContent.subfix).size()?$("#"+AjaxContent.container+AjaxContent.subfix):$("#"+AjaxContent.container);
            if(!AjaxContent.container.size()) return;
        }

        if(!AjaxContent.showLoadding) return;

        var _uuid = new UUID();

        var msgObj = '<div id="loadding-msg-'+_uuid+'" class="loadding-msg x-air-window" style="width: 105px;">' +
                     '<table cellpadding="0" cellspacing="0" border="0" class="x-air" width="100%">' +
                     '<tr><td class="x-air x-window-tl"></td><td class="x-air x-window-tc" width="100%"></td>' +
                     '<td class="x-air x-window-tr"></td></tr>' +
                     '<tr><td class="x-air x-window-ml"></td><td class="x-air x-window-mc"><div class="x-air x-window-body">' +
                     '<div class="x-air x-window-wait"><img src="/'+app.name+
        		     '/modules/systemapi/templates/default/images/shared/loading/wait.gif"/></div>' +
                     '<div class="x-air x-window-body-text">Loading...</div></div>' +
                     '</td><td class="x-air x-window-mr"></td></tr>' +
                     '<tr class="x-air x-window-bc"><td class="x-air x-window-bl"></td><td class="x-air x-window-footer"></td>' +
                     '<td class="x-air x-window-br"></td></tr>' +
                     '</table></div>';
        // Overley
        $('<div id="loadding-overlay-'+_uuid+'" class="loadding-overlay"></div>')
        .appendTo('body').animate({opacity: 0.4});

        $(msgObj).appendTo('body')
        .ajaxStart(function(){
            _overlay = $('div#loadding-overlay-'+_uuid);
            if(AjaxContent.overlay) _overlay.show();

            var params = AjaxContent.container.offset();

            if(AjaxContent.overlay) _overlay.css($.extend({},params,{'width':AjaxContent.container.width(),'height':AjaxContent.container.height()}));

            params.left = params.left+((AjaxContent.container.width()-$(this).width())/2);
            params.top  = params.top+((AjaxContent.container.height()-$(this).height())/2);

            $(this).css(params).show();
        })
        .animate({opacity: 1})
        .ajaxStop(function(){
            $(this).fadeOut('slow', function() {$(this).remove();});
            if(AjaxContent.overlay) $('div#loadding-overlay-'+_uuid).fadeOut('slow', function() {$(this).remove(); });
        });
/*
        if(jQuery.browser.msie) {
            jQuery('#loadding-msg-'+_uuid).find("*").each(function(){
    			var bgIMG = jQuery(this).css('background-image');
    			if(bgIMG.indexOf(".png")!=-1){
    				var iebg = bgIMG.split('url("')[1].split('")')[0];
    				jQuery(this).css('background-image', 'none');
    				jQuery(this).get(0).runtimeStyle.filter = "progid:DXImageTransform.Microsoft.AlphaImageLoader(src='" + iebg + "',sizingMethod='scale')";
    			}
    		});
        }
*/
        return;
    },

	send: function(params, callback) {
		if(AjaxContent.proxy != null) {
			AjaxContent.responseText = "";
			AjaxContent.responseXML = null;
			AjaxContent.status = 0;

			//var content = $(params).serialize();
			//AjaxContent.contentLength = content.length;

			function getResponse(response) {
				AjaxContent.status = response.status;
				AjaxContent.responseText = response.responseText;

				if(callback != null) {
					// AjaxContent.responseXML = response.responseXML;
					var jsOut = AjaxContent.toJSON(response.responseText);
					AjaxContent.userCallback(jsOut,callback);
				} else {
                    var jsOut = AjaxContent.toJSON(response.responseText);
                    AjaxContent.callback(jsOut);
				}
			}

			$.ajax({
				 url: AjaxContent.proxy,
				 dataType: "xml",
				 processData: false,
				 data: params,
				 complete: getResponse
				 /*
				 ,
				 beforeSend: function(reqObj) {
					reqObj.setRequestHeader("Method", "POST");
				 	reqObj.setRequestHeader("Content-Length", AjaxContent.contentLength);
					reqObj.setRequestHeader("Content-Type", AjaxContent.contentType + "; charset=\"" + AjaxContent.charSet + "\"");
				 }
				 * **/
			});
		}
	},

	toJSON : function(responseText) {
	    var _json = null;
	    if($.trim(responseText)) { eval("_json="+responseText+";"); }
	    return _json;
	},

	callback : function(data) {
	    if(AjaxContent.htmlTemplate != null) {
            var result = TrimPath.parseTemplate(AjaxContent.htmlTemplate).process(data);
            AjaxContent.container.empty().html(result);
        } else {
            return data;
        }
	},

	userCallback : function(data, callback) {
	    if(AjaxContent.htmlTemplate != null && typeof TrimPath != 'undefined') {
            var result = TrimPath.parseTemplate(AjaxContent.htmlTemplate).process(data);
            callback(result);
        } else {
            callback(data);
        }
	},

	getposOffset :function (what, offsettype){
        var totaloffset=(offsettype=="left")? what.offsetLeft : what.offsetTop;
        var parentEl=what.offsetParent;
        while (parentEl!=null){
            totaloffset=(offsettype=="left")? totaloffset+parentEl.offsetLeft : totaloffset+parentEl.offsetTop;
            parentEl=parentEl.offsetParent;
        }
        return totaloffset;
    }
}
