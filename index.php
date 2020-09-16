<?php
require_once('include/auto_class_loader.php');

$page = explode('/', $_SERVER['REQUEST_URI']);
// echo url();

if (isset($page) === TRUE) {
  if ($page[1] === '' || $page[1] === 'transfer') {
    TransferController::get_view();
  } elseif ($page[1] === 'download') {
    DownloadController::get_view($_GET['file']);
  } else {
    TransferController::get_view();
  }
} else {
  echo 'Error 404: page not found.';
}
