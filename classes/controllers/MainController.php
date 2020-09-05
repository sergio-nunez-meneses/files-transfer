<?php

class MainController
{

  public static function execute($query, $inputs = false)
  {
    if ($query === 'transfer_file')
    {
      $response = TransferController::transfer_file();
    }

    if (empty($response) === FALSE)
    {
      echo $response;
    }
  }
}
