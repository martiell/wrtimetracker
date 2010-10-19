{$forms.clientForm.open}
<table cellspacing="4" cellpadding="7" border="0">
  <tbody>
    <tr>
      <td>
      
          <table id="table1" cellspacing="1" cellpadding="2" border="0">
            <tr>
              <td align = "right">{$i18n.form.client.name} (*):</td>
              <td>{$forms.clientForm.name.control}</td>
            </tr>
            <tr>
	          <td align='right'>{$i18n.form.client.custcoo}:</td>
	          <td>{$forms.clientForm.custcoo.control}</td>
	        </tr>
	        <tr>
	          <td align='right'>{$i18n.form.client.tax}, %:</td>
	          <td>{$forms.clientForm.tax.control}&nbsp;(0{$i18n.float_delimiter}00)</td>
	        </tr>
	        <tr>
	          <td align='right'>{$i18n.form.client.discount}, %:</td>
	          <td>{$forms.clientForm.discount.control}&nbsp;(0{$i18n.float_delimiter}00)</td>
	        </tr>
	        <tr>
              <td></td>
              <td><hr noshade></td>
            </tr>
	        <tr>
	          <td align='right'>{$i18n.form.client.yourcoo}:</td>
	          <td>{$forms.clientForm.yourcoo.control}</td>
	        </tr>
			<tr>
	          <td align='right'>{$i18n.form.client.comment}:</td>
	          <td>{$forms.clientForm.comment.control}</td>
	        </tr>
	        <tr>
	          <td align='right'>{$i18n.form.client.daily_subtotals}:</td>
	          <td>{$forms.clientForm.daily_subtotals.control}</td>
	        </tr>
            <tr>
              <td height="40"></td>
              <td>{$i18n.label.req_fields}</td>
            </tr>
            <tr>
              <td></td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td colspan="2" align="center" height="50">{$forms.clientForm.btsubmit.control}</td>
            </tr>
          </table>

      </td>
    </tr>
  </tbody>
</table>
{$forms.clientForm.close}