{literal}
<SCRIPT>
<!--
function get_date() {
var dt = new Date();
d = dt.getDate();
m = dt.getMonth()+1;
y = dt.getFullYear();
time = m + "/" + d + "/" + y;
return time;
}
//-->
</SCRIPT>
{/literal}
<table cellspacing="4" cellpadding="7" border="0">
  <tr>
    <td>

      {$forms.loginForm.open}
      {include file="login.`$smarty.const.AUTH_MODULE`.tpl"}
      {$forms.loginForm.close}

    </td>
  </tr>
</table>

{if !empty($login_hello_text)}
    <div id="LoginHelloText"> {$login_hello_text} </div>
{/if}