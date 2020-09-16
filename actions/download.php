<?php
chdir('..');
require_once('include/auto_class_loader.php');

(new DownloadController)->download_file($_GET['file']);
