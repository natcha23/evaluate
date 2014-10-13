    {if $header}
    <tr>
        <td width="7" height="35" rowspan="3" valign="top"><img src="{$g_image}/ltable.gif"></td>
        <td rowspan="3" align="center" class="headtable"><input type="checkbox" id="checkall" class="input-checkbox" onclick="app.list.select({ldelim}_this:this,child:'checkrows'{rdelim})"/></td>
        <td width="2" rowspan="3" bgcolor="8A8A8A"><img src="{$g_image}/div.gif"></td>
        {foreach name=tblheader from=$header item=fieldName key=index}
        <td rowspan="3" align="center" class="headtable sortable">{$fieldName|translate}<dfn style="display:none">{$fieldName}</dfn></td>
        <td width="2" rowspan="3" bgcolor="8A8A8A"><img src="{$g_image}/div.gif"></td>
        {/foreach}
        <td height="18" colspan="3" align="center" class="headtable">Action</td>
        <td width="2" rowspan="3" bgcolor="8A8A8A"><img src="{$g_image}/div.gif"></td>
        <td width="7" height="5" rowspan="3" valign="top"><img src="{$g_image}/rtable.gif"></td>
    </tr>
    <tr>
        <td height="1" colspan="3" bgcolor="#FFFFFF"></td>
    </tr>
    <tr>
        <td align="center" class="headtable" style="width: 70px;">View</td>
        <td width="2" bgcolor="8A8A8A"><img src="{$g_image}/div2.gif"></td>
        <td align="center" class="headtable" style="width: 70px;">Edit</td>
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
    <tr>
        <td><input type="button" name="Select" value="Select" onclick="OpenpopPage('popup/page/roles','roles');"></td>
    </tr>
    {/if}
    <tbody id="{$name}_subform">

    </tbody>
    <tr>
        <td colspan="99" height="1" background="{$g_image}/line_hor.gif"></td>
    </tr>
    <tr>
        <td height="1" colspan="99" bgcolor="#BCBAAE"></td>
    </tr>
    <!-- tr>
        <td height="22" colspan="99">{include file="$g_template/_nev.tpl"}</td>
    </tr  -->
