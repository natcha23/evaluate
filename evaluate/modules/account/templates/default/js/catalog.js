var catForm = {
	Edline : 0,
	Hiline : 0,
	Coline : 0,
	HDeline : 0,
	DDeline : 0,
	Deline : 0,
	Trline : 0,
	handlerSwitch : new Array(),
	img_path : "/office-one2.0/modules/systemapi/templates/default/images"
}
catForm.CheckAddDetail = function(){
	
	if(document.getElementById('code').value==0){
		alert('กรุณากรอกข้อมูลรหัสสินค้า');
		document.getElementById('code').focus();
		return false;
	}else{
		var paramArray = new Array();
		paramArray['code'] = $('#code').val();
		paramArray['name'] = document.getElementById('_name').innerHTML.replace("'","\'");
		paramArray['price'] = document.getElementById('_price').innerHTML.replace(/[\,]/g,'');
		paramArray['unit'] = document.getElementById('_unit').innerHTML;
		
		catForm.AddDetail(paramArray);
		catForm.SumItem();
		
		$('#code').val('');
		$('#_name').html('');
		$('#_price').html('');
		$('#_unit').html('');
		$('#code').focus();
				
	}
}
catForm.AddDetail = function (paramArray){	
	var tr_line=document.createElement("TR");
		tr_line.id = "detail_line_"+catForm.Deline;
		tr_line.className = "rowodd";
		tr_line.setAttribute('height','20');
		tr_line.setAttribute('dir','rtl');
		tr_line.pr_total = paramArray['price']*paramArray['amount'];
	
	var myc=document.createElement("TD");
		myc.setAttribute('align','center');
		input = catForm.AddInput('checkbox','cat['+catForm.Deline+'][check]',paramArray['code'],'','chk_'+catForm.Deline);	
		input.setAttribute('price',''+paramArray['price']);
		myc.appendChild(input);
		tr_line.appendChild(myc);
		
	var myc=document.createElement("TD");
		myc.setAttribute('align','center');
		input = catForm.AddInput('hidden','cat['+catForm.Deline+'][product]',paramArray['code']);
		myc.appendChild(input);
	var span = document.createElement('SPAN');
		span.innerHTML = paramArray['code'];
		myc.appendChild(span);
		tr_line.appendChild(myc);

	var myc=document.createElement("TD");
		myc.setAttribute('align','left');
		input = catForm.AddInput('hidden','cat['+catForm.Deline+'][prod_desc]',paramArray['name']);
		myc.appendChild(input);	
	var span = document.createElement('SPAN');
		span.innerHTML = paramArray['name'];
		myc.appendChild(span);
		tr_line.appendChild(myc);

	var myc=document.createElement("TD");
		myc.setAttribute('align','right');
		input_am = catForm.AddInput('hidden','cat['+catForm.Deline+'][amount]','1');
		myc.appendChild(input_am);
		input_to = catForm.AddInput('hidden','cat['+catForm.Deline+'][price]',paramArray['price']);
		myc.appendChild(input_to);	
		input = catForm.AddInput('hidden','cat['+catForm.Deline+'][price_unit]',paramArray['price']);
		myc.appendChild(input);	
	var span = document.createElement('SPAN');
		span.innerHTML = number_format(paramArray['price'],'2','.',',')+"&nbsp;"
		myc.appendChild(span);
		tr_line.appendChild(myc);
		
	var myc=document.createElement("TD");
		myc.setAttribute('align','center');
		input = catForm.AddInput('hidden','cat['+catForm.Deline+'][unit]',paramArray['unit']);
		myc.appendChild(input);
	var span = document.createElement('SPAN');
		span.innerHTML = paramArray['unit'];
		myc.appendChild(span);
		tr_line.appendChild(myc);
		
		document.getElementById('showProdCatalog').appendChild(tr_line);
		catForm.Deline=catForm.Deline+1;
}
catForm.SumItem = function (){
	var num = 1;		
	var num_item = document.getElementById('num_item').innerHTML.replace(/[\,]/g,'')*1;		
	var total_item = num_item + num *1;	
	document.getElementById('num_item').innerHTML = total_item;
}
catForm.delSumItem = function (num){
	var num_item = document.getElementById('num_item').innerHTML.replace(/[\,]/g,'')*1;		
	var total_item = num_item - num *1;	
	document.getElementById('num_item').innerHTML = total_item;
 }
 function delCatLineMulti(){
 	var param_code = '';
 	var num_item = 0;
 	var item = 1;
 	var chk = '';
 	
 	$(':checkbox',$('#catalog_view').get(0)).each(function() { 
 		var reg = /([0-9a-zA-Z]+)$/i;
 		if( this.checked==true && this.id.match(reg)){   			  
 			chk = '1';   	      	  	     
 		}         		
 	});  
 	if(chk == '1'){
 		if(confirm('คุณยืนยันที่จะลบข้อมูลสินค้าใน Catalog ใช่หรือไม่')){
 			$(':checkbox',$('#catalog_view').get(0)).each(function() { 
 		 		var reg = /([0-9a-zA-Z]+)$/i;
 		 		if( this.checked==true && this.id.match(reg)){   			  
 		 			id=this.id.split("_");   	
 		   	        var data = {
 		  	    		'product' :this.value
 		  	       }    
 		  	     param_code = data.product;	
 		   	     num_item += item * 1;
 		   	     $("#detail_line_"+id[1]).remove();        	      	  	     
 		 		}         		
 		 	});   		 	
 		 	catForm.delSumItem(num_item);
 		}
 	}else{
 		alert('กรุณาเลือกรายการที่ต้องการลบออก');
		return;  
 	}		
 }
