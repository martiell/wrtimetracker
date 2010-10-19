<br>
{$forms.fpassForm.open}
<table cellspacing="4" cellpadding="7" border="0" id="table6">
  <tbody>
    <tr>
      <td>

      {if $result_message}
 	      <table cellspacing="4" cellpadding="7" border="0" width="100%"><tr><td align="center">
          <font color="red"><b>{$result_message}</b></font>
       	  </td></tr></table>
	  {else}
          <table>
          	<tr>
              <td colspan="4" height="40">{$i18n.form.fpass.reset_comment}</td>
            </tr>
            <tr>
              <td align="right">{$i18n.form.profile.name}:</td>
              <td colspan="3">{$userdet_string}</td>
            </tr>
            <tr>
              <td align="right">{$i18n.form.profile.pas1} (*):</td>
              <td colspan="3">{$forms.fpassForm.pass1.control}</td>
            </tr>
            <tr>
              <td align="right">{$i18n.form.profile.pas2} (*):</td>
              <td colspan="3">{$forms.fpassForm.pass2.control}</td>
            </tr>
            <tr>
              <td colspan="4">&nbsp;</td>
            </tr>
            <tr>
              <td></td>
              <td>{$i18n.label.req_fields}</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td colspan="3" align="center">{$forms.fpassForm.btsubmit.control}</td>
            </tr>
          </table>
      {/if}
          
      </td>
    </tr>
  </tbody>
</table>
{$forms.fpassForm.close}