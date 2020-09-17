<?php
require_once('include/auto_class_loader.php');
echo realpath('download.php');

$url = explode('/', $_GET['url']);

if (isset($url) === TRUE) {
  if ($url[0] === '' || $url[0] === 'transfer') {
    TransferController::get_view();
  } elseif ($url[0] === 'download') {
    DownloadController::get_view($_GET['file']);
  } else {
    TransferController::get_view();
  }
} else {
  echo 'Error 404: page not found.';
}
