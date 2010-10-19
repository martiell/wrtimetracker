<?php
// +----------------------------------------------------------------------+
// | WR Time Tracker
// +----------------------------------------------------------------------+
// | Copyright (c) 2004-2006 WR Consulting (http://wrconsulting.com)
// +----------------------------------------------------------------------+
// | LIBERAL FREEWARE LICENSE: This source code document may be used
// | by anyone for any purpose, and freely redistributed alone or in
// | combination with other software, provided that the license is obeyed.
// |
// | There are only two ways to violate the license:
// |
// | 1. To redistribute this code in source form, with the copyright
// |    notice or license removed or altered. (Distributing in compiled
// |    forms without embedded copyright notices is permitted).
// |
// | 2. To redistribute modified versions of this code in *any* form
// |    that bears insufficient indications that the modifications are
// |    not the work of the original author(s).
// |
// | This license applies to this document only, not any other software
// | that it may be combined with.
// |
// +----------------------------------------------------------------------+
// | Contributors: Igor Melnik <igor@rivne.com>
// +----------------------------------------------------------------------+

	require_once('initialize.php');
	import('form.Form');
	import('form.ActionForm');
	import('DateAndTime');
	import('UserHelper');
	import('Period');
	import('ProjectHelper');
    import('ActivityHelper');
    import('form.check.Validator');

	if ($auth->isAuthenticated()) {
		$user = new User($auth->getUserId());
		if ($user->isAdministrator()) {
			Header("Location: admin.php");
			exit();
		}
	} else {
		Header("Location: login.php");
		exit();
	}

    $form = new Form('mailForm');
    $form->addInput(array("type"=>"text","size"=>"51","name"=>"receiver"));
    $form->addInput(array("type"=>"text","size"=>"51","name"=>"subject"));
    $form->addInput(array("type"=>"submit","name"=>"btsubmit"));

    $repform = new Form('reportForm');
	$bean = new ActionForm("reportBean", $repform);

	// period
	if ($bean->getAttribute("period")) {
  		$period = new Period($bean->getAttribute("period"), new DateAndTime($i18n->getDateFormat()) );
	} else {
		$o_from = new DateAndTime($i18n->getDateFormat(),$bean->getAttribute("from"));
		$o_to = new DateAndTime($i18n->getDateFormat(),$bean->getAttribute("to"));
		$period = new Period();
		$period->setPeriod($o_from, $o_to);
	}

	// selected users
	if ( ($user->isManager() || $user->isCoManager())
		 && is_array($bean->getAttribute('users'))  )
		$userlist	= join (',', $bean->getAttribute('users'));
    if (!isset($userlist))	$userlist = $user->getUserId();

    // subject
	$users = UserHelper::findAllUsers($user);
	$ua = array();
	foreach ($users as $u) {
		if (!is_null($bean->getAttribute('users'))
			&& is_array($bean->getAttribute('users')) )
		{
			if (in_array($u["u_id"],$bean->getAttribute('users')))
				$ua[] = $u["u_name"];
		}
	}
	$user_info = join (', ', $ua);

	$form->setValueByElement("subject", $i18n->getKey("form.report.title")." - timesheet:  $user_info");
	$form->setValueByElement("btsubmit", $i18n->getKey('button.send') );

	if ($request->getMethod()=="POST") {
    	$cl_receiver = $request->getParameter('receiver');
        $cl_subject = $request->getParameter('subject');
        $cl_comment = $request->getParameter('comment');


        $validator = new Validator($cl_receiver);
        $validator->validateSpaceString();
		$validator->validateEmptyString();
		$validator->validateEmail();
        if (!$validator->isValid()) {
        	$errors->add("receiver",$i18n->getKey("errors.wrong"),$i18n->getKey("form.mail.to"));
        }

        if ($errors->isEmpty()) {
        $letter_structure	= '<html><head><meta http-equiv="Content-Type" content="text/html; charset='.@$i18n->getCharSet().'">'."\n".'</head><body><p>%s</p>%s<p style="text-align: center;">%s</p></div></body></html>';
	    	ob_start();
	   		include(RESOURCE_DIR."/prepare.report_timesheet.php");
	   		include(RESOURCE_DIR."/report_timesheet.php");
	    	$accum = ob_get_clean();
	    	$let_body = sprintf($letter_structure, $cl_comment, $accum, $i18n->getKey("form.mail.footer_str"));

	    	import("mail.Mailer");
	    	$sender = new Mailer();
	    	$sender->setCharSet(CHARSET);
	    	$sender->setContentType("text/html");
	    	$sender->setSender(SENDER);
	    	$sender->setReceiver("$cl_receiver");

	    	/*$v = new Validator($cl_subject);
    		$v->validateLatinCharset();
    		if (!$v->isValid()) {
				$cl_subject = Mail::mimeEncode($cl_subject,CHARSET);
    		}*/

	    	$sender->setSendType(MAIL_MODE);
    		$sender->setHostName(MAIL_SMTP_HOST);

	    	$res = $sender->send($cl_subject, $let_body);
	    	$smarty->assign("result_message", $res ? $i18n->getKey("form.mail.sending_str") :  $i18n->getKey("errors.mail_send"));
        }
    } else {
    	$smarty->assign("onload","onLoad = \"document.mailForm.receiver.focus()\"");
    }

	$smarty->assign_by_ref("errors", $errors);
	$smarty->assign("forms",array($form->getName()=>$form->toArray()));
	$smarty->assign("userdet_string",UserHelper::getUserDetailsString($user,$GLOBALS["I18N"]));
  	$smarty->assign("content_page_name", "email_send.tpl");
  	$smarty->display(INDEX_TEMPLATE);
?>