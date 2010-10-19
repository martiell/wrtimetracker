{literal}
<script>
   function chLocation(newLocation) {
		document.location = newLocation;
   }
</script>
{/literal}

<table cellspacing="0" cellpadding="7" border="0" width="720">
  <tr>
    <td valign="top" align="center">

        {if $user->isManager()}
        <table cellspacing="1" bordercolordark="#ffffff" cellpadding="3" bordercolorlight="#cccccc" border="0" width="100%">
        <tr>
            <td width="35%" class="tableHeader">{$i18n.form.people.th.name}</td>
            <td width="30%" class="tableHeader">{$i18n.form.people.th.login}</td>
            <td class="tableHeader">{$i18n.form.people.th.role}</td>
            <td class="tableHeader">{$i18n.form.people.th.edit}</td>
            <td class="tableHeader">{$i18n.form.people.th.del}</td>
        </tr>
        {if $user_list}
        {foreach from=$user_list item=u}
		<tr bgcolor="{cycle values="#f5f5f5,#dedee5"}">
            <td>{$u.u_name}</td>
            <td>{$u.u_login}</td>
            {if $u.u_manager_id}
                {if $u.u_comanager}
	            	<td>{$i18n.form.people.comanager}</td>
	            {else}
	            	<td>{$i18n.form.people.empl}</td>
	            {/if}
            {else}
            	<td>{$i18n.form.people.manager}</td>
            {/if}
            <td><a href="people_edit.php?ppl_id={$u.u_id}">{$i18n.forward.edit}</a></td>
        	<td><a href="people_delete.php?ppl_id={$u.u_id}">{$i18n.forward.delete}</a></td>
        </tr>
        {/foreach}
        {/if}
        </table>
        <table width="100%">
        <tr>
          <td align="center" height="50">
                <form><input type="button" onclick="chLocation('people_add.php');" value="{$i18n.button.ppl_add}"></form>
          </td>
        </tr>
      	</table>
      	{/if}


      	{if $user->isCoManager()}
        <table cellspacing="1" bordercolordark="#ffffff" cellpadding="3" bordercolorlight="#cccccc" border="0" width="100%">
        <tr>
            <td width="35%" class="tableHeader">{$i18n.form.people.th.name}</td>
            <td width="30%" class="tableHeader">{$i18n.form.people.th.login}</td>
            <td class="tableHeader">{$i18n.form.people.th.role}</td>
            <td class="tableHeader">{$i18n.form.people.th.edit}</td>
            <td class="tableHeader">{$i18n.form.people.th.del}</td>
        </tr>
        {if $user_list}
        {foreach from=$user_list item=u}
		<tr bgcolor="{cycle values="#f5f5f5,#dedee5"}">
            <td>{$u.u_name}</td>
            <td>{$u.u_login}</td>
            {if $u.u_manager_id}
                {if $u.u_comanager}
	            	<td>{$i18n.form.people.comanager}</td>
	            {else}
	            	<td>{$i18n.form.people.empl}</td>
	            {/if}
            {else}
            	<td>{$i18n.form.people.manager}</td>
            {/if}
            <td>{if $user->getUserId()==$u.u_id || !$u.u_comanager && $user->getManagerId()==$u.u_manager_id}<a href="people_edit.php?ppl_id={$u.u_id}">{$i18n.forward.edit}</a>{/if}</td>
        	<td>{if $user->getUserId()==$u.u_id || !$u.u_comanager && $user->getManagerId()==$u.u_manager_id}<a href="people_delete.php?ppl_id={$u.u_id}">{$i18n.forward.delete}</a>{/if}</td>
        </tr>
        {/foreach}
        {/if}
        </table>
        <table width="100%">
        <tr>
          <td align="center" height="50">
                <form><input type="button" onclick="chLocation('people_add.php');" value="{$i18n.button.ppl_add}"></form>
          </td>
        </tr>
      	</table>
      	{/if}


      	{if !$user->isManager() && !$user->isCoManager()}
		<table cellspacing="1" bordercolordark="#ffffff" cellpadding="3" bordercolorlight="#cccccc" border="0" width="100%">
		<tr>
        	<td class="tableHeader">{$i18n.form.people.th.name}</td>
        	<td class="tableHeader">{$i18n.form.people.th.login}</td>
        	<td class="tableHeader">{$i18n.form.people.th.role}</td>
        </tr>
        {if $user_list}
        {foreach from=$user_list item=user}
		<tr bgcolor="{cycle values="#f5f5f5,#dedee5"}">
            <td>{$user.u_name}</td>
            <td>{$user.u_login}</td>
            {if $user.u_manager_id}
                {if $user.u_comanager}
	            	<td>{$i18n.form.people.comanager}</td>
	            {else}
	            	<td>{$i18n.form.people.empl}</td>
	            {/if}
            {else}
            	<td>{$i18n.form.people.manager}</td>
            {/if}
        </tr>
        {/foreach}
        {/if}
		</table>
        {/if}

    </td>
  </tr>
</table>