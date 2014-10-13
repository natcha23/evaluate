<?php /* Smarty version 2.6.19, created on 2014-09-16 19:16:29
         compiled from account/login.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'render_jscore', 'account/login.tpl', 7, false),array('function', 'render_stylesheets', 'account/login.tpl', 8, false),array('function', 'add_script', 'account/login.tpl', 101, false),array('function', 'render_javascripts', 'account/login.tpl', 103, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" href="/iceworkflow/modules/systemapi/templates/default/css/login.css">
<title><?php echo $this->_tpl_vars['_title']; ?>
</title>
<?php echo $this->_plugins['function']['render_jscore'][0][0]->render_jscore(array(), $this);?>

<?php echo $this->_plugins['function']['render_stylesheets'][0][0]->render_stylesheets(array(), $this);?>

<style type="text/css">

</style>
<script type="text/javascript">
<?php echo '
$(document).ready(function() {
	$(\'#f_email\').focus();
});
'; ?>


</script>
</head>

<body>
<table width="818" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="56">&nbsp;</td>
  </tr>
  <tr>
    <td align="left"><img src="<?php echo $this->_tpl_vars['g_image']; ?>
/login/login_04.jpg" width="389" height="79" /></td>
  </tr>
  <tr>
    <td height="66">&nbsp;</td>
  </tr>
  <tr>
    <td width="818" height="108" align="left" background="<?php echo $this->_tpl_vars['g_image']; ?>
/login/login_07.jpg">&nbsp;</td>
  </tr>
  <tr>
    <td><table width="818" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="389" height="133" background="<?php echo $this->_tpl_vars['g_image']; ?>
/login/login_08.jpg">&nbsp;</td>
        <td align="left" valign="top" background="<?php echo $this->_tpl_vars['g_image']; ?>
/login/login_10.jpg"><table width="250" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td class="style2"><img src="<?php echo $this->_tpl_vars['g_image']; ?>
/login/space1.gif" width="5" height="5" /></td>
          </tr>
          <tr>
            <td><span class="style2">User Name </span></td>
          </tr>
          <tr>
            <td align="left"><img src="<?php echo $this->_tpl_vars['g_image']; ?>
/login/space1.gif" width="5" height="5" /></td>
          </tr>
          <tr>
            <td><input name="username" id="f_email" value="" type="text" size="30" onkeyup="checkEvent(event);"></td>
          </tr>
          <tr>
            <td><img src="<?php echo $this->_tpl_vars['g_image']; ?>
/login/space1.gif" width="5" height="15" /></td>
          </tr>
          <tr>
            <td align="left"><span class="style2">Password</span></td>
          </tr>
          <tr>
            <td><img src="<?php echo $this->_tpl_vars['g_image']; ?>
/login/space1.gif" width="5" height="5" /></td>
          </tr>
          <tr>
            <td><input type="password" name="password" id="f_pwd" value="" size="30" onkeyup="checkEvent(event);"></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><table width="818" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="389" height="116" background="<?php echo $this->_tpl_vars['g_image']; ?>
/login/login_11.jpg">&nbsp;</td>
        <td align="left" valign="top" background="<?php echo $this->_tpl_vars['g_image']; ?>
/login/login_12.jpg"><table width="250" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td colspan="4"><img src="<?php echo $this->_tpl_vars['g_image']; ?>
/login/space1.gif" width="5" height="10" /></td>
            </tr>
          <tr>
            <td width="60">&nbsp;</td>
            <td width="60"><table width="60" border="0" cellspacing="0" cellpadding="0">
             <tr>
                <TD COLSPAN=2><a href="javascript:checkLogin();" target="_top" ><img src="<?php echo $this->_tpl_vars['g_image']; ?>
/menu/index_28.gif" alt="Login" name="index28" width="62" height="26" border="0" id="index28" onload="" /></a></TD>
              </tr>
            </table></td>
            <td width="10">&nbsp;</td>
            <td align="left"><table width="65" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <TD><a href="javascript:CancelReset();" target="_top" ><img src="<?php echo $this->_tpl_vars['g_image']; ?>
/menu/index_30.gif" alt="Cancel" name="index30" width="63" height="26" border="0" id="index30" onload="" /></a></TD>
               </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
</body>
</html>
<?php echo $this->_plugins['function']['add_script'][0][0]->add_script(array('file' => "modal,utils,".($this->_tpl_vars['g_js'])."/jquery.fancybox-1.0.0.js,".($this->_tpl_vars['g_js'])."/shared.js,".($this->_tpl_vars['g_js'])."/utils.js,".($this->_tpl_vars['g_js'])."/ajaxcontent.js,".($this->_tpl_vars['g_js'])."/modal.js"), $this);?>

<?php echo $this->_plugins['function']['add_script'][0][0]->add_script(array('js' => ($this->_tpl_vars['g_js'])."/app.js"), $this);?>

<?php echo $this->_plugins['function']['render_javascripts'][0][0]->render_javascripts(array(), $this);?>

