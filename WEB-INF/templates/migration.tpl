<table cellspacing="0" cellpadding="7" border="0" width="720">
  <tr>
  <td valign="top">
  
   {$forms.migrationForm.open}
	<table cellspacing="4" cellpadding="7" border="0" width="100%">
	  <tr>
	    <td align="center">
	
	    {if $user->isManager()}
			<table border="0" width="60%">
			<tr>
			  <td colspan="2">{$i18n.form.migration.export.text}<br></td>
			</tr>
			<tr>
			  <td colspan="2">&nbsp;</td>
			</tr>
			<tr>
			  <td align='right'>{$i18n.form.migration.zip}:</td>
			  <td>{$forms.migrationForm.compress.control}</td>
			</tr>
			<tr>
			  <td height="50" align="center" colspan="2">
			  {$forms.migrationForm.btsubmit.control}
			  </td>
			</tr>
			</table>
		{/if}
		
		{if $user->isAdministrator()}
			<table border="0" width="60%">
			<tr>
			  <td colspan="2">{$i18n.form.migration.import.text}<br></td>
			</tr>
			<tr>
			  <td colspan="2">&nbsp;</td>
			</tr>
			<tr>
			  <td align='right'>{$i18n.form.migration.file}:</td>
			  <td>{$forms.migrationForm.xmlfile.control}</td>
			</tr>
			<tr>
			  <td height="50" align="center" colspan="2">
			  {$forms.migrationForm.btsubmit.control}
			  </td>
			</tr>
			</table>
		{/if}
			
		</td>
	</tr>
	</table>
	{$forms.migrationForm.close}
  	
	
  </td>
  </tr>
</table>