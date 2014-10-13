<?php /* Smarty version 2.6.19, created on 2014-08-28 17:04:04
         compiled from menu/_list.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'cycle', 'menu/_list.tpl', 41, false),array('modifier', 'indent', 'menu/_list.tpl', 42, false),)), $this); ?>
<table width="100%" cellspacing="0" cellpadding="0" border="0">
    <input type="hidden" id="type" value="<?php echo $this->_tpl_vars['_params']['type']; ?>
">
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

                                    <input id="btn_new" title="New Module" class="btn_tools" onclick="app.gotoview('/master/menu/form/id/1/type/<?php echo $this->_tpl_vars['_params']['type']; ?>
')" value="New Module" type="button">
                                </div>
                            </td>
                        </tr>
                    </table>
                    <?php echo '
                    <script>
                    	$(function(){
                    		$("#menuList").change(function(){
                    			var mod = $("option:selected", this).text();
                    			var type = $(\'#type\').val();
                    			if (mod == "All") mod = "";
                    			app.gotoview(\'/master/menu/list/mod/\'+ mod+\'/type/\'+type);
                    		});
                    	});
                    </script>
                    '; ?>

                    <table width="100%" align="center" border="0" cellspacing="1" cellpadding="1" >
                        <thead>
                            <tr bgcolor="#C6DCFF" height="20">
                                <td align="center" width="70%" class="tdhead">Menu Name</td>
                                <td colspan="3" width="30%" align="center" class="tdhead">Actions</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $_from = $this->_tpl_vars['menus']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['menu']):
?>
                            <tr bgcolor="<?php echo smarty_function_cycle(array('values' => "#ffffff,#EBEBEB"), $this);?>
" height="20">
                                <td><?php $this->assign('repeat', $this->_tpl_vars['menu']['section_level']*5); ?> <?php echo ((is_array($_tmp=$this->_tpl_vars['menu']['section_name'])) ? $this->_run_mod_handler('indent', true, $_tmp, $this->_tpl_vars['repeat'], "&nbsp;") : smarty_modifier_indent($_tmp, $this->_tpl_vars['repeat'], "&nbsp;")); ?>
</td>
                                <td align="center"><input id="btn_new" title="Add" class="btn_tools" onclick="app.gotoview('/master/menu/form/id/<?php echo $this->_tpl_vars['menu']['section_id']; ?>
/mod/<?php echo $this->_tpl_vars['mod']; ?>
/type/<?php echo $this->_tpl_vars['_params']['type']; ?>
')" value="Add" type="button"></td>
                                <td align="center"><input id="btn_edit" title="Edit" class="btn_tools" onclick="app.gotoview('/master/menu/form/id/<?php echo $this->_tpl_vars['menu']['section_id']; ?>
/mode/edit/mod/<?php echo $this->_tpl_vars['mod']; ?>
/type/<?php echo $this->_tpl_vars['_params']['type']; ?>
')" value="Edit" type="button"></td>
                                <td align="center">
                                <?php if ($this->_tpl_vars['menu']['section_level']): ?>
                                    <input id="btn_delete" title="Delete" class="btn_tools" onclick="_confirm('Are you sure to delete this menu ?',function(){app.gotoview('/master/menu/delete/id/<?php echo $this->_tpl_vars['menu']['section_id']; ?>
/mod/<?php echo $this->_tpl_vars['mod']; ?>
/type/<?php echo $this->_tpl_vars['_params']['type']; ?>
')})" value="Delete" type="button">
                                <?php endif; ?>
                                </td>
                                <!--td align="center">
                                <?php if ($this->_tpl_vars['menu']['section_level']): ?>
                                    <input id="btn_move" title="Move" class="btn_tools" onclick="app.gotoview('/master/menu/moveform/id/<?php echo $this->_tpl_vars['menu']['section_id']; ?>
/mod/<?php echo $this->_tpl_vars['mod']; ?>
/type/<?php echo $this->_tpl_vars['_params']['type']; ?>
')" value="Move" type="button">
                                <?php endif; ?>
                                </td-->
                            </tr>
                            <?php endforeach; endif; unset($_from); ?>
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
                        <td width="12"><img width="12" height="19" src="<?php echo $this->_tpl_vars['g_image']; ?>
/buttonmenuleft.gif"/></td>
                        <td>&nbsp;</td>
                        <td width="12"><img width="12" height="19" src="<?php echo $this->_tpl_vars['g_image']; ?>
/buttonmenuright.gif"/></td>
                    </tr>
                </tbody>
            </table>
            </td>
        </tr>
    </tbody>
</table>
<?php echo '
<script type="text/javascript" language="javascript">
    $(document).ready(function(){
        $("img[@id=img-minimize]").click(function(){
            $($(this).parents("table").get(0))
            .find(\'div#content-container\')
            .slideToggle("slow", function() {
                var _img = $($(this).parents("table").get(0)).find("img#img-minimize").get(0);
                var _flag = _img.src.split("/").pop().split(".")[0];
                if(_flag=="up") _img.src = _img.src.replace("up","down");
                else _img.src = _img.src.replace("down","up")
            });
        });
    });
</script>
'; ?>