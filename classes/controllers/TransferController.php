<?php
require_once('functions/functions.php');

class TransferController
{
  public static function get_view()
  {
    return TransferView::display();
  }

  public static function transfer_file()
  {
    $form = 'transfer-form';
    $error = FALSE;
    $error_msg = '';

    if (empty($_POST['sender-email']))
    {
      $error = TRUE;
      $error_msg .= "Field can't be empty <br>";
    }
    elseif (!preg_match('#^[\w.-]+@[\w.-]{2,}\.[a-z]{2,6}$#', $_POST['sender-email']))
    {
      $error = TRUE;
      $error_msg .= 'Invalid email format <br>';
    }
    else
    {
      $sender = trim(htmlspecialchars($_POST['sender-email']));
    }

    if (empty($_POST['receiver-email']))
    {
      $error = TRUE;
      $error_msg .= "Field can't be empty <br>";
    }
    elseif (!preg_match('#^[\w.-]+@[\w.-]{2,}\.[a-z]{2,6}$#', $_POST['receiver-email']))
    {
      $error = TRUE;
      $error_msg .= 'Invalid email format <br>';
    }
    else
    {
      $receiver = trim(htmlspecialchars($_POST['receiver-email']));
    }

    if (empty($_POST['email-message']))
    {
      $error = TRUE;
      $error_msg .= "Field can't be empty <br>";
    }
    elseif (strlen($_POST['email-message']) < 20)
    {
      $error = TRUE;
      $error_msg .= 'Message must contain more than 20 characters <br>';
    }
    else
    {
      $message = trim(addslashes(htmlspecialchars($_POST['email-message'])));
    }

    if (empty($_FILES['files']['name']))
    {
      $error = TRUE;
      $error_msg .= "Field can't be empty <br>";
    }
    else
    {
    	$zip = new ZipArchive();
    	$zip_name = 'transfer-it-' . substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789'), 0, random_int(10, 20)) . '.zip';

      // create zip file
    	if($zip->open($zip_name, ZIPARCHIVE::CREATE) !== TRUE)
      {
        $error = TRUE;
    	  $error_msg .= 'Failed to compress files <br>';
    	}
      else
      {
        // store files and add them to the zip file
      	$total_files = sizeof($_FILES['files']['name']);

      	for ($i = 0; $i < $total_files; $i++) {
          $file_name = $_FILES['files']['name'][$i];
          move_uploaded_file($_FILES['files']['tmp_name'][$i], $file_name);
          $zip->addFile($file_name);
      	}

      	$zip->close();

        // remove files from $directory
      	for ($i = 0; $i < $total_files; $i++)
        {
      		$file_name = $_FILES['files']['name'][$i];
      		unlink($file_name);
      	}
      }
    }

    // check .zip file size
    if (filesize($zip_name) > 2000000)
    {
      $error = TRUE;
      $error_msg .= 'Files size must not exceed 4Go <br>';
    }

    if ($error === FALSE)
    {
      // remove .zip extension
      $file_name = preg_replace('/\\.[^.\\s]{3,4}$/', '', $zip_name);

      $transfer = new TransferModel();
      // store sender in db and get its id
      $sender_id = $transfer->store_sender($sender);

      // store file in db
      $transfer->store_file($file_name, $zip_name, $sender_id);

      // format mail
      $messages = 'Sender: ' . $sender . PHP_EOL . '<br>';
      $messages .= 'Receiver: '. $receiver . PHP_EOL . '<br>';
      $messages .= 'Message: '. $message . PHP_EOL . '<br>';
      // $messages .= 'Download link: <a href="' . url() . '/download?file=' . $zip_name . '" target="_blank">Files</a>';
      $messages .= 'Download link: <a href="' . url() . '/download.php?file=' . $zip_name . '" target="_blank">Files</a>';

      $subject = 'File(s) sent via Transfer IT';

      mail($sender, $subject, $messages);
      mail($receiver, $subject, $messages);

      $response = [
        'form' => $form,
        'errors' => '',
        'subject' => $subject,
        'messages' => $messages
      ];
      return $response;
    }
    else
    {
      $response = [
        'form' => $form,
        'errors' => $error_msg,
        'subject' => '',
        'messages' => ''
      ];
      return $response;
    }
  }
}
