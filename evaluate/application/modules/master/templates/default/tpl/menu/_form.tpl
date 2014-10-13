<table cellpadding="0" cellspacing="0" border="0" class="tbl">
    <tr >
       <td>
            <div class="corner" style="padding: 0px;">
                <table cellpadding="2" cellspacing="0" width="100%" class="tbl" border="0">
                    {*foreach from=$table.metadata item=field key=fieldName*}
                    {*if !$field.IS_HIDDEN*}
                    <tr>
                        <td width="30%" align="right" class="cell" style="font-weight: bold;vertical-align: top;">
                            {$table.metadata.acc_fname.COLUMN_NAME|translate} &nbsp; : &nbsp;
                        </td>
                        <td class="cell">
                            {$table.metadata.acc_fname.HTML_FIELD}
                        </td>
                         <td width="30%" align="right" class="cell" style="font-weight: bold;vertical-align: top;">
                            {$table.metadata.acc_username.COLUMN_NAME|translate} &nbsp; : &nbsp;
                        </td>
                        <td class="cell">
                            {$table.metadata.acc_username.HTML_FIELD}
                        </td>
                    </tr>
                    <tr>
                        <td width="30%" align="right" class="cell" style="font-weight: bold;vertical-align: top;">
                            {$table.metadata.acc_lname.COLUMN_NAME|translate} &nbsp; : &nbsp;
                        </td>
                        <td class="cell">
                            {$table.metadata.acc_lname.HTML_FIELD}
                        </td>
                         <td width="30%" align="right" class="cell" style="font-weight: bold;vertical-align: top;">
                            {$table.metadata.acc_password.COLUMN_NAME|translate} &nbsp; : &nbsp;
                        </td>
                        <td class="cell">
                            {$table.metadata.acc_password.HTML_FIELD}
                        </td>
                    </tr>
                    <tr>
                        <td width="30%" align="right" class="cell" style="font-weight: bold;vertical-align: top;">
                            {*Status &nbsp; : &nbsp;*}
                        </td>
                        <td class="cell">
                            <!--input type="text" name="" id="" value=""-->
                        </td>
                         <td width="30%" align="right" class="cell" style="font-weight: bold;vertical-align: top;">
                          {if $mode neq "view"}
                            Confirm password &nbsp; : &nbsp;
                          {/if}
                        </td>
                        <td class="cell">
                          {if $mode neq "view"}
                            <input type="password" name="confirmpass" id="confirmpass" value="{if $mode eq 'edit'}*****************{/if}" onchange="checkpass(this,'acc_password');">
                          {/if}
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4" class="cell">
                              <div id="MyTab" class="html-tabs">
                                  <ul>
                                      <li><a href="#MyTab-1"><span>USER INFORMATION</span></a></li>
                                      <li><a href="#MyTab-2"><span>ADDRESS</span></a></li>
                                      <li><a href="#MyTab-3"><span>E-MAIL</span></a></li>
                                  </ul>
                                  <div id="MyTab-1" style="background-color: #9f9f9f;">
                                      {* user information *}
                                      <table cellpadding="0" cellspacing="0" width="100%">
                                        <tr>
                                            <td width="20%" align="right" class="cell" style="font-weight: bold;vertical-align: top;">
                                                {$table.metadata.acc_title_id.COLUMN_NAME|translate} &nbsp; : &nbsp;
                                            </td>
                                            <td class="cell" nowrap="nowrap">
                                                <input type="text" name="title_name" id="title_name" value="{$data_array.title_name}">
                                                <input type="hidden" name="data[acc_title_id]" id="acc_title_id" value="{$data_array.acc_title_id}">
                                                {*$table.metadata.acc_title_id.HTML_FIELD*}&nbsp;
                                                <input type="button" name="opTitle" value="..." onclick="OpenpopPage('popup/page/title/key/acc_title_id/desc/title_name','title');">
                                            </td>
                                             <td width="20%" align="right" class="cell" style="font-weight: bold;vertical-align: top;">
                                                {$table.metadata.acc_office_phone.COLUMN_NAME|translate} &nbsp; : &nbsp;
                                            </td>
                                            <td class="cell">
                                                {$table.metadata.acc_office_phone.HTML_FIELD}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="20%" align="right" class="cell" style="font-weight: bold;vertical-align: top;">
                                                {$table.metadata.acc_dep_id.COLUMN_NAME|translate} &nbsp; : &nbsp;
                                            </td>
                                            <td class="cell">
                                                <input type="text" name="dept_name" id="dept_name" value="{$data_array.dept_name}">
                                                <input type="hidden" name="data[acc_dep_id]" id="acc_dep_id" value="{$data_array.acc_dep_id}">
                                                {*$table.metadata.acc_dep_id.HTML_FIELD*}&nbsp;
                                                <input type="button" name="opDep" value="..." onclick="OpenpopPage('popup/page/department/key/acc_dep_id/desc/dept_name','dep');">
                                            </td>
                                             <td width="20%" align="right" class="cell" style="font-weight: bold;vertical-align: top;">
                                                {$table.metadata.acc_mobile.COLUMN_NAME|translate} &nbsp; : &nbsp;
                                            </td>
                                            <td class="cell">
                                                {$table.metadata.acc_mobile.HTML_FIELD}
                                            </td>
                                        </tr>
                                         <tr>
                                            <td width="30%" align="right" class="cell" style="font-weight: bold;vertical-align: top;">
                                                {$table.metadata.acc_reportto_id.COLUMN_NAME|translate} &nbsp; : &nbsp;
                                            </td>
                                            <td class="cell">
                                                <input type="text" name="acc_reportto_name" id="acc_reportto_name" value="{$data_array.acc_fname}">
                                                <input type="hidden" name="data[acc_reportto_id]" id="acc_reportto_id" value="{$data_array.acc_reportto_id}">
                                                {*$table.metadata.acc_reportto_id.HTML_FIELD*}&nbsp;
                                                <input type="button" name="opReport" value="..." onclick="OpenpopPage('popup/page/account/key/acc_reportto_id/desc/acc_reportto_name','acc');">
                                            </td>
                                             <td width="30%" align="right" class="cell" style="font-weight: bold;vertical-align: top;">
                                                {$table.metadata.acc_other_phone.COLUMN_NAME|translate} &nbsp; : &nbsp;
                                            </td>
                                            <td class="cell">
                                                {$table.metadata.acc_other_phone.HTML_FIELD}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="30%" align="right" class="cell" style="font-weight: bold;vertical-align: top;">
                                               &nbsp;
                                            </td>
                                            <td class="cell">
                                               &nbsp;
                                            </td>
                                             <td width="30%" align="right" class="cell" style="font-weight: bold;vertical-align: top;">
                                                {$table.metadata.acc_fax.COLUMN_NAME|translate} &nbsp; : &nbsp;
                                            </td>
                                            <td class="cell">
                                                {$table.metadata.acc_fax.HTML_FIELD}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="30%" align="right" class="cell" style="font-weight: bold;vertical-align: top;">
                                               &nbsp;
                                            </td>
                                            <td class="cell">
                                               &nbsp;
                                            </td>
                                             <td width="30%" align="right" class="cell" style="font-weight: bold;vertical-align: top;">
                                                {$table.metadata.acc_home_phone.COLUMN_NAME|translate} &nbsp; : &nbsp;
                                            </td>
                                            <td class="cell">
                                                {$table.metadata.acc_home_phone.HTML_FIELD}
                                            </td>
                                        </tr>
                                        <tr>
                                             <td width="30%" align="right" class="cell" style="font-weight: bold;vertical-align: top;">
                                                {$table.metadata.acc_note.COLUMN_NAME|translate} &nbsp; : &nbsp;
                                            </td>
                                            <td class="cell" colspan="2">
                                                {$table.metadata.acc_note.HTML_FIELD}
                                            </td>
                                            <td class="cell">
                                               &nbsp;
                                            </td>
                                        </tr>
                                     </table>
                                    {* end user information *}
                                  </div>
                                  <div id="MyTab-2" style="background-color: #9f9f9f;">
                                      {* adress *}
                                        <table cellpadding="0" cellspacing="0" width="100%">
                                            <tr>
                                                 <td width="20%" align="right" class="cell" style="font-weight: bold;vertical-align: top;">
                                                    {$table.metadata.acc_primary_address.COLUMN_NAME|translate} &nbsp; : &nbsp;
                                                </td>
                                                <td class="cell" colspan="3">
                                                    {$table.metadata.acc_primary_address.HTML_FIELD}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="20%" align="right" class="cell" style="font-weight: bold;vertical-align: top;">
                                                    {$table.metadata.acc_distict_id.COLUMN_NAME|translate} &nbsp; : &nbsp;
                                                </td>
                                                <td class="cell">
                                                    {assign var="district_name" value=district_name_$_lang}
                                                    <input type="text" name="district_name_{$_lang}" id="district_name_{$_lang}" value="{$data_array.$district_name}">
                                                    <input type="hidden" name="data[acc_distict_id]" id="acc_distict_id" value="{$data_array.acc_distict_id}">
                                                    {*$table.metadata.acc_distict_id.HTML_FIELD*}&nbsp;
                                                    <input type="button" name="opDis" value="..." onclick="OpenpopPage('popup/page/district/key/acc_distict_id/desc/district_name_{$_lang}','dist');">
                                                </td>
                                                 <td width="20%" align="right" class="cell" style="font-weight: bold;vertical-align: top;">
                                                    {$table.metadata.acc_city_id.COLUMN_NAME|translate} &nbsp; : &nbsp;
                                                </td>
                                                <td class="cell" nowrap="nowrap">
                                                    <input type="text" name="city_name" id="city_name" value="{$data_array.city_name}">
                                                    <input type="hidden" name="data[acc_city_id]" id="acc_city_id" value="{$data_array.acc_city_id}">
                                                    {*$table.metadata.acc_city_id.HTML_FIELD*}&nbsp;
                                                    <input type="button" name="opCity" value="..." onclick="OpenpopPage('popup/page/city/key/acc_city_id/desc/city_name','city');">
                                                </td>
                                            </tr>
                                             <tr>
                                                <td width="20%" align="right" class="cell" style="font-weight: bold;vertical-align: top;">
                                                    {$table.metadata.acc_province_id.COLUMN_NAME|translate} &nbsp; : &nbsp;
                                                </td>
                                                <td class="cell" width="30%">
                                                    {assign var="province_name" value=province_name_$_lang}
                                                    <input type="text" name="province_name_{$_lang}" id="province_name_{$_lang}" value="{$data_array.$province_name}">
                                                    <input type="hidden" name="data[acc_province_id]" id="acc_province_id" value="{$data_array.acc_province_id}">
                                                    {*$table.metadata.acc_province_id.HTML_FIELD*}&nbsp;
                                                    <input type="button" name="opProv" value="..." onclick="OpenpopPage('popup/page/province/key/acc_province_id/desc/province_name_{$_lang}','prov');">
                                                </td>
                                                 <td width="20%" align="right" class="cell" style="font-weight: bold;vertical-align: top;">
                                                    {$table.metadata.acc_country.COLUMN_NAME|translate} &nbsp; : &nbsp;
                                                </td>
                                                <td class="cell" width="30%">
                                                    {$table.metadata.acc_country.HTML_FIELD}
                                                </td>
                                            </tr>
                                            <tr>
                                                 <td width="20%" align="right" class="cell" style="font-weight: bold;vertical-align: top;">
                                                    {$table.metadata.acc_postcode.COLUMN_NAME|translate} &nbsp; : &nbsp;
                                                </td>
                                                <td class="cell">
                                                    {$table.metadata.acc_postcode.HTML_FIELD}
                                                </td>
                                                <td class="cell" colspan="2">
                                                   &nbsp;
                                                </td>
                                            </tr>
                                          </table>
                                        {* end adress *}
                                  </div>
                                  <div id="MyTab-3" style="background-color: #9f9f9f;">
                                      {* e-mail *}
                                        <table cellpadding="0" cellspacing="0" width="100%">
                                            <tr>
                                                <td width="20%" align="right" class="cell" style="font-weight: bold;vertical-align: top;">
                                                    {$table.metadata.acc_email.COLUMN_NAME|translate} &nbsp; : &nbsp;
                                                </td>
                                                <td class="cell">
                                                    {$table.metadata.acc_email.HTML_FIELD}
                                                </td>
                                                <td class="cell" colspan="2">&nbsp;</td>
                                            </tr>
                                            <tr>
                                                 <td width="20%" align="right" class="cell" style="font-weight: bold;vertical-align: top;">
                                                    {$table.metadata.acc_second_email.COLUMN_NAME|translate} &nbsp; : &nbsp;
                                                </td>
                                                <td class="cell">
                                                    {$table.metadata.acc_second_email.HTML_FIELD}
                                                </td>
                                                <td class="cell" colspan="2">&nbsp;</td>
                                            </tr>
                                          </table>
                                        {* end e-mail *}
                                  </div>
                              </div>
                        </td>
                    </tr>
                    {*/if*}
                    {*/foreach*}

                    {foreach from=$table.metadata item=field key=fieldName}
                    {if $field.IS_HIDDEN}
                    <tr>
                        <td colspan="4" class="cell">{$field.HTML_FIELD}</td>
                    </tr>
                    {/if}
                    {/foreach}
                </table>
            </div>
        </td>
    </tr>
</table>
<script type="text/javascript" charset="utf-8" class="init-script">
{literal}
      $(document).ready(function () {
          $('#MyTab > ul').tabs();// { fx: { opacity: 'toggle',duration: 'fast'} }
          $("#MyTab-1,#MyTab-2,#MyTab-3").corner();
      });
{/literal}
</script>