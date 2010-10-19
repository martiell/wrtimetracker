{$forms.mytimeForm.open}
<table cellspacing="4" cellpadding="7" border="0" width="720">
<tbody>
  <tr>
    <td>
    
      <table border='0' cellpadding='3' cellspacing='1' width="100%">
	  	<tr>
	        <td class="tableHeader">{$i18n.form.mytime.th.project}</td>
	        <td class="tableHeader">{$i18n.form.mytime.th.activity}</td>
	        <td class="tableHeader" align='right'>{$i18n.form.mytime.th.start}</td>
	        <td class="tableHeader" align='right'>{$i18n.form.mytime.th.finish}</td>
	        <td class="tableHeader">{$i18n.form.mytime.th.duration}</td>
	        <td class="tableHeader">{$i18n.form.mytime.th.note}</td>
	    </tr>
		{foreach from=$time_rec item=t}
			<tr bgcolor="{cycle values="#f5f5f5,#ccccce"}">
		        <td valign='top'>{$t.p_name}</td>
		        <td valign='top'>{$t.a_name}</td>
		        <td align='right' valign='top'>{if $t.tfrom}{$t.tfrom}{else}&nbsp;{/if}</td>
		        <td align='right' valign='top'>{if $t.tto}{$t.tto}{else}&nbsp;{/if}</td>
		        <td align='right' valign='top'>{if $t.tdur}{$t.tdur}{else}&nbsp;{/if}</td>
		        <td valign='top'>{if $t.al_comment}{$t.al_comment}{else}&nbsp;{/if}</td>
		    </tr>
		{/foreach}
	  <table>
	  
	  <table width="100%">
        <tr>
            <td align="center">&nbsp;</td>
        </tr>
        <tr>
            <td align="center">
            {$forms.mytimeForm.confirmation.control}&nbsp;
            &nbsp;{$forms.mytimeForm.rejecting.control}</td>
        </tr>
      </table>
    
    </td>
  </tr>
</tbody>
</table>
{$forms.mytimeForm.close}