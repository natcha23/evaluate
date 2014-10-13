<?php /* Smarty version 2.6.19, created on 2014-09-11 15:24:14
         compiled from C:%5CAppServ%5Cwww%5CrsEvaluation/modules/systemapi/templates/default/tpl/_header.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'render_stylesheets', 'C:\\AppServ\\www\\rsEvaluation/modules/systemapi/templates/default/tpl/_header.tpl', 7, false),array('function', 'render_jscore', 'C:\\AppServ\\www\\rsEvaluation/modules/systemapi/templates/default/tpl/_header.tpl', 8, false),array('function', 'add_script', 'C:\\AppServ\\www\\rsEvaluation/modules/systemapi/templates/default/tpl/_header.tpl', 65, false),)), $this); ?>
<?php if (! $this->_tpl_vars['_isAjax']): ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $this->_tpl_vars['_title']; ?>
</title>
<?php echo $this->_plugins['function']['render_stylesheets'][0][0]->render_stylesheets(array(), $this);?>

<?php echo $this->_plugins['function']['render_jscore'][0][0]->render_jscore(array(), $this);?>

</head>
<body >
<table cellpadding="0" cellspacing="0" border="0" width="100%" align="center">
	<tr >
   	 	<td colspan="2" valign="top">
			<table cellpadding="0" cellspacing="0" border="0" width="100%" align="center" id="mainTable"  ><!--style="margin-top: 10px;"-->
				<tr bgcolor="#31424A">
			   	 	<td valign="top">
			    		<table width="100%" border="0" cellspacing="0" cellpadding="0">
					      <tr>
					        <td width="198" rowspan="3" valign="top"><img src="<?php echo $this->_tpl_vars['g_image']; ?>
/form/logo_01.gif" width="198" height="108" /></td>
					        <td width="176" align="left" valign="top"><img src="<?php echo $this->_tpl_vars['g_image']; ?>
/form/logo_02.gif" width="176" height="53" />
					        </td>
					        <td>
						        <table width="40%" border="0" align="right" cellpadding="0" cellspacing="0">
						          <tr>
						            <td align="center"><img src="<?php echo $this->_tpl_vars['g_image']; ?>
/form/per.gif" width="18" height="20" /></td>
						            <td align="left" class="style6">&nbsp;<?php if ($this->_tpl_vars['_profile']->user_code == '1001'): ?>-contact-<?php else: ?><?php echo $this->_tpl_vars['_profile']->user_code; ?>
<?php endif; ?> :: <?php echo $this->_tpl_vars['_profile']->user_name; ?>
 <?php echo $this->_tpl_vars['_profile']->user_lname; ?>
 </td>
						            <td width="28"><a href="javascript:checkOut();"><img src="<?php echo $this->_tpl_vars['g_image']; ?>
/form/Logout-icon.gif" alt="Logout" width="28" height="28" border="0" /></a></td>
						            <td width="2%">&nbsp;</td>
						          </tr>
						          <tr height="20">
							          <td align="center" width="18"></td>
							          <td colspan="2" class="style6">&nbsp;<?php echo $this->_tpl_vars['_profile']->position_name; ?>
</td>
							          <td colspan="2">&nbsp;</td>
						          </tr>
						          <tr height="20">
							          <td align="center" width="18"></td>
							          <td colspan="2" class="style6">&nbsp;วันที่ ::&nbsp;<?php echo $this->_tpl_vars['_profile']->dateNow; ?>
</td>
							          <td colspan="2">&nbsp;</td>
						          </tr>
						        </table>
						    </td>
					      </tr>
					      
			    		</table>
			    	</td>
			  	</tr>
			    <tr>
			    	<td height="3" background="<?php echo $this->_tpl_vars['g_image']; ?>
/form/bg_underline-link.gif"><img src="<?php echo $this->_tpl_vars['g_image']; ?>
/form/bg_underline-link.gif" width="3" height="3" /></td><!-- background="<?php echo $this->_tpl_vars['g_image']; ?>
/form/bg_underline-link.gif"-->
			  	</tr>
			</table>
		</td>
	</tr>
	<tr>
	     <td colspan="2"><div id="imenubar"></div></td>
	</tr>
	<tr>
         	<td valign="top" width="220"><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['g_template'])."/_lmenu.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></td>
			<td valign="top" width="100%">
				<table width="100%" border="0" cellpadding="2"><!--class="box"-->
				    <tr>
				    	<td valign="top">
	<!--tr>
		<td valign="top"-->
<?php endif; ?>
<?php echo $this->_plugins['function']['add_script'][0][0]->add_script(array('file' => ($this->_tpl_vars['g_js'])."/jquery.fancybox-1.0.0.js,".($this->_tpl_vars['g_js'])."/shared.js,".($this->_tpl_vars['g_js'])."/utils.js,".($this->_tpl_vars['g_js'])."/ajaxcontent.js,".($this->_tpl_vars['g_js'])."/modal.js"), $this);?>