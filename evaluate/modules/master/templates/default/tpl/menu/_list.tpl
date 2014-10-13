<table width="100%" cellspacing="0" cellpadding="0" border="0">
    <input type="hidden" id="type" value="{$_params.type}">
    <tbody>
        <tr>
            <td  height="38" class="titlehead">&nbsp;&nbsp;Menu Master</td>
        </tr>
        <tr>
            <td colspan="4" >
                <div id="content-container" style="margin: 0px;padding: 0px;">
                    <table cellpadding="0" cellspacing="0" class="tscrolling" width="100%">
                        <tr>
                            <td>
                                <div>

                                    <input id="btn_new" title="New Module" class="btn_tools" onclick="app.gotoview('/master/menu/form/id/1/type/{$_params.type}')" value="New Module" type="button">
                                </div>
                            </td>
                        </tr>
                    </table>
                    {literal}
                    <script>
                    	$(function(){
                    		$("#menuList").change(function(){
                    			var mod = $("option:selected", this).text();
                    			var type = $('#type').val();
                    			if (mod == "All") mod = "";
                    			app.gotoview('/master/menu/list/mod/'+ mod+'/type/'+type);
                    		});
                    	});
                    </script>
                    {/literal}
                    <table width="100%" align="center" border="0" cellspacing="1" cellpadding="1" >
                        <thead>
                            <tr bgcolor="#C6DCFF" height="20">
                                <td align="center" width="70%" class="tdhead">Menu Name</td>
                                <td colspan="3" width="30%" align="center" class="tdhead">Actions</td>
                            </tr>
                        </thead>
                        <tbody>
                            {foreach from=$menus item="menu"}
                            <tr bgcolor="{cycle values="#ffffff,#EBEBEB"}" height="20">
                                <td>{assign var="repeat" value=$menu.section_level*5} {$menu.section_name|indent:$repeat:"&nbsp;"}{* <strong> [ {$menu.section_left}, {$menu.section_right}, {$menu.section_level} ] </strong>*}</td>
                                <td align="center"><input id="btn_new" title="Add" class="btn_tools" onclick="app.gotoview('/master/menu/form/id/{$menu.section_id}/mod/{$mod}/type/{$_params.type}')" value="Add" type="button"></td>
                                <td align="center"><input id="btn_edit" title="Edit" class="btn_tools" onclick="app.gotoview('/master/menu/form/id/{$menu.section_id}/mode/edit/mod/{$mod}/type/{$_params.type}')" value="Edit" type="button"></td>
                                <td align="center">
                                {if $menu.section_level}
                                    <input id="btn_delete" title="Delete" class="btn_tools" onclick="_confirm('Are you sure to delete this menu ?',function(){ldelim}app.gotoview('/master/menu/delete/id/{$menu.section_id}/mod/{$mod}/type/{$_params.type}'){rdelim})" value="Delete" type="button">
                                {/if}
                                </td>
                                <!--td align="center">
                                {if $menu.section_level}
                                    <input id="btn_move" title="Move" class="btn_tools" onclick="app.gotoview('/master/menu/moveform/id/{$menu.section_id}/mod/{$mod}/type/{$_params.type}')" value="Move" type="button">
                                {/if}
                                </td-->
                            </tr>
{*                            <tr>
                                <td colspan="8" background="{$g_image}/line_hor.gif"></td>
                            </tr>*}
                            {/foreach}
                        </tbody>
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
<script type="text/javascript" language="javascript">
    $(document).ready(function(){
        $("img[@id=img-minimize]").click(function(){
            $($(this).parents("table").get(0))
            .find('div#content-container')
            .slideToggle("slow", function() {
                var _img = $($(this).parents("table").get(0)).find("img#img-minimize").get(0);
                var _flag = _img.src.split("/").pop().split(".")[0];
                if(_flag=="up") _img.src = _img.src.replace("up","down");
                else _img.src = _img.src.replace("down","up")
            });
        });
    });
</script>
{/literal}