//var errNumber = 'Please input number only !';
var errNumber = 'กรุณากรอกตัวเลข 0-9 เท่านั้น !';
 function isNumber(obj){
	 var testresult = null;
	 if(obj.value == ''){
	      return null;
	 }else{
	      var anum=/(^\d+$)|(^\d+\.\d+$)/
	      if (anum.test(obj.value))
		    testresult=true;
	      else{
		    alert(errNumber);
	        testresult=false;
	        obj.value = '';
	      }
	    return (testresult);
	 }
 }
 function ckvNum(obj,noDot){
		var text = ckvNumeric(obj.value,noDot);
		if(text == false){
			alert("กรุณากรอกตัวเลข 0-9 เท่านั้น");
			obj.value="";
		}
	}
 function ckvNumeric(sText,noDot)
	{
		if (noDot)	var ValidChars = "0123456789";
		else			var ValidChars = "0123456789.";
	   	var IsNumber=true;
	   	var Char;
	   	var Dot=0;

	   	for (i = 0; i < sText.length && IsNumber == true; i++)
	    {
	      Char = sText.charAt(i);
		  if (Char=="."){
			  Dot++;
		  }
		  if (Dot>1){
			  return false;
		  }
	      if (ValidChars.indexOf(Char) == -1){
	         IsNumber = false;
	      }
		  else
		     IsNumber = true;
	    }
	   	return IsNumber;

	}
 	function checkAll(){
		var thefrm = document.forms[0];
	    var len = thefrm.elements['check_id'].length;
	    if (typeof(len)== 'undefined'){
	      	if(thefrm.elements['check_id'].disabled==false)
		      	thefrm.elements['check_id'].checked=true;
	    }else {
		    for (var i = 0 ; i < thefrm.elements['check_id'].length; i++)
	    	{
		      if(thefrm.elements['check_id'][i].disabled==false)
		     	thefrm.elements['check_id'][i].checked=true;
	    	}
	    }
	  }
	  function unCheckAll(){
		  var thefrm = document.forms[0];
	        var len = thefrm.elements['check_id'].length;
	        if (typeof(len)== 'undefined'){
		        thefrm.elements['check_id'].checked=false;
	        }else{
		        for (var i = 0 ; i < thefrm.elements['check_id'].length; i++)
	    	      {
	        	   	thefrm.elements['check_id'][i].checked=false;
		          }
		    }
		}
	  
	  function number_format (number, decimals, dec_point, thousands_sep)
		{
			  var exponent = "";
			  var numberstr = number.toString ();
			  var eindex = numberstr.indexOf ("e");
			  if (eindex > -1)
			  {
			    exponent = numberstr.substring (eindex);
			    number = parseFloat (numberstr.substring (0, eindex));
			  }

			  if (decimals != null)
			  {
			    var temp = Math.pow (10, decimals);
			    number = Math.round (number * temp) / temp;
			  }
			  var sign = number < 0 ? "-" : "";
			  var integer = (number > 0 ?
			      Math.floor (number) : Math.abs (Math.ceil (number))).toString ();

			  var fractional = number.toString ().substring (integer.length + sign.length);
			  dec_point = dec_point != null ? dec_point : ".";
			  fractional = decimals != null && decimals > 0 || fractional.length > 1 ?
			               (dec_point + fractional.substring (1)) : "";
			  if (decimals != null && decimals > 0)
			  {
			    for (i = fractional.length - 1, z = decimals; i < z; ++i)
			      fractional += "0";
			  }

			  thousands_sep = (thousands_sep != dec_point || fractional.length == 0) ?
			                  thousands_sep : null;
			  if (thousands_sep != null && thousands_sep != "")
			  {
				for (i = integer.length - 3; i > 0; i -= 3)
			      integer = integer.substring (0 , i) + thousands_sep + integer.substring (i);
			  }

			  return sign + integer + fractional + exponent;
		}
	  function handleEnter (field, event) {
			var keyCode = event.keyCode ? event.keyCode : event.which ? event.which : event.charCode;
			if (keyCode == 13) {
				var i;
				//alert(field.form.elements.length);
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
			if(field.type=="hidden" || field.type=="file" || field.readOnly==true || field.disabled==true)
				return true;
			else
				return false;
		}