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
// | Contributors: Igor Melnik <imelnik@wrconsulting.com>
// +----------------------------------------------------------------------+

  require_once('initialize.php');
  import('form.Form');
  import('UserHelper');
  import('form.check.Validator');

  if ($auth->isPasswordExternal()) {
    Header("Location: login.php");
    exit();
  }

  $form = new Form('fpassForm');
  $form->addInput(array("type"=>"text","maxlength"=>"120","name"=>"login","style"=>"width:300;"));
  $form->addInput(array("type"=>"submit","name"=>"btsubmit","value"=>$i18n->getKey('button.sendpwd')));

  if ($request->getMethod()=="POST") {
    $login = $request->getParameter("login");
    if ($u = UserHelper::findUserByLogin($login)) {
      // prepare pass data
      $temp_ref = md5(uniqid("send_pass"));
      UserHelper::saveTmpRef($temp_ref, $u["u_id"]);

      // get user language
      $user_lang = '';
      $mdb2 = getConnection();
      $sql = 'SELECT u_lang FROM users WHERE u_id='.$u['u_id'];
      $res = &$mdb2->query($sql);
    		
	  if (PEAR::isError($res) == 0) {
	    $val = $res->fetchRow();
	    $user_lang = $val['u_lang'];
	  };
	  if ($user_lang) {
	    $user_i18n = new I18n();
	    $user_i18n->setSourceDir(RESOURCE_DIR);
        $user_i18n->load($user_lang);
      } else {
        $user_i18n = &$i18n;
      }

      $ud = UserHelper::getUserArrById($u['u_id']);
      $receiver = !empty($ud['u_email']) ? $ud['u_email'] : $login;
	  if (!preg_match('/.+@.+/', $receiver)) {
	    $smarty->assign("result_message", $i18n->getKey("errors.fpass_no_user_email"));
	  } else {
        import("mail.Mailer");
  	    $sender = new Mailer();
  	    $sender->setCharSet(CHARSET);
        //$sender->setContentType("text/html");
  	    $sender->setSender(SENDER);
  	    $sender->setReceiver("$receiver");

  	    $cl_subject = $user_i18n->getKey("form.fpass.send_pass_subj");
        if (APP_NAME) {
      	  $pass_edit_url = "http://".$_SERVER["HTTP_HOST"]."/".APP_NAME."/change_password.php?ref=".$temp_ref;
        } else {
          $pass_edit_url = "http://".$_SERVER["HTTP_HOST"]."/change_password.php?ref=".$temp_ref;
        }

        $sender->setSendType(MAIL_MODE);
        $sender->setHostName(MAIL_SMTP_HOST);

        $res = $sender->send($cl_subject, sprintf($user_i18n->getKey("form.fpass.send_pass_body"), $pass_edit_url)); //$pass_val
  	    $smarty->assign("result_message", $res ? $i18n->getKey("form.fpass.send_pass_str") : $i18n->getKey("errors.mail_send"));
	  }
    } else
    $smarty->assign("result_message", $i18n->getKey("errors.search_by_login"));
  }

  $smarty->assign("forms",array($form->getName()=>$form->toArray()));
  $smarty->assign("onload","onLoad=\"document.fpassForm.login.focus()\"");
  $smarty->assign("title_page",$i18n->getKey("form.fpass.title"));
  $smarty->assign("content_page_name", "forgot_pass.tpl");
  $smarty->display(INDEX_TEMPLATE);
?>