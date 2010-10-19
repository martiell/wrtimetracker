{literal}
<script>
   function chLocation(newLocation) { document.location = newLocation; }
</script>
{/literal}

{$forms.reportForm.open}
<table width="720" cellspacing="4" cellpadding="7" border="0">
          <tr>
            <td colspan="2" class="sectionHeader">
              <table width = "100%" border = "0" cellspacing="0" cellpadding="5">
                <tr>
                  <td valign="top" class="sectionHeader_0" align="center"><a href="tofile.php?type=xml">{$i18n.forward.toxmlfile}</a></td>
                </tr>
                <tr>
                  <td valign="top" class="sectionHeader_0" align="center"><a href="tofile.php?type=csv">{$i18n.forward.tocsvfile}</a></td>
                </tr>
              </table>
            </td>
          </tr>
          
          <tr>
            <td valign="top" colspan="2">

            {$report_content}

            </td>
          </tr>
          
          <tr>
            <td align="center">

            <table><tr>
            <td>
                <input type="button" onclick="chLocation('report_send.php');" value="{$i18n.forward.sendbyemail}">
            </td>
            
            {if $user->isManager() || $user->isCoManager()}
            <td>
                <input type="button" onclick="chLocation('invoice.php');" value="{$i18n.forward.geninvoice}">
            </td>
            {/if}
            
            </tr></table>

            </td>
          </tr>
        </table>
{$forms.reportForm.close}