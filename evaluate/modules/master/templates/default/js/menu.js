function openTag(id,obj){
	    var reg = eval("/^("+id+")_([a-zA-Z0-9\_]+)/i");
	      $("input[@type=checkbox]").each(function (){
	        var m = this.id.match(reg);
	        if(m){
	        	if(obj.checked){
	        		$(this).attr("checked","checked");
	        	}else{
	        		$(this).removeAttr("checked");
	        	}
	        }
	      });
	   if(obj.checked){
	   		chkParent(id);
	   }
}

function chkParent(id){
	var elm_arr = id.split("_");
	var elm_id="";
	for(i=((elm_arr.length*1)-1); i > 0; i--){
		elm_id = elm_arr[i];
		//alert(elm_id);
		if(elm_id){
			id = id.replace("_"+elm_id,"");
			if($("input[@id="+id+"]")){
				$("input[@id="+id+"]").attr("checked","checked")
			}
		}
	}

}

function checkSaveMenuAuth(mode){
	var i=0;
	      $("input[@type=checkbox]").each(function (){
	        if(this.checked)
	        	i++;
	      });
	var ckDup ;
	ckDup = CheckDupMenu($('#lookup_code').val(),$('#lookup_name').val());
	if(!$('#lookup_code').val()){
		alert('Please required Code Menu Type ');
		$('#lookup_code').focus();
			return false;
	}else if(!$('#lookup_name').val()){
		alert('Please required Name Menu Type ');
		$('#lookup_name').focus();
			return false;
	}else if(ckDup && mode == "new"){
		alert('Please Check Duplicate Data ');
		$('#lookup_code').select();
			return false;
	}else if(i==0){
			alert('Please Select Menu');
			return false;
	}else{
		_confirm('Are you sure save menu?',function(){document.forms['my_form'].submit();},{icon:'question'});
	}
}

function CheckDupMenu(code,name){
 var chk;
 var params ='_output=json&lookup_code='+code+'&lookup_name='+name;
 var baseUrl = '/'+app.basePath+'/master/mtmenu/checkmenu/';

	AjaxContent.init({
        proxy : baseUrl,
        container : 'menu_list',
        overlay : false,
        showLoadding: false,
        htmlTemplate: null
    });

	AjaxContent.send(params,function(returnText){
		if(returnText){
			eval(returnText);
			chk=1;
		}
	});
	return chk;
}

function deleteMultiLine(){
 	var param_code = '';
 	var chk = '';
 	 $("input[@type=checkbox]").each(function (){
	        if(this.checked)
	        	chk=1;
	 });
 	if(chk == '1'){
 		if(confirm('Do you want to dalete data ?')){
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
 		}
 	}else{
 		alert('Plases select data.');
 		return;
 	}
 }

 function jsDelete(param_code){
 var params ='_output=json&delID='+param_code;
	var baseUrl = '/'+projectName+'/master/mtmenu/delete';
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