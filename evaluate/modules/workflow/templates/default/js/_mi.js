var miForm = {
	Edline : 0,
	Hiline : 0,
	Coline : 0,
	HDeline : 0,
	DDeline : 0,
	Deline : 0,
	Trline : 0,
	handlerSwitch : new Array(),
	img_path : IMG_URL
}

miForm.checkDataLine = function(){
	if(document.getElementById('subject').value==0){
		alert('Please input Subject.');
		document.getElementById('subject').focus();
		return false;
	}else{
		var paramArray = new Array();
		paramArray['id'] = '';
		paramArray['subject'] = document.getElementById('subject').value.replace("'","\'");
		paramArray['wscoll'] = $('#wscoll').val();
		paramArray['status'] = $('#status').val();
		paramArray['rscoll'] = $('#rscoll').val();
		paramArray['tscoll'] = $('#wscoll').val() * $('#rscoll').val();
		paramArray['loopCol'] = $('#loopCol').val();

		miForm.AddLine(paramArray);
		miForm.SummaryTotal(paramArray);

		document.getElementById('subject').value='';
		document.getElementById('wscoll').value='';
		document.getElementById('rscoll').value='';

	}
}
miForm.SummaryTotal = function (paramArray){
	var total1 = document.getElementById('weight').innerHTML.replace(/[\,]/g,'')*1;
	if(paramArray['status'] != 'F' && paramArray['status'] != 'R'){
		var total3 = document.getElementById('point').innerHTML.replace(/[\,]/g,'')*1;
		var sum_total3 = total3 + paramArray['rscoll']*1;
	}
	var total4 = document.getElementById('point_total').innerHTML.replace(/[\,]/g,'')*1;

	var sum_total1 = total1 + paramArray['wscoll']*1;
	var sum_total4 = total4 + paramArray['tscoll']*1;

	document.getElementById('weight').innerHTML = number_format(sum_total1,'0','.',',');
	document.getElementById('point_total').innerHTML = number_format(sum_total4,'0','.',',');
}
miForm.DelSummaryTotal = function (wscoll,fscoll,rscoll,tscoll){
	var total1 = document.getElementById('weight').innerHTML.replace(/[\,]/g,'')*1;
	var total3 = document.getElementById('point').innerHTML.replace(/[\,]/g,'')*1;
	var total4 = document.getElementById('point_total').innerHTML.replace(/[\,]/g,'')*1;

	var sum_total1 = total1 - wscoll * 1;
	var sum_total3 = total3 - rscoll * 1;
	var sum_total4 = total4 - tscoll * 1;

	document.getElementById('weight').innerHTML = number_format(sum_total1,'0','.',',');
	document.getElementById('point_total').innerHTML = number_format(sum_total4,'0','.',',');
}
miForm.AddLine = function (paramArray){
	eval('var json_data='+paramArray['JSON']+'; ');

	var tr_line=document.createElement("TR");
		tr_line.id = "detail_line_"+miForm.Deline;
		tr_line.className = "color_line";
		tr_line.setAttribute('height','20');
		tr_line.wscoll = paramArray['wscoll'];
		tr_line.rscoll = paramArray['rscoll'];
		tr_line.tscoll = paramArray['wscoll'] * paramArray['rscoll'];

	var myc=document.createElement("TD");
		myc.setAttribute('align','left');
		myc.className = "font12";
		input1 = miForm.AddInput('hidden','detail['+miForm.Deline+'][mpl_id]',paramArray['id']);
		myc.appendChild(input1);
		if(paramArray['status'] == 'C' || paramArray['change']){
			input = miForm.AddInput('text','detail['+miForm.Deline+'][mpl_subject]',paramArray['subject'],'50');
			myc.appendChild(input);
		}else{
		input = miForm.AddInput('hidden','detail['+miForm.Deline+'][mpl_subject]',paramArray['subject'],'50');
			myc.appendChild(input);
		var span = document.createElement('SPAN');
			span.innerHTML = "&nbsp;"+paramArray['subject'];
			myc.appendChild(span);
		}
		tr_line.appendChild(myc);
	if(paramArray['status'] == 'C' || paramArray['change']){
		var myc=document.createElement("TD");
			myc.setAttribute('align','center');
			input = miForm.AddInput('text','detail['+miForm.Deline+'][mpl_weight]',paramArray['wscoll'],'5','w_'+miForm.Deline);
			input.onblur= function (){
				miForm._sumText(this,'weight');
			};
			myc.appendChild(input);
			tr_line.appendChild(myc);
	}else{
		var myc=document.createElement("TD");
			myc.setAttribute('align','center');
			input = miForm.AddInput('hidden','detail['+miForm.Deline+'][mpl_weight]',paramArray['wscoll'],'5','w_'+miForm.Deline);
			myc.appendChild(input);
			var span = document.createElement('SPAN');
			span.innerHTML = number_format(paramArray['wscoll'],'0','.',',');
			myc.appendChild(span);
			tr_line.appendChild(myc);
	}
	if(json_data){
		for(key in json_data){
			if(!json_data[key]['sl_id'])continue;
			var myc=document.createElement("TD");
				myc.setAttribute('align','center');
				myc.setAttribute('width','8%');
			var span = document.createElement('SPAN');
				span.innerHTML = number_format(json_data[key]['sl_point'],'0','.',',');
				myc.appendChild(span);
				tr_line.appendChild(myc);
		}
	}else{
		var i = 0;
		for(i;i<paramArray['loopCol'];i++){
			var myc=document.createElement("TD");
				myc.setAttribute('align','center');
				myc.setAttribute('width','8%');
			var span = document.createElement('SPAN');
				span.innerHTML = '';
				myc.appendChild(span);
				tr_line.appendChild(myc);
		}
	}
	if(paramArray['status'] != 'F' && paramArray['status'] != 'R'){
	if(paramArray['status'] == 'C'){
		var myc=document.createElement("TD");
			myc.setAttribute('align','center');
			input = miForm.AddInput('hidden','detail['+miForm.Deline+'][mpl_point]',paramArray['rscoll'],'5','p_'+miForm.Deline);
			myc.appendChild(input);
			var span = document.createElement('SPAN');
			span.innerHTML = number_format(paramArray['rscoll'],'0','.',',');
			myc.appendChild(span);
			tr_line.appendChild(myc);
	}else{
		var myc=document.createElement("TD");
			myc.setAttribute('align','center');
			input = miForm.AddInput('text','detail['+miForm.Deline+'][mpl_point]',paramArray['rscoll'],'5','p_'+miForm.Deline);
			input.onblur= function (){
				if(this.value > 10){
					alert('You input point more than 10,Please check again.');
					this.value = 0;
				}
				miForm._sumText(this,'point');
			};
			myc.appendChild(input);
			tr_line.appendChild(myc);
	}
	}
	var myc=document.createElement("TD");
		myc.setAttribute('align','center');
	var span = document.createElement('SPAN');
		span.id = "t_"+miForm.Deline;
		span.innerHTML = number_format(paramArray['tscoll'],'0','.',',');
		myc.appendChild(span);
		tr_line.appendChild(myc);

	var myc=document.createElement("TD");
		myc.setAttribute('align','center');
	if(paramArray['status'] == 'C' || paramArray['change']){
	var actionImg = document.createElement('IMG');
		actionImg.src=miForm.img_path+"/deletep.gif";
		actionImg.style.cursor="pointer";
		actionImg.id   ="detail_"+miForm.Deline;
		actionImg.onclick= function (){
			miForm.RemoveData(this.id,'detail_','showTab1');
			miForm.DelSummaryTotal(tr_line.wscoll,tr_line.fscoll,tr_line.rscoll,tr_line.tscoll);
		};
		myc.appendChild(actionImg);
	}
		tr_line.appendChild(myc);

		document.getElementById('showTab1').appendChild(tr_line);
		miForm.Deline=miForm.Deline+1;
}
miForm._sumText = function (elm,type){
	var weight1 = 0;
	var ctn = $('#table_list',$('#content-container').get(0));
	$('input[@id^=w\_]').each(function(){
		weight1 += $(this).val().replace(/[\,]/g,'')*1;
	});
	document.getElementById('weight').innerHTML = weight1;

	var kline = elm.id.substr(2);
	var params = '_output=json&'+$('#_mifrm :input',$('#content-container').get(0)).serialize();
	var baseUrl = '/'+projectName+'/workflow/evaluate/caldatami/';
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
      		var sum_total ;
      		var weight = document.getElementById('w_'+kline).value.replace(/[\,]/g,'')*1;
      		var piont = document.getElementById('p_'+kline).value.replace(/[\,]/g,'')*1;
			sum_total = weight * piont;
      		document.getElementById('t_'+kline).innerHTML = sum_total;
       	 }
   	});
 }
miForm.AddInput = function(ttype,tname,tvalue,size,tid){
	var input = document.createElement('INPUT');
		input.type = ttype;
		input.name = tname;
		input.value = tvalue;
		input.id = tid;
	if(size)
		input.size=size;

	return input;
}
miForm.RemoveData = function (lid,rep,body_id){//now2
	var removeid = lid.replace(rep,'');
	if (confirm("Are you sure delete data ?")){
	    document.getElementById(body_id).removeChild(document.getElementById(rep+'line_'+removeid));
	}
}