function openPageGrade(mode,grade){
	var baseUrl = '/'+projectName+'/master/master/gradefrm/grade/'+grade+'/mode/'+mode;
	window.location.href = baseUrl;
}
function openPageGroup(mode,id){
	var baseUrl = '/'+projectName+'/master/master/groupfrm/id/'+id+'/mode/'+mode;
	window.location.href = baseUrl;
}
function openPage(url){
	var baseUrl = '/'+projectName+'/'+url;
	window.location.href = baseUrl;
}
function openLevelGrade(grade,id){
	var baseUrl = '/'+projectName+'/master/master/level/grade/'+grade+'/id/'+id;
	window.location.href = baseUrl;
}
function openPageLevel(mode,id,grade){
	var baseUrl = '/'+projectName+'/master/master/levelfrm/id/'+id+'/mode/'+mode+'/grade/'+grade;
	window.location.href = baseUrl;
}
function jsSearch(){
	document.forms[0].submit();
}
function openPageType(mode,id,mId){
	var baseUrl = '/'+projectName+'/master/master/typemstfrom/id/'+id+'/mode/'+mode+'/menu_id/'+mId;
	window.location.href = baseUrl;
}
function openSendDate(mode,id){
	var baseUrl = '/'+projectName+'/master/master/senddatefrm/id/'+id+'/mode/'+mode;
	window.location.href = baseUrl;
}
function chekSubmitType(){
	$('#save').val('save');
	if($('#type_name').val()==''){
		_alert('Please input data.');
	}else{
		_confirm('Do you want save data?',function(){document.forms[0].submit();},{icon:'question'});
	}
}
function deleteRow(id){

	if(confirm('Do you want delete data?')){
		var params = '_output=json&id='+id;
	    var baseUrl = '/'+projectName+'/master/master/delgrade/';

	    AjaxContent.init({
	        proxy : baseUrl,
	        container : 'content-container',
	        overlay : true,
	        showLoadding: false,
	        htmlTemplate: null
	    });
	    AjaxContent.send(params,function(returnText){
	      	 if(returnText){
	      		eval(returnText);
	      		$("#tr_"+id).remove();
	      		alert("delete data complease.");
	      	 }
	   	});
	}
}
function chekSubmit(){
	if($('#grade').val() ==''){
		_alert('Please input Grade.');
	}else if($('#start_scoll').val() ==''){
		_alert('Please input start scoll.');
	}else if($('#end_scoll').val() ==''){
		_alert('Please input end scoll.');
	}else{
		$('#save').val('1');
		_confirm('Do you want save data?',function(){document.forms[0].submit();},{icon:'question'});
	}
}
function chekSubmit2(){
	if($('#grade').val() ==''){
		_alert('Please input Grade.');
	}else if($('#start_scoll').val() ==''){
		_alert('Please input start scoll.');
	}else if($('#end_scoll').val() ==''){
		_alert('Please input end scoll.');
	}else{
		_confirm('Do you want save data?',function(){
			var params = '_output=json&'+$('#_gradefrm :input',$('#content-container').get(0)).serialize();
		    var baseUrl = '/'+projectName+'/master/master/savegrade/';

		    AjaxContent.init({
		        proxy : baseUrl,
		        container : 'content-container',
		        overlay : true,
		        showLoadding: false,
		        htmlTemplate: null
		    });
		    AjaxContent.send(params,function(returnText){
		      	 if(returnText){
		      		eval(returnText);
		      		var baseUrl = '/'+projectName+'/master/master/grade/';
		      		window.location.href = baseUrl;
		      	 }
		   	});
	   	});
   	}
}
function chekSubmitGroup(){
	if($('#l_shotname').val() ==''){
		_alert('Please input Group.');
	}else{
		_confirm('Do you want save data?',function(){
			var params = '_output=json&'+$('#_groupfrm :input',$('#content-container').get(0)).serialize();
		    var baseUrl = '/'+projectName+'/master/master/savegroup/';
		    AjaxContent.init({
		        proxy : baseUrl,
		        container : 'content-container',
		        overlay : true,
		        showLoadding: false,
		        htmlTemplate: null
		    });
		    AjaxContent.send(params,function(returnText){
		      	 if(returnText){
		      		eval(returnText);
		      		alert("save data complease.");
		      		var baseUrl = '/'+projectName+'/master/master/group/';
		      		window.location.href = baseUrl;
		      	 }
		   	});
		});
	}
}
function chkChange(elm){
	var params = '_output=json&id='+elm.value;
    var baseUrl = '/'+projectName+'/master/master/check/';
    AjaxContent.init({
        proxy : baseUrl,
        container : 'content-container',
        overlay : true,
        showLoadding: false,
        htmlTemplate: null
    });
    AjaxContent.send(params,function(returnText){
      	 if(returnText){
     		alert("Data duplicate, Please select again.");
     		$('#'+elm.id).val('');
      	 }
   	});
}
function submitSendDate(){
	$('#save').val('save');
	if($('#config_level').val() ==''){
		alert('Please select Group Level.');
		$('#config_level').focus();
		return;
	}else if($('#config_senddate').val() ==''){
		alert('Please input Config date.');
		$('#config_senddate').focus();
		return;
	}else{
		_confirm('Do you want save data?',function(){document.forms[0].submit();},{icon:'question'});
	}
}
function chekSubmitLevel(grade){
	if($('#lv_code').val() ==''){
		alert('Please input Code.');
		$('#lv_code').focus();
		return;
	}else if($('#lv_shotname').val() ==''){
		alert('Please input shotname.');
		$('#lv_shotname').focus();
		return;
	}else if($('#lv_fullname').val() ==''){
		alert('Please input fullname.');
		$('#lv_fullname').focus();
		return;
	}else{
		$('#save').val('save');
		_confirm('Do you want save data?',function(){document.forms[0].submit();},{icon:'question'});
	}
}
function chekSubmitLevel2(grade){

	if($('#lv_code').val() ==''){
		alert('Please input Code.');
		$('#lv_code').focus();
		return;
	}else if($('#lv_shotname').val() ==''){
		alert('Please input shotname.');
		$('#lv_shotname').focus();
		return;
	}else if($('#lv_fullname').val() ==''){
		alert('Please input fullname.');
		$('#lv_fullname').focus();
		return;
	}
	var params = '_output=json&'+$('#_levelfrm :input',$('#content-container').get(0)).serialize();
    var baseUrl = '/'+projectName+'/master/master/savelevel/';

    AjaxContent.init({
        proxy : baseUrl,
        container : 'content-container',
        overlay : true,
        showLoadding: false,
        htmlTemplate: null
    });
    AjaxContent.send(params,function(returnText){
      	 if(returnText){
      		eval(returnText);
      		alert("save data complease.");

      		var baseUrl = '/'+projectName+'/master/master/level/grade/'+grade;
      		window.location.href = baseUrl;
      	 }
   	});
}
function deleteMultiLine(act,table,filed_id){
 	var param_code = '';
 	var chk = '';
 	$(':checkbox',$('#content-container').get(0)).each(function() {
 		var reg = /([0-9a-zA-Z]+)$/i;
 		if( this.checked==true && this.id.match(reg)){
  	      chk = '1';
 		}
 	});
 	if(chk == '1'){
 		_confirm("Do you want dalete data ?",function(){
	 		$(':checkbox',$('#content-container').get(0)).each(function() {
		 		var reg = /([0-9a-zA-Z]+)$/i;
		 		if( this.checked==true && this.id.match(reg)){
		  	       id = this.value;
		   	        var data = {
		  	    		'product' :this.value
		  	       }
		  	     if(param_code == "") param_code = data.product;
		 	     else param_code += ","+data.product;

		  	     $("#tr_"+id).remove();
		 		}
		 	});
	 		jsDelete(param_code,act,table,filed_id);
 		},{icon:'question'});
 	}else{
 		_alert('Plases select data.');
 		return;
 	}
 }
 function jsDelete(param_code,act,table,filed_id){
 var params ='_output=json&delID='+param_code;
	var baseUrl = '/'+projectName+'/master/'+act+'/delete/table/'+table+'/filed_id/'+filed_id;
	AjaxContent.init({
        proxy : baseUrl,
        container : 'content-container',
        overlay : false,
        showLoadding: false,
        htmlTemplate: null
    });
	AjaxContent.send(params,function(returnText){
		if(returnText){
			eval(returnText);
	        $(':checkbox').uncheck();
		}

	});
}