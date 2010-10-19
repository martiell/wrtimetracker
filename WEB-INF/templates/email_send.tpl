{$userdet_string}

{$forms.mailForm.open}
<table cellspacing="4" cellpadding="7" border="0">
  <tr>
    <td colspan = 2 class="sectionHeader">
      <table width = "100%" border = "0" cellspacing="0" cellpadding="0">
        <tr>
          <td class="sectionHeader_0">{$i18n.label.rep_str}</td>
          <td class="sectionHeader_0" align="right">&nbsp;</td>
        </tr>
      </table>
    </td>
  </tr>
  
  <tr>
    <td>

	<table cellspacing="4" cellpadding="7" border="0">
	  <td valign="top" colspan="2">
	
	  {if $result_message}
 	      <table cellspacing="4" cellpadding="7" border="0" width="100%"><tr><td align="center">
          <font color="red"><b>{$result_message}</b></font>
       	  </td></tr></table>
	  {else}
	      <table>
	        <tr>
	          <td colspan="2">{$i18n.form.mail.above}<br>&nbsp;</td>
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
	          <td align='right'>{$i18n.form.mail.subject}:</td>
	          <td>{$forms.mailForm.subject.control}</td>
	        </tr>
	        <tr>
	          <td align='right'>{$i18n.form.mail.comment}:</td>
	          <td><textarea name="comment" cols="50" rows="5"></textarea></td>
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