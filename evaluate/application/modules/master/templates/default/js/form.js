function jsSearch(){
	document.forms[0].submit();
}
function pageFormCreate(form_id,form_type){
	if(form_type =='MI')
		var baseUrl = '/'+projectName+'/workflow/evaluate/createmi/form_id/'+form_id+'/form_type/'+form_type;
	else
		var baseUrl = '/'+projectName+'/workflow/evaluate/createpi/form_id/'+form_id+'/form_type/'+form_type;

	window.location.href = baseUrl;
}
function pageFormDraft(drf_id,form_id,form_type){
	if(form_type =='MI')
		var baseUrl = '/'+projectName+'/workflow/evaluate/createmi/drf_id/'+drf_id+'/form_id/'+form_id+'/form_type/'+form_type;
	else
		var baseUrl = '/'+projectName+'/workflow/evaluate/createpi/drf_id/'+drf_id+'/form_id/'+form_id+'/form_type/'+form_type;

	window.location.href = baseUrl;
}
function pageFormEva(id,mode){
	var baseUrl = '/'+projectName+'/master/form/evafrm/id/'+id+'/mode/'+mode;
	window.location.href = baseUrl;
}
function openPage(url){
	var baseUrl = '/'+projectName+'/'+url;
	window.location.href = baseUrl;
}
function submitForm(){
	$('#save').val('save');
	if($('#form_code').val()==''){
		alert('Please input data Form code.');
		$('#form_code').focus();
		return;
	}else if($('#form_name').val()==''){
		alert('Please input data Form name.');
		$('#form_name').focus();
		return;
	}else if($('#form_objective').val()==''){
		alert('Please input data Objective.');
		$('#form_objective').focus();
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
 		_confirm("Do you want delete data ?",function(){
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
 function ChangeData(quo){
	 TINY.box.show({iframe:'/'+projectName+'/master/form/popup/sid/'+quo,boxid:'chgframe',width:650,height:400,fixed:true,close:false,maskopacity:40});
 }
 
 function sendMultiLine(act){
	 var param_code = '';
	 var chk = '';
	 	$(':checkbox',$('#mst_list1').get(0)).each(function() {
	 		var reg = /([0-9a-zA-Z]+)$/i;
	 		if( this.checked==true && this.id.match(reg)){
	  	      chk = '1';
	 		}
	 	});
	 	if(chk == '1'){
	 		$(':checkbox',$('#mst_list1').get(0)).each(function() {
		 		var reg = /([0-9a-zA-Z]+)$/i;
		 		if( this.checked==true && this.id.match(reg)){
		  	       id = this.value;
		   	        var data = {
		  	    		'product' :this.value
		  	       }
		  	     if(param_code == "") param_code = data.product;
		 	     else param_code += ","+data.product;

		 		}
		 	});
	 		ChangeData(param_code);
	 	}else{
	 		_alert('Please select data.');
	 		return;
	 	}
 }
function delDraftMultiLine(act){
 	var param_code = '';
 	var chk = '';
 	$(':checkbox',$('#mst_list1').get(0)).each(function() {
 		var reg = /([0-9a-zA-Z]+)$/i;
 		if( this.checked==true && this.id.match(reg)){
  	      chk = '1';
 		}
 	});
 	if(chk == '1'){
 		_confirm("Do you want delete data ?",function(){
	 		$(':checkbox',$('#mst_list1').get(0)).each(function() {
		 		var reg = /([0-9a-zA-Z]+)$/i;
		 		if( this.checked==true && this.id.match(reg)){
		  	       id = this.value;
		   	        var data = {
		  	    		'product' :this.value
		  	       }
		  	     if(param_code == "") param_code = data.product;
		 	     else param_code += ","+data.product;

		  	     $("#trd_"+id).remove();
		 		}
		 	});
	 		jsDraftDelete(param_code,act);
 		},{icon:'question'});
 	}else{
 		_alert('Please select data.');
 		return;
 	}
 }
 function jsDraftDelete(param_code,act){
 var params ='_output=json&delID='+param_code;
	var baseUrl = '/'+projectName+'/master/'+act+'/deldraft';
	AjaxContent.init({
        proxy : baseUrl,
        container : 'mst_list1',
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
