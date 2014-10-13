<?php /* Smarty version 2.6.19, created on 2014-09-08 12:33:14
         compiled from C:%5CAppServ%5Cwww%5CntEvaluation/modules/systemapi/templates/default/tpl/_footer.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'add_script', 'C:\\AppServ\\www\\ntEvaluation/modules/systemapi/templates/default/tpl/_footer.tpl', 9, false),array('function', 'render_javascripts', 'C:\\AppServ\\www\\ntEvaluation/modules/systemapi/templates/default/tpl/_footer.tpl', 10, false),)), $this); ?>
<?php if (! $this->_tpl_vars['_isAjax']): ?>
						</td>
			        </tr>
				</table>
            </td>
        </tr>
	</table>
	<script>var img_path_menu="<?php echo $this->_tpl_vars['g_js']; ?>
";</script>
	<?php echo $this->_plugins['function']['add_script'][0][0]->add_script(array('js' => "modal,utils,".($this->_tpl_vars['g_js'])."/app.js"), $this);?>

	<?php echo $this->_plugins['function']['render_javascripts'][0][0]->render_javascripts(array(), $this);?>

</body>
</html>
<?php endif; ?>