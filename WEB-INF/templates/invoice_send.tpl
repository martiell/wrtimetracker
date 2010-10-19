{$forms.mailForm.open}
<table cellspacing="4" cellpadding="7" border="0">
  <tr>
    <td>
    
<table cellspacing="4" cellpadding="7" border="0">
  <tr>
    <td valign="top" colspan="2">

	  {if $result_message}
 	      <table cellspacing="4" cellpadding="7" border="0" width="100%"><tr><td align="center">
          <font color="red"><b>{$result_message}</b></font>
       	  </td></tr></table>
	  {else}
	      <table>
	        <tr>
	          <td colspan="2">{$i18n.form.invoice.mailinv_above}<br>&nbsp;</td>
	        </tr>
	        <tr>
	          <td align='right'>{$i18n.form.mail.from}:</td>
	          <td>{$smarty.const.SENDER}</td>
	        </tr>
	        <tr>
	          <td align='right'>{$i18n.form.mail.to}:</td>
	          <td>{$forms.mailForm.receiver.control}</td>
	        </tr>
	        <tr>
	          <td align='right'>{$i18n.form.mail.cc}:</td>
	          <td>{$forms.mailForm.cc.control}</td>
	        </tr>
	        <tr>
	          <td align='right'>{$i18n.form.mail.subject}:</td>
	          <td>{$forms.mailForm.subject.control}</td>
	        </tr>
	        <tr>
	          <td align='right'>{$i18n.form.mail.comment}:</td>
	          <td>{$forms.mailForm.comment.control}</textarea></td>
	        </tr>
	        <tr>
	          <td colspan="2" align="center" height="70">{$forms.mailForm.btsubmit.control}</td>
	        </tr>
	      </table>
	{/if}
    

    </td>
  </tr>
</table>

  </td>
 </tr>
</table>
{$forms.mailForm.close}