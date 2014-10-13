var Success;
function openPopup(url){
	var baseUrl = '/'+projectName+'/'+url;
 	var LeftPosition = (screen.width-730)/2 ;
 	var TopPosition =  50 ;
  	myWinName = window.open(baseUrl,'frmpopup','status=1,menubar=0,scrollbars=yes,resizable=0,width=730,height=600,left='+LeftPosition+',top='+TopPosition);
  	if (parseInt(navigator.appVersion) >= 4) {
		myWinName.window.focus();
	}
}
function jsChange(id){
	$('#search').val('search');
 	document.forms[0].submit();
}
function jsSearch(){
	document.forms[0].submit();
}
function jsShowTime(val){
	if(val == 'MI'){
		$('#quarter').show();
		$('#month').hide();
	}else if(val == 'PI'){
		$('#quarter').hide();
		$('#month').show();
	}
}
function chkDraftSubmit(type,form_id){
	var chk_t1 = '';
	var chk_t2 = '';

	$(':checkbox:checked',$('#_show1').get(0)).each(function() {
 		var reg = /([0-9a-zA-Z]+)$/i;
 		chk_t1 = '1';
 	});
	if($('#month').val()==''){
		if(type=='PI')_alert('Please select month.');
		else _alert('Please select Quarter.');
	}else if($('#mph_objective').val() ==''){
		_alert('Please input Evaluate Objective.');
	}else if(chk_t1 =='' ){
		_alert('Please select data.');
	}else if($('#user_code').val() ==''){
		_alert('Please input user.');
	}else if($('#mph_sflow').val() ==''){
		_alert('Please select start flow.');
	}else if($('#mph_eflow').val() ==''){
		_alert('Please select end flow.');
	}else if($('#user_rec').val() =='' ){
		_alert('Please select data.');
	}else{
		$('#mode').val('save');
		$('#save').val('save');
		_confirm("Do you want to draft data ?",function(){
		 	var params = '_output=post&'+$('#_create :input',$('#content-container').get(0)).serialize();
		    if(type =='MI')
		    	var baseUrl = '/'+projectName+'/workflow/evaluate/draftmi/';
		    else
		    	var baseUrl = '/'+projectName+'/workflow/evaluate/draftpi/';

		    AjaxContent.init({
		        proxy : baseUrl,
		        container : 'content-container',
		        overlay : true,
		        showLoadding: false,
		        htmlTemplate: null
		    });
		    AjaxContent.send(params,function(returnText){

		    });
	   	});
	}
}
function chkSaveSubmit(type,form_id){
	var chk_t1 = '';
	var chk_t2 = '';

	$(':checkbox:checked',$('#_show1').get(0)).each(function() {
 		var reg = /([0-9a-zA-Z]+)$/i;
 		chk_t1 = '1';
 	});
	if($('#month').val()==''){
		if(type=='PI')_alert('Please select month.');
		else _alert('Please select Quarter.');
	}else if($('#mph_objective').val() ==''){
		_alert('Please input Evaluate Objective.');
	}else if(chk_t1 =='' ){
		_alert('Please select data.');
	}else if($('#user_code').val() ==''){
		_alert('Please input user.');
	}else if($('#mph_sflow').val() ==''){
		_alert('Please select start flow.');
	}else if($('#mph_eflow').val() ==''){
		_alert('Please select end flow.');
	}else if($('#user_rec').val() =='' ){
		_alert('Please select data.');
	}else{
		$('#mode').val('save');
		$('#save').val('save');
		_confirm("Do you want to save data ?",function(){
		 	var params = '_output=post&'+$('#_create :input',$('#content-container').get(0)).serialize();
		    if(type =='MI')
		    	var baseUrl = '/'+projectName+'/workflow/evaluate/savemi/';
		    else
		    	var baseUrl = '/'+projectName+'/workflow/evaluate/savepi/';

		    AjaxContent.init({
		        proxy : baseUrl,
		        container : 'content-container',
		        overlay : true,
		        showLoadding: false,
		        htmlTemplate: null
		    });
		    AjaxContent.send(params,function(returnText){
		      	if(type =='MI'){
		      		var baseUrl = '/'+projectName+'/workflow/evaluate/portalmi/form_id/'+form_id+'/form_type/'+type;
		      	}else{
		      		var baseUrl = '/'+projectName+'/workflow/evaluate/portalpi/form_id/'+form_id+'/form_type/'+type;
		      	}
		      	window.location.href = baseUrl;
		   	});
	   	});
	}
}
function bttChkSubmit(type,accept,status,head){
	var chk = '';
	$(':radio',$('#frmpopup').get(0)).each(function() {
 		var reg = /([0-9a-zA-Z]+)$/i;
 		if( this.checked==true && this.id.match(reg)){
 			chk = '1';
 		}
 	});
	if(chk =='1'){
		$(':radio',$('#frmpopup').get(0)).each(function() {
		 	var reg = /([0-9a-zA-Z]+)$/i;
		 	if( this.checked==true && this.id.match(reg)){
		   	    var data = {
		  	    	'code' :this.value,
                    'name'   :this.title
		  	    }
		   	    param_code = data.code;
		 	}
		 });
		window.opener.$('#user_recive_popup').val(param_code);
		window.close();
		
		window.opener.bttFinish('P',type,status,'send');
	}else{
		_alert('Please select data.');
	}
}
function chekSubmit(type,accept,status,head){
	var param_code = '';
	var param_name = '';
	var chk = '';

	if(type =='pi' || type =='mi' || head =='Y'){
		$(':radio',$('#frmpopup').get(0)).each(function() {
	 		var reg = /([0-9a-zA-Z]+)$/i;
	 		if( this.checked==true && this.id.match(reg)){
	 			chk = '1';
	 		}
	 	});
	}else{
		$(':checkbox',$('#frmpopup').get(0)).each(function() {
	 		var reg = /([0-9a-zA-Z]+)$/i;
	 		if( this.checked==true && this.id.match(reg)){
	 			chk = '1';
	 		}
	 	});
	}
	if(chk =='1'){
		if(head =='Y'){
			$(':radio',$('#frmpopup').get(0)).each(function() {
			 	var reg = /([0-9a-zA-Z]+)$/i;
			 	if( this.checked==true && this.id.match(reg)){
			   	    var data = {
			  	    	'code' :this.value,
	                    'name'   :this.title
			  	    }
			   	    param_code = data.code;
			   	    param_name = data.name;
			 	}
			 });
			window.opener.$('#user_header').val(param_code);
			window.opener.$('#header_name').val(param_name);
			window.close();
		}else if(type =='pi' || type =='mi'){

			$(':radio',$('#frmpopup').get(0)).each(function() {
			 	var reg = /([0-9a-zA-Z]+)$/i;
			 	if( this.checked==true && this.id.match(reg)){
			   	    var data = {
			  	    	'code' :this.value,
	                    'name'   :this.title
			  	    }
			   	    param_code = data.code;
			 	}
			 });
			window.opener.$('#user_recive').val(param_code);
			window.close();
			if(accept)
				window.opener.acceptDataToSave('P',type);
			else
				window.opener.sendDataToSave('P',type,status,'send');

		}else{
			$(':checkbox',$('#frmpopup').get(0)).each(function() {
			 	var reg = /([0-9a-zA-Z]+)$/i;
			 	if( this.checked==true && this.id.match(reg)){
			   	    var data = {
			  	    	'code' :this.value,
	                    'name'   :this.title
			  	    }
			   	 if(param_code == "") param_code = data.code;
	    	     else param_code += ","+data.code;

			   	 if(param_name == "") param_name = data.name;
	    	     else param_name += ","+data.name;

			 	}
			 });
			window.opener.$('#user_code').val(param_code);
	  		window.opener.$('#user_name').val(param_name);
	  		window.close();
		}
	}else{
		_alert('Please input data.');
	}
}
function acceptDataToSave(status,type){
	$('#mode').val("update");
	$('#status').val(status);
	if(status =='P') var acc_title = 'Do you want to accept data ?'; else var acc_title = 'Do you want to accept data end flow ?';
	_confirm(acc_title,function(){
		if(type == 'mi'){
		 	var params = '_output=json&status='+status+'&'+$('#_portal :input',$('#content-container').get(0)).serialize();
		 	var baseUrl = '/'+projectName+'/workflow/evaluate/acceptmi/';
		}else if(type == 'pi'){
			var params = '_output=json&status='+status+'&'+$('#_portal :input',$('#content-container').get(0)).serialize();
		 	var baseUrl = '/'+projectName+'/workflow/evaluate/acceptpi/';
		}
	    AjaxContent.init({
	        proxy : baseUrl,
	        container : 'content-container',
	        overlay : true,
	        showLoadding: false,
	        htmlTemplate: null
	    });
	    AjaxContent.send(params,function(returnText){
	      	 //if(returnText){
	      	//	eval(returnText);
	      		_alert("Accept data to complease.");
	      		if(type == 'mi'){
					if(status =='P')
						var baseUrl = '/'+projectName+'/workflow/evaluate/view/type/MI/user/'+$('#user_send').val()+'/status/C';
					else
						var baseUrl = '/'+projectName+'/workflow/evaluate/urecive';
	      		}else{
	      			if(status =='P')
	      				var baseUrl = '/'+projectName+'/workflow/evaluate/view/type/PI/user/'+$('#user_send').val()+'/status/C';
	      			else
	      				var baseUrl = '/'+projectName+'/workflow/evaluate/urecive';
				}
	      		window.location.href = baseUrl;
	      	// }
	   	});
   	},{icon:'question'});
}
function sendDataToOwner(status,type,page,mph_user){
	$('#mode').val("update");
	$('#status').val(status);
	$('#page_status').val(page);
	$('#user_recive').val(mph_user);
	_confirm('Do you want to send data?',function(){
		if(type == 'mi'){
		 	var params = '_output=json&status='+status+'&'+$('#_mifrm :input',$('#content-container').get(0)).serialize();
		 	var baseUrl = '/'+projectName+'/workflow/evaluate/updatemi/';
		}else if(type == 'pi'){
			var params = '_output=json&status='+status+'&'+$('#_pifrm :input',$('#content-container').get(0)).serialize();
		 	var baseUrl = '/'+projectName+'/workflow/evaluate/updatepi/';
		}
	    AjaxContent.init({
	        proxy : baseUrl,
	        container : 'content-container',
	        overlay : true,
	        showLoadding: false,
	        htmlTemplate: null
	    });
	    AjaxContent.send(params,function(returnText){
	      	 //if(returnText){
	      		if($('#checksend').val()== 'N') _alert("You send evaluate data late.");
	      		if(page =='V'){
	      			var baseUrl = '/'+projectName+'/workflow/evaluate/urecive';
	      		}else{
		      		if(type == 'mi'){
		  				var baseUrl = '/'+projectName+'/workflow/evaluate/view/type/MI/user/'+$('#user_send').val()+'/status/'+page;
		      		}else{
		      			var baseUrl = '/'+projectName+'/workflow/evaluate/view/type/PI/user/'+$('#user_send').val()+'/status/'+page;
					}
				}
	      		window.location.href = baseUrl;
	      	// }
	   	});
	},{icon:'question'});
}
function bttFinish(status,type,page,btt){
	$('#mode').val("update");
	$('#page_status').val(page);
	var old_status = $('#old_status').val();
	
	if(btt == 'send') var data_confirm = "Do you want to send to data ?";
	else if(btt == 'finish') var data_confirm = "Do you want to finish approve ?";
	else var data_confirm = "Do you want to save data ?";
	_confirm(data_confirm,function(){
		if(type == 'mi'){
		 	var params = '_output=json&chk=1&status='+status+'&'+$('#_mifrm :input',$('#content-container').get(0)).serialize();
		 	var baseUrl = '/'+projectName+'/workflow/evaluate/updatemi/';
		}else if(type == 'pi'){
			var params = '_output=json&chk=1&status='+status+'&'+$('#_pifrm :input',$('#content-container').get(0)).serialize();
		 	var baseUrl = '/'+projectName+'/workflow/evaluate/updatedetailpi/';
		}else if(type == 'pi_admin'){
			var params = '_output=json&chk=1&status='+status+'&'+$('#_pifrm :input',$('#content-container').get(0)).serialize();
		 	var baseUrl = '/'+projectName+'/workflow/evaluate/updatedetailpibyadmin/';
		}

	    AjaxContent.init({
	        proxy : baseUrl,
	        container : 'content-container',
	        overlay : true,
	        showLoadding: false,
	        htmlTemplate: null
	    });
	    AjaxContent.send(params,function(returnText){
	      		if($('#checksend').val()== 'N') _alert("You send evaluate data late.");
	      		if(type == 'mi'){
	  				var baseUrl = '/'+projectName+'/workflow/evaluate/accept/type/MI';
	      		}else{
	      			var baseUrl = '/'+projectName+'/workflow/evaluate/accept/type/PI';
				}
	      		window.location.href = baseUrl;
	   	});
	},{icon:'question'});
}
function sendDataToSave(status,type,page,btt){
	$('#mode').val("update");
	$('#status').val(status);
	$('#page_status').val(page);
	var old_status = $('#old_status').val();
	var weight1 = 0;
	var chks = 100*1;
	var ctn = $('#table_list',$('#content-container').get(0));	
	$('input[@id^=wscoll\_]').each(function(){
		weight1 += $(this).val().replace(/[\,]/g,'')*1;
	});
	if(weight1 != chks && page == 'E') $('#status').val(old_status);

	if(btt == 'send') var data_confirm = "Do you want to send to data ?";
	else if(btt == 'finish') var data_confirm = "Do you want to finish approve ?";
	else var data_confirm = "Do you want to save data ?";
	_confirm(data_confirm,function(){
		if(type == 'mi'){
		 	var params = '_output=json&status='+status+'&'+$('#_mifrm :input',$('#content-container').get(0)).serialize();
		 	var baseUrl = '/'+projectName+'/workflow/evaluate/updatemi/';
		}else if(type == 'pi'){
			var params = '_output=json&status='+status+'&'+$('#_pifrm :input',$('#content-container').get(0)).serialize();
		 	var baseUrl = '/'+projectName+'/workflow/evaluate/updatepi/';
		}

	    AjaxContent.init({
	        proxy : baseUrl,
	        container : 'content-container',
	        overlay : true,
	        showLoadding: false,
	        htmlTemplate: null
	    });
	    AjaxContent.send(params,function(returnText){
	      		if($('#checksend').val()== 'N') _alert("You send evaluate data late.");
	      		if(page =='V'){
	      			var baseUrl = '/'+projectName+'/workflow/evaluate/urecive';
	      		}else if(page =='E'){
	      			var baseUrl = '/'+projectName+'/workflow/evaluate/history';
	      		}else{
		      		if(type == 'mi'){
		  				var baseUrl = '/'+projectName+'/workflow/evaluate/view/type/MI/user/'+$('#user_send').val()+'/status/'+page;
		      		}else{
		      			if(page == 'A'){
		      				var baseUrl = '/'+projectName+'/workflow/evaluate/accept/type/PI';
		      			}else{
		      				var baseUrl = '/'+projectName+'/workflow/evaluate/view/type/PI/user/'+$('#user_send').val()+'/status/'+page;
		      			}
					}
				}
	      		window.location.href = baseUrl;
	   	});
	},{icon:'question'});
}
function sendDataToSave_old(status,type,page,btt){

	$('#mode').val("update");
	$('#status').val(status);
	$('#page_status').val(page);
	var old_status = $('#old_status').val();
	var weight1 = 0;
	var chks = 100*1;
	var ctn = $('#table_list',$('#content-container').get(0));
	$('input[@id^=w\_]').each(function(){
		weight1 += $(this).val().replace(/[\,]/g,'')*1;
	});
		
	if(weight1 != chks && page == 'E') $('#status').val(old_status);

	if(btt == 'send') var data_confirm = "Do you want to send to data ?";
	else var data_confirm = "Do you want to save data ?";
	_confirm(data_confirm,function(){
		if(type == 'mi'){
		 	var params = '_output=json&status='+status+'&'+$('#_mifrm :input',$('#content-container').get(0)).serialize();
		 	var baseUrl = '/'+projectName+'/workflow/evaluate/updatemi/';
		}else if(type == 'pi'){
			var params = '_output=json&status='+status+'&'+$('#_pifrm :input',$('#content-container').get(0)).serialize();
		 	var baseUrl = '/'+projectName+'/workflow/evaluate/updatepi/';
		}

	    AjaxContent.init({
	        proxy : baseUrl,
	        container : 'content-container',
	        overlay : true,
	        showLoadding: false,
	        htmlTemplate: null
	    });
	    AjaxContent.send(params,function(returnText){
	      		if($('#checksend').val()== 'N') _alert("You send evaluate data late.");
	      		if(page =='V'){
	      			var baseUrl = '/'+projectName+'/workflow/evaluate/urecive';
	      		}else if(page =='E'){
	      			var baseUrl = '/'+projectName+'/workflow/evaluate/history';
	      		}else{
		      		if(type == 'mi'){
		  				var baseUrl = '/'+projectName+'/workflow/evaluate/view/type/MI/user/'+$('#user_send').val()+'/status/'+page;
		      		}else{
		      			var baseUrl = '/'+projectName+'/workflow/evaluate/view/type/PI/user/'+$('#user_send').val()+'/status/'+page;
					}
				}
	      		window.location.href = baseUrl;
	   	});
	},{icon:'question'});
}
function chkScoll_old(scoll_id,url,status){
	var weight1 = 0;
	var ctn = $('#table_list',$('#content-container').get(0));
	$('input[@id^=w\_]').each(function(){
		weight1 += $(this).val().replace(/[\,]/g,'')*1;
	});
	document.getElementById('weight').innerHTML = weight1;
	var scoll = document.getElementById(scoll_id).innerHTML.replace(/[\,]/g,'')*1;
	var scoll_full = 100*1;
	if(status != 'E'){
		if(scoll != scoll_full){
			_alert('Point weight more than 100 or less than 100,Please check again.');
		}else{
			openPopup(url);
		}
	}else{openPopup(url);}
}
function bttSendTo(url){
	var chk;
	$('input[@id^=rscoll\_]').each(function(){
		weight1 = $(this).val().replace(/[\,]/g,'')*1;		
		if(weight1==0 || weight1 =='undifile'){
	  	   chk = '1';
	 	}
	});
	if(chk){
		_alert('Please check point again.');
	}else{
		openPopup(url);
	}
}
function chkScoll(scoll_id,url,status){
	var weight1 = 0;
	var chk;
	$('input[@id^=rscoll\_]').each(function(){
		weight1 = $(this).val().replace(/[\,]/g,'')*1;				
		if(weight1==0 || weight1 =='undifile'){
	  	   chk = '1';
	 	}else{
	 	   chk = '1';
	 	}
	});	
	var scoll = $('#sum_weight').val().replace(/[\,]/g,'')*1;
	var scoll_full = 100*1;
	if(!chk){
		_alert('Please check point again.');
	}else{
		if(status != 'E'){
			if(scoll != scoll_full){
				_alert('Point weight more than 100 or less than 100,Please check again.');
			}else{
				openPopup(url);
			}			
		}else{openPopup(url);}
	}
}
function chkScollSend_old(scoll_id,status,type,page,mph_user,old_status,url){
	var weight1 = 0;
	var ctn = $('#table_list',$('#content-container').get(0));
	$('input[@id^=w\_]').each(function(){
		weight1 += $(this).val().replace(/[\,]/g,'')*1;
	});
	document.getElementById('weight').innerHTML = weight1;
	var scoll = document.getElementById(scoll_id).innerHTML.replace(/[\,]/g,'')*1;
	var scoll_full = 100*1;

	if(page != 'E'){
		if(scoll != scoll_full){
			_alert('Point weight more than 100 or less than 100,Please check again.');
		}else{
			sendDataToOwner(status,type,page,mph_user);
		}
	}else{
		if(scoll != scoll_full)
			$('#status').val('C');
		openPopup(url);
	}//sendDataToOwner(status,type,page,mph_user);}
}
function chkScollSend(scoll_id,status,type,page,mph_user,old_status,url){
	var weight1 = 0;
	var ctn = $('#table_list',$('#content-container').get(0));
	$('input[@id^=wscoll\_]').each(function(){
		weight1 += $(this).val().replace(/[\,]/g,'')*1;
	});
	if(weight1>0)
		document.getElementById('weight').innerHTML = weight1;
	var scoll = $('#sum_weight').val().replace(/[\,]/g,'')*1;
	/*var scoll = document.getElementById('weight').innerHTML.replace(/[\,]/g,'')*1;*/
	var scoll_full = 100*1;
	if(page != 'E'){
		if(weight1 != scoll_full){
			_alert('Point weight more than 100 or less than 100,Please check again.');
		}else{
			sendDataToOwner(status,type,page,mph_user);
		}
	}else{
		if(weight1 != scoll_full)
			$('#status').val('C');
		openPopup(url);
	}
}
function openPageAccept(type){
	var baseUrl = '/'+projectName+'/workflow/evaluate/accept/type/'+type;
	window.location.href = baseUrl;
}
function openPageView(type,user,sta){
	var baseUrl = '/'+projectName+'/workflow/evaluate/view/type/'+type+'/user/'+user+'/status/'+sta;
	window.location.href = baseUrl;
}
function openPageEvaluate(type,id,user,m,status){
	if(type == 'MI')
		var baseUrl = '/'+projectName+'/workflow/evaluate/mifrm/user/'+user+'/id/'+id+'/m/'+m+'/status/'+status;
	else if(type == 'PI')
		var baseUrl = '/'+projectName+'/workflow/evaluate/pifrm/user/'+user+'/id/'+id+'/m/'+m+'/status/'+status;

	window.location.href = baseUrl;
}
function openEvaluate(type,user){
	if(type == 'MI')
		var baseUrl = '/'+projectName+'/workflow/evaluate/mifrm/user/'+user;
	else if(type == 'PI')
		var baseUrl = '/'+projectName+'/workflow/evaluate/pifrm/user/'+user;

	window.location.href = baseUrl;
}
function openLinkPage(type,user,tab,mClick,status,copy_to){
	if(type == 'MI')
		var baseUrl = '/'+projectName+'/workflow/evaluate/mifrm/user/'+user+'/tab/'+tab+'/m/'+mClick+'/status/'+status+'/copy_to/'+copy_to;
	else if(type == 'PI')
		var baseUrl = '/'+projectName+'/workflow/evaluate/pifrm/user/'+user+'/tab/'+tab+'/m/'+mClick+'/status/'+status+'/copy_to/'+copy_to;

	window.location.href = baseUrl;
}
function selectChkHead(elm){
	var parents = $(elm).parents("table").get(0);
	if(elm.checked) {
		$(':checkbox:not(#'+elm.id+')',parents).each(function(){
			var reg = /d\_([0-9a-zA-Z]+)\_([0-9a-zA-Z]+)$/i;
	        var m = elm.id.match(reg);
	        $("#s_"+m[1]).check();
        });
	}else{
		$(this).uncheck();
	}
}
function jsChange1(id){
	var params = '_output=json&type=search&id='+id;
	var baseUrl = '/'+projectName+'/workflow/evaluate/userpopup';
    AjaxContent.init({
   	 proxy : baseUrl,
        container : 'frmpopup',
        overlay : true,
        showLoadding: false,
        htmlTemplate: null
   });
   AjaxContent.send(params,function(returnText){
	   	if(returnText){
			eval(returnText);
	   	}
	});
	return;
}

