<?php
require_once 'db.php';

class Download extends Database
{
  public function download_file($link)
  {
    $form = 'download-form';
    $error_msg = '';
    $error = false;

    if (empty($link)) {
      $error_msg .= '<p>link has expired or doesn\'t exist</p>';
      $error = true;
    }

    if (!$error) {
      // get file link
      $stmt = $this->run_query('SELECT file_link FROM files WHERE file_link = :link', ['link' => $link]);
      $file = $stmt->fetch();
      $file_link = $file['file_link'];

      // download file
      header('Content-Description: File Transfer');
      header('Content-Type: application/zip');
      header('Content-Disposition: attachment; filename="' . $file_link);
      header('Expires: 0');
      header('Cache-Control: must-revalidate');
      header('Pragma: public');
      header('Content-Length: ' . filesize($file_link));
      ob_clean();
      readfile($file_link);
      ob_flush();

      $array = [
        'form' => $form,
        'message' => 'file downloaded'
      ];
      echo json_encode($array);
    }
  }
}
