<?php

class DownloadController
{
  public static function get_view($file_name)
  {
    $download_model = new DownloadModel();
    $expiration_date = $download_model->get_expiration_date($file_name);

    if ($expiration_date === TRUE)
    {
      $file_link = $download_model->get_file_link($file_name);
      DownloadView::display($file_link);
    }
    else
    {
      $download_model->detele_file();
      // ErrorView::display();
      echo 'File link has expired <br>';
    }
  }

  public static function download_file($file_name)
  {
    $form = 'download-form';
    $error = FALSE;
    $error_msg = '';

    // if (empty($link))
    // {
    //   $error = TRUE;
    //   $error_msg .= "Link has expired or doesn't exist <br>";
    // }

    if ($error === FALSE)
    {
      // get file link
      // $file = (new DownloadModel)->get_file_link($file_name);
      // $file_link = $file['file_link'];

      // download file
      header('Content-Description: File Transfer');
      header('Content-Type: application/zip');
      header('Content-Disposition: attachment; filename="' . $file_name);
      header('Expires: 0');
      header('Cache-Control: must-revalidate');
      header('Pragma: public');
      header('Content-Length: ' . filesize($file_name));
      // ob_start();
      ob_end_clean();
      readfile($file_name);
      // ob_flush();
      ob_end_flush();
      // ob_end_clean();

      $response = [
        'form' => $form,
        'message' => 'file downloaded'
      ];
      return $response;
    }
    else
    {
      $response = [
        'form' => $form,
        'errors' => $error_msg
      ];
      return $response;
    }
  }
}
