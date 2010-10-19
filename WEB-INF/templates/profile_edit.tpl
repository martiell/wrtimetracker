{$forms.profileForm.open}

{if $can_set_custom_datetime_formats}
{include file="custom_datetime_format_preview.tpl"}
{/if}

<table cellspacing="4" cellpadding="7" border="0">
  <tbody>
    <tr>
      <td>

          <table id="table1" cellspacing="1" cellpadding="2" border="0">
            <tr>
              <td align = "right" nowrap>{$i18n.form.profile.name} (*):</td>
              <td>{$forms.profileForm.uname.control}</td>
            </tr>
            <tr>
              <td align = "right" nowrap>{$i18n.form.profile.login} (*):</td>
              <td>{$forms.profileForm.login.control}</td>
            </tr>

            {if !$auth_is_password_external}
            <tr>
              <td align = "right" nowrap>{$i18n.form.profile.pas1} (*):</td>
              <td>{$forms.profileForm.pas1.control}</td>
            </tr>
            <tr>
              <td align = "right" nowrap>{$i18n.form.profile.pas2} (*):</td>
              <td>{$forms.profileForm.pas2.control}</td>
            </tr>
            {/if}

            <tr>
              <td align = "right" nowrap>{$i18n.form.profile.email}:</td>
              <td>{$forms.profileForm.email.control}</td>
            </tr>

            {if $user->isManager() || $user->isAdministrator()}
            <tr>
              <td align = "right" nowrap>{$i18n.form.profile.comp} (*):</td>
              <td>{$forms.profileForm.comp.control}</td>
            </tr>
            {if !$user->isAdministrator()}
            <tr>
              <td align = "right">{$i18n.form.profile.www}:</td>
              <td>{$forms.profileForm.www.control}</td>
            </tr>
            <tr>
              <td align = "right">{$i18n.form.profile.curr}:</td>
              <td>{$forms.profileForm.curr.control}</td>
            </tr>
            <tr>
              <td align = "right" nowrap>{$i18n.form.admin.lock.period}:</td>
              <td>{$forms.profileForm.locktime.control}</td>
            </tr>
	          <tr>
              <td align = "right" nowrap>{$forms.profileForm.show_pie.control} {$i18n.form.profile.showchart}:</td>
              <td>{$forms.profileForm.pie_mode.control}</td>
            </tr>
            {/if}
            {/if}

            {if $user->isManager() || $cl_lang_allow_user_change}
            <tr>
	            <td align = "right" nowrap>{$i18n.form.profile.lang}:</td>
	            <td>{$forms.profileForm.lang.control}</td>
            </tr>
            {/if}
            {if $user->isManager()}
            <tr>
	            <td align = "right" nowrap>&nbsp;</td>
	            <td>{$forms.profileForm.lang_set_to_all.control} {$i18n.form.profile.lang_set_to_all}</td>
            </tr>
            <tr>
	            <td align = "right" nowrap>&nbsp;</td>
	            <td>{$forms.profileForm.lang_allow_user_change.control} {$i18n.form.profile.lang_allow_user_change}</td>
            </tr>
            {/if}

            {if $can_set_custom_datetime_formats}
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td align = "right" nowrap>{$i18n.form.profile.custom_date_format}:</td>
              <td>{$forms.profileForm.format_date.control} <font id="custom_date_format_preview" color="#777777">&nbsp;</font></td>
            </tr>
            <tr>
              <td align = "right" nowrap>{$i18n.form.profile.custom_time_format}:</td>
              <td>{$forms.profileForm.format_time.control} <font id="custom_time_format_preview" color="#777777">&nbsp;</font></td>
            </tr>
            <tr>
              <td align = "right" nowrap>{$i18n.form.profile.start_week}:</td>
              <td>{$forms.profileForm.start_week.control}</td>
            </tr>

            {* initialize preview text *}
            {literal}
            <script type="text/javascript">
              SetCustomDateTimeFormatPreview("custom_date_format_preview", document.getElementById("format_date"));
              SetCustomDateTimeFormatPreview("custom_time_format_preview", document.getElementById("format_time"));
            </script>
            {/literal}

            {if $can_hide_world_clock}
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td align = "right" nowrap>{$i18n.form.profile.hide_world_clock}:</td>
              <td>{$forms.profileForm.hide_world_clock.control}</td>
            </tr>
            {/if}

            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            {/if}


            <tr>
              <td></td>
              <td>{$i18n.label.req_fields}</td>
            </tr>
            <tr>
              <td colspan = 2>&nbsp;</td>
            </tr>
            <tr>
              <td colspan="2" height="50" align="center">{$forms.profileForm.btsubmit.control}&nbsp;{$forms.profileForm.btcancel.control}</td>
            </tr>
          </table>

      </td>
    </tr>
  </tbody>
</table>
{$forms.profileForm.close}