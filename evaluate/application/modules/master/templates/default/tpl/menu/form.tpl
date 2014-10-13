{include file="$g_template/_header.tpl"}
<table width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#efefef">
    <tbody>
        <tr>
			<td colspan="4" align="center">
				 <table bgcolor="#ffffff" cellpadding="0" cellspacing="1" width="100%" border="0" >
					   <tr >
					        <td height="38" class="titlehead">&nbsp;{if $mode eq "edit"}Edit{else}New{/if} Menu</td>
				       </tr>
				 </table>
	        </td>
		</tr>
        <tr>
            <td colspan="4" style="background: #efefef; padding: 5px; padding-top: 0px;border: none; ">
                <div id="content-container" style="margin: 0px;padding: 0px;">
                <form name="" id="" method="post"
                    {if $mode eq "edit"}
                	action="/{$projectName}/master/menu/edit/id/{$id}/mod/{$mod}/type/{$_params.type}"
                	{else}
                	action="/{$projectName}/master/menu/add/id/{$id}/mod/{$mod}/type/{$_params.type}"
                	{/if}
                	>
                <table cellpadding="0" cellspacing="0" border="0" class="tbl" style="background-color: transparent;">
                    <tbody>
                        <tr><td colspan="3">&nbsp;</td></tr>
                		<tr>
                            <td></td>
                			<td>
                                <b>Menu name(TH): </b><input type="text" name="section[section_name]" value="{$section.section_name}" />
                                <!--b>Menu name(EN): </b><input type="text" name="section[section_name][EN]" value="{$section.section_name.EN}" /-->
                			    <b>Link : </b><input type="text" name="section[section_link]" value="{$section.section_link}" />
                                <input type="submit" id="btn_save" class="btn_tools" name="btn_save" value="{"save"|translate}"/>
                                <input type="reset" id="btn_cancel" class="btn_tools" name="btn_reset" value="Reset"/>
                			</td>
                		</tr>
                	</tbody>
                </table>
                </form>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="4">
            <table width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#b9b9b9">
                <tbody>
                    <tr>
                        <td width="12"><img width="12" height="19" src="{$g_image}/buttonmenuleft.gif"/></td>
                        <td>&nbsp;</td>
                        <td width="12"><img width="12" height="19" src="{$g_image}/buttonmenuright.gif"/></td>
                    </tr>
                </tbody>
            </table>
            </td>
        </tr>
    </tbody>
</table>
{include file="menu/_list.tpl" menus=$menus}
{include file="$g_template/_footer.tpl"}