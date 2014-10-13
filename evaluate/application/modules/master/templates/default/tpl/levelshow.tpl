{include file="$g_template/_header.tpl"}
<div id="content-container">
<form method="post" action="" id="_grade" enctype="multipart/form-data">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td valign="top">
    	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	      <tr>
			<!--detail-->
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
				    			<tr bgcolor="#C6DCFF" height="25">
				    				<td class="font11b" align="center" width="5%"> No. </td>
				    				<td class="font11b" align="center" width="25%"> ระดับ Level </td>
				    				{foreach from=$grade item=grd}
				    				<td class="font11b" align="center" width="13%" nowrap>
				    					{$grd.grade}<br>{$grd.start_scoll|number_format:2} - {$grd.end_scoll|number_format:2}
				    				</td>
				    				{/foreach}
				    			</tr>
				    			{assign var="loopH" value=1}
				    			{foreach from=$level item=item key=key}
				    			<tr height="20" bgcolor="{cycle values="#ffffff,#EBEBF5"}" id="tr_{$item.gr_id}">
				    				<td align="center" class="font12">{$loopH}.</td>
				    				<td align="left" class="font12" >&nbsp;{$item.lv_code} : {$item.lv_shotname}</td>
				    				{foreach from=$grade item=grd}
				    				{assign var="_grade" value=$grd.grade}
				    				<td class="font12" align="right" >{$rows.$key.$_grade.money|number_format:0}&nbsp;&nbsp;</td>
				    				{/foreach}
				    			</tr {$loopH++}>
					    		{/foreach}
				    		</table>
				    	</td>
				    </tr>
				    <tr align="right">
			            <td colspan="2">
			            <table width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#b9b9b9">
			                <tbody>
			                    <tr align="right">
			                        <td width="12"><img width="12" height="19" src="{$g_image}/buttonmenuleft.gif"/></td>
			                        <td>&nbsp;</td>
			                        <td width="12"><img width="12" height="19" src="{$g_image}/buttonmenuright.gif"/></td>
			                    </tr>
			                </tbody>
			            </table>
			            </td>
			        </tr>
			        <tr>
			            <td colspan="2">&nbsp;</td>
			        </tr>
			      </table>
			   </td>
	        <!-- end detail-->
	      	</tr>
    	</table>
    </td>
  </tr>
</table>
{add_script file="$_js/master.js"}
{include file="$g_template/_footer.tpl"}
</form>
</div>