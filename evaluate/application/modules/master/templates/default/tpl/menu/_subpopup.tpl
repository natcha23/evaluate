{include file="$g_template/_header.tpl"}
<div id="{$name}_container">
    <table cellpadding="0" cellspacing="0" width="100%" border="0">
        <tr>
            <td>
                <table cellpadding="0" cellspacing="0" >
                  <tr >
                    <td class="etemplate_tab_active th" id="product.edit.search-tab" onmouseover="self.status='Location, Start- and Endtimes, ...'; return true;" onmouseout="self.status=''; return true;">List Accounts</td>
                  </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td class="tab_body">
                <div style="display: inline;" id="{$name}.list">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tbl">
                        <tr>
                            <td>{html_toolsbar name=$name buttons="close" base_url=$base_url search=false}</td>
                        </tr>
                    </table>
                    <div id="{$name}_listcontainer">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tbl">
                            {if $header}
                            <tr>
                                <td width="7" height="35" rowspan="3" valign="top"><img src="{$g_image}/ltable.gif"></td>
                                <td width="2" rowspan="3" bgcolor="8A8A8A"><img src="{$g_image}/div.gif"></td>
                                {foreach name=tblheader from=$header item=fieldName key=index}
                                <td rowspan="3" align="center" class="headtable">{$fieldName|translate}</td>
                                <td width="2" rowspan="3" bgcolor="8A8A8A"><img src="{$g_image}/div.gif"></td>
                                {/foreach}
                                <td height="18" align="center" class="headtable">Action</td>
                                <td width="2" rowspan="3" bgcolor="8A8A8A"><img src="{$g_image}/div.gif"></td>
                                <td width="7" height="5" rowspan="3" valign="top"><img src="{$g_image}/rtable.gif"></td>
                            </tr>
                            <tr>
                                <td height="1" colspan="3" bgcolor="#FFFFFF"></td>
                            </tr>
                            <tr>
                                <td align="center" class="headtable" style="width: 70px;">Select</td>
                            </tr>
                            {else}
                            <tr>
                                <td width="7" height="35" rowspan="3" valign="top"><img src="{$g_image}/ltable.gif"></td>
                                <td height="18" colspan="97" class="headtable">&nbsp;</td>
                                <td width="7" height="5" rowspan="3" valign="top"><img src="{$g_image}/rtable.gif"></td>
                            </tr>
                            <tr>
                                <td height="1" colspan="99" bgcolor="#FFFFFF"></td>
                            </tr>
                            <tr>
                                <td width="2" class="headtable" colspan="99" bgcolor="8A8A8A">&nbsp;</td>
                            </tr>
                            {/if}
                            {section loop=$perpage name=record}
                            {assign var=key value=$smarty.section.record.index}
                            <tr class="{cycle values='rowodd,roweven'}" style="height: 21px;">
                                {if $dataArray[$key]}
                                <td width="2" bgcolor="#DDDDDD"></td>
                                {foreach from=$dataArray[$key] item=value key=fieldName}
                                <td width="2"></td>
                                <td>{$value|default:'&nbsp;'}</td>
                                {/foreach}
                                <td width="2"></td>
                                <td align="center">
                                    <div class="btn" onclick="popupSelect2Parrent({ldelim}name:'{$name}',mode:'view',fname:'{$dataArray[$key].acc_fname}',lname:'{$dataArray[$key].acc_lname}',url:'{$base_url}',id:'{$dataArray[$key][$fieldId]}'{rdelim});"><img id="view" src="{$g_image}/shared/toolsbar/select.gif"></div>
                                </td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                {else}
                                {if !$dataArray && $key eq 0}
                                <td colspan="99" class="blank"><div align="center" style="font-style: italic; color: #666666;border: 1px solid #cccccc;">Data not found !</div></td>
                                {else}
                                <td colspan="99" class="blank">&nbsp;</td>
                                {/if}
                                {/if}
                            </tr>
                            {if $dataArray[$key]}
                            <tr>
                                <td colspan="99" background="{$g_image}/line_hor.gif"></td>
                            </tr>
                            {/if}
                            {/section}
                            <tr>
                                <td colspan="99" height="1" background="{$g_image}/line_hor.gif"></td>
                            </tr>
                            <tr>
                                <td height="1" colspan="99" bgcolor="#BCBAAE"></td>
                            </tr>
                            <tr>
                                <td height="22" colspan="99">{include file="$g_template/_nev.tpl"}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </td>
        </tr>
    </table>
</div>
{include file="$g_template/_footer.tpl"}