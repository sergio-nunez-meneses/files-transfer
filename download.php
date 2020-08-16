<?php
require 'download_class.php';

(new Download())->download_file($_GET['file']);
