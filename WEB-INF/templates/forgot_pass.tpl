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
              <td align="right">{$i18n.form.fpass.login}:</td>
              <td colspan="3">{$forms.fpassForm.login.control}</td>
            </tr>
            <tr>
              <td colspan="4">&nbsp;</td>
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