{literal}
<style>
.not_billable td {
	color: #ff6666;
}
</style>
<script language="JavaScript">
<!--
    function setNow(formField) {
         today = new Date();
         sec = today.getSeconds();
         min = today.getMinutes();
         smin = min;
         if (min<10) smin = "0"+min;
         hour = today.getHours();
         shour = hour;
         if (hour<10) shour = "0"+hour;
         obj = eval("document.mytimeForm." + formField);
         obj.value = shour + ":" + smin;
    }

    function formDisable(formField) {

    	formFieldValue = eval("document.mytimeForm." + formField + ".value")
    	formFieldName = eval("document.mytimeForm." + formField + ".name")

    	if ((formFieldValue != "")&&(formFieldName == "start")||(formFieldValue != "")&&(formFieldName == "finish")) {
    		var x = eval("document.mytimeForm.duration")
    		x.disabled = true
    		x.style.background = "#E9E9E9"
    	}

    	if ((formFieldValue == "")&&(formFieldName == "start")&&(document.mytimeForm.finish.value == "")||(formFieldValue == "")&&(formFieldName == "finish")&&(document.mytimeForm.start.value == "")) {
    		var x = eval("document.mytimeForm.duration")
    		x.disabled = false
    		x.style.background = "white"
    	}

    	if ((formFieldValue != "")&&(formFieldName == "duration")) {
    		var x = eval("document.mytimeForm.start")
    		x.disabled = true
    		x.style.background = "#E9E9E9"
    		var x = eval("document.mytimeForm.finish")
    		x.disabled = true
    		x.style.background = "#E9E9E9"
    	}

    	if ((formFieldValue == "")&&(formFieldName == "duration")) {
    		var x = eval("document.mytimeForm.start")
    		x.disabled = false
    		x.style.background = "white"
    		var x = eval("document.mytimeForm.finish")
    		x.disabled = false
    		x.style.background = "white"
    	}
    }
//-->
</script>

<script>
<!--
	function unit(sId,projects,sName) {
		this.id = sId;
		this.parentid = projects;
		this.name = sName;
	    this.cnt = -1;
	    this.collect = new Array();
		this.append = appendUnit;
	}

	function appendUnit(sId,projects,sName) {
		this.cnt++;
		t = new unit(sId,projects,sName);
		this.collect[this.cnt] = t;
	}

	var act = new unit();
	var projects = new Array();
{/literal}
	var empty_label = '{$i18n.controls.select.activity|regex_replace:"/(\&rsquo;)/":"\'"}';

    {if $activity_list}
    {foreach from=$activity_list item=activity}
    	projects = new Array();
    	{if $activity.aprojects}
    	{foreach from=$activity.aprojects item=project}
    	projects.push({$project.p_id});
    	{/foreach}
    	{/if}
	act.append({$activity.a_id},projects,'{$activity.a_name|escape:"quotes"}');
	{/foreach}
	{/if}

{literal}
    function clearOptions(formElement) {
        formObject = eval("document.mytimeForm." + formElement);
        formObject.length = 0;
    }

    function fill(parentId, list, formElement) {
      formObject = eval("document.mytimeForm." + formElement);
      cnt = 0;
      formObject.options[cnt] = new Option(empty_label,'',true,false);
      cnt++;
      if (list.collect.length > 0) {
        for (var i = 0; i < list.collect.length; i++) {
        	finded = false;
        	for (var p = 0; p < list.collect[i].parentid.length; p++) {
        		if (parentId==list.collect[i].parentid[p]) finded = true;
        	}
            if (finded) {
              formObject.options[cnt] = new Option(list.collect[i].name,list.collect[i].id,true,false);
              cnt++;
            }
        }
      }
    }

    function fillActivityDir() {
        var project_list = document.mytimeForm.project;
        var project_list_item = project_list.options[project_list.selectedIndex].value;
        var activity_list = document.mytimeForm.activity;
        var activity_list_item = activity_list.options[activity_list.selectedIndex].value;

      	clearOptions('activity');
       	fill(project_list_item,act,'activity');

       	if (activity_list.options.length > 0) {
	        for (var i = 0; i < activity_list.options.length; i++) {
	        	if (activity_list.options[i].value == activity_list_item)  {
	        		activity_list.options[i].selected = true;
	        	}
	        }
        }
    }
// -->
</script>
{/literal}

