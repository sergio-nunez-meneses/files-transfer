<?php
require_once('functions/functions.php');

class DownloadView
{

  public static function display()
  {
    $title = 'Download IT!';
    ob_start();
    ?>
    <section>
      <a class="btn btn-md bg-dark text-white" href="<?php echo url() . '/actions/download.php?file=' . $_GET['file']; ?>">Download</a>
    </section>
    <?php
    $content = ob_get_clean();
    require('templates/template.php');
  }
}
