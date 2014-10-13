<?php /* Smarty version 2.6.19, created on 2014-08-24 14:09:23
         compiled from MI/_form.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'number_format', 'MI/_form.tpl', 202, false),array('modifier', 'replace', 'MI/_form.tpl', 406, false),array('function', 'add_script', 'MI/_form.tpl', 397, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['g_template'])."/_header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<script>
	var IMG_URL = '<?php echo $this->_tpl_vars['IMG_URL']; ?>
';
	var user_code = '<?php echo $this->_tpl_vars['_profile']->user_code; ?>
';
</script>
<div id="content-container">
<!--
onload="MM_preloadImages('<?php echo $this->_tpl_vars['g_image']; ?>
/form/Quarter1_over.gif','<?php echo $this->_tpl_vars['g_image']; ?>
/form/Quarter2_over.gif',
'<?php echo $this->_tpl_vars['g_image']; ?>
/form/Quarter3_over.gif','<?php echo $this->_tpl_vars['g_image']; ?>
/form/Quarter4_over.gif')"
-->
<form method="post" action="" id="_mifrm" enctype="multipart/form-data">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td valign="top">
    	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	      <tr>
	        	        <td width="3" background="<?php echo $this->_tpl_vars['g_image']; ?>
/form/line.jpg"><img src="<?php echo $this->_tpl_vars['g_image']; ?>
/form/line.jpg" width="3" height="6" /></td>
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
						                      <td><img src="<?php echo $this->_tpl_vars['g_image']; ?>
/form/namebox_top.png" width="303" height="14" /></td>
						                    </tr>
						                    <tr>
						                      <td background="<?php echo $this->_tpl_vars['g_image']; ?>
/form/namebox.png">
							                      <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
							                          <tr>
							                            <td width="30%">
							                            <?php if (! $this->_tpl_vars['user_image']): ?>
															<img src="<?php echo $this->_tpl_vars['UPLOAD_URL']; ?>
/default.gif" id="PreviewImage" width="80" height="100">
														<?php else: ?>
							                            	<img src="<?php echo $this->_tpl_vars['UPLOAD_URL']; ?>
/account/<?php echo $this->_tpl_vars['userArr']['user_image']; ?>
?<?php echo $this->_tpl_vars['rand']; ?>
" width="80" height="100"/>
							                            <?php endif; ?>
							                            </td>
							                            <td width="70%">
								                            <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
								                                <tr>
								                                  <td valign="top" width="22%" class="style24" height="18">ชื่อ-สกุล</td>
								                                  <td align="left">:&nbsp;</td>
								                                  <td height="18" class="style24"> <?php echo $this->_tpl_vars['userArr']['user_name']; ?>
 <?php echo $this->_tpl_vars['userArr']['user_lname']; ?>
</td>
								                                </tr>
								                                <tr>
								                                  <td valign="top" height="18" class="style24">รหัส </td>
								                                  <td align="left">:&nbsp;</td>
								                                  <td height="18" class="style24"> <?php if ($this->_tpl_vars['userArr']['user_code'] == '1001'): ?>-contact-<?php else: ?><?php echo $this->_tpl_vars['userArr']['user_code']; ?>
<?php endif; ?></td>
								                                </tr>
								                                <tr>
								                                  <td valign="top" height="18" class="style24">ตำแหน่ง</td>
								                                  <td align="left">:&nbsp;</td>
								                                  <td height="18" class="style24"> <?php echo $this->_tpl_vars['userArr']['org_position_name_th']; ?>
</td>
								                                </tr>
								                                <tr>
								                                  <td valign="top" height="18" class="style24">แผนก</td>
								                                  <td valign="top" align="left">:&nbsp;</td>
								                                  <td valign="top" height="18" class="style24"> <?php echo $this->_tpl_vars['userArr']['org_sec_name_th']; ?>
</td>
								                                </tr>
								                            </table>
							                            </td>
							                          </tr>
							                      </table>
						                      </td>
						                    </tr>
						                    <tr>
						                      <td><img src="<?php echo $this->_tpl_vars['g_image']; ?>
/form/namebox_bottom.png" width="303" height="15" /></td>
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
							                                  <td ><a href="javascript:tabMISubmit('mitab','Q1<?php echo $this->_tpl_vars['yearNow']; ?>
', '');" target="_top" onclick="MM_nbGroup('down','group1','month11','',1)" onmouseover="MM_nbGroup('over','month11','<?php echo $this->_tpl_vars['g_image']; ?>
/form/Quarter1_over.gif','',1)" onmouseout="MM_nbGroup('out')"><img <?php if ($this->_tpl_vars['monthNow'] == 'Q1'): ?>src="<?php echo $this->_tpl_vars['g_image']; ?>
/form/Quarter1_over.gif"<?php else: ?>src="<?php echo $this->_tpl_vars['g_image']; ?>
/form/Quarter1.gif"<?php endif; ?> alt="" border="0" id="month11" /></a></td>
							                                  <td ><a href="javascript:tabMISubmit('mitab','Q2<?php echo $this->_tpl_vars['yearNow']; ?>
', '');" target="_top" onclick="MM_nbGroup('down','group1','month14','',1)" onmouseover="MM_nbGroup('over','month14','<?php echo $this->_tpl_vars['g_image']; ?>
/form/Quarter2_over.gif','',1)" onmouseout="MM_nbGroup('out')"><img <?php if ($this->_tpl_vars['monthNow'] == 'Q2'): ?>src="<?php echo $this->_tpl_vars['g_image']; ?>
/form/Quarter2_over.gif"<?php else: ?>src="<?php echo $this->_tpl_vars['g_image']; ?>
/form/Quarter2.gif"<?php endif; ?> alt="" border="0" id="month14" /></a></td>
							                                  <td ><a href="javascript:tabMISubmit('mitab','Q3<?php echo $this->_tpl_vars['yearNow']; ?>
', '');" target="_top" onclick="MM_nbGroup('down','group1','month17','',1)" onmouseover="MM_nbGroup('over','month17','<?php echo $this->_tpl_vars['g_image']; ?>
/form/Quarter3_over.gif','',1)" onmouseout="MM_nbGroup('out')"><img <?php if ($this->_tpl_vars['monthNow'] == 'Q3'): ?>src="<?php echo $this->_tpl_vars['g_image']; ?>
/form/Quarter3_over.gif"<?php else: ?>src="<?php echo $this->_tpl_vars['g_image']; ?>
/form/Quarter3.gif"<?php endif; ?> alt="" border="0" id="month17" /></a></td>
							                                  <td ><a href="javascript:tabMISubmit('mitab','Q4<?php echo $this->_tpl_vars['yearNow']; ?>
', '');" target="_top" onclick="MM_nbGroup('down','group1','month06','',1)" onmouseover="MM_nbGroup('over','month06','<?php echo $this->_tpl_vars['g_image']; ?>
/form/Quarter4_over.gif','',1)" onmouseout="MM_nbGroup('out')"><img <?php if ($this->_tpl_vars['monthNow'] == 'Q4'): ?>src="<?php echo $this->_tpl_vars['g_image']; ?>
/form/Quarter4_over.gif"<?php else: ?>src="<?php echo $this->_tpl_vars['g_image']; ?>
/form/Quarter4.gif"<?php endif; ?> alt="" border="0" id="month06" /></a></td>
							                                  <!-- <td ><a href="javascript:openLinkPage('MI','<?php echo $this->_tpl_vars['user']; ?>
','','Q1<?php echo $this->_tpl_vars['yearNow']; ?>
','<?php echo $this->_tpl_vars['status']; ?>
','<?php echo $this->_tpl_vars['copy_to']; ?>
');" target="_top" onclick="MM_nbGroup('down','group1','month11','',1)" onmouseover="MM_nbGroup('over','month11','<?php echo $this->_tpl_vars['g_image']; ?>
/form/Quarter1_over.gif','',1)" onmouseout="MM_nbGroup('out')"><img <?php if ($this->_tpl_vars['monthNow'] == 'Q1'): ?>src="<?php echo $this->_tpl_vars['g_image']; ?>
/form/Quarter1_over.gif"<?php else: ?>src="<?php echo $this->_tpl_vars['g_image']; ?>
/form/Quarter1.gif"<?php endif; ?> alt="" border="0" id="month11" /></a></td>
							                                  <td ><a href="javascript:openLinkPage('MI','<?php echo $this->_tpl_vars['user']; ?>
','','Q2<?php echo $this->_tpl_vars['yearNow']; ?>
','<?php echo $this->_tpl_vars['status']; ?>
','<?php echo $this->_tpl_vars['copy_to']; ?>
');" target="_top" onclick="MM_nbGroup('down','group1','month14','',1)" onmouseover="MM_nbGroup('over','month14','<?php echo $this->_tpl_vars['g_image']; ?>
/form/Quarter2_over.gif','',1)" onmouseout="MM_nbGroup('out')"><img <?php if ($this->_tpl_vars['monthNow'] == 'Q2'): ?>src="<?php echo $this->_tpl_vars['g_image']; ?>
/form/Quarter2_over.gif"<?php else: ?>src="<?php echo $this->_tpl_vars['g_image']; ?>
/form/Quarter2.gif"<?php endif; ?> alt="" border="0" id="month14" /></a></td>
							                                  <td ><a href="javascript:openLinkPage('MI','<?php echo $this->_tpl_vars['user']; ?>
','','Q3<?php echo $this->_tpl_vars['yearNow']; ?>
','<?php echo $this->_tpl_vars['status']; ?>
','<?php echo $this->_tpl_vars['copy_to']; ?>
');" target="_top" onclick="MM_nbGroup('down','group1','month17','',1)" onmouseover="MM_nbGroup('over','month17','<?php echo $this->_tpl_vars['g_image']; ?>
/form/Quarter3_over.gif','',1)" onmouseout="MM_nbGroup('out')"><img <?php if ($this->_tpl_vars['monthNow'] == 'Q3'): ?>src="<?php echo $this->_tpl_vars['g_image']; ?>
/form/Quarter3_over.gif"<?php else: ?>src="<?php echo $this->_tpl_vars['g_image']; ?>
/form/Quarter3.gif"<?php endif; ?> alt="" border="0" id="month17" /></a></td>
							                                  <td ><a href="javascript:openLinkPage('MI','<?php echo $this->_tpl_vars['user']; ?>
','','Q4<?php echo $this->_tpl_vars['yearNow']; ?>
','<?php echo $this->_tpl_vars['status']; ?>
','<?php echo $this->_tpl_vars['copy_to']; ?>
');" target="_top" onclick="MM_nbGroup('down','group1','month06','',1)" onmouseover="MM_nbGroup('over','month06','<?php echo $this->_tpl_vars['g_image']; ?>
/form/Quarter4_over.gif','',1)" onmouseout="MM_nbGroup('out')"><img <?php if ($this->_tpl_vars['monthNow'] == 'Q4'): ?>src="<?php echo $this->_tpl_vars['g_image']; ?>
/form/Quarter4_over.gif"<?php else: ?>src="<?php echo $this->_tpl_vars['g_image']; ?>
/form/Quarter4.gif"<?php endif; ?> alt="" border="0" id="month06" /></a></td> -->
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
					                    	<td background="<?php echo $this->_tpl_vars['g_image']; ?>
/form/bg_underline-link.gif"><img src="<?php echo $this->_tpl_vars['g_image']; ?>
/form/bg_underline-link.gif" width="3" height="3" /></td>
					                    </tr>
					                </table>
				                </td>
				                <td valign="top">
					                <table width="100%" border="0" cellspacing="0" cellpadding="0">
					                    <tr>
					                      <td valign="top" background="<?php echo $this->_tpl_vars['g_image']; ?>
/form/bg_underline-link.gif"><img src="<?php echo $this->_tpl_vars['g_image']; ?>
/form/bg_underline-link.gif" width="3" height="3" /></td>
					                    </tr>
					                </table>
				                </td>
				                <td valign="top">
				                	<table width="100%" border="0" cellspacing="0" cellpadding="0">
					                    <tr>
					                      <td valign="top" background="<?php echo $this->_tpl_vars['g_image']; ?>
/form/bg_underline-link.gif"><img src="<?php echo $this->_tpl_vars['g_image']; ?>
/form/bg_underline-link.gif" width="3" height="3" /></td>
					                    </tr>
				                  	</table>
				                </td>
				              </tr>
				              <!-- End Line -->

				              <tr >
				                <td>
					                <table  border="0" cellspacing="0" cellpadding="0">
					                    <!--tr>
					                      <td width="150" style="cursor: pointer;" height="24" background="<?php echo $this->_tpl_vars['g_image']; ?>
/form/mi-pi-linkover_20.png" onclick="openLinkPage('MI','<?php echo $this->_tpl_vars['user']; ?>
','T1','<?php echo $this->_tpl_vars['monthNow']; ?>
<?php echo $this->_tpl_vars['yearNow']; ?>
','<?php echo $this->_tpl_vars['status']; ?>
','<?php echo $this->_tpl_vars['copy_to']; ?>
');"><div align="right" class="style7">ประเมิน Quarter ปัจจุบัน &nbsp;</div></td>
					                      <td width="150" style="cursor: pointer;" background="<?php echo $this->_tpl_vars['g_image']; ?>
/form/mi-pi-linkover_21.png" onclick="openLinkPage('MI','<?php echo $this->_tpl_vars['user']; ?>
','T2','<?php echo $this->_tpl_vars['monthNow']; ?>
<?php echo $this->_tpl_vars['yearNow']; ?>
','<?php echo $this->_tpl_vars['status']; ?>
','<?php echo $this->_tpl_vars['copy_to']; ?>
');"><div align="right" class="style8">ประเมิน Quarter ถัดไป &nbsp;</div></td>
					                      <td width="149" style="cursor: pointer;" background="<?php echo $this->_tpl_vars['g_image']; ?>
/form/mi-pi-linkover_22.png" onclick="openLinkPage('MI','<?php echo $this->_tpl_vars['user']; ?>
','T3','<?php echo $this->_tpl_vars['monthNow']; ?>
<?php echo $this->_tpl_vars['yearNow']; ?>
','<?php echo $this->_tpl_vars['status']; ?>
','<?php echo $this->_tpl_vars['copy_to']; ?>
');"><div align="center" class="style9">สรุปผล</div></td>
					                    </tr-->
					                    
					                    <tr>
					                      <td width="150" style="cursor: pointer;" height="24" background="<?php echo $this->_tpl_vars['g_image']; ?>
/form/mi-pi-linkover_20.png" onclick="javascript:tabMISubmit('mitab','<?php echo $this->_tpl_vars['monthNow']; ?>
<?php echo $this->_tpl_vars['yearPrv']; ?>
','T1');"><div align="center" class="style7">Quarter ในปี <?php echo $this->_tpl_vars['yearPrv']; ?>
&nbsp;</div></td>
					                      <td width="150" style="cursor: pointer;" background="<?php echo $this->_tpl_vars['g_image']; ?>
/form/mi-pi-linkover_21.png" onclick="javascript:tabMISubmit('mitab','<?php echo $this->_tpl_vars['monthNow']; ?>
<?php echo $this->_tpl_vars['year']; ?>
','T2');"><div align="center" class="style8">Quarter ในปี <?php echo $this->_tpl_vars['year']; ?>
&nbsp;</div></td>
					                      <td width="149" style="cursor: pointer;" background="<?php echo $this->_tpl_vars['g_image']; ?>
/form/mi-pi-linkover_22.png" onclick="javascript:tabMISubmit('mitab','<?php echo $this->_tpl_vars['monthNow']; ?>
<?php echo $this->_tpl_vars['yearNext']; ?>
','T3');"><div align="center" class="style9">Quarter ในปี <?php echo $this->_tpl_vars['yearNext']; ?>
</div></td>
					                    </tr>
					                    
					                    <!-- <tr>
					                      <td width="150" style="cursor: pointer;" height="24" background="<?php echo $this->_tpl_vars['g_image']; ?>
/form/mi-pi-linkover_20.png" onclick="openLinkPage('MI','<?php echo $this->_tpl_vars['user']; ?>
','T1','<?php echo $this->_tpl_vars['monthNow']; ?>
<?php echo $this->_tpl_vars['yearPrv']; ?>
','<?php echo $this->_tpl_vars['status']; ?>
','<?php echo $this->_tpl_vars['copy_to']; ?>
');"><div align="center" class="style7">Quarter ในปี <?php echo $this->_tpl_vars['yearPrv']; ?>
&nbsp;</div></td>
					                      <td width="150" style="cursor: pointer;" background="<?php echo $this->_tpl_vars['g_image']; ?>
/form/mi-pi-linkover_21.png" onclick="openLinkPage('MI','<?php echo $this->_tpl_vars['user']; ?>
','T2','<?php echo $this->_tpl_vars['monthNow']; ?>
<?php echo $this->_tpl_vars['year']; ?>
','<?php echo $this->_tpl_vars['status']; ?>
','<?php echo $this->_tpl_vars['copy_to']; ?>
');"><div align="center" class="style8">Quarter ในปี <?php echo $this->_tpl_vars['year']; ?>
&nbsp;</div></td>
					                      <td width="149" style="cursor: pointer;" background="<?php echo $this->_tpl_vars['g_image']; ?>
/form/mi-pi-linkover_22.png" onclick="openLinkPage('MI','<?php echo $this->_tpl_vars['user']; ?>
','T3','<?php echo $this->_tpl_vars['monthNow']; ?>
<?php echo $this->_tpl_vars['yearNext']; ?>
','<?php echo $this->_tpl_vars['status']; ?>
','<?php echo $this->_tpl_vars['copy_to']; ?>
');"><div align="center" class="style9">Quarter ในปี <?php echo $this->_tpl_vars['yearNext']; ?>
</div></td>
					                    </tr> -->
					                </table>
				                </td>
				              </tr>
				              <tr><td>&nbsp;</td></tr>
			            	</table>
			            	<table width="300" border="0" cellspacing="0" cellpadding="0">
				              <tr>
				                <td width="40"><img src="<?php echo $this->_tpl_vars['g_image']; ?>
/form/Arrow-Left.gif" width="40" height="40" /></td>
				               				              	<td width="238">&nbsp;&nbsp;&nbsp;<span class="style15"><?php echo $this->_tpl_vars['TabName']; ?>
</span></td>
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
								    	<?php $this->assign('i', 1); ?>
								    	<?php unset($this->_sections['col']);
$this->_sections['col']['name'] = 'col';
$this->_sections['col']['loop'] = is_array($_loop=$this->_tpl_vars['column']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['col']['show'] = true;
$this->_sections['col']['max'] = $this->_sections['col']['loop'];
$this->_sections['col']['step'] = 1;
$this->_sections['col']['start'] = $this->_sections['col']['step'] > 0 ? 0 : $this->_sections['col']['loop']-1;
if ($this->_sections['col']['show']) {
    $this->_sections['col']['total'] = $this->_sections['col']['loop'];
    if ($this->_sections['col']['total'] == 0)
        $this->_sections['col']['show'] = false;
} else
    $this->_sections['col']['total'] = 0;
if ($this->_sections['col']['show']):

            for ($this->_sections['col']['index'] = $this->_sections['col']['start'], $this->_sections['col']['iteration'] = 1;
                 $this->_sections['col']['iteration'] <= $this->_sections['col']['total'];
                 $this->_sections['col']['index'] += $this->_sections['col']['step'], $this->_sections['col']['iteration']++):
$this->_sections['col']['rownum'] = $this->_sections['col']['iteration'];
$this->_sections['col']['index_prev'] = $this->_sections['col']['index'] - $this->_sections['col']['step'];
$this->_sections['col']['index_next'] = $this->_sections['col']['index'] + $this->_sections['col']['step'];
$this->_sections['col']['first']      = ($this->_sections['col']['iteration'] == 1);
$this->_sections['col']['last']       = ($this->_sections['col']['iteration'] == $this->_sections['col']['total']);
?>
								    	<td class="font11" width="5%" align="center" style="cursor: pointer;" title="<?php echo $this->_tpl_vars['userColumn'][$this->_tpl_vars['i']]; ?>
"><b>ครั้ง <?php echo $this->_tpl_vars['i']; ?>
</b><br><?php echo $this->_tpl_vars['userColumn'][$this->_tpl_vars['i']]; ?>
</td <?php echo $this->_tpl_vars['i']++; ?>
>
								    	<?php endfor; endif; ?>
								    	<?php if ($this->_tpl_vars['headArr']['mph_status'] != 'F' && $this->_tpl_vars['headArr']['mph_status'] != 'R'): ?>
								    	<td class="font11b" width="8%" align="center" >คะแนนที่ได้ (เต็ม 10)</td>
								    	<?php endif; ?>
								    	<td class="font11b" width="8%" align="center" >คะแนนรวม</td>
								    	<?php if ($this->_tpl_vars['headArr']['mph_status'] == 'C' || $this->_tpl_vars['change']): ?>
								    	<td class="font11b" width="5%" align="center" >Action</td>
								    	<?php endif; ?>
									</tr>
									<tbody id="showTab1">
									</tbody>
									<tr height="20" bgcolor="#CCCCCC">
								    	<td align="right" class="font11b">คะแนนรวม &nbsp;</td>
								    	<td align="center" class="font12"><span id="weight"></span></td>
								     	<?php $this->assign('t', 1); ?>
								     	<?php unset($this->_sections['col']);
$this->_sections['col']['name'] = 'col';
$this->_sections['col']['loop'] = is_array($_loop=$this->_tpl_vars['column']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['col']['show'] = true;
$this->_sections['col']['max'] = $this->_sections['col']['loop'];
$this->_sections['col']['step'] = 1;
$this->_sections['col']['start'] = $this->_sections['col']['step'] > 0 ? 0 : $this->_sections['col']['loop']-1;
if ($this->_sections['col']['show']) {
    $this->_sections['col']['total'] = $this->_sections['col']['loop'];
    if ($this->_sections['col']['total'] == 0)
        $this->_sections['col']['show'] = false;
} else
    $this->_sections['col']['total'] = 0;
if ($this->_sections['col']['show']):

            for ($this->_sections['col']['index'] = $this->_sections['col']['start'], $this->_sections['col']['iteration'] = 1;
                 $this->_sections['col']['iteration'] <= $this->_sections['col']['total'];
                 $this->_sections['col']['index'] += $this->_sections['col']['step'], $this->_sections['col']['iteration']++):
$this->_sections['col']['rownum'] = $this->_sections['col']['iteration'];
$this->_sections['col']['index_prev'] = $this->_sections['col']['index'] - $this->_sections['col']['step'];
$this->_sections['col']['index_next'] = $this->_sections['col']['index'] + $this->_sections['col']['step'];
$this->_sections['col']['first']      = ($this->_sections['col']['iteration'] == 1);
$this->_sections['col']['last']       = ($this->_sections['col']['iteration'] == $this->_sections['col']['total']);
?>
								     	<td align="center"><?php echo $this->_tpl_vars['totalLine'][$this->_tpl_vars['t']]['grade']; ?>
:<?php echo ((is_array($_tmp=$this->_tpl_vars['totalLine'][$this->_tpl_vars['t']]['scoll'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2) : number_format($_tmp, 2)); ?>
</td <?php echo $this->_tpl_vars['t']++; ?>
>
								     	<?php endfor; endif; ?>
								     	<?php if ($this->_tpl_vars['headArr']['mph_status'] != 'F' && $this->_tpl_vars['headArr']['mph_status'] != 'R'): ?>
								    	<td align="center" class="font12"><span id="point"></span></td>
								    	<?php endif; ?>
								    	<td align="center" class="font12"><span id="point_total"></span></td>
								    	<?php if ($this->_tpl_vars['headArr']['mph_status'] == 'C' || $this->_tpl_vars['change']): ?>
								    	<td align="center" ></td>
								    	<?php endif; ?>
									</tr>
							</table>
						</td>
			          </tr>
			          <?php if ($this->_tpl_vars['headArr']['mph_status'] == 'C'): ?>
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
														<img src="<?php echo $this->_tpl_vars['g_image']; ?>
/add.gif" border="0" >
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
			        <?php endif; ?>
			        <tr>
			             <td>
				            <table width="100%" border="0" align="left" cellpadding="0" cellspacing="0">
				                <tr>
						             <td width="65%">
						              	<table width="100%" border="0" align="left" cellpadding="0" cellspacing="0">
							                <tr>
								                <td align="right" width="18%" class="font12">หมายเหตุ :</td>
								                <td align="left" width="80%">
								                    <textarea name="head[mph_desc]" id="detail" rows="5" class="textfield_10c"><?php echo $this->_tpl_vars['headArr']['mph_desc']; ?>
</textarea>
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
						            			<?php if ($this->_tpl_vars['dataRows']): ?>
							            			<img src="<?php echo $this->_tpl_vars['g_image']; ?>
/form/start.png" border="0" title="[ Admin ]">
							            			<img src="<?php echo $this->_tpl_vars['g_image']; ?>
/form/next.gif" border="0" ><img src="<?php echo $this->_tpl_vars['g_image']; ?>
/form/user.png" title="[ <?php echo $this->_tpl_vars['headArr']['user_first_recive']; ?>
 ]" border="0" width="20" height="20">
							            			<?php if ($this->_tpl_vars['headArr']['mph_status'] == 'P' || $this->_tpl_vars['headArr']['mph_status'] == 'R' || $this->_tpl_vars['headArr']['mph_status'] == 'F'): ?>
													<?php $this->assign('u', 1); ?>
								    				<?php unset($this->_sections['col']);
$this->_sections['col']['name'] = 'col';
$this->_sections['col']['loop'] = is_array($_loop=$this->_tpl_vars['column']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['col']['show'] = true;
$this->_sections['col']['max'] = $this->_sections['col']['loop'];
$this->_sections['col']['step'] = 1;
$this->_sections['col']['start'] = $this->_sections['col']['step'] > 0 ? 0 : $this->_sections['col']['loop']-1;
if ($this->_sections['col']['show']) {
    $this->_sections['col']['total'] = $this->_sections['col']['loop'];
    if ($this->_sections['col']['total'] == 0)
        $this->_sections['col']['show'] = false;
} else
    $this->_sections['col']['total'] = 0;
if ($this->_sections['col']['show']):

            for ($this->_sections['col']['index'] = $this->_sections['col']['start'], $this->_sections['col']['iteration'] = 1;
                 $this->_sections['col']['iteration'] <= $this->_sections['col']['total'];
                 $this->_sections['col']['index'] += $this->_sections['col']['step'], $this->_sections['col']['iteration']++):
$this->_sections['col']['rownum'] = $this->_sections['col']['iteration'];
$this->_sections['col']['index_prev'] = $this->_sections['col']['index'] - $this->_sections['col']['step'];
$this->_sections['col']['index_next'] = $this->_sections['col']['index'] + $this->_sections['col']['step'];
$this->_sections['col']['first']      = ($this->_sections['col']['iteration'] == 1);
$this->_sections['col']['last']       = ($this->_sections['col']['iteration'] == $this->_sections['col']['total']);
?>
							            			<img src="<?php echo $this->_tpl_vars['g_image']; ?>
/form/next.gif" border="0" ><img src="<?php echo $this->_tpl_vars['g_image']; ?>
/form/user.png" title="[ <?php echo $this->_tpl_vars['userColumn'][$this->_tpl_vars['u']]; ?>
 ]" border="0" width="20" height="20">
						            				<?php $this->assign('u', $this->_tpl_vars['u']+1); ?>
						            				<?php endfor; endif; ?>
						            				<?php endif; ?>
						            				<?php if ($this->_tpl_vars['headArr']['mph_status'] == 'F'): ?>
						            				<img src="<?php echo $this->_tpl_vars['g_image']; ?>
/form/next.gif" border="0" ><img src="<?php echo $this->_tpl_vars['g_image']; ?>
/form/end.gif" title="[ การเงิน ]" border="0" >
						            				<?php endif; ?>
						            			<?php endif; ?>
						            			</td>
					            			</tr>
					            		</table>
				            		</td>
				                </tr>
				            </table>
			             </td>
			        </tr>
			        <tr><td height="20"></td></tr>
			     <?php if ($this->_tpl_vars['status'] != 'W' && $this->_tpl_vars['status'] != 'O'): ?>
			        <?php if ($this->_tpl_vars['headArr']): ?>
					<?php if ($this->_tpl_vars['headArr']['mph_status'] == 'F' || $this->_tpl_vars['headArr']['mph_status'] == 'R'): ?>
					<?php if ($this->_tpl_vars['_profile']->user_header == 'Y'): ?>
					<tr bgcolor="#EBEBEB">
						<td colspan="2" align="right" >
							<!--input id="btn_copy" title="copy" class="btn_tools" onclick="copyData('<?php echo $this->_tpl_vars['headArr']['mph_id']; ?>
','MI','<?php echo $this->_tpl_vars['copy_to']; ?>
');" value="   Copy" type="button"-->
							<input id="btn_copy" title="copy" class="btn_tools" onclick="copyDataTo('<?php echo $this->_tpl_vars['headArr']['mph_id']; ?>
','<?php echo $this->_tpl_vars['headArr']['mph_month']; ?>
','MI','<?php echo $this->_tpl_vars['headArr']['mph_user']; ?>
');" value="   Copy" type="button">
						</td>
					</tr>
					<?php endif; ?>
					<?php else: ?>
			        <tr bgcolor="#EBEBEB">
						<td colspan="2" align="right" >
							<?php if ($this->_tpl_vars['status'] != 'E'): ?>
							<input id="btn_save" title="Save" class="btn_tools" onclick="sendDataToSave('<?php echo $this->_tpl_vars['headArr']['mph_status']; ?>
','mi','<?php echo $this->_tpl_vars['status']; ?>
','save');" value="   Save" type="button">
							<?php endif; ?>
							<?php if (! $this->_tpl_vars['Finish']): ?>
								<?php if ($this->_tpl_vars['headArr']['mph_status'] == 'C'): ?>
									<input id="btn_list" title="Send To" class="btn_tools" value="  Send To" onclick="chkScollSend('weight','P','mi','<?php echo $this->_tpl_vars['status']; ?>
','<?php echo $this->_tpl_vars['headArr']['mph_user']; ?>
','<?php echo $this->_tpl_vars['headArr']['mph_status']; ?>
','workflow/evaluate/userpopup/pageview/mi/status/<?php echo $this->_tpl_vars['status']; ?>
/depart/<?php echo $this->_tpl_vars['headArr']['user_sec_depart']; ?>
');" type="button">
									<!--input id="btn_list" title="Send To" class="btn_tools" value="  Send To" onclick="sendDataToOwner('P','mi','<?php echo $this->_tpl_vars['status']; ?>
','<?php echo $this->_tpl_vars['headArr']['mph_user']; ?>
');" type="button"-->
								<?php else: ?>
									<input id="btn_list" title="Send To" class="btn_tools" value="  Send To" onclick="chkScoll('weight','workflow/evaluate/userpopup/pageview/mi/status/<?php echo $this->_tpl_vars['status']; ?>
/depart/<?php echo $this->_tpl_vars['headArr']['user_sec_depart']; ?>
','<?php echo $this->_tpl_vars['status']; ?>
');" type="button">
								<?php endif; ?>
							<?php else: ?>
								<?php if ($this->_tpl_vars['headArr']['mph_status'] == 'C'): ?>
								<input id="btn_list" title="Send To" class="btn_tools" value="  Send To" onclick="chkScollSend('weight','P','mi','<?php echo $this->_tpl_vars['status']; ?>
','<?php echo $this->_tpl_vars['headArr']['mph_user']; ?>
','<?php echo $this->_tpl_vars['headArr']['mph_status']; ?>
','workflow/evaluate/userpopup/pageview/mi/status/<?php echo $this->_tpl_vars['status']; ?>
/depart/<?php echo $this->_tpl_vars['headArr']['user_sec_depart']; ?>
');" type="button">
								<!--input id="btn_list" title="Send To" class="btn_tools" value="  Send To" onclick="sendDataToOwner('P','mi','<?php echo $this->_tpl_vars['status']; ?>
','<?php echo $this->_tpl_vars['headArr']['mph_user']; ?>
');" type="button"-->
								<?php else: ?>
								<input id="btn_list" title="Send To" class="btn_tools" value="  Send To" onclick="chkScoll('weight','workflow/evaluate/userpopup/pageview/mi/status/<?php echo $this->_tpl_vars['status']; ?>
','<?php echo $this->_tpl_vars['status']; ?>
');" type="button">
								<input id="btn_accept" title="Finish" class="btn_tools" onclick="sendDataToSave('F','mi','<?php echo $this->_tpl_vars['status']; ?>
','finish');" value="  Finish" type="button">
								<?php endif; ?>
							<?php endif; ?>
							<?php if ($this->_tpl_vars['status'] == 'V'): ?>
							<input id="btn_back" title="Back" class="btn_tools" onclick="openPage('workflow/evaluate/urecive');"  value="  Back" type="button">
							<?php elseif ($this->_tpl_vars['status'] == 'E'): ?>
							<input id="btn_back" title="Back" class="btn_tools" onclick="openPage('workflow/evaluate/history');"  value="  Back" type="button">
							<?php elseif ($this->_tpl_vars['status'] == 'A'): ?>
							<input id="btn_back" title="Back" class="btn_tools" onclick="openPage('workflow/evaluate/accept/type/MI/my/<?php echo $this->_tpl_vars['headArr']['mph_month']; ?>
');"  value="  Back" type="button">
							<?php else: ?>
							<input id="btn_back" title="Back" class="btn_tools" onclick="openPage('workflow/evaluate/view/type/MI/user/<?php echo $this->_tpl_vars['_profile']->user_code; ?>
/status/<?php echo $this->_tpl_vars['status']; ?>
');"  value="  Back" type="button">
							<?php endif; ?>
						</td>
					</tr>
					<?php endif; ?>
					<?php endif; ?>
				<?php else: ?>
					<?php if ($this->_tpl_vars['status'] == 'W'): ?>
					<tr bgcolor="#EBEBEB">
						<td colspan="2" align="right" >
							<input id="btn_back" title="Back" class="btn_tools" onclick="openPage('workflow/summary/incentive/type/MI/my/<?php echo $this->_tpl_vars['headArr']['mph_month']; ?>
');"  value="  Back" type="button">
						</td>
					</tr>
					<?php endif; ?>
				<?php endif; ?>
			        <tr align="right">
				   		<td >
							<table width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#b9b9b9">
						   	<tbody>
						       	<tr align="right">
						           	<td width="12"><img width="12" src="<?php echo $this->_tpl_vars['g_image']; ?>
/buttonmenuleft.gif"/></td>
						            <td>&nbsp;</td>
						            <td width="12"><img width="12" src="<?php echo $this->_tpl_vars['g_image']; ?>
/buttonmenuright.gif"/></td>
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
<input type="hidden" name="loopCol" id="loopCol" value="<?php echo $this->_tpl_vars['column']; ?>
">
<input type="hidden" name="user_recive" id="user_recive" value="<?php echo $this->_tpl_vars['headArr']['mph_user_flow']; ?>
">
<input type="hidden" name="receive_old" id="receive_old" value="<?php echo $this->_tpl_vars['headArr']['mph_user_flow']; ?>
">
<input type="hidden" name="user_send" id="user_send" value="<?php echo $this->_tpl_vars['user_send']; ?>
">
<input type="hidden" name="mode" id="mode">
<input type="hidden" name="checksend" id="checksend">
<input type="hidden" name="page_status" id="page_status" value="<?php echo $this->_tpl_vars['status']; ?>
">
<input type="hidden" name="copy_to" value="<?php echo $this->_tpl_vars['copy_to']; ?>
">
<input type="hidden" name="level_user" value="<?php echo $this->_tpl_vars['headArr']['org_position_level']; ?>
">
<input type="hidden" name="head[mph_id]" value="<?php echo $this->_tpl_vars['headArr']['mph_id']; ?>
">
<input type="hidden" name="head[mph_month]" value="<?php echo $this->_tpl_vars['headArr']['mph_month']; ?>
">
<input type="hidden" name="head[mph_status]" id="status" value="<?php echo $this->_tpl_vars['headArr']['mph_status']; ?>
">
<input type="hidden" name="head[mph_user]" value="<?php echo $this->_tpl_vars['headArr']['mph_user']; ?>
">
<input type="hidden" name="old_status" id="old_status" value="<?php echo $this->_tpl_vars['headArr']['mph_status']; ?>
">
</table>
<?php echo $this->_plugins['function']['add_script'][0][0]->add_script(array('file' => ($this->_tpl_vars['_js'])."/evaluate.js,".($this->_tpl_vars['_js'])."/action.js,".($this->_tpl_vars['_js'])."/_mi.js"), $this);?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['g_template'])."/_footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</form>
</div>
<?php if ($this->_tpl_vars['dataRows']): ?>
<?php $_from = $this->_tpl_vars['dataRows']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
	<script>
		var paramArray = new Array();
			paramArray['id'] = '<?php echo $this->_tpl_vars['item']['mpl_id']; ?>
';
			paramArray['subject'] = '<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['mpl_subject'])) ? $this->_run_mod_handler('replace', true, $_tmp, "'", "\'") : smarty_modifier_replace($_tmp, "'", "\'")); ?>
';
			paramArray['status'] = '<?php echo $this->_tpl_vars['headArr']['mph_status']; ?>
';
			paramArray['change'] = '<?php echo $this->_tpl_vars['change']; ?>
';
			paramArray['wscoll'] = '<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['mpl_weight'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 0) : number_format($_tmp, 0)); ?>
';
			paramArray['rscoll'] = '<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['mpl_point'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2) : number_format($_tmp, 2)); ?>
';
			paramArray['tscoll'] = '<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['mpl_weight']*$this->_tpl_vars['item']['mpl_point'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2) : number_format($_tmp, 2)); ?>
';
			paramArray['JSON'] = '<?php echo $this->_tpl_vars['item']['subColJSON']; ?>
';
			miForm.AddLine(paramArray);
			miForm.SummaryTotal(paramArray);

	</script>
<?php endforeach; endif; unset($_from); ?>
<?php endif; ?>

<form id="mitab" action="/iceworkflow/workflow/evaluate/mifrm" method="POST">
	<input type="hidden" name="user" value="<?php echo $this->_tpl_vars['user']; ?>
" />
	<input type="hidden" name="tab" id="tabyear" value="" />
	<input type="hidden"  name="m" id="tabquarter" value="" />
	<input type="hidden" name="status" value="<?php echo $this->_tpl_vars['status']; ?>
" />
	<input type="hidden" name="copy_to" value="<?php echo $this->_tpl_vars['copy_to']; ?>
" />
	<!-- http://localhost/iceworkflow/workflow/evaluate/mifrm/user/1510583/tab/T2/m/Q42013/status/O/copy_to/ -->
	<!-- 'PI','<?php echo $this->_tpl_vars['user']; ?>
','','01<?php echo $this->_tpl_vars['yearNow']; ?>
','<?php echo $this->_tpl_vars['status']; ?>
','<?php echo $this->_tpl_vars['copy_to']; ?>
 @@@/iceworkflow/workflow/evaluate/pifrm/user/1510583/tab//m/032013/status/W/copy_to/3207-->
</form>

<script>
<?php echo '
	function tabMISubmit(_frm, _q, _y){
		document.getElementById("tabyear").value = _y;
		document.getElementById("tabquarter").value = _q;
		document.getElementById(_frm).submit();
	}
'; ?>

</script>