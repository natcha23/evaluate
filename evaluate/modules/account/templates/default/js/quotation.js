var quoForm = {
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
quoForm.CheckAddDetail = function(){
	
	if(document.getElementById('code').value==0){
		alert('กรุณากรอกข้อมูลรหัสสินค้า');
		document.getElementById('code').focus();
		return false;
	}else if(document.getElementById('amount').value==0){
		alert('กรุณากรอกข้อมูลจำนวนสินค้า');
		document.getElementById('amount').focus();
		return false;
	}else{
		var paramArray = new Array();
		paramArray['code'] = $('#code').val();
		paramArray['amount'] = $('#amount').val();
		paramArray['name'] = document.getElementById('_name').innerHTML.replace("'","\'");
		paramArray['price'] = document.getElementById('_price').innerHTML.replace(/[\,]/g,'');
		paramArray['unit'] = document.getElementById('_unit').innerHTML;
		
		quoForm.AddDetail(paramArray);
		quoForm.SummaryTotal(paramArray);
		
		$('#code').val('');
		$('#amount').val('');
		$('#_name').html('');
		$('#_price').html('');
		$('#_unit').html('');
		$('#code').focus();
				
	}
}
quoForm.AddDetail = function (paramArray){
	
	var tr_line=document.createElement("TR");
		tr_line.id = "detail_line_"+quoForm.Deline;
		tr_line.className = "rowodd";
		tr_line.setAttribute('height','20');
		tr_line.setAttribute('dir','rtl');
		tr_line.pr_total = paramArray['price']*paramArray['amount'];
	
	var myc=document.createElement("TD");
		myc.setAttribute('align','center');
		input = quoForm.AddInput('checkbox','quo['+quoForm.Deline+'][check]',paramArray['code'],'','chk_'+quoForm.Deline);	
		input.setAttribute('price',''+paramArray['price']);
		myc.appendChild(input);
		tr_line.appendChild(myc);
		
	var myc=document.createElement("TD");
		myc.setAttribute('align','center');
		input = quoForm.AddInput('hidden','quo['+quoForm.Deline+'][product]',paramArray['code']);
		myc.appendChild(input);
	var span = document.createElement('SPAN');
		span.innerHTML = paramArray['code'];
		myc.appendChild(span);
		tr_line.appendChild(myc);

	var myc=document.createElement("TD");
		myc.setAttribute('align','left');
		input = quoForm.AddInput('hidden','quo['+quoForm.Deline+'][prod_desc]',paramArray['name']);
		myc.appendChild(input);	
	var span = document.createElement('SPAN');
		span.innerHTML = paramArray['name'];
		myc.appendChild(span);
		tr_line.appendChild(myc);

	var myc=document.createElement("TD");
		myc.setAttribute('align','right');
		input = quoForm.AddInput('hidden','quo['+quoForm.Deline+'][price_unit]',paramArray['price']);
		myc.appendChild(input);	
	var span = document.createElement('SPAN');
		span.innerHTML = number_format(paramArray['price'],'2','.',',');
		myc.appendChild(span);
		tr_line.appendChild(myc);

	var myc=document.createElement("TD");
		myc.setAttribute('align','center');
		input = quoForm.AddInput('text','quo['+quoForm.Deline+'][amount]',paramArray['amount'],'5','n_'+quoForm.Deline);		
		input.onkeyup = function (){			
			isNumber(this);				
		};
		myc.appendChild(input);
		tr_line.appendChild(myc);
		
	var myc=document.createElement("TD");
		myc.setAttribute('align','right');
		input = quoForm.AddInput('hidden','quo['+quoForm.Deline+'][unit]',paramArray['unit']);
		myc.appendChild(input);
	var span = document.createElement('SPAN');
		span.innerHTML = paramArray['unit'];
		myc.appendChild(span);
		tr_line.appendChild(myc);
	
	var myc=document.createElement("TD");
		myc.setAttribute('align','right');
		input = quoForm.AddInput('hidden','quo['+quoForm.Deline+'][price]',paramArray['price'] * paramArray['amount'],'','t_'+quoForm.Deline);
		myc.appendChild(input);
	var span = document.createElement('SPAN');
		span.innerHTML = number_format(paramArray['price']*paramArray['amount'],'2','.',',')+"&nbsp;";
		span.setAttribute('id','span_t_'+quoForm.Deline);
		myc.appendChild(span);
		tr_line.appendChild(myc);
		
	/*var myc=document.createElement("TD");
		myc.setAttribute('align','center');
	var actionImg = document.createElement('IMG');
		actionImg.src=quoForm.img_path+"/deletep.gif";
		actionImg.style.cursor="pointer";
		actionImg.id   ="detail_"+quoForm.Deline;
		actionImg.onclick= function (){
			quoForm.RemoveData(this.id,'detail_','showProduct');	
			quoForm.DelSummaryTotal(tr_pr_total);
		};
		myc.appendChild(actionImg);
		tr_line.appendChild(myc);
		*/
		document.getElementById('showProduct').appendChild(tr_line);
		quoForm.Deline=quoForm.Deline+1;
}
quoForm.SummaryTotal = function (paramArray){
	var sumTotalPrice = document.getElementById('sumT').innerHTML.replace(/[\,]/g,'')*1;	
	var sumLine = paramArray['price']*paramArray['amount'];
	
	var sum_total = sumTotalPrice + sumLine *1;
	var sumVat = sum_total*VAT/100;
 	var sumAll = ((sum_total*1)+(sumVat*1));
	
	document.getElementById('sumT').innerHTML = number_format(sum_total,'2','.',',');
	document.getElementById('sumV').innerHTML = number_format(sumVat,'2','.',',');
	document.getElementById('sumA').innerHTML = number_format(sumAll,'2','.',',');
}
quoForm.DelSummaryTotal = function (val){
	var sumTotalPrice = document.getElementById('sumT').innerHTML.replace(/[\,]/g,'')*1;	
	
	var sum_total = sumTotalPrice - val *1;
	var sumVat = sum_total*VAT/100;
 	var sumAll = ((sum_total*1)+(sumVat*1));
				
	document.getElementById('sumT').innerHTML = number_format(sum_total,'2','.',',');
	document.getElementById('sumV').innerHTML = number_format(sumVat,'2','.',',');
	document.getElementById('sumA').innerHTML = number_format(sumAll,'2','.',',');	
}
quoForm.setNewTotal = function (val){
	var sumTotalPrice = val * 1;	
	
	var sum_total = sumTotalPrice ;
	var sumVat = sum_total*VAT/100;
 	var sumAll = ((sum_total*1)+(sumVat*1));
				
	document.getElementById('sumT').innerHTML = number_format(sum_total,'2','.',',');
	document.getElementById('sumV').innerHTML = number_format(sumVat,'2','.',',');
	document.getElementById('sumA').innerHTML = number_format(sumAll,'2','.',',');	
}
quoForm.AddInput = function(ttype,tname,tvalue,size,tid){
	var input = document.createElement('INPUT');
		input.type = ttype;
		input.name = tname;
		input.value = tvalue;
		input.id = tid;
	if(size)
		input.size=size;

	return input;
}
quoForm.RemoveData = function (lid,rep,body_id){
	var removeid = lid.replace(rep,'');
	if (confirm("Are you sure delete data ?")){
	    document.getElementById(body_id).removeChild(document.getElementById(rep+'line_'+removeid));
	}
}
function recordQuotation(act,quo_id){
 	$('#mode').val('view');
	if(confirm('กรุณาตรวจสอบข้อมูลใบเสนอราคา ก่อนทำใบเสนอราคา')){
	 	$('#action_mode').val(act);
	 	$('#type_mode').val('Save');
	 	document.forms[0].submit();
	 } 	
}
function jsViewPrint(quoid){
	var baseUrl = '/'+projectName+'/products/category/print/quoId/'+quoid; 		  	
  	myWinName = window.open(baseUrl,'_print','status=1,menubar=0,scrollbars=yes,resizable=0,width='+screen.width+',height='+screen.height+',left=0,top=0');  		
  	if (parseInt(navigator.appVersion) >= 4) {
		myWinName.window.focus();
	}
	return myWinName; 	
}