<?php

class DownloadModel extends Database
{

  public static function get_file_info()
  {
    //
  }
  
  public static function get_file_link()
  {
    $stmt = $this->run_query('SELECT file_link FROM files WHERE file_link = :link', ['link' => $link]);
    $file = $stmt->fetch();
    return $file;
  }
}
