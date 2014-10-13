<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" href="/iceworkflow/modules/systemapi/templates/default/css/login.css">
<title>{$_title}</title>
{render_jscore}
{render_stylesheets}
<style type="text/css">

</style>
<script type="text/javascript">
{literal}
$(document).ready(function() {
	$('#f_email').focus();
});
{/literal}

</script>
</head>

<body>
<table width="818" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="56">&nbsp;</td>
  </tr>
  <tr>
    <td align="left"><img src="{$g_image}/login/login_04.jpg" width="389" height="79" /></td>
  </tr>
  <tr>
    <td height="66">&nbsp;</td>
  </tr>
  <tr>
    <td width="818" height="108" align="left" background="{$g_image}/login/login_07.jpg">&nbsp;</td>
  </tr>
  <tr>
    <td><table width="818" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="389" height="133" background="{$g_image}/login/login_08.jpg">&nbsp;</td>
        <td align="left" valign="top" background="{$g_image}/login/login_10.jpg"><table width="250" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td class="style2"><img src="{$g_image}/login/space1.gif" width="5" height="5" /></td>
          </tr>
          <tr>
            <td><span class="style2">User Name </span></td>
          </tr>
          <tr>
            <td align="left"><img src="{$g_image}/login/space1.gif" width="5" height="5" /></td>
          </tr>
          <tr>
            <td><input name="username" id="f_email" value="{*$smarty.cookies.defCookie.user*}" type="text" size="30" onkeyup="checkEvent(event);"></td>
          </tr>
          <tr>
            <td><img src="{$g_image}/login/space1.gif" width="5" height="15" /></td>
          </tr>
          <tr>
            <td align="left"><span class="style2">Password</span></td>
          </tr>
          <tr>
            <td><img src="{$g_image}/login/space1.gif" width="5" height="5" /></td>
          </tr>
          <tr>
            <td><input type="password" name="password" id="f_pwd" value="{*$smarty.cookies.defCookie.pwd*}" size="30" onkeyup="checkEvent(event);"></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><table width="818" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="389" height="116" background="{$g_image}/login/login_11.jpg">&nbsp;</td>
        <td align="left" valign="top" background="{$g_image}/login/login_12.jpg"><table width="250" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td colspan="4"><img src="{$g_image}/login/space1.gif" width="5" height="10" /></td>
            </tr>
          <tr>
            <td width="60">&nbsp;</td>
            <td width="60"><table width="60" border="0" cellspacing="0" cellpadding="0">
             <tr>
                <TD COLSPAN=2><a href="javascript:checkLogin();" target="_top" ><img src="{$g_image}/menu/index_28.gif" alt="Login" name="index28" width="62" height="26" border="0" id="index28" onload="" /></a></TD>
              </tr>
            </table></td>
            <td width="10">&nbsp;</td>
            <td align="left"><table width="65" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <TD><a href="javascript:CancelReset();" target="_top" ><img src="{$g_image}/menu/index_30.gif" alt="Cancel" name="index30" width="63" height="26" border="0" id="index30" onload="" /></a></TD>
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
{add_script file="modal,utils,$g_js/jquery.fancybox-1.0.0.js,$g_js/shared.js,$g_js/utils.js,$g_js/ajaxcontent.js,$g_js/modal.js"}
{add_script js="$g_js/app.js"}
{render_javascripts}

