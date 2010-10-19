{$forms.profileForm.open}
<table cellspacing="4" cellpadding="7" border="0">
  <tbody>
    <tr>
      <td>

          <table id="table1" cellspacing="1" cellpadding="2" border="0">
            <tr>
              <td align = "right" nowrap>{$i18n.form.profile.name} (*):</td>
              <td>{$forms.profileForm.name.control}</td>
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
              <td align = "right" nowrap>{$i18n.form.profile.comp} (*):</td>
              <td>{$forms.profileForm.comp.control}</td>
            </tr>
            <tr>
              <td align = "right" nowrap>{$i18n.form.profile.email}:</td>
              <td>{$forms.profileForm.email.control}</td>
            </tr>
            {if (!$user) || ($user && !$user->isAdministrator())}
            <tr>
              <td align = "right">{$i18n.form.profile.www}:</td>
              <td>{$forms.profileForm.www.control}</td>
            </tr>
            <tr>
              <td align = "right">{$i18n.form.profile.curr}:</td>
              <td>{$forms.profileForm.curr.control}</td>
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
              <td colspan="2" height="50" align="center">{$forms.profileForm.btsubmit.control}</td>
            </tr>
          </table>

      </td>
    </tr>
  </tbody>
</table>
{$forms.profileForm.close}