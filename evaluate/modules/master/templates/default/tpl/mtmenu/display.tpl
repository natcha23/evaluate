{if !$_isAjax}
{include file="$g_template/_header.tpl"}
<form name="{$name}_form" id="{$name}_form" action="{$base_url}" method="post" enctype="application/x-www-form-urlencoded" class="form-check" style="margin: 0px;">
    <div id="{$name}_container">
{foreach from=$lbl key=k1 item=v1}
    <input type="hidden" id="lbl_{$k1}" value="{$v1}">
{/foreach}
{/if}
<table width="100%" cellspacing="0" cellpadding="0" border="0" >
    <tbody>
        <tr>
            <td  height="38" class="titlehead">&nbsp;&nbsp;Menu Authen</td>
        </tr>
        <tr>
            <td >
            {include file="$_template/mtmenu/_list.tpl"}
            </td>
        </tr>
    </tbody>
</table>
{if !$_isAjax}
    </div>
</form>
{literal}
<script type="text/javascript" language="javascript">
/*$(document).ready(function(){
    $("#btn_new").removeAttr("onclick").click(function(){
        app.gotoview("/master/mtmenu/form/_m/new");
    });
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
 $(document).ajaxComplete(function(){
     $("#btn_new").removeAttr("onclick").click(function(){
         app.gotoview("/master/mtmenu/form/_m/new");
    });
 });*/
function editmenu(code){
   app.gotoview("/master/mtmenu/form/_m/edit/code/"+code);
}
function viewmenu(code){
   app.gotoview("/master/mtmenu/form/_m/view/code/"+code);
}
</script>
{/literal}
{add_script js="$_js/menu.js"}
{include file="$g_template/_footer.tpl"}
{/if}