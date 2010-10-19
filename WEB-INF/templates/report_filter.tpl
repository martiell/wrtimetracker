{literal}
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
	var aprojects = new Array();
{/literal}
	var empty_label = '{$i18n.controls.select.activity|regex_replace:"/(\&rsquo;)/":"\'"}';

	{if $aprojects_list}
	{foreach from=$aprojects_list item=aprojects key=indx}
	aprojects[{$indx}] = new Array();
		{if $aprojects}{foreach from=$aprojects item=aproject key=indxAp}
	aprojects[{$indx}][{$indxAp}] = {$aproject};
		{/foreach}{/if}
	{/foreach}
	{/if}

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
        formObject = eval("document.reportForm." + formElement);
        formObject.length = 0;
    }

    function fill(parentId, list, formElement) {
      formObject = eval("document.reportForm." + formElement);
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
        var project_list = document.reportForm.project;
        var project_list_item = project_list.options[project_list.selectedIndex].value;
        var activity_list = document.reportForm.activity;
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

    function fillUsersGroup() {
    	var indxUser;
    	var indxProject = null;
    	if (document.reportForm.project!=null) {
    		indxProject = document.reportForm.project.options[document.reportForm.project.selectedIndex].value;
    	}

    	if (indxProject!=null)
    	for (var i = 0; i < document.reportForm.elements.length; i++) {
        	if (document.reportForm.elements[i].type=='checkbox' && document.reportForm.elements[i].name=='users[]') {

        		indxUser = document.reportForm.elements[i].value;


        		document.reportForm.elements[i].checked = (indxProject == '');

				if(aprojects[indxUser]!=undefined){ji=aprojects[indxUser].length;}
				else{ji=0;}

        			if (indxProject != '')
        			for (var j = 0; j < ji; j++) {
        				if (indxProject == aprojects[indxUser][j]) {

	        				document.reportForm.elements[i].checked = true;

        				}
        			}
        	}
    	}
    }
// -->
</script>
{/literal}


{$forms.reportForm.open}
<div style="padding:0 0 10 0;">
<table border="0" bgcolor="#efefef" width="720">
<tr><td>
   <table cellspacing="1" cellpadding="3" border="0">
    <tr>
      <td>{$i18n.form.filter.filter}:</td><td>{$forms.reportForm.f_filter_select.control}</td>
      <td><noscript>{$forms.reportForm.btapply.control}&nbsp;</noscript>{$forms.reportForm.btsubmit.control}&nbsp;{$forms.reportForm.btdelete.control}</td>
    </tr>
  </table>
</td>
</tr>
</table>
</div>


 <table cellspacing="4" cellpadding="7" border="0">
  <tr>
    <td valign="top" colspan="2" align="center">

        <table border="0" cellpadding="3">

        <tr>
           <td><b>{$i18n.label.sel_project}</b></td>
           <td>&nbsp;</td>
           <td><b>{$i18n.label.sel_activity}</b></td>
        </tr>

        <tr>
            <td>{$forms.reportForm.project.control}</td>
            <td>&nbsp;</td>
            <td>{$forms.reportForm.activity.control}</td>
        </tr>

        {if ($user->isManager() || $user->isCoManager())}
        <tr>
           <td colspan="3"><b>{$i18n.label.set_empl}</b></td>
        </tr>
        <tr>
           <td colspan="3">{$forms.reportForm.users.control}</td>
        </tr>
        {/if}

        <tr>
            <td><b>{$i18n.label.sel_tp}</b></td>
            <td>&nbsp;</td>
            <td><b>{$i18n.label.set_tp}</b></td>
        </tr>

        <tr valign="top">
            <td>{$forms.reportForm.period.control}</td>
            <td align="right">&nbsp;{$i18n.form.report.from}:</td>
            <td>{$forms.reportForm.from.control}</td>
        </tr>

        <tr>
            <td></td>
            <td align="right">{$i18n.form.report.to}:</td>
            <td>{$forms.reportForm.to.control}</td>
        </tr>

        <tr>
            <td colspan="3"><b>{$i18n.label.fields}</b></td>
        </tr>

        <tr>
            <td colspan="5">
            <table border="0" width="100%">
              <tr>
                <td width="25%">{$forms.reportForm.chproject.control}&nbsp;{$i18n.form.report.project}</td>
                <td width="25%">{$forms.reportForm.chnote.control}&nbsp;{$i18n.form.report.note}</td>
                <td width="25%">{$forms.reportForm.chfinish.control}&nbsp;{$i18n.form.report.finish}</td>
                <td width="25%">{$forms.reportForm.chshowidle.control}&nbsp;{$i18n.form.report.show_idle}</td>
              </tr>
              <tr>
              	<td>{$forms.reportForm.chactivity.control}&nbsp;{$i18n.form.report.activity}</td>
                <td>{$forms.reportForm.chstart.control}&nbsp;{$i18n.form.report.start}</td>
                <td>{$forms.reportForm.chduration.control}&nbsp;{$i18n.form.report.duration}</td>
                <td>{$forms.reportForm.chtotalonly.control}&nbsp;{$i18n.form.report.totals_only}</td>
              </tr>
            </table>
            </td>
        </tr>

        <tr>
            <td><b>{$i18n.label.group_title}</b></td>
            <td></td>
            <td><b>{$i18n.label.include_title}</b></td>
        </tr>

        <tr valign="top">
            <td>{$forms.reportForm.groupby.control}</td>
            <td></td>
            <td>{$forms.reportForm.increcords.control}</td>
        </tr>
        </table>

<div style="padding:10 0 10 0;">
<table border="0" bgcolor="#efefef" width="720">
<tr><td align="center">
   <table cellspacing="1" cellpadding="3" border="0">
    <tr>
      <td>{$i18n.form.filter.filter_new}:</td><td>{$forms.reportForm.f_filter_new.control}</td>
      <td>{$forms.reportForm.btsave.control}</td>
    </tr>
  </table>
</td>
</tr>
</table>
</div>
        <table border="0" cellpadding="3" width="100%">
        <tr>
            <td colspan="3" height="50" align="center">
            {$forms.reportForm.btsubmit.control}
            </td>
        </tr>
        </table>

    </td>
  </tr>
</table>
{$forms.reportForm.close}