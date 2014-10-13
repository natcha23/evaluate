/* หมายเหตุ ขนาดกว้าง Floating Area สูงสุดไม่ควรเกิน 112 px , จาก 112 + 800 + 112 */

/* 
 * จะใช้ Floating Area ที่ Page ไหน ให้เปลี่ยน <body> เป็น <body onLoad="StartFloatLeft(); StartFloatRight();">
 *
 * แล้วนำ Tag นี้ไปวางไว้ใน <body></body>
 *	[สำหรับข้างขวา]
 * <span align="right" id="FloatingAdRight" name="FloatingAdRight" style="position: absolute; visibility: hidden;">
 *							... สิ่งที่จะให้อยู่ใน Floating Area ใส่ตรงนี้ ...
 * </span> 
 *	[สำหรับข้างซ้าย]
 * <span align="right" id="FloatingAdLeft" name="FloatingAdLeft" style="position: absolute; visibility: hidden;">
 *							... สิ่งที่จะให้อยู่ใน Floating Area ใส่ตรงนี้ ...
 * </span> 
 */

var Type = 'unknow';

var rightGap = 2; // ระยะช่องว่าง (เป็น Pixel) จากขอบขวา สำหรับ floating ad ที่อยู่ข้างขวา
var topRightGap = 120; // ระยะช่องว่าง (เป็น Pixel) จากขอบบน สำหรับ floating ad ที่อยู่ข้างขวา

var leftGap = 2; // ระยะช่องว่าง (เป็น Pixel) จากขอบซ้าย สำหรับ floating ad ที่อยุ่ข้างซ้าย
var topLeftGap = 40; // ระยะช่องว่าง (เป็น Pixel) จากขอบบน สำหรับ floating ad ที่อยู่ข้างซ้าย

var topCenterGap = 300;

var areaSize =100; // ต้องคำนวณเองใช้ document.all.{name}.offsetWidth ไม่ได้

function StartFloatRight()
{
	if(document.all) // Compatible with Internet Explorer & Opera
	{
		// ตำแหน่งของ Floating Area (เป็น Pixel) จากขอบซ้าย
		//document.all.FloatingAdRight.style.pixelLeft = (document.body.clientWidth - document.all.FloatingAdRight.offsetWidth) - rightGap;
		document.all.FloatingAdRight.style.pixelLeft = (document.body.clientWidth/2 + 400)  - rightGap;
		// ตำแหน่งของ Floating Area (เป็น Pixel) จากขอบบน
		document.all.FloatingAdRight.style.pixelTop = document.body.scrollTop + topRightGap;
		// สั่งให้แสดง Floating Area (จะแสดงเฉพาะค่า visible, ค่าอื่นไม่แสดง)
		document.all.FloatingAdRight.style.visibility = 'visible';
		Type = 'all';
	}
	else if(document.getElementById) // Compatible with Firefox & Netscape
	{
		// ตำแหน่งของ Floating Area (เป็น Pixel) จากขอบซ้าย , 20 เป็นค่า offset
		//document.getElementById('FloatingAdRight').style.left = (window.innerWidth - areaSize - 60) - rightGap + 'px';
		document.getElementById('FloatingAdRight').style.left = (window.innerWidth/2 + 400 - 10) - rightGap + 'px';
		// ตำแหน่งของ Floating Area (เป็น Pixel) จากขอบบน
		document.all.FloatingAdRight.style.pixelTop = topRightGap;
		// สั่งให้แสดง Floating Area (จะแสดงเฉพาะค่า visible, ค่าอื่นไม่แสดง)
		document.getElementById('FloatingAdRight').style.visibility = 'visible';
		Type = 'getelement';
	}
	
	if (document.all) { 
		window.onscroll = FloatBoth; 
		window.onresize = AdjustRight;
	} // เรียก Float() เมื่อเกิด Event onScroll
	else { 
		setInterval('FloatBoth()',100);
		setInterval('AdjustRight()',100);
	} // เรียก Float() ทุกๆ 100 milliseconds
}
function FloatRight() // ทำหน้าที่ขยับ Floating Area ตามที่ scroll ขยับ
{
	if (Type == 'all') 
	{ 
		document.all.FloatingAdRight.style.pixelTop = document.body.scrollTop + topRightGap; 
	}
	else if (Type == 'getelement') { document.getElementById('FloatingAdRight').style.top = window.pageYOffset + topRightGap + 'px'; }
}
function AdjustRight()
{
	if(document.all) {
		document.all.FloatingAdRight.style.pixelLeft = (document.body.clientWidth/2 + 400) - rightGap;
	} else if(document.getElementById) {
		document.getElementById('FloatingAdRight').style.left = (window.innerWidth/2 + 400 - 10) - rightGap + 'px';
	}
}

