function jsSearch(){
	document.forms[0].submit();
}
function openPage(url){
	var baseUrl = '/'+projectName+'/'+url;
	window.location.href = baseUrl;
}
function pageForm(id,mode){
	var baseUrl = '/'+projectName+'/master/setting/frm/id/'+id+'/mode/'+mode;
	window.location.href = baseUrl;
}
function submitForm(mode){
	$('#save').val('save');
	if($('#hs_step').val()==''){
		_alert('Please select step flow.');
	}else if($('#hs_send').val()==''){
		_alert('Please select sender name.');
	}else if($('#hs_recive').val()==''){
		_alert('Please select receiver name.');
	}else{
		if(mode == 'new'){
			var params ='_output=json&send='+$('#hs_send').val()+'&recive='+$('#hs_recive').val();
			var baseUrl = '/'+projectName+'/master/setting/check';
			AjaxContent.init({
		        proxy : baseUrl,
		        container : 'mst_list',
		        overlay : false,
		        showLoadding: false,
		        htmlTemplate: null
		    });
			AjaxContent.send(params,function(returnText){
				if(returnText){
					_alert('Sender and Receiver duplicate,Please input again.');
					$('#hs_send').val('');$('#hs_recive').val('');$('#hs_send').focus();
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