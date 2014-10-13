{include file="$g_template/_header.tpl"}
<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="white">
<tr>
    <td align="center" class="font_head">{'view'|translate} {'menu_name_master'|translate}</td>
</tr>
<tr>
    <td align="center" class="headtable">{"menu_name"|translate} : <input type="text" value="{$name}" id="menu" onkeyup="$(this).css('background-color','');" width="100" readonly="readonly"></td>
</tr>
<tr>
    <td align="center"><b>{'list_menu_item'|translate}</b></td>
</tr>
<tr>
    <td>
    <table align="center" border="0" cellpadding="0" cellspacing="0" style="height:400px;width:70%;background-color:#EFEFEF;" class="tbl">
       <tbody style="height:400px;overflow: auto;overflow-x:hidden;"><tr valign="top"><td>{html_dbtree data=$data id="MyTree" class="filetree"}</td></tr></tbody>
    </table>
    </td>
</tr>
<tr>
<td align="right"><input type="button" class="btn_tools" id="btn_close" value="{"close"|translate}" onclick="window.close();"></td>
</tr>
</table>
<script>
{literal}
    $(document).ready(function(){
        $("a").each(function(){
            $(this).attr("href","javascript:void(0);");
        });
    });
{/literal}
</script>
{add_script js="tree,corner,form"}
{include file="$g_template/_footer.tpl"}