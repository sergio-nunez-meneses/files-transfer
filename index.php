<?php
require_once('include/auto_class_loader.php');

$page = explode('/', $_SERVER['REQUEST_URI']);
var_dump($page);

if (($_SERVER['REQUEST_URI'] === '/') || ($_SERVER['REQUEST_URI'] === '')) {
  TransferController::transfer_form();
} elseif ($page[1] === 'download') {
  DownloadController::download_file($_GET['file']);
} elseif ($_SERVER['REQUEST_URI'] === '/error') {
  // error page
} else {
  TransferController::transfer_form();
}

// require_once('include/auto_js_loader.php');
