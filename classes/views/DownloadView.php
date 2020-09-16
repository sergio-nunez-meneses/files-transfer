<?php

class DownloadView
{

  public static function display()
  {
    $title = 'Download IT!';
    ob_start();
    ?>
    <section>
      <form id="download-form" method="POST" enctype="multipart/form-data" onsubmit="ajax(query('download_file', this)); return false;">
        <fieldset>
          <!-- <legend>Download</legend> -->
          <div class="form-group">
            <input type="hidden" name="link" value="<?php echo $_GET['file']; ?>">
            <button class="btn btn-lg bg-dark text-white" type="submit" name="download-button">Download</button>
          </div>
        </fieldset>
      </form>
    </section>
    <?php
    $content = ob_get_clean();
    require('templates/template.php');
  }
}
