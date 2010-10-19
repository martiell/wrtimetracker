{literal}
<script type="text/javascript">
  function SetCustomDateTimeFormatPreview(id, selectElement)
  {
    var dst = document.getElementById(id);
    if (dst) {
      var date = new Date();
      var format;
      if (selectElement.value != "") {
        format = selectElement.value;
      } else {
        format = selectElement.options[0].text;
      }
      date.locale = "{/literal}{$js_date_cur_locale}{literal}";
      dst.innerHTML = "<i>" + date.strftime(format) + "</i>";
    }
  }
</script>
{/literal}