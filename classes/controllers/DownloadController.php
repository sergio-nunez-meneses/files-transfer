<?php

class DownloadController
{
  public static function download_link()
  {
    // DownloadModel::get_file_info();
    DownloadView::display();
  }

  public static function download_file($link)
  {
    $form = 'download-form';
    $error = FALSE;
    $error_msg = '';


    if (empty($link))
    {
      $error = TRUE;
      $error_msg .= "Link has expired or doesn't exist <br>";
    }

    if ($error === FALSE)
    {
      // get file link
      $file = DownloadModel::get_file_link();
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
