var piForm = {
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
piForm.checkDataLine = function(){
	if(document.getElementById('subject').value==0){
		alert('Please input subject.');
		document.getElementById('subject').focus();
		return false;
	}else{
		var paramArray = new Array();
		paramArray['id'] = '';
		paramArray['type'] = 'S';
		paramArray['disabled'] = 'N';
		paramArray['subject'] = document.getElementById('subject').value.replace("'","\'");
		paramArray['wscoll'] = document.getElementById('wscoll').value;
		paramArray['status'] = document.getElementById('status').value;
		piForm.AddSubject(paramArray);
		piForm.AddTBODY(paramArray);
		piForm.AddText(paramArray);

		document.getElementById('subject').value='';
		document.getElementById('wscoll').value='';
	}
}
piForm.AddTBODY = function (paramArray){
	var tr_line=document.createElement("DIV");
	    tr_line.id = "TBODYdetailT1_"+piForm.HDeline;
		document.getElementById('showTab1').appendChild(tr_line);
}
piForm.AddSubject = function (paramArray){

	var tr_line=document.createElement("TR");
		tr_line.id = "head_line_"+piForm.HDeline;
		tr_line.className = "color_head";
		tr_line.setAttribute('height','20');
	var myc=document.createElement("TD");
		myc.setAttribute('align','left');
		input1 = piForm.AddInput('hidden','detail['+piForm.HDeline+'][mpl_id]',paramArray['id']);
		input2 = piForm.AddInput('hidden','detail['+piForm.HDeline+'][mpl_type]',paramArray['type']);
		input = piForm.AddInput('hidden','detail['+piForm.HDeline+'][mpl_subject]',paramArray['subject']);
		myc.appendChild(input1);
		myc.appendChild(input2);
		myc.appendChild(input);
	var span = document.createElement('SPAN');
		span.innerHTML = "&nbsp;"+paramArray['subject'];
		myc.appendChild(span);
		tr_line.appendChild(myc);

	var myc=document.createElement("TD");
		myc.setAttribute('align','center');
		if(paramArray['status'] =='C'){
			input = piForm.AddInput('text','detail['+piForm.HDeline+'][mpl_weight]',paramArray['wscoll'],'5');
			if(paramArray['wscoll'] !=0 && !paramArray['disabled']){input.readOnly=true;}
			myc.appendChild(input);
			tr_line.appendChild(myc);
		}else{
			input = piForm.AddInput('hidden','detail['+piForm.HDeline+'][mpl_weight]',paramArray['wscoll'],'5');
			myc.appendChild(input);
			var span = document.createElement('SPAN');
			span.innerHTML = paramArray['wscoll'];
			myc.appendChild(span);
			tr_line.appendChild(myc);
		}

		if(paramArray['column']){
			var i = 0;
			for(i;i<paramArray['column'];i++){
				var myc=document.createElement("TD");
					myc.setAttribute('align','center');
				var span = document.createElement('SPAN');
					span.innerHTML = '';
					myc.appendChild(span);
					tr_line.appendChild(myc);
			}
		}
	if(paramArray['status'] != 'F' && paramArray['status'] != 'R'){
	var myc=document.createElement("TD");
		myc.setAttribute('align','center');
		tr_line.appendChild(myc);
	}
	var myc=document.createElement("TD");
		myc.setAttribute('align','center');
		tr_line.appendChild(myc);

	if(paramArray['status'] == 'C' || paramArray['change']){
		var myc=document.createElement("TD");
			myc.setAttribute('align','center');
		if(paramArray['disabled']){
		var actionImg = document.createElement('IMG');
			actionImg.src = piForm.img_path+"/deletep.gif";
			actionImg.style.cursor="pointer";
			actionImg.id   ="head_"+piForm.HDeline;
			actionImg.onclick= function (){
				piForm.RemoveData(this.id,'head_','showTab1');
			};
			myc.appendChild(actionImg);
		}
			tr_line.appendChild(myc);
	}

		document.getElementById('showTab1').appendChild(tr_line);

}
piForm.AddText = function (paramArray){
	var tr_line=document.createElement("TR");
		tr_line.id = "detail_line_"+piForm.HDeline;
		tr_line.className = "rowodd";
		tr_line.setAttribute('height','20');

	var myc=document.createElement("TD");
		myc.setAttribute('align','center');
		if(paramArray['status'] == 'C' || paramArray['change']){
			input = piForm.AddInput('text','txt['+piForm.HDeline+'][subject]','','50','subject_'+piForm.HDeline);
		}else{
			input = piForm.AddInput('hidden','txt['+piForm.HDeline+'][subject]','','50','subject_'+piForm.HDeline);
		}

		myc.appendChild(input);
		tr_line.appendChild(myc);

	var myc=document.createElement("TD");
		myc.setAttribute('align','center');
		if(paramArray['status'] == 'C' || paramArray['change']){
			input = piForm.AddInput('text','txt['+piForm.HDeline+'][wscoll]','','5','wscoll_'+piForm.HDeline);
		}else{
			input = piForm.AddInput('hidden','txt['+piForm.HDeline+'][wscoll]','','5','wscoll_'+piForm.HDeline);
		}
		myc.appendChild(input);
		tr_line.appendChild(myc);
	if(paramArray['status'] != 'F' && paramArray['status'] != 'R'){
	var myc=document.createElement("TD");
		myc.setAttribute('align','center');
		if(paramArray['status'] == 'C' || paramArray['change']){
		input = piForm.AddInput('hidden','txt['+piForm.HDeline+'][rscoll]','','5','rscoll_'+piForm.HDeline);
		}else{
		input = piForm.AddInput('hidden','txt['+piForm.HDeline+'][rscoll]','','5','rscoll_'+piForm.HDeline);
		}
		myc.appendChild(input);
		tr_line.appendChild(myc);
	}
	var myc=document.createElement("TD");
		myc.setAttribute('align','center');
	var span = document.createElement('SPAN');
		span.innerHTML = '';
		myc.appendChild(span);
		tr_line.appendChild(myc);

	if(paramArray['status'] == 'C' || paramArray['change']){
	var myc=document.createElement("TD");
		myc.setAttribute('align','center');
	var actionImg = document.createElement('IMG');
		actionImg.src = piForm.img_path+"/add.gif";
		actionImg.style.cursor = "pointer";
		actionImg.id = "imgadd_"+piForm.HDeline;
		actionImg.onclick= function (){
			piForm.CheckAddDetail(this.id);
		};

		myc.appendChild(actionImg);
		tr_line.appendChild(myc);
	}
		document.getElementById('showTab1').appendChild(tr_line);
		piForm.HDeline=piForm.HDeline+1;
}


piForm.CheckAddDetail = function(id){
	var ids = id.replace('imgadd_','');
	if(document.getElementById('subject_'+ids).value==0){
		alert('Please input subject.');
		document.getElementById('subject_'+ids).focus();
		return false;
	}else{
		var paramArray = new Array();

		paramArray['id'] = '';
		paramArray['type'] = 'D';
		paramArray['disabled'] = 'N';
		paramArray['fix'] = 'N';
		paramArray['change'] = document.getElementById('change').value;
		paramArray['subject'] = document.getElementById('subject_'+ids).value.replace("'","\'");
		paramArray['wscoll'] = document.getElementById('wscoll_'+ids).value;
		paramArray['rscoll'] = document.getElementById('rscoll_'+ids).value;
		paramArray['tscoll'] = document.getElementById('wscoll_'+ids).value * document.getElementById('rscoll_'+ids).value;
		paramArray['status'] = document.getElementById('status').value;
		piForm.AddDetailPI(paramArray,ids);
		piForm.SummaryTotal(paramArray,ids);

		document.getElementById('subject_'+ids).value='';
		document.getElementById('wscoll_'+ids).value='';
		document.getElementById('rscoll_'+ids).value='';

	}
}
piForm.AddDetailPI = function (paramArray,tbody_id){
	eval('var json_data='+paramArray['JSON']+'; ');
	var tr_line=document.createElement("TR");
		tr_line.id = "detail1_line_"+piForm.DDeline;
		tr_line.setAttribute('height','20');
		tr_line.wscoll = paramArray['wscoll'];
		tr_line.rscoll = paramArray['rscoll'];
		tr_line.tscoll = number_format(paramArray['wscoll'] * paramArray['rscoll'],'2','.',',');

	var myc=document.createElement("TD");
		myc.setAttribute('align','left');
		input1 = piForm.AddInput('hidden','detail['+tbody_id+'][line]['+piForm.DDeline+'][mpl_id]',paramArray['id']);
		input2 = piForm.AddInput('hidden','detail['+tbody_id+'][line]['+piForm.DDeline+'][mpl_type]',paramArray['type']);
		myc.appendChild(input1);
		myc.appendChild(input2);
		if(paramArray['status'] == 'C' || paramArray['change']=='1'){
			if(paramArray['fix'] == 'F'){
				input =  piForm.AddInput('hidden','detail['+tbody_id+'][line]['+piForm.DDeline+'][mpl_subject]',paramArray['subject'],'50');
				myc.appendChild(input);
				var span = document.createElement('SPAN');
				span.innerHTML = "<DD>"+paramArray['subject'];
				myc.appendChild(span);
			}else{
				input =  piForm.AddInput('text','detail['+tbody_id+'][line]['+piForm.DDeline+'][mpl_subject]',paramArray['subject'],'50');
				myc.appendChild(input);
			}

		}else{
			input =  piForm.AddInput('hidden','detail['+tbody_id+'][line]['+piForm.DDeline+'][mpl_subject]',paramArray['subject'],'50');
			myc.appendChild(input);
			var span = document.createElement('SPAN');
			span.innerHTML = "<DD>"+paramArray['subject'];
			myc.appendChild(span);
		}
		tr_line.appendChild(myc);

		var myc=document.createElement("TD");
			myc.setAttribute('align','center');
			myc.setAttribute('width','8%');
			if(paramArray['status'] == 'C' || paramArray['change']){
				input = piForm.AddInput('text','detail['+tbody_id+'][line]['+piForm.DDeline+'][mpl_weight]',paramArray['wscoll'],'5','w_'+piForm.DDeline);
				if(paramArray['wscoll'] !=0 && (!paramArray['disabled'] && paramArray['fix'] == 'F')){
				input.readOnly=true;
				}
				input.onblur= function (){
					piForm._sumText(this,'weight');
				};
				myc.appendChild(input);
			}else{
				input = piForm.AddInput('hidden','detail['+tbody_id+'][line]['+piForm.DDeline+'][mpl_weight]',paramArray['wscoll'],'5','w_'+piForm.DDeline);
				myc.appendChild(input);
				var span = document.createElement('SPAN');
				span.innerHTML = number_format(paramArray['wscoll'],'0','.',',');
				myc.appendChild(span);
			}
			tr_line.appendChild(myc);

		if(json_data){
			for(key in json_data){
				if(!json_data[key]['sl_id'])continue;
				var myc=document.createElement("TD");
					myc.setAttribute('align','center');
					myc.setAttribute('width','8%');
				var span = document.createElement('SPAN');
					span.innerHTML = number_format(json_data[key]['sl_point'],'2','.',',');
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
					span.innerHTML = number_format('0','2','.',',');
					myc.appendChild(span);
					tr_line.appendChild(myc);
			}
		}
	if(paramArray['status'] != 'F' && paramArray['status'] != 'R'){
	var myc=document.createElement("TD");
		myc.setAttribute('align','center');
		myc.setAttribute('width','8%');
		if(paramArray['status'] == 'C'){
			input = piForm.AddInput('hidden','detail['+tbody_id+'][line]['+piForm.DDeline+'][mpl_point]','','5','p_'+piForm.DDeline);
		}else{
			input = piForm.AddInput('text','detail['+tbody_id+'][line]['+piForm.DDeline+'][mpl_point]',paramArray['rscoll'],'5','p_'+piForm.DDeline);
		}
		input.onblur= function (){
			if(this.value > 10){
				alert('You input point more than 10,Please check again.');
				this.value = 0;
			}
			piForm._sumText(this,'point');
		};
		myc.appendChild(input);
		/*if(stpage == 'W'){
			var span = document.createElement('SPAN');
				span.innerHTML = number_format(paramArray['rscoll'],'2','.',',');
				myc.appendChild(span);
		}*/
		tr_line.appendChild(myc);
	}
	var myc=document.createElement("TD");
		myc.setAttribute('align','center');
		myc.setAttribute('width','8%');
	var span = document.createElement('SPAN');
		span.id = "t_"+piForm.DDeline;
		if(paramArray['status'] != 'C'){
		span.innerHTML = number_format(paramArray['wscoll']*paramArray['rscoll'],'2','.',',');
		}
		myc.appendChild(span);
		tr_line.appendChild(myc);

	if(paramArray['status'] == 'C' || paramArray['change']){
	var myc=document.createElement("TD");
		myc.setAttribute('align','center');
		myc.setAttribute('width','5%');
	if(paramArray['fix'] != 'F' || paramArray['change']){
	var actionImg = document.createElement('IMG');
		actionImg.src=piForm.img_path+"/deletep.gif";
		actionImg.style.cursor="pointer";
		actionImg.id   ="detail1_"+piForm.DDeline;
		actionImg.onclick= function (){
			piForm.RemoveData(this.id,'detail1_','TBODYdetailT1_'+tbody_id);
			piForm.DelSummaryTotal(tr_line.wscoll,tr_line.rscoll,tr_line.tscoll);
		};
		myc.appendChild(actionImg);
	}
		tr_line.appendChild(myc);
	}
	document.getElementById('TBODYdetailT1_'+tbody_id).appendChild(tr_line);
	piForm.DDeline=piForm.DDeline+1;
}
piForm._sumText = function (elm,type){
	var weight1 = 0;
	var ctn = $('#table_list',$('#content-container').get(0));
	$('input[@id^=w\_]').each(function(){
		weight1 += $(this).val().replace(/[\,]/g,'')*1;
	});

	document.getElementById('weight').innerHTML = weight1;

	var kline = elm.id.substr(2);
	var params = '_output=json&'+$('#_pifrm :input',$('#content-container').get(0)).serialize();
	var baseUrl = '/'+projectName+'/workflow/evaluate/caldata/';
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
piForm.SummaryTotal = function (paramArray){
	var total1 = document.getElementById('weight').innerHTML.replace(/[\,]/g,'')*1;
	var total4 = document.getElementById('point_total').innerHTML.replace(/[\,]/g,'')*1;

	var sum_total1 = total1 + paramArray['wscoll']*1;
	var sum_total4 = total4 + paramArray['tscoll']*1;


	var params = '_output=json&total='+sum_total4;
	var baseUrl = '/'+projectName+'/workflow/evaluate/getgrade/';
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
       	 }
   	});

	document.getElementById('weight').innerHTML = number_format(sum_total1,'2','.',',');
	document.getElementById('point_total').innerHTML = number_format(sum_total4,'2','.',',');
}
piForm.DelSummaryTotal = function (wscoll,rscoll,tscoll){
	var total1 = document.getElementById('weight').innerHTML.replace(/[\,]/g,'')*1;
	var total4 = document.getElementById('point_total').innerHTML.replace(/[\,]/g,'')*1;

	var sum_total1 = total1 - wscoll * 1;
	var sum_total4 = total4 - tscoll * 1;

	var params = '_output=json&total='+sum_total4;
	var baseUrl = '/'+projectName+'/workflow/evaluate/getgrade/';
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
       	 }
   	});

	document.getElementById('weight').innerHTML = number_format(sum_total1,'2','.',',');
	document.getElementById('point_total').innerHTML = number_format(sum_total4,'2','.',',');
}
piForm.AddInput = function(ttype,tname,tvalue,size,tid){
	var input = document.createElement('INPUT');
		input.type = ttype;
		input.name = tname;
		input.value = tvalue;
		input.id = tid;
	if(size)
		input.size=size;

	return input;
}
piForm.RemoveData = function (lid,rep,body_id){//now2
	var removeid = lid.replace(rep,'');
	if (confirm("Are you sure delete data ?")){
	    document.getElementById(body_id).removeChild(document.getElementById(rep+'line_'+removeid));
	}
}