function StartFloatLeft()
{
	if(document.all) // Compatible with Internet Explorer & Opera
	{
		// ตำแหน่งของ Floating Area (เป็น Pixel) จากขอบซ้าย
		document.all.FloatingAdLeft.style.pixelLeft = leftGap;
		// ตำแหน่งของ Floating Area (เป็น Pixel) จากขอบบน
		document.all.FloatingAdLeft.style.pixelTop = document.body.scrollTop + topLeftGap;
		// สั่งให้แสดง Floating Area (จะแสดงเฉพาะค่า visible, ค่าอื่นไม่แสดง)
		document.all.FloatingAdLeft.style.visibility = 'visible';
		Type = 'all';
	}
	else if(document.getElementById) // Compatible with Firefox & Netscape
	{
		// ตำแหน่งของ Floating Area (เป็น Pixel) จากขอบซ้าย , 20 เป็นค่า offset
		document.getElementById('FloatingAdLeft').style.left = leftGap + 'px';
		// ตำแหน่งของ Floating Area (เป็น Pixel) จากขอบบน
		document.all.FloatingAdLeft.style.pixelTop = topLeftGap;
		// สั่งให้แสดง Floating Area (จะแสดงเฉพาะค่า visible, ค่าอื่นไม่แสดง)
		document.getElementById('FloatingAdLeft').style.visibility = 'visible';
		Type = 'getelement';
	}
	
	if (document.all) { window.onscroll = FloatBoth; } // เรียก FloatLeft() เมื่อเกิด Event onScroll
	else { setInterval('FloatBoth()', 100); } // เรียก FloatLeft() ทุกๆ 100 milliseconds
}
function FloatLeft() // ทำหน้าที่ขยับ Floating Area ตามที่ scroll ขยับ
{
	if (Type == 'all') { document.all.FloatingAdLeft.style.pixelTop = document.body.scrollTop + topLeftGap; }
	else if (Type == 'getelement') { document.getElementById('FloatingAdLeft').style.top = window.pageYOffset + topLeftGap + 'px'; }
}

function StartFloatCenter()
{
	if(document.all) // Compatible with Internet Explorer & Opera
	{
		// ตำแหน่งของ Floating Area (เป็น Pixel) จากขอบซ้าย
		document.all.FloatingAdCenter.style.pixelLeft = (document.body.clientWidth/2 + 60);
		// ตำแหน่งของ Floating Area (เป็น Pixel) จากขอบบน
		document.all.FloatingAdCenter.style.pixelTop = document.body.scrollTop + document.body.clientHeight - 200;
		// สั่งให้แสดง Floating Area (จะแสดงเฉพาะค่า visible, ค่าอื่นไม่แสดง)
		document.all.FloatingAdCenter.style.visibility = 'visible';
		Type = 'all';
	}
	else if(document.getElementById) // Compatible with Firefox & Netscape
	{
		// ตำแหน่งของ Floating Area (เป็น Pixel) จากขอบซ้าย , 20 เป็นค่า offset
		document.getElementById('FloatingAdCenter').style.left = (window.innerWidth/2 + 60 - 10) + 'px';
		// ตำแหน่งของ Floating Area (เป็น Pixel) จากขอบบน
		document.all.FloatingAdCenter.style.pixelTop = window.innerHeight - 200;
		// สั่งให้แสดง Floating Area (จะแสดงเฉพาะค่า visible, ค่าอื่นไม่แสดง)
		document.getElementById('FloatingAdCenter').style.visibility = 'visible';
		Type = 'getelement';
	}
	
	if (document.all) { 
		window.onscroll = FloatBoth; 
		window.onresize = AdjustCenter;
	} // เรียก Float() เมื่อเกิด Event onScroll
	else { 
		setInterval('FloatBoth()',100);
		setInterval('AdjustCenter()',100);
	} // เรียก Float() ทุกๆ 100 milliseconds
}
function FloatCenter() // ทำหน้าที่ขยับ Floating Area ตามที่ scroll ขยับ
{
	if (Type == 'all') 
	{ 
		document.all.FloatingAdCenter.style.pixelTop = document.body.scrollTop + document.body.clientHeight - 200;
	}
	else if (Type == 'getelement') { document.getElementById('FloatingAdCenter').style.top = window.pageYOffset + window.innerHeight - 200 + 'px'; }
}
function AdjustCenter()
{
	if(document.all) {
		document.all.FloatingAdCenter.style.pixelLeft = (document.body.clientWidth/2 + 60);
		document.all.FloatingAdCenter.style.pixelTop = document.body.scrollTop + document.body.clientHeight - 200;
	} else if(document.getElementById) {
		document.getElementById('FloatingAdCenter').style.left = (window.innerWidth/2 + 60 - 10) + 'px';
		document.getElementById('FloatingAdCenter').style.top = window.pageYOffset + window.innerHeight - 200 + 'px';
	}
}

