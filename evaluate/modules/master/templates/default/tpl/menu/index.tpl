{include file="$g_template/_header.tpl"}
<table width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#efefef">
    <tbody>
        <tr>
            <td width="12" height="38"></td>
            <td class="menu">&nbsp;Menu Master</td>
            <td width="43" class="menu" valign="middle" align="right"></td>
            <td width="15"></td>
        </tr>
        <tr>
            <td colspan="4" style="background: #efefef; padding: 5px; padding-top: 0px;border: none; ">
                <div id="content-container" style="margin: 0px;padding: 0px;">
                    <table cellpadding="0" cellspacing="0">
                        <tr>
                            <td>
                                <select name="menuList" id="menuList">
                                    <option value="" label="All">All</option>
                                    {html_options options=$moduleList selected=`$mod`}
                                </select>
                                <input id="btn_opt" title="Manage Menu" class="btn_tools" onclick="app.gotoview('/master/menu/list')" value="Manage Menu" type="button">
                                {*<input id="btn_list" title="All" class="btn_tools" onclick="app.gotoview('/master/menu/index')" value="All" type="button">*}
                            </td>
                        </tr>
                    </table>
                    <table cellpadding="0" cellspacing="0">
                        <tr>
                            <td>{html_dbtree data=$menuList id="MyTree" class="filetree"}</td>
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
                        <td>&nbsp;</td>
                        <td width="12"><img width="12" height="19" src="{$g_image}/buttonmenuright.gif"/></td>
                    </tr>
                </tbody>
            </table>
            </td>
        </tr>
    </tbody>
</table>
{literal}
<script>
    $(function(){
        $("#menuList").change(function(){
            var mod = $("option:selected", this).text();
            if (mod == "All") mod = "";
            app.gotoview("/master/menu/index/mod/"+ mod);
        });

        $("#img-minimize").click(function(){
            $("#content-container").slideToggle("slow", function() {
                var _flag = $("#img-minimize").get(0).src.split("/").pop().split(".")[0];
                if(_flag=="up") $("#img-minimize").get(0).src = $("#img-minimize").get(0).src.replace("up","down");
                else $("#img-minimize").get(0).src = $("#img-minimize").get(0).src.replace("down","up")
            });
        });
    });
</script>
{/literal}
{add_script js="corner,form"}
{include file="$g_template/_footer.tpl"}