{$forms.mytimeForm.open}
<table cellspacing="4" cellpadding="7" border="0">
<tr>
  <td>
  <table width = "100%">
  <tr>
  	<td valign="top">

    <table border="0">
    <tr>
      <td align="right">{$i18n.form.mytime.project} (*):</td>
      <td>{$forms.mytimeForm.project.control}</td>
    </tr>
    <tr>
      <td align="right">{$i18n.form.mytime.activity} (*):</td>
      <td>{$forms.mytimeForm.activity.control}</td>
    </tr>
    <tr>
      <td align="right">{$i18n.form.mytime.start}:</td>
      <td>{$forms.mytimeForm.start.control}&nbsp;<input onclick="setNow('start');" type="button" value="{$i18n.button.now}">{$i18n.form.mytime.time_form}</td>
    </tr>
    <tr>
      <td align="right">{$i18n.form.mytime.finish}:</td>
      <td>{$forms.mytimeForm.finish.control}&nbsp;<input onclick="setNow('finish');" type="button" value="{$i18n.button.now}">{$i18n.form.mytime.time_form}</td>
    </tr>
    <tr>
      <td align="right">{$i18n.form.mytime.duration}:</td>
      <td>{$forms.mytimeForm.duration.control} (hh:mm or 0.0h)</td>
    </tr>
    <tr>
      <td align="right">{$i18n.form.mytime.note}:</td>
      <td>{$forms.mytimeForm.note.control}</td>
    </tr>
    <tr>
      <td align="right">&nbsp;</td>
      <td>{$forms.mytimeForm.billable.control}{$i18n.form.mytime.billable}</td>
    </tr>
    </table>


    </td>

    <!-- right side-->
    <td valign="top">
   		{$forms.mytimeForm.date.control}
    </td>
  </tr>

  <tr>
      <td colspan="2">&nbsp;</td>
  </tr>
  <tr bgcolor="#efefef">
    <td colspan="2" height="25">&nbsp;&nbsp;{$i18n.label.timeweek}: {$week_time} {$i18n.label.hrs}</td>
  </tr>

  <tr>
    <td colspan="2" height="50" align="center">
    {$forms.mytimeForm.btmytime.control}
    </td>
  </tr>
  </table>
  </td>
  </tr>
  </table>
  {$forms.mytimeForm.close}


  <table cellspacing="4" cellpadding="7" border="0" width="720">
  <tr>
	  {if ($user->isManager() || $user->isCoManager())}
		  {$forms.behalfForm.open}
		  <td class="sectionHeader">
	    	{$i18n.form.mytime.behalf}&nbsp;{$forms.behalfForm.behalfUser.control}
	    	<noscript>{$forms.behalfForm.bhvsubmit.control}</noscript>
	      </td>
	      {$forms.behalfForm.close}
	  {else}
	  	  <td class="sectionHeader">
	  		{$i18n.form.mytime.daily}
	  	  </td>
	  {/if}
  </tr>
  <tr>
	  <td valign="top">
	  {if $time_list}
	  <table border='0' cellpadding='3' cellspacing='1' width="100%">
      	<tr>
	        <td class="tableHeader">{$i18n.form.mytime.th.project}</td>
	        <td class="tableHeader">{$i18n.form.mytime.th.activity}</td>
	        <td class="tableHeader" align='right'>{$i18n.form.mytime.th.start}</td>
	        <td class="tableHeader" align='right'>{$i18n.form.mytime.th.finish}</td>
	        <td class="tableHeader">{$i18n.form.mytime.th.duration}</td>
	        <td class="tableHeader">{$i18n.form.mytime.th.note}</td>
	        <td class="tableHeader">{$i18n.form.mytime.th.edit}</td>
	        <td class="tableHeader">{$i18n.form.mytime.th.delete}</td>
        </tr>
    	{foreach from=$time_list item=t}
			<tr bgcolor="{cycle values="#f5f5f5,#ccccce"}"
			{if !$t.al_billable}
			class="not_billable"
			{/if}>
		        <td valign='top'>{$t.p_name}</td>
		        <td valign='top'>{$t.a_name}</td>
		        <td align='right' valign='top'>{if $t.tfrom}{$t.tfrom}{else}&nbsp;{/if}</td>
		        <td align='right' valign='top'>{if $t.tto}{$t.tto}{else}&nbsp;{/if}</td>
		        <td align='right' valign='top'>{if $t.tdur}{$t.tdur}{else}&nbsp;{/if}</td>
		        <td valign='top'>{if $t.al_comment}{$t.al_comment}{else}&nbsp;{/if}</td>
		        <td valign='top'><a href='mytime_edit.php?ts={$t.al_timestamp}&date={$curr_date}'>{$i18n.form.mytime.th.edit}</a></td>
		        <td valign='top'><a href='mytime_del.php?ts={$t.al_timestamp}&date={$curr_date}'>{$i18n.form.mytime.th.delete}</a></td>
		    </tr>
		{/foreach}
	  </table>
	  <table border='0'>
      <tr>
        <td align='right'>{$i18n.form.mytime.total}</td>
        <td>{$total_time}</td>
      </tr>
      </table>
	  {else}
	    {$i18n.label.time_noentry}
	  {/if}
	  </td>
  </tr>
  </table>

  <br/>

  {if $chart_href}
  <table cellspacing="4" cellpadding="7" border="0" width="720">
  <tr>
  	  {$forms.chartForm.open}
  	  <td class="sectionHeader">
  		{$i18n.label.chart.period}&nbsp;{$forms.chartForm.chPeriod.control}
  		<noscript>{$forms.chartForm.chsubmit.control}</noscript>
  	  </td>
  	  {$forms.chartForm.close}
  </tr>
  <tr>
  	  <td>
  	  <table border="0" width="100%"><tr>
  	  	<td colspan="2" align="center"><b>{if $pie_mode == 2}{$i18n.label.chart.title2}{else}{$i18n.label.chart.title1}{/if} {$chart_data.active_user_name}</b></td>
  	  </tr><tr>
    		<td width="50%" align="{if !$i18n.language.rtl}right{else}left{/if}"><img src="{$chart_href}" border="0"/></td>
    		<td>
		      {section name=i loop=$chart_data.points}
		      {if $smarty.section.i.index < 12}
		      	<table border="0""><tr><td style="width: 5px; height: 1em; background-color: {$chart_data.points[i].color_html};"></td><td>{$chart_data.points[i].name} ({$i18n.language.drm}{$chart_data.points[i].time} - {$chart_data.points[i].time_perc}{$i18n.language.drm})</td></tr></table>
		      {elseif $smarty.section.i.index == 12}
		      	...
		      {/if}
		      {/section}
		    </td>
    	</tr></table>
      </td>
  </tr>
  </table>
  {/if}