<?php

class MainController
{

  public static function execute($query, $inputs = false)
  {
    if ($query === 'transfer_file')
    {
      $response = TransferController::transfer_file();
    }
    elseif ($query === 'download_file')
    {
      $response = DownloadController::download_file();
    }

    if (empty($response) === FALSE)
    {
      echo json_encode($response);
    }
  }
}
