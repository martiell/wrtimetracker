<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset={$smarty.const.CHARSET}">
	<link href="{$smarty.const.DEFAULT_CSS}" rel="stylesheet" type="text/css">
	{if $i18n.language.rtl}
	<link href="{$smarty.const.RTL_CSS}" rel="stylesheet" type="text/css">
	{/if}
	<title>Anuko Time Tracker{if $title_page} - {$title_page}{/if}</title>
	<script type="text/javascript" src="js/strftime.js"></script>
	<script type="text/javascript">
	  {* Setup locale for strftime *}
    {$js_date_locale}
	</script>
	<script type="text/javascript" src="js/strptime.js"></script>
</head>

<body leftmargin="0" topmargin="0" marginheight="0" marginwidth="0" {$onload}>

{assign var="tab_width" value="700"}

<table height="100%" cellspacing="0" cellpadding="0" width="100%" border="0" id="table2">
	<tbody>
	<tr>
		<td valign="top" width="100%" align="center">

		<!-- top image -->
		<table cellspacing="0" cellpadding="0" width="100%" border="0"><tr><td  bgcolor="#A6CCF7" background="images/top_bg.gif" align="center">
		<table {*height="70"*} cellspacing="0" cellpadding="0" width="{$tab_width}" border="0" id="table3">
  		<tbody>
    	<tr>
      		<td valign="top">
      			<table width="100%" cellspacing="0" cellpadding="0" border="0">
      				<tr><td height="6" colspan="2"><img width="1" height="6" src="images/1x1.gif" border="0"></td></tr>
      				<tr valign="top">
      					<td height="{if $show_world_clock}45{else}55{/if}" align="center"><a href="http://www.anuko.com/content/time_tracker/index.htm" target="_blank"><img alt="wr timetracker" width="360" height="43" src="images/tt_logo.gif" border="0"></a></td>
      				</tr>
      				{if $show_world_clock}
      				<tr>
      					<td valign="bottom" align="center">
		<table cellspacing="0" cellpadding="1" border="0">
		<tr valign="top">
		<td width="95" height="17">
      	<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,0,0" width="95" height="17" id="fzt" align="middle">
		<param name="allowScriptAccess" value="sameDomain" />
		<param name="movie" value="fzt.swf" />
		<param name="quality" value="high" />
		<param name="FlashVars" VALUE="{$smarty.const.FV_ZT1}">
		<embed src="fzt.swf" quality="high" width="95" height="17" name="fzt" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" FlashVars="{$smarty.const.FV_ZT1}"/>
		</object>
		</td>
		<td width="95" height="17">
      	<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,0,0" width="95" height="17" id="fzt" align="middle">
		<param name="allowScriptAccess" value="sameDomain" />
		<param name="movie" value="fzt.swf" />
		<param name="quality" value="high" />
		<param name="FlashVars" VALUE="{$smarty.const.FV_ZT2}">
		<embed src="fzt.swf" quality="high" width="95" height="17" name="fzt" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" FlashVars="{$smarty.const.FV_ZT2}"/>
		</object>
		</td>
		<td width="95" height="17">
      	<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,0,0" width="95" height="17" id="fzt" align="middle">
		<param name="allowScriptAccess" value="sameDomain" />
		<param name="movie" value="fzt.swf" />
		<param name="quality" value="high" />
		<param name="FlashVars" VALUE="{$smarty.const.FV_ZT3}">
		<embed src="fzt.swf" quality="high" width="95" height="17" name="fzt" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" FlashVars="{$smarty.const.FV_ZT3}"/>
		</object>
		</td>
		<td width="95" height="17">
      	<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,0,0" width="95" height="17" id="fzt" align="middle">
		<param name="allowScriptAccess" value="sameDomain" />
		<param name="movie" value="fzt.swf" />
		<param name="quality" value="high" />
		<param name="FlashVars" VALUE="{$smarty.const.FV_ZT4}">
		<embed src="fzt.swf" quality="high" width="95" height="17" name="fzt" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" FlashVars="{$smarty.const.FV_ZT4}"/>
		</object>
		</td>
		<td width="95" height="17">
      	<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,0,0" width="95" height="17" id="fzt" align="middle">
		<param name="allowScriptAccess" value="sameDomain" />
		<param name="movie" value="fzt.swf" />
		<param name="quality" value="high" />
		<param name="FlashVars" VALUE="{$smarty.const.FV_ZT5}">
		<embed src="fzt.swf" quality="high" width="95" height="17" name="fzt" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" FlashVars="{$smarty.const.FV_ZT5}"/>
		</object>
		</td>
		</tr>
		</table>

      					</td>
      				</tr>
      				{/if}
      			</table>
      		</td>
    	</tr>
  		</tbody>
		</table>
		</td></tr></table>

		<!-- main menu -->
		{if $authsession.registered}
			{if $user && $user->isAdministrator()}
			<table cellspacing="0" cellpadding="3" border="0" width = "100%">
			<tr>
				<td class="systemMenu" height="17" align="center">&nbsp;
				<a class="systemMenu" href="logout.php">{$i18n.menu.logout}</a> &middot;
				<a class="systemMenu" href="{$smarty.const.FEEDBACK_LINK}" target="_blank">{$i18n.menu.feedback}</a> &middot;
				<a class="systemMenu" href="{$smarty.const.HELP_LINK}" target="_blank">{$i18n.menu.help}</a>
				</td>
			</tr>
			</table>
			<!-- /main menu -->

			<!-- sub menu -->
			<table cellspacing="0" cellpadding="3" width="100%" border="0">
			<tr>
				<td  align="center" bgcolor="#D9D9D9" nowrap height="17" background="images/subm_bg.gif">&nbsp;
				<a class="mainMenu" href="admin.php">{$i18n.menu.admin}</a>
				&middot;  <a class="mainMenu" href="admin_profiles.php">{$i18n.menu.profile}</a>
				&middot; <a class="mainMenu" href="admin_services.php">{$i18n.menu.services}</a>
				</td>
			</tr>
			</table>
			<!-- sub menu -->
			{else}
			<table cellspacing="0" cellpadding="3" border="0" width = "100%">
			<tr>
				<td class="systemMenu" height="17" align="center">&nbsp;
				<a class="systemMenu" href="logout.php">{$i18n.menu.logout}</a> &middot;
				<a class="systemMenu" href="edit_profile.php">{$i18n.menu.edprof}</a> &middot;
				<a class="systemMenu" href="{$smarty.const.FEEDBACK_LINK}" target="_blank">{$i18n.menu.feedback}</a> &middot;
				<a class="systemMenu" href="{$smarty.const.HELP_LINK}" target="_blank">{$i18n.menu.help}</a>
				</td>
			</tr>
			</table>
			<!-- /main menu -->

			<!-- sub menu -->
			<table cellspacing="0" cellpadding="3" width="100%" border="0">
			<tr>
				<td  align="center" bgcolor="#D9D9D9" nowrap height="17" background="images/subm_bg.gif">&nbsp;
				<a class="mainMenu" href="mytime.php">{$i18n.menu.mytime}</a> &middot;
				<a class="mainMenu" href="reports.php">{$i18n.menu.report}</a> &middot;
				<a class="mainMenu" href="projects.php">{$i18n.menu.project}</a> &middot;
				<a class="mainMenu" href="activities.php">{$i18n.menu.activity}</a> &middot;
				<a class="mainMenu" href="people.php">{$i18n.menu.people}</a>
				{if $user && ($user->isManager() || $user->isCoManager())}
				 &middot; <a class="mainMenu" href="clients.php">{$i18n.menu.clients}</a>
				{/if}
				{if $user && $user->isManager()}
				 &middot; <a class="mainMenu" href="export.php">{$i18n.menu.migration}</a>
				{/if}
				</td>
			</tr>
			</table>
			<!-- sub menu -->
			{/if}
		{else}
		<table cellspacing="0" cellpadding="3" border="0" width = "100%">
		<tr>
			<td class="systemMenu" height="17" align="center">&nbsp;
			<a class="systemMenu" href="login.php">{$i18n.menu.login}</a> &middot;
			{if $smarty.const.MULTITEAM_MODE=="true"}
			<a class="systemMenu" href="register.php">{$i18n.menu.register}</a> &middot;
			{/if}
			<a class="systemMenu" href="{$smarty.const.FEEDBACK_LINK}" target="_blank">{$i18n.menu.feedback}</a> &middot;
			<a class="systemMenu" href="{$smarty.const.HELP_LINK}" target="_blank">{$i18n.menu.help}</a>
			</td>
		</tr>
		</table>
		{/if}
		<br>

		{if $title_page}
		<table width="{$tab_width+20}" cellspacing="0" cellpadding="5" border="0">
  		<tr>
    		<td class="sectionHeader"><div class="pageTitle">{$title_page}{if $timestring}: {$timestring}{/if}</div></td>
  		</tr>
  		<tr>
    		<td>{$userdet_string}</td>
  		</tr>
  		</table>
  		<br>
  		{/if}

		<!-- errors -->
		{if !$errors->isEmpty()}
		<table id="error_tab" cellspacing="4" cellpadding="7" border="0" width="{$tab_width}">
		  <tr>
		    <td class="error_style">
		    <b>{$i18n.label.errors}:</b>
		    <ul>
			{foreach from=$errors->getErrors() item=error}
				<li><font color="#FF0000">{$error.message}</font></li>
			{/foreach}
			</ul>
		    </td>
		  </tr>
		</table>
		{/if}
		<!-- /errors -->

		<!-- messages -->
		{if !$messages->isEmpty()}
		<table id="error_tab" cellspacing="4" cellpadding="7" border="0" width="{$tab_width}">
		  <tr>
		    <td class="error_style">
		    <b>Messages:</b>
		    <ul>
			{foreach from=$messages->getErrors() item=onemessage}
				<li><font color="#000066">{$onemessage.message}</font></li>
			{/foreach}
			</ul>
		    </td>
		  </tr>
		</table>
		{/if}
		<!-- /messages -->

