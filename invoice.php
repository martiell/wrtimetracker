<?php
// +----------------------------------------------------------------------+
// | WR Time Tracker
// +----------------------------------------------------------------------+
// | Copyright (c) 2004-2005 WR Consulting (http://wrconsulting.com)
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
	import('form.check.Validator');
	import('DateAndTime');
	import('Period');
	import('ProjectHelper');
    import('ActivityHelper');
    import('UserHelper');
    import('InvoiceHelper');
    import('ClientHelper');

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

	$client_list = ClientHelper::findAllClients($user->getOwnerId());
	
	$form = new Form("invoiceForm");
    $form->addInput(array("type"=>"datefield","name"=>"date","size"=>"20"));
    $form->addInput(array("type"=>"text","name"=>"number","size"=>"20"));
    $form->addInput(array("type"=>"textarea","name"=>"yourcoo","maxlength"=>"255","cols"=>"50","rows"=>"5"));
    $form->addInput(array("type"=>"textarea","name"=>"custcoo","maxlength"=>"255","cols"=>"50","rows"=>"5"));
    $form->addInput(array("type"=>"textarea","name"=>"comment","maxlength"=>"200","cols"=>"50","rows"=>"5"));
    $form->addInput(array("type"=>"floatfield","name"=>"tax","size"=>"10","format"=>".2"));
    $form->addInput(array("type"=>"checkbox","name"=>"daily_subtotals","data"=>1));
	$form->addInput(array("type"=>"floatfield","name"=>"discount","size"=>"10","format"=>".2"));
    $form->addInput(array("type"=>"submit","name"=>"btsubmit"));
    $form->addInput(array("type"=>"combobox",
    	"onchange"=>"document.invoiceForm.client_form.value=1; document.invoiceForm.submit();",
    	"name"=>"client",
    	"style"=>"width: 250",
    	"data"=>$client_list,
    	"datakeys"=>array("clnt_id","clnt_name"),
    	"empty"=>array(""=>$i18n->getKey('controls.select.client'))
    	));
    $form->addInput(array("type"=>"hidden","name"=>"client_form"));
	
	$bean = new ActionForm("invoiceBean", $form, $request);
	$form->setValueByElement("btsubmit",$i18n->getKey('button.generate'));
	$form->setValueByElement("client_form","");
	
	if ($request->getMethod()=="POST") {
		
		if ($request->getAttribute("client_form")) {
			if ($bean->getAttribute("client")) {
				ClientHelper::fillBean($user, $bean->getAttribute("client"), $bean);
				$bean->saveBean();
				header("Location: invoice.php");
			}
		} else {
			$d = new DateAndTime($i18n->getDateFormat(),$bean->getAttribute("date"));
			$validator = new Validator($bean->getAttribute("date"));
			$validator->validateSpaceString();
			$validator->validateEmptyString();
			if (!$validator->isValid() || $d->isError()) {
				$errors->add("date",$i18n->getKey("errors.wrong"),$i18n->getKey("form.invoice.date"));	
			}
			
			$validator = new Validator($bean->getAttribute("number"));
			$validator->validateSpaceString();
			$validator->validateEmptyString();
			//$validator->validateLatinCharset();
			if (!$validator->isValid()) {
				$errors->add("number",$i18n->getKey("errors.wrong"),$i18n->getKey("form.invoice.number"));	
			}
			
			if ($request->getAttribute("tax")) {
				$validator = new Validator($request->getAttribute("tax"));
				$validator->validateSpaceString();
				$validator->validateEmptyString();
				$validator->validateFloat($i18n->getFloatDelimiter());
				if (!$validator->isValid()) {
					$errors->add("tax",$i18n->getKey("errors.wrong"),$i18n->getKey("form.invoice.tax"));	
				}
			}
			
			if ($request->getAttribute("discount")) {
				$validator = new Validator($request->getAttribute("discount"));
				$validator->validateSpaceString();
				$validator->validateEmptyString();
				$validator->validateFloat($i18n->getFloatDelimiter());
				if (!$validator->isValid()) {
					$errors->add("discount",$i18n->getKey("errors.wrong"),$i18n->getKey("form.invoice.discount"));	
				}
			}
			
	        if ($errors->isEmpty()) {
	        	$bean->saveBean();
	        	
	        	InvoiceHelper::saveInvoiceHeader($user, $bean);
	        	header("Location: invoice_table.php");
	        }
		}
	}//POST
	
	if (!$bean->isSaved()) { // stored in session
		InvoiceHelper::loadInvoiceHeader($user, $bean);
    	
		$crdate = new DateAndTime($i18n->getDateFormat());
		$form->setValueByElement("date", $crdate->toString());
    }

    $smarty->assign_by_ref("errors", $errors);
    $smarty->assign("forms",array($form->getName()=>$form->toArray()));
    $smarty->assign("onload","onLoad = \"document.invoiceForm.number.focus()\"");
	$smarty->assign("userdet_string",UserHelper::getUserDetailsString($user,$GLOBALS["I18N"]));
	$smarty->assign("title_page",$i18n->getKey("form.invoice.title"));
  	$smarty->assign("content_page_name", "invoice.tpl");
  	$smarty->display(INDEX_TEMPLATE);
?>