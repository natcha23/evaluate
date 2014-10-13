/**
 * $Id$ modal.js $
 *
 * Overriding Javascript's Alert ans Confirm Dialog
 * Copyright (C) 2008, Nattakorn Samnuan (ICE Solution Ltd.), All rights reserved. (http://www.icesolution.com)
 *
 * @author Nattakorn Samnuan
 * @email nattakorn@icesolution.com
 *
 * @requires jQuery library by John Resig (jquery.com), http://jquery.com
 * @requires jqModal Minimalist Modaling with jQuery by Brice Burgess <bhb@iceburg.net>, http://www.iceburg.net
 * @requires UUID generater library by Erik Giberti (AF-Design) ,http://www.af-design.com/resources/javascript_uuid.php
 *
 * Example :
 *
 * var options = {
 *     id : '<id>' // ID for dialog.
 *     name : '<name>' // Name of dialog, Default 'dialog'
 *     title : '<title>', // Default 'Message'.
 *     icon  : '<icon-name>', // info, question, warning and error, Default 'info'.
 *     message : '<message>', // Message to display. Default 'Message is null'
 *     button : ['button-text1','button-text2','button-text3',...], // Array of button name. Default ['OK'].
 *     callback : <callback> , // Default null,
 * }
 *
 * basicDialog.createDisalog(options);
 */
var basicDialog = {
    name: 'Modal',
    varsion: '1.04RC1',
    dialogID : '',

    setDialogID : function(id) {basicDialog.dialogID=id;},

    getDialogID : function(){ return basicDialog.dialogID;},

    getUUID : function(){return new UUID();},

    createDialog : function(options) {

        if(!options) options = {};

        options = $.extend({
            id       : basicDialog.getUUID(),
            name     : 'dialog',
            title    : 'Message',
            icon     : 'info',
            message  : 'Message is null',
            button   : ['OK'],
            modal    : true
        },options);

        basicDialog.setDialogID(options.name +'-'+options.id);

        return $('<div class="jqmDialog basic-dialog" id="'+basicDialog.getDialogID()+'">' +
          '<table cellpadding="0" cellspacing="0" border="0" width="100%">' +
          '<tr><td class="basic-dialog-tl"></td><td class="basic-dialog-tc" style="width:100%">' +
          '<div class="x-tool x-tool-close jqmClose" style="display: block;"></div>' +
          '<div class="basic-dialog-header"><div class="basic-dialog-header-text">'+options.title+'</div></div>' +
          '</td><td class="basic-dialog-tr"></td></tr>' +
          '<tr height="10"><td class="basic-dialog-ml"></td><td class="basic-dialog-mc"></td>' +
          '<td class="basic-dialog-mr"></td></tr>' +
          '<tr><td class="basic-dialog-ml"></td><td class="basic-dialog-mc">' +
          basicDialog.createMessage({message:options.message,icon:options.icon}) +
          '</td><td class="basic-dialog-mr"></td></tr>' +
          '<tr><td class="basic-dialog-ml"></td><td class="basic-dialog-mc">' +
          basicDialog.createButton({button:options.button}) +
          '</td><td class="basic-dialog-mr"></td></tr>' +
          '<tr><td class="basic-dialog-bl"></td><td class="basic-dialog-bc">' +
          '<div class="basic-dialog-footer">&nbsp;</div></td>' +
          '<td class="basic-dialog-br"></td></tr></table></div>')
          .appendTo('body').unbind().find('.x-btn').unbind()
          .mousedown(function(){$(this).addClass('x-btn-click');})
          .mouseup(function(){$(this).removeClass('x-btn-click');})
          .hover(function(){ $(this).addClass('x-btn-over'); },function(){ $(this).removeClass('x-btn-over'); })
          .end().find('div.jqmClose')
          .hover(function(){ $(this).addClass('x-tool-close-over'); },function(){ $(this).removeClass('x-tool-close-over'); })
          .end().jqm({
              trigger: '.jqModal',
              overlay: options.modal===false?0:50,
              overlayClass: options.modal===false?null:'jqmOverlay',
              modal: options.modal,
              onShow:function(h){
                  h.w.css('opacity',1).show();
                  if(jQuery.browser.msie) { h.w.css({"z-index":3000}); if(h.o && h.o.size()) h.o.css({"position":"absolute","z-index":2999}); }
              },
              onHide: function(h) {
                  h.w.fadeOut('fast', function() {
                      // $(this).unbind().remove();
                      if(h.o && h.o.size()) h.o.unbind().remove();
                      //basicDialog.dialogID = '';
                  });
              }
          }).jqDrag('.basic-dialog-header').get(0);
    },

    createMessage : function(options) {
        options = $.extend({'icon':'info'},options);
        return '<div class="basic-dialog-body" style="width: 100%; height: auto;">' +
               '<div class="basic-dialog-dlg"><div class="basic-dialog-icon basic-dialog-'+options.icon+'" ></div></div>' +
               '<div class="basic-dialog-content"><span class="basic-dialog-text">'+options.message+'</span></div></div>';

    },

    createButton : function(options) {
        var buttonHtml = null;
        buttonHtml = '<table cellspacing="2" cellpadding="0" border="0" align="center"><tr>';
        options = $.extend({'button':['OK']},options);
        $(options.button).each(function(i,n){
           buttonHtml += '<td>' +
                         '<table cellspacing="0" cellpadding="0" border="0" class="x-btn-wrap x-btn" style="width: 75px;">' +
                         '<tbody><tr><td class="x-btn-left"><i>�</i></td>' +
                         '<td class="x-btn-center"><em unselectable="on"><button type="button" class="x-btn-text" id="accept-btn">'+n+'</button></em></td>' +
                         '<td class="x-btn-right"><i>�</i></td></tr></tbody></table>' +
                         '</td>';
        });
        buttonHtml += '</td></tr></table>';
        return buttonHtml;
    }
};

