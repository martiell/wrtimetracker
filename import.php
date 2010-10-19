<?php
// +----------------------------------------------------------------------+
// | WR Time Tracker
// +----------------------------------------------------------------------+
// | Copyright (c) 2006 WR Consulting (http://wrconsulting.com)
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
  import('MigrationHelper');
  import('form.Form');
  import('UserHelper');

  if ($auth->isAuthenticated()) {
    $user = new User($auth->getUserId());
    if (!$user->isAdministrator()) {
      Header("Location: login.php");
      exit();
    }
  }

  if ($request->getMethod()=="POST") {
    if ($request->getAttribute("btsubmit")!=null) {
      $uploadDir = TEMPLATE_DIR . '_c/';
      $uploadFilename = md5(uniqid("upload_file"))."upload";
      $uploadFile = $uploadDir . $uploadFilename;

      if (!move_uploaded_file($_FILES['xmlfile']['tmp_name'], $uploadFile)) {
        $errors->add("upload", $i18n->getKey("errors.upload"));
      }

      if ($errors->isEmpty()) {

        $migration = new MigrationHelper();
        $migration->setErrors($errors);
        $migration->setManager($user);
        $migration->setFileName($uploadFile);

        $compressor_ext = Array( 'bzip' => Array('bz','tbz','bz2','tbz2'), 'gzip' => Array('gz','tgz') );
        $file_ext = substr($_FILES['xmlfile']['name'], strrpos($_FILES['xmlfile']['name'], '.')+1);
        foreach ( $compressor_ext as $ctype=>$cext) if (in_array($file_ext, $cext)) $migration->setCompressor($ctype);

        $migration->importXml();

        if ($errors->isEmpty()) {
          $messages->add("imported",$i18n->getKey("form.migration.import.success"));
          //Header("Location: admin.php");
        }
        @unlink($uploadFile);
      }
    }
  }

  $form = new Form('migrationForm');
  $form->addInput(array("type"=>"upload","name"=>"xmlfile","value"=>"browse","maxsize"=>10000000));
  $form->addInput(array("type"=>"submit","name"=>"btsubmit","value"=>$i18n->getKey('button.import')));

  $smarty->assign_by_ref("messages", $messages);
  $smarty->assign_by_ref("errors", $errors);
  $smarty->assign("forms",array($form->getName()=>$form->toArray()) );
  $smarty->assign("title_page",$i18n->getKey("form.migration.import.title"));
  $smarty->assign("content_page_name","migration.tpl");
  $smarty->display(INDEX_TEMPLATE);
?>