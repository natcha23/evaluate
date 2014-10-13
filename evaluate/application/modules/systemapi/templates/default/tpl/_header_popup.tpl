{if !$_isAjax}
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>{$_title}</title>
<link rel="stylesheet" href="/iceworkflow/modules/systemapi/templates/default/css/login.css">
{render_stylesheets}
{render_jscore}
</head>
<body >
<table cellpadding="0" cellspacing="0" border="1" width="100%" align="center" id="mainTable" style="margin-top: 10px;">
</table>
{/if}
{add_script file="$g_js/jquery.fancybox-1.0.0.js,$g_js/shared.js,$g_js/utils.js,$g_js/ajaxcontent.js,$g_js/modal.js"}