function FloatBoth()
{
	if (document.getElementById('FloatingAdRight')!=null)
	{
		FloatRight();
	}
	if (document.getElementById('FloatingAdLeft')!=null)
	{
		FloatLeft();
	}
	if (document.getElementById('FloatingAdCenter')!=null)
	{
		FloatCenter();
	}
}

function closeAd(adArea)
{
	adArea.parentNode.style.display = 'none';
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/* 
 * จะใช้ Rotate Text ที่ Page ไหน ให้เปลี่ยน <body> เป็น <body onLoad="StartRotateText()">
 *
 * แล้วนำ Tag นี้ไปวางไว้ในจุดที่ต้องการ
 *		<div id="RotateTextAd" name="RotateTextAd" style="position:relative;"></div>
 */

var rotateDelayTime = 3000; // เวลาในการเปลี่ยนข้อความ
var textArray = new Array(); // เก็บข้อความเป็น Array
var rotateTextIterator = 0; // Iterator ที่ใช้ในการอ้าง Index ของ Array เพื่อเข้าถึงข้อความ
var rotateCommand; // คำสั่งที่ถูกสร้างขึ้นจาก Function เพื่อนนำไปใช้เปลี่ยนข้อความ (ด้วย eval();) เมื่อครบตาม DelayTime

function StartRotateText()
{

	textArray[0] = "<a href='http://today.trendycare.com/' style='text-decoration:none; color:none;'><span style='color:red'>ลด/เพิ่มน้ำหนัก</span> <span style='color:red'>5-10 กก.</span> <span style='color:black'>หุ่นดี</span> <span style='color:black'>สุขภาพดี</span> <span style='color:#00BF60'>ปลอดภัย</span> <span style='color:blue'>ได้ผล 100 % ผอมถาวร</span> <span style='color:fuchsia'>ไม่กลับมาอ้วนอีก</span></a>";
	textArray[1] = "<a href='http://www.businessinter.com/mind/' style='text-decoration:none; color:none;'><span style='color:blue;'>part-time</span><span style='color:blue;'> job 2-3 ชม/วัน</span> <span style='color:red'>เสริม</span> <span style='color:red;'>5,000-30,000 บ/ด</span> <span style='color:#407F00'>ทำที่บ้านหลังเลิกงาน</span></a>";
	// เพิ่มข้อความได้ที่นี่

	if (document.all) 
	{
		rotateCommand = 'document.all.RotateTextAd1.innerHTML = textArray[rotateTextIterator++];';
	}
	else if (document.getElementById) 
	{
		rotateCommand = 'document.getElementById("RotateTextAd1").innerHTML = textArray[rotateTextIterator++];';
	}
	RotateText();
}
function RotateText() // ทำหน้าที่เปลี่ยนข้อความ
{
	eval(rotateCommand);
	
	TextFadeEffect("RotateTextAd1");
	
	if (rotateTextIterator == textArray.length) rotateTextIterator = 0; // แสดงข้อความจนครบรอบแล้ว ให้เริ่มต้นใหม่
	setTimeout("RotateText() ", rotateDelayTime); // กำหนด Timeout เพื่อทำการเรียก RotateText() อีกครั้ง เมื่อเวลาผ่านไปเท่ากับ rotateDelayTime
}

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/* 
 * เวลาเรียกใช้ ให้ใส่ค่า Attribute ของ name ใน Tag HTML เป็น พารามิเตอร์
 * เช่น <div id="RotateTextAd" name="RotateTextAd" style="position:relative;"></div>
 * ต้องการ Fade ข้อความใน Tag <DIV> ก็สั่ง TextFadeEffect("RotateTextAd");
 */

var hex = 255 // ค่าเริ่มต้น (สีขาว)
var fadeStep = 10; // ค่ายิ่งมากยิ่งเปลี่ยนช้า
var fadeDelayTime = 10; // ค่ายิ่งมากยิ่งเปลี่ยนช้า
function TextFadeEffect(tagname) // ใช้สำหรับในการค่อยๆ Fade ตัวอักษรขึ้นมาแสดง
{ 
	if (hex > 0) 
	{
		hex -= fadeStep;
		document.getElementById(tagname).style.color= "RGB("+hex+","+hex+","+hex+")"; // อาจจะเปลี่ยนสีตามลูกเล่นที่ต้องการ
		setTimeout("TextFadeEffect(\""+tagname+"\")",fadeDelayTime);
	}
	else hex=255;
}
