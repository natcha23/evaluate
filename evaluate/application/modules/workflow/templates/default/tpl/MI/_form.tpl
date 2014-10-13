{include file="$g_template/_header.tpl"}
<script>
	var IMG_URL = '{$IMG_URL}';
	var user_code = '{$_profile->user_code}';
</script>
<div id="content-container">
<!--
onload="MM_preloadImages('{$g_image}/form/Quarter1_over.gif','{$g_image}/form/Quarter2_over.gif',
'{$g_image}/form/Quarter3_over.gif','{$g_image}/form/Quarter4_over.gif')"
-->
<form method="post" action="" id="_mifrm" enctype="multipart/form-data">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td valign="top">
    	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	      <tr>
	        {*include file="$g_template/_menuleft.tpl"*}
	        <td width="3" background="{$g_image}/form/line.jpg"><img src="{$g_image}/form/line.jpg" width="3" height="6" /></td>
			<!--detail-->
				<td valign="top" bgcolor="#FFFFFF">
					<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
					  <tr><td height="3"></td></tr>
			          <tr>
			            <td>
			            	<table width="100%" border="0" cellspacing="0" cellpadding="0">
					            <tr>
					                <td width="68%">&nbsp;</td>
					                <td width="10%">&nbsp;</td>
					                <td width="10%" rowspan="5">
					                	<table width="303" border="0" cellspacing="0" cellpadding="0">
						                    <tr>
						                      <td><img src="{$g_image}/form/namebox_top.png" width="303" height="14" /></td>
						                    </tr>
						                    <tr>
						                      <td background="{$g_image}/form/namebox.png">
							                      <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
							                          <tr>
							                            <td width="30%">
							                            {if !$user_image}
															<img src="{$UPLOAD_URL}/default.gif" id="PreviewImage" width="80" height="100">
														{else}
							                            	<img src="{$UPLOAD_URL}/account/{$userArr.user_image}?{$rand}" width="80" height="100"/>
							                            {/if}
							                            </td>
							                            <td width="70%">
								                            <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
								                                <tr>
								                                  <td valign="top" width="22%" class="style24" height="18">ชื่อ-สกุล</td>
								                                  <td align="left">:&nbsp;</td>
								                                  <td height="18" class="style24"> {$userArr.user_name} {$userArr.user_lname}</td>
								                                </tr>
								                                <tr>
								                                  <td valign="top" height="18" class="style24">รหัส </td>
								                                  <td align="left">:&nbsp;</td>
								                                  <td height="18" class="style24"> {if $userArr.user_code eq '1001'}-contact-{else}{$userArr.user_code}{/if}</td>
								                                </tr>
								                                <tr>
								                                  <td valign="top" height="18" class="style24">ตำแหน่ง</td>
								                                  <td align="left">:&nbsp;</td>
								                                  <td height="18" class="style24"> {$userArr.org_position_name_th}</td>
								                                </tr>
								                                <tr>
								                                  <td valign="top" height="18" class="style24">แผนก</td>
								                                  <td valign="top" align="left">:&nbsp;</td>
								                                  <td valign="top" height="18" class="style24"> {$userArr.org_sec_name_th}</td>
								                                </tr>
								                            </table>
							                            </td>
							                          </tr>
							                      </table>
						                      </td>
						                    </tr>
						                    <tr>
						                      <td><img src="{$g_image}/form/namebox_bottom.png" width="303" height="15" /></td>
						                    </tr>
					                	</table>
					                </td>
					                <td width="3%">&nbsp;</td>
					            </tr>
					            <!-- Month Tab-->
			              		<tr>
			                		<td>
			                			<table width="100%" border="0" cellspacing="0" cellpadding="0">
						                    <tr>
						                      <td width="97%">
							                      <table width="65%" border="0" cellspacing="0" cellpadding="0">

							                          <tr>
							                            <td><table border="0" cellspacing="0" cellpadding="0">
							                                <tr >
							                                  <td ><a href="javascript:tabMISubmit('mitab','Q1{$yearNow}', '');" target="_top" onclick="MM_nbGroup('down','group1','month11','',1)" onmouseover="MM_nbGroup('over','month11','{$g_image}/form/Quarter1_over.gif','',1)" onmouseout="MM_nbGroup('out')"><img {if $monthNow eq 'Q1'}src="{$g_image}/form/Quarter1_over.gif"{else}src="{$g_image}/form/Quarter1.gif"{/if} alt="" border="0" id="month11" /></a></td>
							                                  <td ><a href="javascript:tabMISubmit('mitab','Q2{$yearNow}', '');" target="_top" onclick="MM_nbGroup('down','group1','month14','',1)" onmouseover="MM_nbGroup('over','month14','{$g_image}/form/Quarter2_over.gif','',1)" onmouseout="MM_nbGroup('out')"><img {if $monthNow eq 'Q2'}src="{$g_image}/form/Quarter2_over.gif"{else}src="{$g_image}/form/Quarter2.gif"{/if} alt="" border="0" id="month14" /></a></td>
							                                  <td ><a href="javascript:tabMISubmit('mitab','Q3{$yearNow}', '');" target="_top" onclick="MM_nbGroup('down','group1','month17','',1)" onmouseover="MM_nbGroup('over','month17','{$g_image}/form/Quarter3_over.gif','',1)" onmouseout="MM_nbGroup('out')"><img {if $monthNow eq 'Q3'}src="{$g_image}/form/Quarter3_over.gif"{else}src="{$g_image}/form/Quarter3.gif"{/if} alt="" border="0" id="month17" /></a></td>
							                                  <td ><a href="javascript:tabMISubmit('mitab','Q4{$yearNow}', '');" target="_top" onclick="MM_nbGroup('down','group1','month06','',1)" onmouseover="MM_nbGroup('over','month06','{$g_image}/form/Quarter4_over.gif','',1)" onmouseout="MM_nbGroup('out')"><img {if $monthNow eq 'Q4'}src="{$g_image}/form/Quarter4_over.gif"{else}src="{$g_image}/form/Quarter4.gif"{/if} alt="" border="0" id="month06" /></a></td>
							                                  <!-- <td ><a href="javascript:openLinkPage('MI','{$user}','','Q1{$yearNow}','{$status}','{$copy_to}');" target="_top" onclick="MM_nbGroup('down','group1','month11','',1)" onmouseover="MM_nbGroup('over','month11','{$g_image}/form/Quarter1_over.gif','',1)" onmouseout="MM_nbGroup('out')"><img {if $monthNow eq 'Q1'}src="{$g_image}/form/Quarter1_over.gif"{else}src="{$g_image}/form/Quarter1.gif"{/if} alt="" border="0" id="month11" /></a></td>
							                                  <td ><a href="javascript:openLinkPage('MI','{$user}','','Q2{$yearNow}','{$status}','{$copy_to}');" target="_top" onclick="MM_nbGroup('down','group1','month14','',1)" onmouseover="MM_nbGroup('over','month14','{$g_image}/form/Quarter2_over.gif','',1)" onmouseout="MM_nbGroup('out')"><img {if $monthNow eq 'Q2'}src="{$g_image}/form/Quarter2_over.gif"{else}src="{$g_image}/form/Quarter2.gif"{/if} alt="" border="0" id="month14" /></a></td>
							                                  <td ><a href="javascript:openLinkPage('MI','{$user}','','Q3{$yearNow}','{$status}','{$copy_to}');" target="_top" onclick="MM_nbGroup('down','group1','month17','',1)" onmouseover="MM_nbGroup('over','month17','{$g_image}/form/Quarter3_over.gif','',1)" onmouseout="MM_nbGroup('out')"><img {if $monthNow eq 'Q3'}src="{$g_image}/form/Quarter3_over.gif"{else}src="{$g_image}/form/Quarter3.gif"{/if} alt="" border="0" id="month17" /></a></td>
							                                  <td ><a href="javascript:openLinkPage('MI','{$user}','','Q4{$yearNow}','{$status}','{$copy_to}');" target="_top" onclick="MM_nbGroup('down','group1','month06','',1)" onmouseover="MM_nbGroup('over','month06','{$g_image}/form/Quarter4_over.gif','',1)" onmouseout="MM_nbGroup('out')"><img {if $monthNow eq 'Q4'}src="{$g_image}/form/Quarter4_over.gif"{else}src="{$g_image}/form/Quarter4.gif"{/if} alt="" border="0" id="month06" /></a></td> -->
							                                </tr>
							                            </table></td>
							                          </tr>
							                      </table>
							                   </td>
						                    </tr>

						                </table>
						            </td>
				              </tr>
				              <!-- End Month Tab-->

				              <!-- Line -->
				              <tr valign="top">
				                <td height="3" valign="top">
					                <table width="100%" border="0" cellspacing="0" cellpadding="0">
					                    <tr>
					                    	<td background="{$g_image}/form/bg_underline-link.gif"><img src="{$g_image}/form/bg_underline-link.gif" width="3" height="3" /></td>
					                    </tr>
					                </table>
				                </td>
				                <td valign="top">
					                <table width="100%" border="0" cellspacing="0" cellpadding="0">
					                    <tr>
					                      <td valign="top" background="{$g_image}/form/bg_underline-link.gif"><img src="{$g_image}/form/bg_underline-link.gif" width="3" height="3" /></td>
					                    </tr>
					                </table>
				                </td>
				                <td valign="top">
				                	<table width="100%" border="0" cellspacing="0" cellpadding="0">
					                    <tr>
					                      <td valign="top" background="{$g_image}/form/bg_underline-link.gif"><img src="{$g_image}/form/bg_underline-link.gif" width="3" height="3" /></td>
					                    </tr>
				                  	</table>
				                </td>
				              </tr>
				              <!-- End Line -->

				              <tr >
				                <td>
					                <table  border="0" cellspacing="0" cellpadding="0">
					                    <!--tr>
					                      <td width="150" style="cursor: pointer;" height="24" background="{$g_image}/form/mi-pi-linkover_20.png" onclick="openLinkPage('MI','{$user}','T1','{$monthNow}{$yearNow}','{$status}','{$copy_to}');"><div align="right" class="style7">ประเมิน Quarter ปัจจุบัน &nbsp;</div></td>
					                      <td width="150" style="cursor: pointer;" background="{$g_image}/form/mi-pi-linkover_21.png" onclick="openLinkPage('MI','{$user}','T2','{$monthNow}{$yearNow}','{$status}','{$copy_to}');"><div align="right" class="style8">ประเมิน Quarter ถัดไป &nbsp;</div></td>
					                      <td width="149" style="cursor: pointer;" background="{$g_image}/form/mi-pi-linkover_22.png" onclick="openLinkPage('MI','{$user}','T3','{$monthNow}{$yearNow}','{$status}','{$copy_to}');"><div align="center" class="style9">สรุปผล</div></td>
					                    </tr-->
					                    
					                    <tr>
					                      <td width="150" style="cursor: pointer;" height="24" background="{$g_image}/form/mi-pi-linkover_20.png" onclick="javascript:tabMISubmit('mitab','{$monthNow}{$yearPrv}','T1');"><div align="center" class="style7">Quarter ในปี {$yearPrv}&nbsp;</div></td>
					                      <td width="150" style="cursor: pointer;" background="{$g_image}/form/mi-pi-linkover_21.png" onclick="javascript:tabMISubmit('mitab','{$monthNow}{$year}','T2');"><div align="center" class="style8">Quarter ในปี {$year}&nbsp;</div></td>
					                      <td width="149" style="cursor: pointer;" background="{$g_image}/form/mi-pi-linkover_22.png" onclick="javascript:tabMISubmit('mitab','{$monthNow}{$yearNext}','T3');"><div align="center" class="style9">Quarter ในปี {$yearNext}</div></td>
					                    </tr>
					                    
					                    <!-- <tr>
					                      <td width="150" style="cursor: pointer;" height="24" background="{$g_image}/form/mi-pi-linkover_20.png" onclick="openLinkPage('MI','{$user}','T1','{$monthNow}{$yearPrv}','{$status}','{$copy_to}');"><div align="center" class="style7">Quarter ในปี {$yearPrv}&nbsp;</div></td>
					                      <td width="150" style="cursor: pointer;" background="{$g_image}/form/mi-pi-linkover_21.png" onclick="openLinkPage('MI','{$user}','T2','{$monthNow}{$year}','{$status}','{$copy_to}');"><div align="center" class="style8">Quarter ในปี {$year}&nbsp;</div></td>
					                      <td width="149" style="cursor: pointer;" background="{$g_image}/form/mi-pi-linkover_22.png" onclick="openLinkPage('MI','{$user}','T3','{$monthNow}{$yearNext}','{$status}','{$copy_to}');"><div align="center" class="style9">Quarter ในปี {$yearNext}</div></td>
					                    </tr> -->
					                </table>
				                </td>
				              </tr>
				              <tr><td>&nbsp;</td></tr>
			            	</table>
			            	<table width="300" border="0" cellspacing="0" cellpadding="0">
				              <tr>
				                <td width="40"><img src="{$g_image}/form/Arrow-Left.gif" width="40" height="40" /></td>
				               {* {if $Tab eq 'T1' || !$Tab}
				                <td width="238">&nbsp;&nbsp;&nbsp;<span class="style15">ประเมิน Quarter ปัจจุบัน </span></td>
				              	{elseif $Tab eq 'T2'}
				              	<td width="238">&nbsp;&nbsp;&nbsp;<span class="style15">ประเมิน Quarter ถัดไป </span></td>
				              	{elseif $Tab eq 'T3'}
				              	<td width="238">&nbsp;&nbsp;&nbsp;<span class="style15">สรุปผล </span></td>
				              	{/if}*}
				              	<td width="238">&nbsp;&nbsp;&nbsp;<span class="style15">{$TabName}</span></td>
				              </tr>
			            	</table>
			            </td>
			          </tr>
			          <tr>
			            <td>
							<table id="table_list" bgcolor="#ffffff" cellpadding="0" cellspacing="1" width="100%" border="0" style="border:1px solid #B9B9B9;">
									<tr bgcolor="#C6DCFF" height="30">
								    	<td class="font11b" align="center" >หัวข้อของการประเมิน</td>
								    	<td class="font11b" width="8%" align="center" >น้ำหนักคะแนน</td>
								    	{assign var=i value=1}
								    	{section name=col loop=$column}
								    	<td class="font11" width="5%" align="center" style="cursor: pointer;" title="{$userColumn[$i]}"><b>ครั้ง {$i}</b><br>{$userColumn[$i]}</td {$i++}>
								    	{/section}
								    	{if $headArr.mph_status neq 'F' && $headArr.mph_status neq 'R'}
								    	<td class="font11b" width="8%" align="center" >คะแนนที่ได้ (เต็ม 10)</td>
								    	{/if}
								    	<td class="font11b" width="8%" align="center" >คะแนนรวม</td>
								    	{if $headArr.mph_status eq 'C' || $change}
								    	<td class="font11b" width="5%" align="center" >Action</td>
								    	{/if}
									</tr>
									<tbody id="showTab1">
									</tbody>
									<tr height="20" bgcolor="#CCCCCC">
								    	<td align="right" class="font11b">คะแนนรวม &nbsp;</td>
								    	<td align="center" class="font12"><span id="weight"></span></td>
								     	{assign var=t value=1}
								     	{section name=col loop=$column}
								     	<td align="center">{$totalLine[$t].grade}:{$totalLine[$t].scoll|number_format:2}</td {$t++}>
								     	{/section}
								     	{if $headArr.mph_status neq 'F' && $headArr.mph_status neq 'R'}
								    	<td align="center" class="font12"><span id="point"></span></td>
								    	{/if}
								    	<td align="center" class="font12"><span id="point_total"></span></td>
								    	{if $headArr.mph_status eq 'C' || $change}
								    	<td align="center" ></td>
								    	{/if}
									</tr>
							</table>
						</td>
			          </tr>
			          {if $headArr.mph_status eq 'C'}
			          <tr>
			             <td>
				            <table width="60%" border="0" align="left" cellpadding="0" cellspacing="0">
				                <tr>
						             <td width="60%">
						             <br>
						             <fieldset >

						             	<table width="100%" border="0" align="left" cellpadding="0" cellspacing="0">
							                <tr height="30">
								                <td align="left" colspan="3" class="font12b">&nbsp; เพิ่มข้อมูล </td>
							                </tr>
							                <tr height="30">
								                <td align="right" width="20%" class="font12">หัวข้อการประเมิน :</td>
								                <td align="left" colspan="2">
								                    <input type="text" name="subject" id="subject" class="textfield_10c">
								                </td>
							                </tr>
							                <tr height="30">
								                <td align="right" width="15%" class="font12">น้ำหนักคะแนน :</td>
								                <td align="left" width="10%">
								                    <input type="text" name="wscoll" id="wscoll" class="textfield_3c" onKeyup="ckvNum(this);">
								                </td>
								                <!--td align="right" width="20%" class="font12">คะแนนที่ได้ :</td>
								                <td align="left" >
								                    <input type="hidden" name="rscoll" id="rscoll" class="textfield_3c" onKeyup="ckvNum(this);">
								                </td-->
								                 <td align="left" >
								                 	<input type="hidden" name="rscoll" id="rscoll" class="textfield_3c" onKeyup="ckvNum(this);">
								                 	<a href="javascript:void(0)" onClick="miForm.checkDataLine();">
														<img src="{$g_image}/add.gif" border="0" >
													</a>
								                </td>
							                </tr>
							            </table>
				           			 </fieldset >
				            		</td>
				                </tr>
				            </table>
			             </td>
			        </tr>
			        {/if}
			        <tr>
			             <td>
				            <table width="100%" border="0" align="left" cellpadding="0" cellspacing="0">
				                <tr>
						             <td width="65%">
						              	<table width="100%" border="0" align="left" cellpadding="0" cellspacing="0">
							                <tr>
								                <td align="right" width="18%" class="font12">หมายเหตุ :</td>
								                <td align="left" width="80%">
								                    <textarea name="head[mph_desc]" id="detail" rows="5" class="textfield_10c">{$headArr.mph_desc}</textarea>
								                </td>
							                </tr>
							                <tr>
							                	<td align="left" colspan="2">
							                	<br>&nbsp; หมายเหตุ : คะแนนในช่อง คะแนนรวม เป็นคะแนนรวมทั้งหมดที่กรอกเข้าไป ล่าสุด
							                	<br><dd>ปุ่ม save คือ การบันทึกข้อมูลไว้ โดยที่สถานะใบประเมินยังอยู่ที่ตนเองถ้าต้องการส่ง ต้องทำการคลิกปุ่ม Send to
							                	<br><dd>ปุ่ม Send to คือ การส่งต่อข้อมูลไปให้คนที่เราเลือกให้รับใบประเมิน
							                	<br><dd>สำหรับ คนที่มีหน้าที่ใส่รายละเอียดในใปประเมิน การคลิกปุ่ม send to คือการส่งหาเจ้าของใบประเมินนั้นโดยที่ไม่ต้องเลือกคนรับใบประเมิน
							                	</td>
							                </tr>
							            </table>
				            		</td>
				            		<td valign="top">
					            		<table width="100%" border="0" align="left" cellpadding="0" cellspacing="0">
					            			<tr height="30">
						            			<td nowrap>
						            			{if $dataRows}
							            			<img src="{$g_image}/form/start.png" border="0" title="[ Admin ]">
							            			<img src="{$g_image}/form/next.gif" border="0" ><img src="{$g_image}/form/user.png" title="[ {$headArr.user_first_recive} ]" border="0" width="20" height="20">
							            			{if $headArr.mph_status eq 'P' || $headArr.mph_status eq 'R' || $headArr.mph_status eq 'F'}
													{assign var=u value=1}
								    				{section name=col loop=$column}
							            			<img src="{$g_image}/form/next.gif" border="0" ><img src="{$g_image}/form/user.png" title="[ {$userColumn[$u]} ]" border="0" width="20" height="20">
						            				{assign var=u value=$u+1}
						            				{/section}
						            				{/if}
						            				{if $headArr.mph_status eq 'F'}
						            				<img src="{$g_image}/form/next.gif" border="0" ><img src="{$g_image}/form/end.gif" title="[ การเงิน ]" border="0" >
						            				{/if}
						            			{/if}
						            			</td>
					            			</tr>
					            		</table>
				            		</td>
				                </tr>
				            </table>
			             </td>
			        </tr>
			        <tr><td height="20"></td></tr>
			     {if $status neq 'W' && $status neq 'O'}
			        {if $headArr}
					{if $headArr.mph_status eq 'F' || $headArr.mph_status eq 'R'}
					{if $_profile->user_header eq 'Y'}
					<tr bgcolor="#EBEBEB">
						<td colspan="2" align="right" >
							<!--input id="btn_copy" title="copy" class="btn_tools" onclick="copyData('{$headArr.mph_id}','MI','{$copy_to}');" value="   Copy" type="button"-->
							<input id="btn_copy" title="copy" class="btn_tools" onclick="copyDataTo('{$headArr.mph_id}','{$headArr.mph_month}','MI','{$headArr.mph_user}');" value="   Copy" type="button">
						</td>
					</tr>
					{/if}
					{else}
			        <tr bgcolor="#EBEBEB">
						<td colspan="2" align="right" >
							{if $status neq 'E'}
							<input id="btn_save" title="Save" class="btn_tools" onclick="sendDataToSave('{$headArr.mph_status}','mi','{$status}','save');" value="   Save" type="button">
							{/if}
							{if !$Finish}
								{if $headArr.mph_status eq 'C'}
									<input id="btn_list" title="Send To" class="btn_tools" value="  Send To" onclick="chkScollSend('weight','P','mi','{$status}','{$headArr.mph_user}','{$headArr.mph_status}','workflow/evaluate/userpopup/pageview/mi/status/{$status}/depart/{$headArr.user_sec_depart}');" type="button">
									<!--input id="btn_list" title="Send To" class="btn_tools" value="  Send To" onclick="sendDataToOwner('P','mi','{$status}','{$headArr.mph_user}');" type="button"-->
								{else}
									<input id="btn_list" title="Send To" class="btn_tools" value="  Send To" onclick="chkScoll('weight','workflow/evaluate/userpopup/pageview/mi/status/{$status}/depart/{$headArr.user_sec_depart}','{$status}');" type="button">
								{/if}
							{else}
								{if $headArr.mph_status eq 'C'}
								<input id="btn_list" title="Send To" class="btn_tools" value="  Send To" onclick="chkScollSend('weight','P','mi','{$status}','{$headArr.mph_user}','{$headArr.mph_status}','workflow/evaluate/userpopup/pageview/mi/status/{$status}/depart/{$headArr.user_sec_depart}');" type="button">
								<!--input id="btn_list" title="Send To" class="btn_tools" value="  Send To" onclick="sendDataToOwner('P','mi','{$status}','{$headArr.mph_user}');" type="button"-->
								{else}
								<input id="btn_list" title="Send To" class="btn_tools" value="  Send To" onclick="chkScoll('weight','workflow/evaluate/userpopup/pageview/mi/status/{$status}','{$status}');" type="button">
								<input id="btn_accept" title="Finish" class="btn_tools" onclick="sendDataToSave('F','mi','{$status}','finish');" value="  Finish" type="button">
								{/if}
							{/if}
							{if $status eq 'V'}
							<input id="btn_back" title="Back" class="btn_tools" onclick="openPage('workflow/evaluate/urecive');"  value="  Back" type="button">
							{elseif $status eq 'E'}
							<input id="btn_back" title="Back" class="btn_tools" onclick="openPage('workflow/evaluate/history');"  value="  Back" type="button">
							{elseif $status eq 'A'}
							<input id="btn_back" title="Back" class="btn_tools" onclick="openPage('workflow/evaluate/accept/type/MI/my/{$headArr.mph_month}');"  value="  Back" type="button">
							{else}
							<input id="btn_back" title="Back" class="btn_tools" onclick="openPage('workflow/evaluate/view/type/MI/user/{$_profile->user_code}/status/{$status}');"  value="  Back" type="button">
							{/if}
						</td>
					</tr>
					{/if}
					{/if}
				{else}
					{if $status eq 'W'}
					<tr bgcolor="#EBEBEB">
						<td colspan="2" align="right" >
							<input id="btn_back" title="Back" class="btn_tools" onclick="openPage('workflow/summary/incentive/type/MI/my/{$headArr.mph_month}');"  value="  Back" type="button">
						</td>
					</tr>
					{/if}
				{/if}
			        <tr align="right">
				   		<td >
							<table width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#b9b9b9">
						   	<tbody>
						       	<tr align="right">
						           	<td width="12"><img width="12" src="{$g_image}/buttonmenuleft.gif"/></td>
						            <td>&nbsp;</td>
						            <td width="12"><img width="12" src="{$g_image}/buttonmenuright.gif"/></td>
						        </tr>
						    </tbody>
				 	        </table>
					    </td>
					</tr>
			    </table>
			  </td>
	        <!-- end detail-->
	      </tr>
    	</table>
    </td>
  </tr>
