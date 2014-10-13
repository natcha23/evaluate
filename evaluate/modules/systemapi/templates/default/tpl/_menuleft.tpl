		<td width="201" valign="top" id="_menuhide" bgcolor="#E0E0E0">
			<table width="201" height="100%" border="0" cellpadding="0" cellspacing="0" id="test">
				<tr>
					<td width="15"></td>
					<td >
						<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0" >
							<tr height="20">
								<td></td>
							</tr>
							<tr>
								<td >
									<!-- ======== table menu ========== -->
							            <table width="164" border="0" cellspacing="0" cellpadding="0">
							              <tr>
							                <td><img src="{$g_image}/form/left-menu_top.gif" width="164" height="13" /></td>
							              </tr>
							              <tr>
							                <td background="{$g_image}/form/left-menu_bg.gif">
								                <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
								                    <tr>
								                      <td colspan="2">&nbsp;</td>
								                    </tr>
								                    {foreach from=$_menuLeft item=menu key=key}
								                    <tr>
								                      <td><img src="{$g_image}/form/left-menu_icon.gif" width="29" height="26" /></td>
								                      <td>
									                      <table width="93%" border="0" cellspacing="0" cellpadding="0">
									                          <tr>
									                            <td id="txt_link" ><span class="style6">&nbsp;<a href="javascript:openLinkMenu('{$menu.menu_pageurl}');">{$menu.menu_name}</a></span></td>
									                          </tr>
									                      </table>
								                      </td>
								                    </tr>
								                    <tr>
								                      <td height="11" colspan="2"><div align="center"><img src="{$g_image}/form/line2.gif" width="148" height="12" /></div></td>
								                    </tr>
								                    {/foreach}
								                    <tr>
								                      <td height="11" colspan="2">&nbsp;</td>
								                    </tr>
								                </table>
							                </td>
							              </tr>
							              <tr>
							                <td><img src="{$g_image}/form/left-menu_bottom.gif" width="164" height="14" /></td>
							              </tr>
							            </table>
						          <!-- ======== end table menu ========== --> 
								</td>
							</tr>
						</table>
					</td>
					<td id="_imghide" valign="top" bgcolor="#E0E0E0">
						<img src="{$g_image}/form/hidden-icon.png" width="20" style="cursor: pointer;" height="60" onclick="jsHideMenu();"/>
					</td>					
					
				</tr>
			</table>
       </td>
       <td id="_imgshow" valign="top" bgcolor="#E0E0E0" style="display:none">
			<img src="{$g_image}/form/open-icon.png" width="20" height="60" style="cursor: pointer;" onclick="jsShowMenu();"/>
	   </td>