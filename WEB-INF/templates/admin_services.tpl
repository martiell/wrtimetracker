{$forms.serviceForm.open}

{include file="custom_datetime_format_preview.tpl"}

<table cellspacing="4" cellpadding="7" border="0">
  <tbody>
    <tr>
      <td>
        <table id="table1" cellspacing="1" cellpadding="2" border="0">
          <tr>
            <td colspan="2">{$i18n.form.admin.change_pass}</td>
          </tr>
          <tr>
            <td>{$i18n.form.admin.password}:</td>
            <td>{$forms.serviceForm.newpass.control}</td>
          </tr>
          <tr>
            <td>{$i18n.form.admin.password_confirm}:</td>
            <td>{$forms.serviceForm.newpass1.control}</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
    				<td>{$i18n.form.admin.lock.period} (*):</td>
    				<td>{$forms.serviceForm.todate.control}</td>
    			</tr>
          <tr>
            <td align = "right" nowrap>{$i18n.form.admin.lang_default}:</td>
            <td>{$forms.serviceForm.lang_default.control}</td>
          </tr>
          <tr>
            <td align = "right" nowrap>{$i18n.form.admin.show_world_clock}:</td>
            <td>{$forms.serviceForm.show_world_clock.control}</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td align = "right" nowrap>{$i18n.form.admin.custom_date_format}:</td>
            <td>{$forms.serviceForm.format_date.control} <font id="custom_date_format_preview" color="#777777">&nbsp;</font></td>
          </tr>
          <tr>
            <td align = "right" nowrap>{$i18n.form.admin.custom_time_format}:</td>
            <td>{$forms.serviceForm.format_time.control} <font id="custom_time_format_preview" color="#777777">&nbsp;</font></td>
          </tr>
          <tr>
            <td align = "right" nowrap>{$i18n.form.admin.start_week}:</td>
            <td>{$forms.serviceForm.start_week.control}</td>
          </tr>

          {* initialize preview text *}
          {literal}
          <script type="text/javascript">
            SetCustomDateTimeFormatPreview("custom_date_format_preview", document.getElementById("format_date"));
            SetCustomDateTimeFormatPreview("custom_time_format_preview", document.getElementById("format_time"));
          </script>
          {/literal}

          <tr>
            <td></td>
            <td>{$i18n.label.req_fields}</td>
          </tr>
          <tr>
            <td colspan="2" align="center" height="50">{$forms.serviceForm.btsubmit.control}</td>
          </tr>
        </table>

      </td>
    </tr>
  </tbody>
</table>
{$forms.serviceForm.close}