/* Overriding Javascript's Alert Dialog */
function _alert(msg,title,options) {
    if(!title) title = "Message";
    if(!msg) msg = "";
    if(!options) options = {}
    callback = options.callback||function(){};
    // delete options.callback;

    var jqm_alert = $('div[@id^=jqm-alert]');
    if(!jqm_alert.size()) {
        options = $.extend({name:'jqm-alert',message:msg,title:title},options)
        html = basicDialog.createDialog(options);

        $(html)
        .find('.x-btn').unbind('click').click(function() {
            $('#'+basicDialog.getDialogID()).jqmHide();
            callback();
        }).end().jqmShow();
    } else {
        jqm_alert
        .find('.x-btn').unbind('click').click(function() {
            $(this).parents('.jqmDialog.basic-dialog').jqmHide();
            callback();
        }).end()
        .find('.basic-dialog-header-text').html(title).end()
        .find('.basic-dialog-text').html(msg).end()
        .jqmShow();
    }
    html = null;
}

/* Overriding Javascript's Confirm Dialog */
function _confirm(msg,callback,options) {
    var jqm_confirm = $('div[@id^=jqm-confirm]');
    if(!jqm_confirm.size()) {
        options = $.extend({name:'jqm-confirm',message:msg,button:['Yes','No']},options);
        $(basicDialog.createDialog(options))
        .find('.x-btn').unbind('click').click(function() {
            if($.trim($(':button',this).html()) == 'Yes') {
                if (typeof callback == 'string') window.location.href = callback;
                else callback();
            }
            $('#'+basicDialog.getDialogID()).jqmHide();
        }).end().jqmShow();
        options = null;
    } else {
        jqm_confirm.find('.x-btn').unbind('click').click(function() {
            if($.trim($(':button',this).html()) == 'Yes') {
                if (typeof callback == 'string') window.location.href = callback;
                else callback();
            }
            $(this).parents('.jqmDialog.basic-dialog').jqmHide();
        }).end()
        /*.find('.basic-dialog-header-text').html(options.title).end()*/
        .find('.basic-dialog-text').html(msg).end()
        .jqmShow();
    }
    return;
}

$(window).unload(function(){
    basicDialog=null;
    _alert = null;
    _confirm = null;
});
/*
function createNotice(id,title,content,onshow) {
    if(typeof onshow == "undefined") onshow = false;
    if(!id) id = new UUID();

    $('<div style="position: absolute; margin: -100px 0 0 100px;">' +
      '<div id="'+id+'-notice" class="jqmNotice">' +
      '<div class="jqmnTitle jqDrag"><h1>'+title+'</h1></div>' +
      '<div class="jqmnContent"><p>'+content+'</p></div>' +
      '<img src="/'+app.name+'/modules/systemapi/templates/default/css/i/modal/notice/close_icon.png" alt="close" class="jqmClose" />' +
      '<img src="/'+app.name+'/modules/systemapi/templates/default/css/i/modal/dialog/resize.gif" alt="resize" class="jqResize" />' +
      '</div></div>')
    .appendTo('body');

    $('#'+id+'-notice')
    .jqDrag('.jqDrag')
    .jqResize('.jqResize')
    .jqm({
        trigger: '#'+id,
        overlay: 0,
        onShow: function(h) {
            h.w.css('opacity',0.92).fadeIn('fast');
        },
        onHide: function(h) {
            h.w.fadeOut('fast', function() { if(h.w.parent().is("div > div.jqmNotice")) h.w.parent().remove()});
        }
    })
    .jqmShow();
}

function modalDialog(content,title) {
    _alert(content,title);
}

function showNotice(title,content) {
    createNotice(new UUID(),title,content);
}
*/