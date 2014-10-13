{capture name=toolbar}
	<table width="100%"	>
		<tr>
			<td align="right">
 				{if !$readonly}
    				<input type="button" class="btn_tools" id="btn_save" value="Save" onclick="checkSaveMenuAuth('{$mode}');">
    			{/if}
					<input id="btn_back" title="Back" class="btn_tools" onclick="app.gotoview('/master/mtmenu/display');" value=" Back " type="button">
            </td>
	</tr>
</table>
{/capture}
{include file="$g_template/_header.tpl"}
<form method="post" action="{$app_url}master/mtmenu/save/_m/{$mode}" id="my_form" enctype="multipart/form-data">
	{foreach from=$lbl key=k1 item=v1}
	    <input type="hidden" id="lbl_{$k1}" value="{$v1}">
	{/foreach}
	<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="white">
		<tr colspan="2">
            <td class="titlehead" colspan="2">&nbsp;Menu Authen</td>
        </tr>
        <tr>
    			<td bgcolor="#EBEBEB">
    				{$smarty.capture.toolbar}
    			</td>
    		</tr>
		<tr height="50">
		    <td align="left" " colspan="2">
		    	&nbsp;&nbsp;&nbsp;
		    	<b>Code Menu Type :</b> <input type="text" value="{$look_menu.lookup_code}" id="lookup_code" {$readonly} class="{$readonly}" name="lookup_code" size="10" {if $mode eq 'edit'}readonly="readonly"{/if}>
		    	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		    	<b>Name Menu Type :</b> <input type="text" value="{$look_menu.lookup_name}" id="lookup_name" {$readonly} class="{$readonly}" name="lookup_name" size="50" {if $mode eq 'edit'}readonly="readonly"{/if}>
		    </td>
		</tr>
		<tr>
		    <td colspan="2">
		    	{$MenuTree}
		    </td>
		</tr>
		<tr>
	    	<td bgcolor="#EBEBEB">
	    		{$smarty.capture.toolbar}
	    	</td>
    	</tr>
    	<tr align="right">
			<td colspan="2">
				<table width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#b9b9b9">
			    	<tbody>
			        	<tr align="right">
			            	<td width="12"><img width="12" height="19" src="{$g_image}/buttonmenuleft.gif"/></td>
			                <td>&nbsp;</td>
			                <td width="12"><img width="12" height="19" src="{$g_image}/buttonmenuright.gif"/></td>
			            </tr>
			        </tbody>
			     </table>
			</td>
        </tr>
	</table>
</form>

{*add_script js="$_js/menu.js"*}
{add_script file="$_js/menu.js"}
{include file="$g_template/_footer.tpl"}