function openPageEvalmst(mode,Id,mId,level){
	var baseUrl = '/'+projectName+'/workflow/evaluate/evalmst/id/'+Id+'/mode/'+mode+'/menu_id/'+mId+'/level/'+level;
	window.location.href = baseUrl;
}
function addSubEval(mode,Id,type,mId){
	var baseUrl = '/'+projectName+'/workflow/evaluate/evalmst/parId/'+Id+'/type/'+type+'/mode/'+mode+'/menu_id/'+mId;
	window.location.href = baseUrl;
}
function openPage(url){
	var baseUrl = '/'+projectName+'/'+url;
	window.location.href = baseUrl;
}

function chekSavemst(){
	$('#save').val('save');
	if($('#type_name').val()==''){
		_alert('Please input data.');
	}else{
		_confirm('Do you want to save data?',function(){document.forms[0].submit();},{icon:'question'});
	}
}
function DelRecord(id){
	var params ='_output=json&delID='+id;
	var baseUrl = '/'+projectName+'/workflow/evaluate/delrec';
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
	$("#tr_"+id).remove();
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
 	}
 }
 function jsDelete(param_code,act,table,filed_id){
 	var params ='_output=json&delID='+param_code;
	var baseUrl = '/'+projectName+'/workflow/'+act+'/delete/table/'+table+'/filed_id/'+filed_id;
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
function copyData(copy_from,type){
	var copy_to = '';
	$(':radio',$('#frmpopup').get(0)).each(function() {
		var reg = /([0-9a-zA-Z]+)$/i;
		if( this.checked==true && this.id.match(reg)){
			var data = {
				'code' :this.value
			}
			copy_to = data.code;
		}
	});
	if(copy_to){
		_confirm("Do you want to copy data ?",function(){
			var params ='_output=json&copy_from='+copy_from+'&copy_to='+copy_to+'&type='+type;
			var baseUrl = '/'+projectName+'/workflow/evaluate/copy/';
			AjaxContent.init({
		        proxy : baseUrl,
		        container : 'content-container',
		        overlay : false,
		        showLoadding: false,
		        htmlTemplate: null
		    });
			AjaxContent.send(params,function(returnText){
				if(returnText){
			        _alert('Copy data complete.','',{callback:function(){window.close();}});
				}
			});
		},{icon:'question'});
	}else{
		_alert('Plases select data.');
	}
}
function copyData1(copy_from,type,copy_to){
	_confirm("Do you want to copy data ?",function(){
		var params ='_output=json&copy_from='+copy_from+'&copy_to='+copy_to+'&type='+type;
		var baseUrl = '/'+projectName+'/workflow/evaluate/copy/';
		AjaxContent.init({
	        proxy : baseUrl,
	        container : 'content-container',
	        overlay : false,
	        showLoadding: false,
	        htmlTemplate: null
	    });
		AjaxContent.send(params,function(returnText){
			if(returnText){
		        _alert('Copy data complete.');
			}
		});
	},{icon:'question'});
}
function copyDataTo(copy_from,month_now,type,user_owner){
	var url ='/workflow/evaluate/popvalue/copy_from/'+copy_from+'/month_now/'+month_now+'/type/'+type+'/user_owner/'+user_owner;
	openPopup(url);
}
function jsExportExcel(type){
	var month = $('#month').val();
	var year = $('#year').val();
	var group = $('#group').val();
	var baseUrl = '/'+projectName+'/workflow/summary/exporttoxls/type/'+type+'/month/'+month+'/year/'+year+'/group/'+group;
	window.location.href = baseUrl;
}
function jsExportExcelYear(){
	var year = $('#year').val();
	var group = $('#group').val();
	var baseUrl = '/'+projectName+'/workflow/summary/exporttoxls3/year/'+year+'/group/'+group;
	window.location.href = baseUrl;
}
function jsExportExcel2(type){
	var month = $('#month').val();
	var year = $('#year').val();
	var group = $('#group').val();
	var baseUrl = '/'+projectName+'/workflow/summary/exporttoxls2/type/'+type+'/month/'+month+'/year/'+year+'/group/'+group;
	window.location.href = baseUrl;
}
function sendSMS(type){
	var month = $('#month').val()+''+$('#year').val();
	var user_rec = $('#user_rec').val();

	var baseUrl = '/'+projectName+'/workflow/evaluate/sendsms/type/'+type+'/month/'+month+'/user_rec/'+user_rec;
 	var LeftPosition = (screen.width-730)/2 ;
 	var TopPosition =  50 ;
  	window.open(baseUrl,'frmpopup','status=1,menubar=0,scrollbars=yes,resizable=0,width=1,height=1,left='+LeftPosition+',top='+TopPosition);
	window.close();
	//var baseUrl = '/'+projectName+'/workflow/evaluate/sendsms/type/'+type+'/month/'+month+'/user_rec/'+user_rec;
	//window.location.href = baseUrl;
}
function jsPrintReport(type){
	var month = $('#month').val();
	var year = $('#year').val();
	var group = $('#group').val();
	var baseUrl = '/'+projectName+'/workflow/summary/printpdf/type/'+type+'/month/'+month+'/year/'+year+'/group/'+group;
	//window.location.href = baseUrl;
	//window.open(baseUrl,'frmpopup','status=1,menubar=0,scrollbars=yes,resizable=0,width='+screen.width+',height='+screen.height);
	myWinName = window.open(baseUrl,'frmpopup','status=1,menubar=0,scrollbars=yes,resizable=0,width='+screen.width+',height='+screen.height);
  	if (parseInt(navigator.appVersion) >= 4) {
		myWinName.window.focus();
	}
}
function jsAnalysis(type){
	var month = $('#month').val();
	var year = $('#year').val();
	var group = $('#group').val();
	var LeftPosition = (screen.width-470)/2 ;
 	var TopPosition =  50 ;
	var baseUrl = '/'+projectName+'/workflow/summary/analysis/type/'+type+'/month/'+month+'/year/'+year+'/group/'+group;
	myWinName = window.open(baseUrl,'frmpopup','status=1,menubar=0,scrollbars=yes,resizable=0,width=470,height=430,left='+LeftPosition+',top='+TopPosition);
  	if (parseInt(navigator.appVersion) >= 4) {
		myWinName.window.focus();
	}
}
function delMultiLine(act){
 	var param_code = '';
 	var chk = '';
 	$(':checkbox',$('#content-container').get(0)).each(function() {
 		var reg = /([0-9a-zA-Z]+)$/i;
 		if( this.checked==true && this.id.match(reg)){
  	      chk = '1';
 		}
 	});
 	if(chk == '1'){
 		_confirm("Do you want to delete data ?",function(){
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
	 		jsDeleteHis(param_code,act);
 		},{icon:'question'});
 	}else{
 		_alert('Please select data.');
 		return;
 	}
 }
function jsDeleteHis(param_code,act){
 var params ='_output=json&delID='+param_code;
	var baseUrl = '/'+projectName+'/workflow/evaluate/'+act;
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
function openDetail(month,grade,t,m1){
	var baseUrl = '/'+projectName+'/workflow/report/detail/t/'+t+'/month/'+month+'/grade/'+grade+'/m1/'+m1;
	window.location.href = baseUrl;
}
function jsSearch1(){
	if($('#month').val()==''){
		_alert('Please select month.','',{callback:function(){$('#month').focus();}});
		return;
	}else if($('#year').val()==''){
		_alert('Please select year.','',{callback:function(){$('#year').focus();}});
		return;
	}/*else if($('#group').val()==''){
		_alert('Please select department.','',{callback:function(){$('#group').focus();}});
		return;
	}*/else
		document.forms[0].submit();
}

function UpdateInc(type,mval){
	var acc_title = 'Do you want to update data ?';
	_confirm(acc_title,function(){
		if(type == 'mi'){
		 	var params = '_output=json&update_mode=1&'+$('#_portal :input',$('#content-container').get(0)).serialize();
		 	var baseUrl = '/'+projectName+'/workflow/evaluate/upincen/';
		}else if(type == 'pi'){
			var params = '_output=json&update_mode=1&mval='+mval+'&'+$('#_portal :input',$('#content-container').get(0)).serialize();
		 	var baseUrl = '/'+projectName+'/workflow/evaluate/upincen/';
		}
	    AjaxContent.init({
	        proxy : baseUrl,
	        container : 'content-container',
	        overlay : true,
	        showLoadding: false,
	        htmlTemplate: null
	    });
	    AjaxContent.send(params,function(returnText){
	      	_alert("Update data complease.");
	   	});
   	},{icon:'question'});
}
function approveDetail(type){
	var param_code = '';
	var chk = '';
	var mph_month = $('#mph_month').val();
 	$(':checkbox',$('#content-container').get(0)).each(function() {
 		var reg = /chk\_([0-9a-zA-Z]+)\_([0-9a-zA-Z]+)$/i;
 		if( this.checked==true && this.id.match(reg)){
  	      chk = '1';
 		}
 	});
 	if(chk == '1'){
	 	$(':checkbox',$('#content-container').get(0)).each(function() {
		 	var reg = /chk\_([0-9a-zA-Z]+)\_([0-9a-zA-Z]+)$/i;
		 	if( this.checked==true && this.id.match(reg)){
		 		id = this.value;	
		 		if(id){
			  	    if(param_code == "") param_code = id;
			 	    else param_code += ":"+id;		  
		 		}
		 	}
		 });
	 	var baseUrl = '/'+projectName+'/workflow/evaluate/acceptdetail/status/A/month/'+mph_month+'/code/'+param_code;
		window.location.href = baseUrl;
 	}else{
 		_alert('Please select data.');
 		return;
 	}
	
	
	//var params = '_output=json&update_mode=1&mval='+mval+'&'+$('#_portal :input',$('#content-container').get(0)).serialize();
 	//var baseUrl = '/'+projectName+'/workflow/evaluate/upincen/';
}
function ChkHead(elm,key){
	var parents = $(elm).parents("table").get(0);
	if(elm.checked == true) {		
		$("#dep_"+key).check();
	}
}
function selectChkSub(elm,key){
	var parents = $(elm).parents("table").get(0);

	if(elm.checked == true) {		
		$('input[@id^=chk_'+key+'\_]').each(function(){
			$(this).check();
		});
	}else{
		$('input[@id^=chk_'+key+'\_]').each(function(){
			$(this).uncheck();
		});		
	}
}

function exportHRSExcel(type) {
	var month = $('#month').val();
	var year = $('#year').val();
	var group = $('#group').val();
	var baseUrl = '/'+projectName+'/workflow/summary/exporttoxls/type/'+type+'/month/'+month+'/year/'+year+'/group/'+group;
		baseUrl += '/format/hr';
		
	window.location.href = baseUrl;
}

function syncCurrentData(type) {
	
	_confirm("Do you want to sync with current data ?",function(){
		var month = $('#month').val();
		var year = $('#year').val();
		var group = $('#group').val();
		var baseUrl = '/'+projectName+'/workflow/summary/incentive/process/sync/type/'+type+'/month/'+month+'/year/'+year+'/group/'+group;
			baseUrl += '/format/hr';
			
		window.location.href = baseUrl;
   	});
	
}
