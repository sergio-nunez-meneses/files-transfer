<?php

class DownloadView
{

  public static function display()
  {
    $title = 'Download IT!';
    ob_start();
    ?>
    <form id="download-form" method="POST" enctype="multipart/form-data" onsubmit="ajax(query('download_file', this)); return false;">
      <div class="form-group">
        <button class="btn btn-lg bg-dark text-white" type="submit" name="download-button">Download</button>
      </div>
    </form>
    <?php
    $content = ob_get_clean();
    require('templates/template.php');
  }
}
