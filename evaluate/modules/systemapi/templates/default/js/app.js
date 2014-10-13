/*****
 * $Id$ app.js
 *
 * Application javascript controls.
 * @requires jQuery Library.
 * @author Nattakorn Samnuan
 * @email nattakorn@icesolution.com
 */

 String.prototype.ltrim = function () {  return this.replace(/\s*((\S+\s*)*)/, "$1");}
 String.prototype.rtrim = function() { return this.replace(/((\s*\S+)*)\s*/, "$1");}
 String.prototype.trim = function() {  return this.replace(/^\s+|\s+$/g, ""); }

 jQuery.fn.check = function() {
    return this.each(function() { this.checked = true; });
 };

 jQuery.fn.uncheck =  function() {
    return this.each(function() { this.checked = false; });
 };

 jQuery.fn.dataFormToObject = function() {
    var val = {};
    this.each(function() { jQuery(":input:not(:button)", this).each(function(){ val[this.name]=this.value; }); });
    return val;
 };

 jQuery.fn.serializeJson = function() {
    var val = {};
    this.each(function() {
        if($(this).is(':input')) {
            val[this.name]=this.value;
        } else {
            jQuery(":input:not(:button)", this).each(function(){ val[this.name]=this.value; });
        }
    });
    return val;
 }

 jQuery.fn.disabled = function() { return this.each(function() { this.disabled = true; }); };

 jQuery.fn.enable = function(b) {
    if (b == undefined) b = true;
    return this.each(function() {
        this.disabled = !b
    });
 };

 var app = null;
 app = {
 	version:"2.0",
 	name : projectName,
 	popupId : [],

 	check: function() {
	    if((typeof window.jQuery == "undefined")) throw("script app.js requires the jQuery JavaScript framework.");
	},

	imports: function(libfile) {
 		$("head").append("<script language=\"javascript\" type=\"text/javascript\" src=\""+libfile+"\"></script>");
 	},

    getScript:function(script){ if(!script) return; $.getScript(script); },

	gotoview: function (view,params) {
         var p = [];
         var _htreg = /^http\:\/\/*/i;
         var _hostname = window.location.hostname;
         if(params && typeof params == "object") for(var i in params) { p.push(i+"/"+params[i]);}
         var url = (_htreg.test(view))?
                   view.replace('http://'+_hostname,'')+"/"+p.join("/"):
                   "/"+projectName+"/"+view+"/"+p.join("/");
         // Redirec to URL.
         window.location = url.replace("//","/");
    },

    open: function (view,name,options) {
        if(typeof options == "object" && options.constructor == Object) {
            options=(options)?options:{'width':800,'height':600};
            options = $.extend(options,{
                'left': (screen.width) ? (screen.width-options.width)/2 : 0,
                'top' : (screen.height) ? (screen.height-options.height)/2 : 0
            });
            // Require JSON Library (json.js)
            options = JSON.toString(options).replace(/\(|\{|\}|\)|\"|\'/ig,"").replace(/\:/ig,"=");
            // options = options.toSource().toString().replace(/\(\{|\}\)/ig,"").replace(/\:/ig,"="); // IE Not support.
        }
        var url = ('/'+this.name+'/'+view).replace("//","/");
        this.popupId[name] = window.open(url,name,options);
        return;
    },

    showMsg:function(msg,prt,options) {
        $('<div id="error_msg" class="alert-msg" align="left">'+msg+'</div>').appendTo("body");

        var _cont = prt?$("#"+prt):$("body");

        var _lmsg = $("div.alert-msg");

        var params = _cont.position();

        params.left = (params.left/1.3)+((_cont.width()-_lmsg.width())/2);
        params.top  = (params.top/1.4)+((_cont.height()-_lmsg.height())/2);

        /**
        var _t = ((_cont.height() - _lmsg.height())/2)+ parseInt(_cont[0].offsetTop);
        var _l;
        if(prt) _l = ((_cont.width() - _lmsg.width())/2)+((_cont.width()/2)-(_lmsg.width()/2));
        else _l = (_cont.width()/2 + _lmsg.width()/2);
        */
        options.width = options.width?options.width:400;
        options.delay = options.delay?options.delay:3000;

        _lmsg.css(params);
        params.width = options.width;

        $("#error_msg").css(params)
        .fadeIn('slow')
        .animate({opacity: 0.7}, options.delay)
        .fadeOut('slow', function() { $(this).remove(); });
    },

    _setPopupId : function(id) {
        this.popupId[id] = id;
    },

    openPopup : function(params) {

        app.ajax.init(params.id);
        $('#'+params.id+"-popup").dialog("open");
        var _id = params.id;
        var _url = params.url;

        $('#'+_id+"-popup").html("<center><b>Loadding...</b></center>");

        setTimeout(function(){
            var html = app.ajax.html(_url);
            $('#'+_id+"-popup").empty().html(html);
            app.ajax.initScript(_id);
        },1000);
        params=null;
        return;
    },

    closePopup : function(id) {
        var popup_id = $("#"+id+"_container").parent().attr("id");
        if(popup_id) {
            if($('#'+popup_id).dialog) {
                $('#'+popup_id).dialog("close");
            } else {
                if(window.opener) {
                    window.close();
                }
            }
        }
        return;
    }
 }

 function toggleBlock(elm,targetId) {
    // slideToggle
    $('#'+targetId).toggle("fast",function(){
        var src = $(elm).get(0).src;
        if(!src) return;
        var reg = /plus/i;
        if(reg.test(src)) {
            src = src.replace('plus','minus');
        } else {
            src = src.replace('minus','plus');
        }
        var _attr = {'src':src};
        $(elm).removeAttr('src').attr(_attr);
        return;
    });
 }
 function SortData(fields){
	document.getElementById('fields_sort').value=fields;
	if(document.getElementById('order').value=="desc")
		document.getElementById('order').value="asc";
	else
		document.getElementById('order').value="desc";
	document.forms[0].submit();
}