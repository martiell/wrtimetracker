{literal}
<script>
    function chLocation(newLocation) { document.location = newLocation; }
</script>
{/literal}

{$forms.clientForm.open}
<table cellspacing="0" cellpadding="7" border="0" width="720">
  <tr>
  <td valign="top">

  {if ($user->isManager() || $user->isCoManager())}
	<table cellspacing="1" bordercolordark="#ffffff" cellpadding="3" bordercolorlight="#cccccc" border="0" width="100%">
    <tr>
      <td width="80%" class="tableHeader">{$i18n.form.client.th.name}</td>
      <td class="tableHeader">{$i18n.form.client.th.edit}</td>
      <td class="tableHeader">{$i18n.form.client.th.del}</td>
    </tr>
    {if $client_list}
    {foreach from=$client_list item=client}
    <tr valign="top" bgcolor="{cycle values="#f5f5f5,#dedee5"}">
    	<td>{$client.clnt_name}</td>
    	<td><a href="client_edit.php?client_id={$client.clnt_id}">{$i18n.forward.edit}</a></td>
       	<td><a href="client_delete.php?client_id={$client.clnt_id}">{$i18n.forward.delete}</a></td>
    </tr>
    {/foreach}
    {/if}
    </table>
    
    <table width="100%">
    <tr>
      <td align="center">
        <br>
       <form>
         <input type="button" onclick="chLocation('client_add.php');" value="{$i18n.button.clnt_add}">
        </form>
      </td>
    </tr>
  	</table>
  {/if}
  
  </td>
  </tr>
</table>
{$forms.clientForm.close}