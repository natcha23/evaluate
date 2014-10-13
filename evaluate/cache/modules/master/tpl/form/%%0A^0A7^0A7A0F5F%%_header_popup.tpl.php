<?php /* Smarty version 2.6.19, created on 2014-10-01 15:50:56
         compiled from C:%5CAppServ%5Cwww%5CrsEvaluation/modules/systemapi/templates/default/tpl/_header_popup.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'render_stylesheets', 'C:\\AppServ\\www\\rsEvaluation/modules/systemapi/templates/default/tpl/_header_popup.tpl', 8, false),array('function', 'render_jscore', 'C:\\AppServ\\www\\rsEvaluation/modules/systemapi/templates/default/tpl/_header_popup.tpl', 9, false),array('function', 'add_script', 'C:\\AppServ\\www\\rsEvaluation/modules/systemapi/templates/default/tpl/_header_popup.tpl', 15, false),)), $this); ?>
<?php if (! $this->_tpl_vars['_isAjax']): ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $this->_tpl_vars['_title']; ?>
</title>
<link rel="stylesheet" href="/iceworkflow/modules/systemapi/templates/default/css/login.css">
<?php echo $this->_plugins['function']['render_stylesheets'][0][0]->render_stylesheets(array(), $this);?>

<?php echo $this->_plugins['function']['render_jscore'][0][0]->render_jscore(array(), $this);?>

</head>
<body >
<table cellpadding="0" cellspacing="0" border="1" width="100%" align="center" id="mainTable" style="margin-top: 10px;">
</table>
<?php endif; ?>
<?php echo $this->_plugins['function']['add_script'][0][0]->add_script(array('file' => ($this->_tpl_vars['g_js'])."/jquery.fancybox-1.0.0.js,".($this->_tpl_vars['g_js'])."/shared.js,".($this->_tpl_vars['g_js'])."/utils.js,".($this->_tpl_vars['g_js'])."/ajaxcontent.js,".($this->_tpl_vars['g_js'])."/modal.js"), $this);?>