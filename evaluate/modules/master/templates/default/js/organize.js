function openPopup(url){

	var baseUrl = '/'+projectName+'/'+url;
 	var LeftPosition = (screen.width-730)/2 ;
 	var TopPosition =  50 ;
  	myWinName = window.open(baseUrl,'frmpopup','status=1,menubar=0,scrollbars=yes,resizable=0,width=730,height=600,left='+LeftPosition+',top='+TopPosition);
  	if (parseInt(navigator.appVersion) >= 4) {
		myWinName.window.focus();
	}
}
function jsSearch(){
	document.forms[0].submit();
}
function openPage(url){
	var baseUrl = '/'+projectName+'/'+url;
	window.location.href = baseUrl;
}
function pageForm(id,mode){
	var baseUrl = '/'+projectName+'/master/organize/frm/id/'+id+'/mode/'+mode;
	window.location.href = baseUrl;
}
function submitForm(mode){
	$('#save').val('save');
	if($('#org_sec_code').val()==''){
		_alert('Please input data Organize code.');
	}else if($('#org_sec_name_th').val()==''){
		_alert('Please input data Organize name TH.');
	}else if($('#org_position_name_en').val()==''){
		_alert('Please input data Organize name EN.');
	}else{
		if(mode == 'new'){
			var params ='_output=json&chk='+$('#org_sec_code').val();
			var baseUrl = '/'+projectName+'/master/organize/check';
			AjaxContent.init({
		        proxy : baseUrl,
		        container : 'mst_list',
		        overlay : false,
		        showLoadding: false,
		        htmlTemplate: null
		    });
			AjaxContent.send(params,function(returnText){
				if(returnText){
					_alert('Organize code duplicate,Please input again.');
					$('#org_sec_code').val('');$('#org_sec_code').focus();
				}else{
					_confirm('Do you want to save data?',function(){document.forms[0].submit();},{icon:'question'});
				}
			});
		}else _confirm('Do you want to save data?',function(){document.forms[0].submit();},{icon:'question'});
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
 		_confirm("Do you want to dalete data ?",function(){
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
	 		jsDelete(param_code,act);
 		},{icon:'question'});
 	}else{
 		_alert('Plases select data.');
 		return;
 	}
 }
 function jsDelete(param_code,act){
 	var params ='_output=json&delID='+param_code;
	var baseUrl = '/'+projectName+'/master/'+act+'/delete';
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