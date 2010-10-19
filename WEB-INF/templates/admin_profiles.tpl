{literal}
<script>
    function chLocation(newLocation) { document.location = newLocation; }
</script>
{/literal}

<table cellspacing="0" cellpadding="7" border="0" width="720">
  <tr>
  <td valign="top">
  
  	<p>{$i18n.form.admin.duty_text}</p>
  
	<table cellspacing="1" bordercolordark="#ffffff" cellpadding="3" bordercolorlight="#cccccc" border="0" width="100%">
    <tr>
      <td width="3%" class="tableHeader">{$i18n.form.admin.profile.th.id}</td>
      <td width="80%" class="tableHeader">{$i18n.form.admin.profile.th.name}</td>
      <td class="tableHeader">{$i18n.form.admin.profile.th.edit}</td>
      <td class="tableHeader">{$i18n.form.admin.profile.th.del}</td>
    </tr>
    {if $profiles_list}
    {foreach from=$profiles_list item=profile}
    <tr bgcolor="{cycle values="#f5f5f5,#dedee5"}">
    	<td>{$profile.c_id}</td>
    	<td>{$profile.c_name}</td>
    	<td><a href="admin_profile_edit.php?profile_id={$profile.c_id}">{$i18n.forward.edit}</a></td>
    	<td><a href="admin_profile_delete.php?profile_id={$profile.c_id}">{$i18n.forward.delete}</a></td>
    </tr>
    {/foreach}
    {/if}
    </table>
    
    <table width="100%">
    <tr>
      <td align="center">
        <br>
       <form>
         <input type="button" onclick="chLocation('admin_profile_add.php');" value="{$i18n.button.profile_add}">&nbsp;{$i18n.label.or}&nbsp;
         <input type="button" onclick="chLocation('import.php');" value="{$i18n.button.import}">
        </form>
      </td>
    </tr>
  	</table>
  
  </td>
  </tr>
</table>