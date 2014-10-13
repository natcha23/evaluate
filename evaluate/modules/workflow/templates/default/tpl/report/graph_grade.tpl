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
				    			<tr bgcolor="#EBEBEB" height="25">
				    				<td class="font11" align="left" ><b>เปรียบเทียบ :</b>
				    					<select name="search[month0]" id="month0" class="selectBox9" >
											{html_options options=$monthOp selected=$month0 }
										</select>
										<select name="search[year0]" id="year0" class="selectBox5"  >
											{html_options options=$yearOp selected=$year0}
										</select>
										<b>กับ :</b>
				    					<select name="search[month]" id="month" class="selectBox9" >
											{html_options options=$monthOp selected=$month }
										</select>
										<select name="search[year]" id="year" class="selectBox5"  >
											{html_options options=$yearOp selected=$year}
										</select>
										<input type="button" id="btn_search" class="btn_tools" value="   Search" name="btt_search" onclick="jsSearch();">
				    				</td>
				    			</tr>
				    			<tr bgcolor="#cccccc" height="25">
					    			<td>
					    			</td>
				    			</tr>
				    			{if $graph}
				    			<tr>
									<td width="100%" align="center">{$graph}</td>
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
