{section loop=$perpage name=record}
    {assign var=key value=$smarty.section.record.index}
    <tr class="{cycle values='rowodd,roweven'}" style="height: 21px;">
        {if $dataArray[$key]}
        <td width="10" colspan="2" align="center" style="border-right: 1px outset #9C9C9C;"></td>
        {foreach from=$dataArray[$key] item=value key=fieldName name=i}
        <td width="10"></td>
        <td {if $fieldName eq 'lookup_date'}align="center"{/if}>{$value|default:'&nbsp;'}</td>
        {/foreach}
        <td></td>
        <td align="center"><input type="button" class="btn_tools" id="btn_delete" value="{'delete'|translate}" onclick="deletemenu('{$dataArray[$key].lookup_name}');"></td>
        <td align="center"><input type="button" class="btn_tools" id="btn_edit" value="{'edit'|translate}" onclick="editmenu('{$dataArray[$key].lookup_name}');"></td>
        <td align="center"><input type="button" class="btn_tools" id="btn_view" value="{'view'|translate}" onclick="viewmenu('{$dataArray[$key].lookup_name}');"></td>
        <td colspan="2"></td>
        {else}
            {if !$dataArray && $key eq 0}
            <td colspan="99" class="blank"><div align="center" style="font-style: italic; color: #666666;border: 1px solid #cccccc;">{'no_data'|translate}</div></td>
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
        <td height="1" colspan="99" bgcolor="#BCBAAE"></td>
    </tr>
    <tr>
        <td height="22" colspan="99">{include file="$g_template/_nev.tpl"}</td>
    </tr>