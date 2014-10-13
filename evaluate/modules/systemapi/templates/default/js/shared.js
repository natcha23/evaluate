function checkLogin(){
	var vChk;
	var user = $('#f_email').val();
	var pwd = $('#f_pwd').val();
	//var chk = document.getElementById('f_remem').checked;

	if(user =='' || pwd =='' ){
		_alert('Pleses input Username and password.');
	}else{
		var baseUrl = '/'+projectName+'/authen/index/login';
		//if(chk == true) vChk = 'Y';else vChk = 'N';
		$.ajax({
			type: "POST",
			url: baseUrl,
			data: {username:user,password:pwd,remember:vChk},
			success: function(msg){
			  eval(msg);
			}
		});
	}
}
function checkEvent(objEvent){
	if($('#f_email').val() && $('#f_pwd').val()){
		// || objEvent.keyCode =='9'
		if(objEvent.keyCode == '13'){
			checkLogin();
		}
	}
}
function checkOut(){
	var vChk = '1';
	_confirm('Do you want to Logout ?',function(){
		var baseUrl = '/'+projectName+'/authen/index/evalogout';
		$.ajax({
			type: "POST",
			url: baseUrl,
			data: {remember:vChk},
			success: function(msg){
			  eval(msg);
			  window.location.href = '/'+projectName+'/account/account/index/';
//				window.location.href = 'http://devioffice4.icesolution.com/api/authorize?response_type=code&client_id=ievaluation&state=accesstoken';
			}
		});
	});
}
function openLinkMenu(url){
	window.location.href = '/'+projectName+'/'+url;
}
function selectChkAll(elm){
	var parents = $(elm).parents("table").get(0);
    if(elm.checked) {
        $(':checkbox:not(#'+elm.id+')',parents).each(function(){
            $(this).check();
        });
    }
    else{
    	$(':checkbox:not(#'+elm.id+')',parents).each(function(){
            $(this).uncheck();
        });
    }
}
function CancelReset(){
	$('#f_email').val('');
	$('#f_pwd').val('');
}
function jsShowMenu(){
	$('#_imghide').show();
	$('#_menuhide').show();
	$('#_imgshow').hide();
}
function jsHideMenu(){
	$('#_imghide').hide();
	$('#_menuhide').hide();
	$('#_imgshow').show();
}
function handleEnter (field, event) {
	var keyCode = event.keyCode ? event.keyCode : event.which ? event.which : event.charCode;
	if (keyCode == 13) {
		var i;
		for (i = 0; i < field.form.elements.length; i++)
			if (field == field.form.elements[i])
				break;
		i = (i + 1) % field.form.elements.length;
		if(handleCheckField(field.form.elements[i]))
			handleEnter(field.form.elements[i],event);
		else
			field.form.elements[i].focus();
		return false;
	}
	else
	return true;
}

function handleCheckField(field){
	if(field.type=="hidden" || field.type=="file" || field.type=="checkbox" || field.readOnly==true || field.disabled==true)
		return true;
	else
		return false;
}