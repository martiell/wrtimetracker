{literal}
<script>
	function chLocation(newLocation) { document.location = newLocation; }
</script>
{/literal}
<table cellspacing="0" cellpadding="7" border="0" width="720">
      <tr>
        <td align="center">

			{$invoice_content}

        </td>
      <tr>
        <td align="center">
            <br>
            <form><input type="button" onclick="chLocation('invoice_send.php');" value="{$i18n.button.sendbyemail}"></form>
        </td>
      </tr>
</table>