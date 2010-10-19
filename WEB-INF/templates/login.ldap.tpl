<table border="0">
  <tr>
    <td colspan="2" align="center">{$i18n.label.ldap_hint}</td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td{if !$i18n.language.rtl} align="right"{/if}>{$i18n.form.login.login}:</td>
    <td>{$forms.loginForm.login.control} <font color="#777777">@{$Auth_ldap_params.default_domain}</font></td>
  </tr>
  <tr>
    <td{if !$i18n.language.rtl} align="right"{/if}>{$i18n.form.login.password}:</td>
    <td>{$forms.loginForm.password.control}</td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  {if $smarty.const.AUTH_MODULE_LDAP_DEMO}
  <tr>
    <td align="center" colspan="2">{$smarty.const.AUTH_MODULE_LDAP_DEMO_SESSION_TIMEOUT|string_format:$i18n.label.ldap_auth_module_demo}</td>
  </tr>
  {/if}
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" align="center" height="50">{$forms.loginForm.btlogin.control}</td>
  </tr>
</table>