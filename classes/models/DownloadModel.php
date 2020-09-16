<?php

class DownloadModel extends Database
{

  public function get_file_link($link)
  {
    $stmt = $this->run_query('SELECT file_link FROM files WHERE file_link = :link', ['link' => $link]);
    $file = $stmt->fetch();
    return $file;
  }

  public function check_link_date()
  {
    // code...
  }
}
