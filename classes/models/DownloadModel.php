<?php

class DownloadModel extends Database
{

  public function get_expiration_date($file_name)
  {
    $stmt = $this->run_query('SELECT expiration_date FROM files WHERE file_link = :file_name', ['file_name' => $file_name]);
    $date = $stmt->fetch();

    if ($date['expiration_date'] > date('Y-m-d H:i:s'))
    {
      return TRUE;
    }
    else
    {
      return FALSE;
    }
  }

  public function get_file_link($file_name)
  {
    $stmt = $this->run_query('SELECT file_link FROM files WHERE file_link = :file_name', ['file_name' => $file_name]);
    $file = $stmt->fetch();
    return $file['file_link'];
  }

  public function detele_file()
  {
    $this->run_query('DELETE * FROM files WHERE expiration_date < NOW()');
  }
}
