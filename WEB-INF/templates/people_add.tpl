{literal}
<script>
<!--
function selectProject(el) {

	if (document.peopleForm.rate === undefined)
		return ;

	var def_val = document.peopleForm.rate.value;
	for (var i = 0; i < peopleForm.elements.length; i++) {
		if (peopleForm.elements[i].type=='text'
				&& peopleForm.elements[i].name==('rate_'+el.value)) {
			if (el.checked) {
				peopleForm.elements[i].value = def_val;
			} else {
				peopleForm.elements[i].value = "";
			}
			break;
		}
	}

}
//-->
</script>
{/literal}
{$forms.peopleForm.open}
<table cellspacing="4" cellpadding="7" border="0">
  <tbody>

    <table id="table1" cellspacing="1" cellpadding="2" border="0">
    <tr>
      <td align = "right">{$i18n.form.people.name} (*):</td>
      <td>{$forms.peopleForm.name.control}</td>
    </tr>
    <tr>
      <td align = "right">{$i18n.form.people.login} (*):</td>
      <td>{$forms.peopleForm.login.control}</td>
    </tr>

    {if !$auth_is_password_external}
    <tr>
      <td align = "right">{$i18n.form.people.pas1} (*):</td>
      <td>{$forms.peopleForm.pas1.control}</td>
    </tr>
    <tr>
      <td align = "right">{$i18n.form.people.pas2} (*):</td>
      <td>{$forms.peopleForm.pas2.control}</td>
    </tr>
    {/if}

    <tr>
      <td align = "right" nowrap>{$i18n.form.people.email}:</td>
      <td>{$forms.peopleForm.email.control}</td>
    </tr>

    {if $user->isManager()}
    <tr>
      <td align="right">{$i18n.form.people.comanager}:</td>
      <td>{$forms.peopleForm.comanager.control}</td>
    </tr>
    <tr>
      <td align = "right">{$i18n.form.people.rate}&nbsp;(0{$i18n.float_delimiter}00):</td>
      <td>{$forms.peopleForm.rate.control}</td>
    </tr>
    {/if}

    <tr valign="top">
      <td align="right">{$i18n.form.people.projects}:</td>
      <td>{$forms.peopleForm.projects.control}</td>
    </tr>
    <tr>
      <td></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2" align="center">{$i18n.label.req_fields}</td>
    </tr>
    <tr>
      <td colspan="2" align="center" height="50">{$forms.peopleForm.btsubmit.control}</td>
    </tr>
    </table>

  </tbody>
</table>
{$forms.peopleForm.close}