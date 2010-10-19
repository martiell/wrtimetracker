{$forms.invoiceForm.open}
<table cellspacing="4" cellpadding="7" border="0">
  <tr>
    <td align="center">

	      <table border="0">
	        <tr>
	          <td colspan="2">{$i18n.form.invoice.above}<br>&nbsp;</td>
	        </tr>
	        <tr>
	          <td align='right'>{$i18n.form.invoice.date} (*):</td>
	          <td>{$forms.invoiceForm.date.control}</td>
	        </tr>
	        <tr>
	          <td align='right'>{$i18n.form.invoice.number} (*):</td>
	          <td>{$forms.invoiceForm.number.control}</td>
	        </tr>
	        <tr>
	          <td colspan="2" height="40"><b>{$i18n.form.invoice.select_cust}</b></td>
	        </tr>
	        <tr>
	          <td align='right'>{$i18n.form.invoice.customer}:</td>
	          <td>{$forms.invoiceForm.client.control}&nbsp;<a href="clients.php">{$i18n.forward.change}</a></td>
	        </tr>
	        <tr>
	          <td colspan="2" height="40"><b>{$i18n.label.or}&nbsp;{$i18n.form.invoice.fillform}</b></td>
	        </tr>
	                
	        <tr>
	          <td align='right'>{$i18n.form.invoice.yourcoo}:</td>
	          <td>{$forms.invoiceForm.yourcoo.control}</td>
	        </tr>
			<tr>
	          <td align='right'>{$i18n.form.invoice.custcoo}:</td>
	          <td>{$forms.invoiceForm.custcoo.control}</td>
	        </tr>
			<tr>
	          <td align='right'>{$i18n.form.invoice.comment}:</td>
	          <td>{$forms.invoiceForm.comment.control}</td>
	        </tr>
	        <tr>
	          <td align='right'>{$i18n.form.invoice.tax}, %:</td>
	          <td>{$forms.invoiceForm.tax.control}&nbsp;(0{$i18n.float_delimiter}00)</td>
	        </tr>
	        <tr>
	          <td align='right'>{$i18n.form.invoice.discount}, %:</td>
	          <td>{$forms.invoiceForm.discount.control}&nbsp;(0{$i18n.float_delimiter}00)</td>
	        </tr>
	        <tr>
	          <td align='right'>{$i18n.form.invoice.daily_subtotals}:</td>
	          <td>{$forms.invoiceForm.daily_subtotals.control}</td>
	        </tr>
	        <tr>
              <td></td>
              <td>{$i18n.label.req_fields}</td>
            </tr>
	        <tr>
	          <td height="50" align="center" colspan="2">
	          {$forms.invoiceForm.btsubmit.control}
	          </td>
	        </tr>
	      </table>
		
	</td>
</tr>
</table>
{$forms.invoiceForm.close}