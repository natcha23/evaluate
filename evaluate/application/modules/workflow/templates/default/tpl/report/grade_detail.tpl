{include file="$g_template/_header.tpl"}
<div id="content-container">
<form method="post" action="" id="_portal" enctype="multipart/form-data">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td valign="top">
    	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	      <tr>
				<td valign="top" bgcolor="#FFFFFF">
					<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
					  <tr>
				    	<td colspan="2" align="center">
				    		<table bgcolor="#ffffff" cellpadding="0" cellspacing="1" width="100%" border="0" >
					    		<tr >
					                <td height="38" class="titlehead">&nbsp;{$headPage}</td>
				              	</tr>
				    		</table>
	        			</td>
					  </tr>
					  <tr>
				    	<td colspan="2" align="center">
				    		<table bgcolor="#ffffff" cellpadding="0" cellspacing="1" width="100%" border="0" style="border:1px solid #B9B9B9;">
				    			<tr bgcolor="#cccccc" height="25">
					    			{if $employee}
					    			<td align="left" class="font12b">{$employee}</td>
					    			<td align="right"><input id="btn_back" title="Back" class="btn_tools" onclick="openPage('workflow/report/empinyear/year/{$year}/group/{$group}');"  value="  Back" type="button"></td>
					    			{else}
					    			<td align="right"><input id="btn_back" title="Back" class="btn_tools" onclick="openPage('workflow/report/display/month0/{$month0}/month/{$month}');"  value="  Back" type="button"></td>
					    			{/if}

				    			</tr>
				    			{if $graph}
				    			<tr>
									<td width="100%" colspan="2" align="center">{$graph}</td>
  								<tr>
  								{/if}

							</table>
				    	</td>
				    </tr>
			       <tr align="right">
				   		<td colspan="2">
							<table width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#b9b9b9">
						   	<tbody>
						       	<tr align="right">
						           	<td width="12"><img width="12" src="{$g_image}/buttonmenuleft.gif"/></td>
						            <td>&nbsp;</td>
						            <td width="12"><img width="12" src="{$g_image}/buttonmenuright.gif"/></td>
						        </tr>
						    </tbody>
				 	        </table>
					    </td>
					</tr>
			    </table>
			  </td>
	        <!-- end detail-->
	      </tr>
    	</table>
    </td>
  </tr>
</table>
</form>
</div>
{$graphmap}
{add_script file="$_js/evaluate.js"}
{include file="$g_template/_footer.tpl"}
