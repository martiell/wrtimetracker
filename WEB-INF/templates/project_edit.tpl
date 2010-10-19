{$forms.projectForm.open}
<table cellspacing="4" cellpadding="7" border="0">
  <tbody>
    <tr>
      <td>

          <table id="table1" cellspacing="1" cellpadding="2" border="0">
            <tr>
              <td align="right">{$i18n.form.project.name} (*):</td>
              <td>{$forms.projectForm.name.control}</td>
            </tr>
	    <tr>
              <td align="right">{$i18n.form.people.ppl_str}:</td>
              <td>{$forms.projectForm.users.control}</td>
            </tr>
	    <tr>
              <td align="right">{$i18n.form.activity.act_title}:</td>
              <td>{$forms.projectForm.activity.control}</td>
            </tr>
            <tr>
              <td></td>
              <td>{$i18n.label.req_fields}</td>
            </tr>
            <tr>
              <td colspan="2">&nbsp;</td>
            </tr>
            <tr>
              <td colspan="2" align="center" height="50">{$forms.projectForm.btsubmit.control}</td>
            </tr>
          </table>

      </td>
    </tr>
  </tbody>
</table>
{$forms.projectForm.close}