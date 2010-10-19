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
    import('ReportHelper');
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
    $form->addInput(array("type"=>"text","size"=>"51","name"=>"cc"));
    $form->addInput(array("type"=>"text","size"=>"51","name"=>"subject"));
    $form->addInput(array("type"=>"textarea","name"=>"comment","maxlength"=>"250","style"=>"width: 330; height: 85;"));
    $form->addInput(array("type"=>"submit","name"=>"btsubmit"));

    $bean = new ActionForm("mailBean", $form, $request);
    $form->setValueByElement("btsubmit", $i18n->getKey('button.send') );

    $form2 = new Form("invoiceForm");
	$invbean = new ActionForm("invoiceBean", $form2);
	$repbean = new ActionForm("reportBean", $form2);

	if ($request->getMethod()=="POST") {
    	$cl_receiver = $request->getParameter('receiver');
    	$cl_cc = $request->getParameter('cc');
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

	    	$accum =  ReportHelper::prepareInvoice($repbean, $invbean, $user, $i18n, $errors);
	    	$let_body = sprintf($letter_structure, $cl_comment, $accum, $i18n->getKey("form.mail.footer_str"));

	    	import("mail.Mailer");
	    	$sender = new Mailer();
	    	$sender->setCharSet(CHARSET);
	    	$sender->setContentType("text/html");
	    	$sender->setSender(SENDER);
	    	$sender->setReceiver("$cl_receiver");
	    	if (isset($cl_cc)) $sender->setReceiverCC("$cl_cc");

    		/*$v = new Validator($cl_subject);
    		$v->validateLatinCharset();
    		if (!$v->isValid()) {
				$cl_subject = Mail::mimeEncode($cl_subject,CHARSET);
    		}*/

    		$sender->setSendType(MAIL_MODE);
    		$sender->setHostName(MAIL_SMTP_HOST);

	    	$res = $sender->send($cl_subject, $let_body);
	    	$smarty->assign("result_message", $res ? $i18n->getKey("form.invoice.sending_str") : $i18n->getKey("errors.mail_send"));
        }
    } else {
    	if ($repbean->getAttribute("period")) {
	  		$period = new Period($repbean->getAttribute("period"), new DateAndTime($i18n->getDateFormat()) );
		} else {
			$o_from = new DateAndTime($i18n->getDateFormat(),$repbean->getAttribute("from"));
			$o_to = new DateAndTime($i18n->getDateFormat(),$repbean->getAttribute("to"));
			$period = new Period();
			$period->setPeriod($o_from, $o_to);
		}
    	$form->setValueByElement("subject",
    		$user->getCompanyName() . ", " . $i18n->getKey('form.invoice.sending_subj') .
    		" " . $period->getBeginDate() . "-" . $period->getEndDate()	);
    	$form->setValueByElement("receiver",
    		$user->getLogin());
    }

	$smarty->assign_by_ref("errors", $errors);
	$smarty->assign("title_page",$i18n->getKey("form.invoice.title"));
	$smarty->assign("forms",array($form->getName()=>$form->toArray()));
	$smarty->assign("userdet_string",UserHelper::getUserDetailsString($user,$GLOBALS["I18N"]));
    $smarty->assign("onload","onLoad = \"document.mailForm.receiver.focus()\"");
  	$smarty->assign("content_page_name", "invoice_send.tpl");
  	$smarty->display(INDEX_TEMPLATE);
?>