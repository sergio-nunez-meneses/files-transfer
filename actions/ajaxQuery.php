<?php
chdir('..');
require_once('include/auto_class_loader.php');

MainController::execute($_POST['query'], $_POST);