catForm.AddInput = function(ttype,tname,tvalue,size,tid){
	var input = document.createElement('INPUT');
		input.type = ttype;
		input.name = tname;
		input.value = tvalue;
		input.id = tid;
	if(size)
		input.size=size;

	return input;
}
catForm.RemoveData = function (lid,rep,body_id){
	var removeid = lid.replace(rep,'');
	if (confirm("Are you sure delete data ?")){
	    document.getElementById(body_id).removeChild(document.getElementById(rep+'line_'+removeid));
	}
}
function ActionCatalog(type){
	var rData='';
	$(':checkbox',$('#catalog_view').get(0)).each(function() { 
 		var reg = /([0-9a-zA-Z]+)$/i;
 		if( this.checked==true && this.id.match(reg)){   			  
 			if(this.id.match(reg)) rData = '1';    	       	           	  	     
 		}         		
 	});  
	if(rData!=''){
		if(type == 'addcart'){
			 var params = '_output=json&'+$('#shopping-view :input',$('#catalog_view').get(0)).serialize();
		     var baseUrl = '/'+projectName+'/products/card/add';
		     AjaxContent.init({
		    	 proxy : baseUrl,
		         container : 'catalog_view',
		         overlay : true,
		         showLoadding: false,
		         htmlTemplate: null
	        });
	        AjaxContent.send(params,function(returnText){
	        	if(returnText){
					eval(returnText);
					alert('เพิ่มสินค้าลงในตระกร้า เรียบร้อยแล้ว');
			        $(':checkbox').uncheck();		        
				}				
			});
		}else if(type == 'quotation'){
			var params = '_output=json&'+$('#shopping-view :input',$('#catalog_view').get(0)).serialize();
			var baseUrl = '/'+projectName+'/products/card/quotation';
		    AjaxContent.init({
		         proxy : baseUrl,
		         container : 'catalog_view',
		         overlay : true,
		         showLoadding: false,
		         htmlTemplate: null
		     });
		    AjaxContent.send(params,function(returnText){
	        	if(returnText){
					eval(returnText);
					var baseUrl = '/'+projectName+'/products/category/quotation/mode/list/';	 		  	
					window.location.href = baseUrl;
				}				
			});
		}	
 	}else alert('คุณยังไม่ได้เลือกรายการสินค้า');return;   	
}
function popupMail(elm,e,id){
	
	//LeftPosition = (screen.width) ? (screen.width-570-8)/2 : 0;
	sumTotalPrice=0;
	var options = {
        'width'   : 300,
        'height'  : 90,
        'border'  :'1px solid #6699CC',
        'left'    : e.clientX,//LeftPosition,
        'top'     : ShopUtils.getposOffset(elm)+$(elm).height(),
        'z-index' : 2,
        'opacity' : 1
    };
	$('#mail-dialog')
    .css(options).slideToggle('slow', function(){
    	//$('#send_mail').val('');
    	$('#close-dialog').css({'background-color':'#000000','opacity':1});        
        $('#send_mail').focus();       
    })
}
function closePopup(){
    $('#mail-dialog').slideToggle('slow');
    $('#send_mail').val('');
}
/*-------check format Email--------*/
function EW_checkemail(id) {
	var object_value = $('#send_mail').val();	
	if (object_value.length == 0){
		alert('กรุณากรอก E-mail ที่ต้องการส่ง');
		$('#send_mail').focus();
		return;
	}
	var mailArr = object_value.split(";");
	var len = mailArr.length
	for(i=0;i<len;i++){		
		if (!(mailArr[i].indexOf("@") > -1 && mailArr[i].indexOf(".") > -1)){
			alert('คุณกรอก Email '+mailArr[i]+' ไม่ถูกรูปแบบ กรุณาตรวจสอบ ');
			$('#send_mail').focus();
			return false;
		}
	}
	MenuCatalog('mail',id);
}
/*--------end check Wmail---------*/
function MenuCatalog(type,id){
	if(type =='mail'){		
		var params = '_output=json&type=catalog&catId='+id+'&'+$('#send_mail').serialize();
	    var baseUrl = '/'+projectName+'/products/card/sendmail';
	    AjaxContent.init({
	        proxy : baseUrl,
	        container : 'mail-dialog',
	        overlay : true,
	        showLoadding: false,
	        htmlTemplate: null
	    });
	    AjaxContent.send(params,function(returnText){
	      	 if(returnText){
	      		eval(returnText);	      		
	      		alert("ทำการส่ง Mail เรียบร้อยแล้ว");
	      		closePopup();
	      	 }			
	   	});
	}else if(type =='duplicate'){		 				 
		recordCatalog_ajax('new','saveas');			
	}else if(type =='photo'){		
		showPopup(id,'print_photo');				
	}else if(type =='table'){
		showPopup(id,'print_table');
	}
}
function showPopup(id,page){
	var baseUrl = '/'+projectName+'/products/category/catprint/id/'+id+'/show/'+page;
 	var LeftPosition = (screen.width-730)/2 ;
 	var TopPosition =  50 ; 		  	
  	myWinName = window.open(baseUrl,'frmview','status=1,menubar=0,scrollbars=yes,resizable=0,width=730,height=600,left='+LeftPosition+',top='+TopPosition);  		
  	if (parseInt(navigator.appVersion) >= 4) {
		myWinName.window.focus();
	}
	return myWinName;
}
	function delCatalog(){
	 	var param_code = '';
	 	var chk = '';
	 	$(':checkbox',$('#catalog').get(0)).each(function() { 
	 		var reg = /([0-9a-zA-Z]+)$/i;
	 		if( this.checked==true && this.id.match(reg)){   			  
	  	        chk = '1';	  	         	      	  	     
	 		}         		
	 	});  
	 	if(chk =='1'){
	 		if(confirm('คุณยืนยันที่จะลบข้อมูลรายการ Catalog ใช่หรือไม่')){
		 		$(':checkbox',$('#catalog').get(0)).each(function() { 
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
		 		
		 		jsDelCatalog(param_code);
	 		}
	 	}else{
	 		alert('กรุณาเลือกรายการ Catalog ที่ต้องการลบออก');
	 		return; 
	 	}
	 	
	 		
		
	 }
 function jsDelCatalog(param_code){
	 var params ='_output=json&delID='+param_code;
		var baseUrl = '/'+projectName+'/products/card/delcat';
		AjaxContent.init({
	        proxy : baseUrl,
	        container : 'catalog',
	        overlay : true,
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
 function findProductCat(elm){   
	    if(elm.value){    
			var params ='_output=json&prod='+elm.value;
			var baseUrl = '/'+projectName+'/products/card/findprod';
			AjaxContent.init({
			     proxy : baseUrl,
			     container : 'catalog_view',
			     overlay : true,
			     showLoadding: false,
			     htmlTemplate: null
			});
			AjaxContent.send(params,function(returnText){
				if(returnText){
					eval(returnText);
				}else{
					alert('ไม่มีสินค้ารายการนี้ในระบบ กรุณากรอกใหม่');
					$('#code').val('');
					$('#amount').val('');
					$('#_name').html('');
					$('#_price').html('');
					$('#_unit').html('');
					$('#code').focus();
				}
				
			});
	    }else return false;
	 }
function showCatalog(cat,mode){	 
	var num = $('#count_item').val();
	if(cat){
		 var baseUrl = '/'+projectName+'/products/category/catalog/catId/'+cat+'/mode/'+mode;	 		  	
		 window.location.href = baseUrl;
	 }else{	 
		 if(count_item < valC || num < valC){
			 var baseUrl = '/'+projectName+'/products/category/catalog/catId/'+cat+'/mode/'+mode;	 		  	
			 window.location.href = baseUrl;
		 }else{
			 alert('รายการ Catalog ของคุณเกินกว่าที่กำหนด ไม่สามารถสร้างรายการใหม่ได้ ');
			 return;
		 }
	 }
 }
function recordCatalog_ajax(act,type){
	$('#mode').val('view');
	if(count_item < valC){
		if(type =='save'){			
			if(confirm('กรุณาตรวจสอบข้อมูลรายการ Catalog ก่อนทำบันทึก')){
			 	$('#action_mode').val(act);
			 	$('#type_mode').val('Save');
				var params = '_output=json&'+$('#_detail :input',$('#catalog_view').get(0)).serialize();
			    var baseUrl = '/'+projectName+'/products/category/savecatalog';
			    AjaxContent.init({
			        proxy : baseUrl,
			        container : 'catalog_view',
			        overlay : true,
			        showLoadding: false,
			        htmlTemplate: null
			    });
			    AjaxContent.send(params,function(returnText){
			      	 if(returnText){
			      		eval(returnText);
			      		alert("ทำการบันทึกข้อมูล catalog เรียบร้อยแล้ว");	
			      		var baseUrl = '/'+projectName+'/products/category/catalog/catId/'+data+'/mode/detail';	 		  	
			      		window.location.href = baseUrl;
			      	 }			
			   	});
			}
		}else{
			if(confirm('คุณกำลังทำการคัดลอกข้อมูล Catalog นี้')){	
				 $('#action_mode').val(act);
				 $('#type_mode').val('Save');
				 $('#save_as').val('1');
				 var params = '_output=json&'+$('#_detail :input',$('#catalog_view').get(0)).serialize();
				 var baseUrl = '/'+projectName+'/products/category/savecatalog';
				 AjaxContent.init({
					 proxy : baseUrl,
				     container : 'catalog_view',
				     overlay : true,
				     showLoadding: false,
				     htmlTemplate: null
				 });
				 AjaxContent.send(params,function(returnText){
				   if(returnText){
				      eval(returnText);
				      alert("ทำการคัดลอกข้อมูล catalog เรียบร้อยแล้ว ");	
				      var baseUrl = '/'+projectName+'/products/category/catalog/catId/'+data+'/mode/detail';	 	 		  	
				      window.location.href = baseUrl;
				   }			
				});
			}
		}
	}else{
		if(act =='new'){
			alert('รายการ Catalog ของคุณเกินกว่าที่กำหนด ไม่สามารถสร้างรายการใหม่ได้ ');
			return;
		}else{
			$('#action_mode').val(act);
		 	$('#type_mode').val('Save');
			var params = '_output=json&'+$('#_detail :input',$('#catalog_view').get(0)).serialize();
		    var baseUrl = '/'+projectName+'/products/category/savecatalog';
		    AjaxContent.init({
		        proxy : baseUrl,
		        container : 'catalog_view',
		        overlay : true,
		        showLoadding: false,
		        htmlTemplate: null
		    });
		    AjaxContent.send(params,function(returnText){
		      	 if(returnText){
		      		eval(returnText);
		      		alert("ทำการบันทึกข้อมูล catalog เรียบร้อยแล้ว");	
		      		var baseUrl = '/'+projectName+'/products/category/catalog/catId/'+data+'/mode/detail';	 		  	
		      		window.location.href = baseUrl;
		      	 }			
		   	});
		}
		
	}
    
}

function recordCatalog(act){
 	$('#mode').val('view');
 	if($('#mch_name').val() ==''){
 		alert('กรุณากรอกชื่อ Catalog');
 		$('#mch_name').focus();
 		return;
 	}else{	
		if(confirm('กรุณาตรวจสอบข้อมูลรายการ Catalog ก่อนทำบันทึก')){
		 	$('#action_mode').val(act);
		 	$('#type_mode').val('Save');
		 	document.forms[0].submit();
		 } 	
 	}
}