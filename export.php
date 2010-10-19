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
    if ($user->isAdministrator()) {
      Header("Location: admin.php");
      exit();
    }
  } else {
    $user = null;
  }

  if (is_null($user) || !$user->isManager()) {
    Header("Location: login.php");
    exit();
  }

  $cl_compress = $request->getAttribute("compress");

  $compressors = array("" => $i18n->getKey('form.migration.compression.none'));
  if (@function_exists('gzencode')) $compressors["gzip"] = $i18n->getKey('form.migration.compression.gzip');
  if (@function_exists('bzcompress')) $compressors["bzip"] = $i18n->getKey('form.migration.compression.bzip');

  $form = new Form('migrationForm');
  $form->addInput(array("type"=>"combobox",
    "name"=>"compress",
    "value"=>@$cl_compress,
    "data"=>$compressors
    ));
  $form->addInput(array("type"=>"submit","name"=>"btsubmit","value"=>$i18n->getKey('button.export')));

  if ($request->getMethod()=="POST") {
    $content_encoding = '';
    $filename = "team_data.xml";
    $mime_type = 'text/xml';

    $migration = new MigrationHelper();
    $migration->setManager($user);
    $migration->setErrors($errors);

    switch ($cl_compress) {
      case "gzip":
        $migration->setCompressor('gzip');
        $filename  .= '.gz';
        $content_encoding = 'x-gzip';
        $mime_type = 'application/x-gzip';
      break;

      case "bzip":
        $migration->setCompressor('bzip');
        $filename  .= '.bz2';
        $mime_type = 'application/x-bzip2';
      break;
    }

    $migration->setFileName($filename);
    $migration->exportXml();

    if ($errors->isEmpty()) {
      if (!empty($content_encoding)) {
        header('Content-Encoding: ' . $content_encoding);
      }

      header('Content-Type: ' . $mime_type);
      header('Expires: ' . gmdate('D, d M Y H:i:s') . ' GMT');
      header('Content-Disposition: attachment; filename="' . $filename . '"');
      //header('Content-Disposition: inline; filename="' . $filename . '"');
      header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
      header('Pragma: no-cache');

      if ($fp = @fopen($migration->getFileName(), "r")) {
        while ($data = fread($fp, 4096)) {
          echo $data;
        }
        fclose($fp);
        @unlink($migration->getFileName());
      }
      exit;
    }
  }

  $smarty->assign_by_ref("errors", $errors);
  $smarty->assign("forms",array($form->getName()=>$form->toArray()) );
  $smarty->assign("title_page",$i18n->getKey("form.migration.export.title"));
  $smarty->assign("content_page_name","migration.tpl");
  $smarty->display(INDEX_TEMPLATE);
?>