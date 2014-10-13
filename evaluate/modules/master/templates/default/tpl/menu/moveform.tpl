{include file="$g_template/_header.tpl"}
<table width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#efefef">
    <tbody>
        <tr>
            <td width="12" height="38"><img src="{$g_image}/leftsidehmenu.gif" /></td>
            <td class="menu">&nbsp;Move Menu</td>
            <td width="43" class="menu" valign="middle" align="right"><img id="img-minimize" src="{$g_image}/up.gif" style="cursor: pointer;" title="{"minimize"|translate}" /><!-- <img src="{$g_image}/b_close.gif" style="cursor: pointer;" title="Close"/>--></td>
            <td width="15"><img src="{$g_image}/rightsidehmenu.gif" /></td>
        </tr>
        <tr>
            <td colspan="4" style="background: #efefef; padding: 5px; padding-top: 0px;border: none; ">
                <div id="content-container" style="margin: 0px;padding: 0px;">
                    <table width="100%" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td>
                                <div style="padding: 4px;">
                                <form name="" id="" method="post" action="/{$projectName}/{$params.module}/{$params.controller}/movebranch/id/{$id}/mod/{$mod}" style="margin: 0px">
                                <table width="100%" border="0" cellpadding="2" cellspacing="0" class="">
                                	<tbody>
                                		<tr>
                                			<td>1) Swapping nodes within the same level and limits of one parent with all its children.</td>
                                		</tr>
                                		<tr>
                                			<td>&nbsp;&nbsp;&nbsp;&nbsp;Choose second section:
                                				<select name="section2_id">
                                                    {foreach from=$branches item="branch"}
                                                	{assign var="repeat" value=$branch.section_level*6}
                                                	<option value="{$branch.section_id}">{$branch.section_name|indent:$repeat:"&nbsp;"}
                                                     {if $id eq $branch.section_id}
                                                     &lt;&lt;&lt;&lt;
                                                     {/if}
                                                     </option>
                                                    {/foreach}
                                                </select>
                                			</td>
                                		</tr>
                                		<tr>
                                			<td>&nbsp;&nbsp;&nbsp;&nbsp;Choose position:
                                				<select name="position">
                                                    <option value="after">After</option>
                                                    <option value="before">Before</option>
                                                </select>
                                			</td>
                                		</tr>
                                		<tr>
                                			<td>&nbsp;<input type="submit" id="btn_save" title="Apply" class="btn_tools" value="Apply"/></td>
                                		</tr>
                                	</tbody>
                                </table>
                                </form>
                                <hr style="height: 1px;"/>
                                <form name="" id="" method="post" action="/{$projectName}/{$params.module}/{$params.controller}/moveallbranch/id/{$id}/mod/{$mod}" style="margin: 0px">
                                <table width="100%" border="0" cellpadding="2" cellspacing="0" class="">
                                	<tbody>
                                		<tr>
                                			<td>2) Assigns a node with all its children to another parent.</td>
                                		</tr>
                                		<tr>
                                			<td>&nbsp;&nbsp;&nbsp;&nbsp;Choose second section:
                                				<select name="section2_id">
                                                	{foreach from=$allbranches item="branch"}
                                                	{assign var="repeat" value=$branch.section_level*6}
                                                	<option value="{$branch.section_id}">{$branch.section_name|indent:$repeat:"&nbsp;"}
                                                     {if $id eq $branch.section_id}
                                                     &lt;&lt;&lt;&lt;
                                                     {/if}
                                                     </option>
                                                     {/foreach}
                                                </select>
                                                <input type="submit" id="btn_save" title="Apply" class="btn_tools" value="Apply"/>
                                			</td>
                                		</tr>
                                	</tbody>
                                </table>
                                </form>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="4">
            <table width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#b9b9b9">
                <tbody>
                    <tr>
                        <td width="12"><img width="12" height="19" src="{$g_image}/buttonmenuleft.gif"/></td>
                        <td> </td>
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