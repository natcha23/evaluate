function jsSearch(){
	document.forms[0].submit();
}
function openPage(url){
	var baseUrl = '/'+projectName+'/'+url;
	window.location.href = baseUrl;
}
function pageAccount(id,mode){
	var baseUrl = '/'+projectName+'/master/account/accfrm/id/'+id+'/mode/'+mode;
	window.location.href = baseUrl;
}
function pageSalary(user_code){
	var baseUrl = '/'+projectName+'/master/account/salary/user_code/'+user_code;
	window.location.href = baseUrl;
}
function openSalary(id,user_code,mode){
	var baseUrl = '/'+projectName+'/master/account/salfrm/user_code/'+user_code+'/id/'+id+'/mode/'+mode;
	window.location.href = baseUrl;
}
function changePwd(){
	$('#save').val('save');
	if($('#u_login').val() ==''){
		_alert('Please input user login.','',{callback:function(){$('#u_login').focus();}});
		return;
	}else if($('#u_password').val() ==''){
		_alert('Please input password.','',{callback:function(){$('#u_password').focus();}});
		return;
	}else if($('#pwd_con').val() ==''){
		_alert('Please input confirm password.','',{callback:function(){$('#pwd_con').focus();}});
		return;
	}else if($('#pwd_con').val() != $('#u_password').val()){
		_alert('Please input password and confirm password again.','',{callback:function(){$('#u_password').val('');$('#pwd_con').val('');$('#password').focus();}});
		return;
	}
	_confirm('Do you want to change password?',function(){document.forms[0].submit();},{icon:'question'});
}
function submitForm(){
	$('#save').val('save');
	if($('#user_code').val()==''){
		_alert('Please input data user code.');
		$('#user_code').focus();
		return;
	}else if($('#user_name').val()==''){
		_alert('Please input data user name.');
		$('#user_name').focus();
		return;
	}else if($('#u_login').val()==''){
		_alert('Please input user login.');
		$('#u_login').focus();
		return;
	}else if($('#u_password').val()==''){
		_alert('Please input password.');
		$('#u_password').focus();
		return;
	}else{
		_confirm('Do you want save data?',function(){document.forms[0].submit();},{icon:'question'});
	}
}
function submitSal(){
	$('#save').val('save');
	if($('#salary').val()==''){
		_alert('Please input data salary.');
		$('#salary').focus();
		return;
	}else if($('#date_upsalary').val()==''){
		_alert('Please input data change date.');
		$('#date_upsalary').focus();
		return;
	}else{
		_confirm('Do you want save data?',function(){document.forms[0].submit();},{icon:'question'});
	}
}
function deleteMultiLine(act){
 	var param_code = '';
 	var chk = '';
 	$(':checkbox',$('#mst_list').get(0)).each(function() {
 		var reg = /([0-9a-zA-Z]+)$/i;
 		if( this.checked==true && this.id.match(reg)){
  	      chk = '1';
 		}
 	});
 	if(chk == '1'){
 		_confirm('Do you want dalete data?',function(){
	 		$(':checkbox',$('#mst_list').get(0)).each(function() {
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
	 		jsDelete(param_code);
 		},{icon:'question'});
 	}else{
 		_alert('Plases select data.');
 		return;
 	}
 }
function jsDelete(param_code){
 	var params ='_output=json&delID='+param_code;
	var baseUrl = '/'+projectName+'/master/account/delete';
	AjaxContent.init({
        proxy : baseUrl,
        container : 'mst_list',
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
function CheckImageType(myfiles){
	myfile=myfiles.value;
	myfile = myfile.toLowerCase();
	Temp = myfile.charAt(myfile.length-4) + myfile.charAt(myfile.length-3) + myfile.charAt(myfile.length-2) + myfile.charAt(myfile.length-1);

	if(Temp!='.jpg' && Temp!='.JPG' && Temp!='.gif' && Temp!='.png' && Temp!='.GIF' && Temp!='jpeg' && Temp!='JPEG' ) {
		_alert('file is not support please select file picture only','',{callback:function(){document.getElementById(myfiles.id).outerHTML = "<INPUT TYPE='file' NAME='"+myfiles.name+"' id='"+myfiles.id+"'>";}});
		return false;
	}
	return true;
}
function GetLevel(elm){
	var params ='_output=json&position='+elm.value;
	var baseUrl = '/'+projectName+'/master/account/getleval';
	AjaxContent.init({
        proxy : baseUrl,
        container : 'mst_list',
        overlay : false,
        showLoadding: false,
        htmlTemplate: null
    });
	AjaxContent.send(params,function(returnText){
	     if(returnText)$('#level_new').val(returnText);
	     else $('#level_new').val('');
	});
}
