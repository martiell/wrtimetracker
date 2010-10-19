{literal}
<script>
    function chLocation(newLocation) { document.location = newLocation; }
</script>
{/literal}

{$forms.projectForm.open}
<table cellspacing="0" cellpadding="7" border="0" width="720">
  <tr>
  <td valign="top">
  
  {if ($user->isManager() || $user->isCoManager())}
	<table cellspacing="1" bordercolordark="#ffffff" cellpadding="3" bordercolorlight="#cccccc" border="0" width="100%">
    <tr>
      <td width="70%" class="tableHeader">{$i18n.form.project.th.name}</td>
      <td class="tableHeader">{$i18n.form.project.th.edit}</td>
      <td class="tableHeader">{$i18n.form.project.th.del}</td>
    </tr>
    {if $project_list}
    {foreach from=$project_list item=project}
    <tr bgcolor="{cycle values="#f5f5f5,#dedee5"}">
    	<td>{$project.p_name}</td>
    	<td><a href="project_edit.php?pr_id={$project.p_id}">{$i18n.forward.edit}</a></td>
       	<td><a href="project_delete.php?pr_id={$project.p_id}">{$i18n.forward.delete}</a></td>
    </tr>
    {/foreach}
    {/if}
    </table>
    
    <table width="100%">
    <tr>
      <td align="center">
        <br>
       <form>
         <input type="button" onclick="chLocation('project_add.php');" value="{$i18n.button.proj_add}">
        </form>
      </td>
    </tr>
  	</table>
  	
  {else}
  
    <table cellspacing="1" bordercolordark="#ffffff" cellpadding="3" bordercolorlight="#cccccc" border="0" width="100%">
    <tr>
      <td class="tableHeader">{$i18n.form.project.th.name}</td>
    </tr>
    {if $project_list}
    {foreach from=$project_list item=project}
    <tr bgcolor="{cycle values="#f5f5f5,#dedee5"}">
    	<td>{$project.p_name}</td>
    </tr>
    {/foreach}
    {/if}
    </table>
  {/if}
  
  </td>
  </tr>
</table>
{$forms.projectForm.close}