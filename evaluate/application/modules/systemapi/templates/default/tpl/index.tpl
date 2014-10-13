{include file="$g_template/_header.tpl"}
<!-- Start of body content -->
<div id="content-container">
<table cellpadding="0" cellspacing="0" border="0" width="800" align="center" id="mainTable">
    <tr valign="top">
        <td width="180">{include file="$g_template/_product_directory.tpl"}</td>
        <td>{if $page_content}{$page_content}{else}{include file="$g_template/_pagenotfound.tpl"}{/if}</td>
    </tr>
    <tr height="20">
        <td></td>
        <td></td>
    </tr>
</table>
</div>
<!-- End of body content -->
{include file="$g_template/_footer.tpl"}