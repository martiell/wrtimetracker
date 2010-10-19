<table border="0">
  <tr>
    <td{if !$i18n.language.rtl} align="right"{/if}>{$i18n.form.login.login}:</td>
    <td>{$forms.loginForm.login.control}</td>
  </tr>
  <tr>
    <td{if !$i18n.language.rtl} align="right"{/if}>{$i18n.form.login.password}:</td>
    <td>{$forms.loginForm.password.control}</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><a href ='send_password.php'>{$i18n.forward.forgot_password}</a></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" align="center" height="50">{$forms.loginForm.btlogin.control}</td>
  </tr>
</table>