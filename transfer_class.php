<?php
require_once 'db.php';
require_once 'functions.php';

class Transfer extends Database
{
  public function transfer_file()
  {
    $form = 'transfer-form';
    $error_msg = '';
    $error = false;

    if (empty($_POST['sender-email'])) {
      $error_msg .= '<p>field can\'t be empty</p>';
      $error = true;
    } elseif (!preg_match('#^[\w.-]+@[\w.-]{2,}\.[a-z]{2,6}$#', $_POST['sender-email'])) {
      $error_msg .= '<p>invalid email format</p>';
      $error = true;
    } else {
      $sender = trim(htmlspecialchars($_POST['sender-email']));
    }

    if (empty($_POST['receiver-email'])) {
      $error_msg .= '<p>field can\'t be empty</p>';
      $error = true;
    } elseif (!preg_match('#^[\w.-]+@[\w.-]{2,}\.[a-z]{2,6}$#', $_POST['receiver-email'])) {
      $error_msg .= '<p>invalid email format</p>';
      $error = true;
    } else {
      $receiver = trim(htmlspecialchars($_POST['receiver-email']));
    }

    if (empty($_POST['email-message'])) {
      $error_msg .= '<p>field can\'t be empty</p>';
      $error = true;
    } elseif (strlen($_POST['email-message']) < 20){
      $error_msg .= '<p>message must contain more than 20 characters</p>';
      $error = true;
    } else {
      $message = trim(addslashes(htmlspecialchars($_POST['email-message'])));
    }

    if (empty($_FILES['files']['name'])) {
      $error_msg .= '<p>field can\'t be empty</p>';
      $error = true;
    } else {
    	$zip = new ZipArchive();
    	$zip_name = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789'), 0, random_int(10, 20)) . '.zip';

      // create zip file
    	if($zip->open($zip_name, ZIPARCHIVE::CREATE) !== true) {
    	  $error_msg .= '<p>failed to compress files</p>';
        $error = true;
    	} else {
        // store files and add them to the zip file
      	$total_files = sizeof($_FILES['files']['name']);
      	for ($i = 0; $i < $total_files; $i++) {
          $file_name = $_FILES['files']['name'][$i];
          move_uploaded_file($_FILES['files']['tmp_name'][$i], $file_name);
          $zip->addFile($file_name);
      	}
      	$zip->close();

        // remove files from $directory
      	for ($i = 0; $i < $total_files; $i++) {
      		$file_name = $_FILES['files']['name'][$i];
      		unlink($file_name);
      	}
      }
    }

    // check .zip file size
    if (filesize($zip_name) > 2000000) {
      $error_msg .= '<p>files size must not exceed 4Go</p>';
      $error = true;
    }

    if (!$error) {
      // remove .zip extension
      $file_name = preg_replace('/\\.[^.\\s]{3,4}$/', '', $zip_name);

      // store sender in db and get its id
      $this->run_query('INSERT INTO senders VALUES (NULL, :sender)', ['sender' => $sender]);
      $stmt = $this->run_query('SELECT LAST_INSERT_ID()');
      $sender_id = $stmt->fetch();
      $sender_id = $sender_id['LAST_INSERT_ID()'];

      // store file in db
      $this->run_query('INSERT INTO files VALUES (NULL, :file_name, 0, NOW(), :zip_name, :sender_id)', ['file_name' => $file_name, 'zip_name' => $zip_name, 'sender_id' => $sender_id]);

      // format mail
      $messages = 'Sender: ' . $sender . PHP_EOL . '<br>';
      $messages .= 'Receiver: '. $receiver . PHP_EOL . '<br>';
      $messages .= 'Message: '. $message . PHP_EOL . '<br>';
      $messages .= 'Download link: <a href="' . url() . DIRECTORY_SEPARATOR . 'download.php?file=' . $zip_name . '">Files</a>';

      $subject = 'File sent via Transfer it';

      mail($sender, $subject, $messages);
      mail($receiver, $subject, $messages);

      $array = [
        'form' => $form,
        'errors' => '',
        'subject' => $subject,
        'messages' => $messages
      ];
      echo json_encode($array);
    } else {
      $array = [
        'form' => $form,
        'errors' => $error_msg,
        'subject' => '',
        'messages' => ''
      ];
      echo json_encode($array);
    }
  }
}