<input type="hidden" name="loopCol" id="loopCol" value="{$column}">
<input type="hidden" name="user_recive" id="user_recive" value="{$headArr.mph_user_flow}">
<input type="hidden" name="receive_old" id="receive_old" value="{$headArr.mph_user_flow}">
<input type="hidden" name="user_send" id="user_send" value="{$user_send}">
<input type="hidden" name="mode" id="mode">
<input type="hidden" name="checksend" id="checksend">
<input type="hidden" name="page_status" id="page_status" value="{$status}">
<input type="hidden" name="copy_to" value="{$copy_to}">
<input type="hidden" name="level_user" value="{$headArr.org_position_level}">
<input type="hidden" name="head[mph_id]" value="{$headArr.mph_id}">
<input type="hidden" name="head[mph_month]" value="{$headArr.mph_month}">
<input type="hidden" name="head[mph_status]" id="status" value="{$headArr.mph_status}">
<input type="hidden" name="head[mph_user]" value="{$headArr.mph_user}">
<input type="hidden" name="old_status" id="old_status" value="{$headArr.mph_status}">
</table>
{add_script file="$_js/evaluate.js,$_js/action.js,$_js/_mi.js"}
{include file="$g_template/_footer.tpl"}
</form>
</div>
{if $dataRows}
{foreach from=$dataRows item=item}
	<script>
		var paramArray = new Array();
			paramArray['id'] = '{$item.mpl_id}';
			paramArray['subject'] = '{$item.mpl_subject|replace:"'":"\'"}';
			paramArray['status'] = '{$headArr.mph_status}';
			paramArray['change'] = '{$change}';
			paramArray['wscoll'] = '{$item.mpl_weight|number_format:0}';
			paramArray['rscoll'] = '{$item.mpl_point|number_format:2}';
			paramArray['tscoll'] = '{$item.mpl_weight*$item.mpl_point|number_format:2}';
			paramArray['JSON'] = '{$item.subColJSON}';
			miForm.AddLine(paramArray);
			miForm.SummaryTotal(paramArray);

	</script>
{/foreach}
{/if}

<form id="mitab" action="/iceworkflow/workflow/evaluate/mifrm" method="POST">
	<input type="hidden" name="user" value="{$user}" />
	<input type="hidden" name="tab" id="tabyear" value="" />
	<input type="hidden"  name="m" id="tabquarter" value="" />
	<input type="hidden" name="status" value="{$status}" />
	<input type="hidden" name="copy_to" value="{$copy_to}" />
	<!-- http://localhost/iceworkflow/workflow/evaluate/mifrm/user/1510583/tab/T2/m/Q42013/status/O/copy_to/ -->
	<!-- 'PI','{$user}','','01{$yearNow}','{$status}','{$copy_to} @@@/iceworkflow/workflow/evaluate/pifrm/user/1510583/tab//m/032013/status/W/copy_to/3207-->
</form>

<script>
{literal}
	function tabMISubmit(_frm, _q, _y){
		document.getElementById("tabyear").value = _y;
		document.getElementById("tabquarter").value = _q;
		document.getElementById(_frm).submit();
	}
{/literal}
</script>