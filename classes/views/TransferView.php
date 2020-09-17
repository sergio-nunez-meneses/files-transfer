<?php

class TransferView
{

  public static function display()
  {
    $title = 'Transfer IT!';
    ob_start();
    ?>
    <section>
      <form id="uploadForm"
      method="POST" enctype="multipart/form-data" onsubmit="ajax(query('transfer_file', this)); return false;">
        <fieldset>
          <legend>Upload</legend>
          <p class="lead">
            Files:
            <div class="form-group">
              <input class="form-control" type="file" multiple name="files[]">
            </div>
          </p>
          <p class="lead">
            Sender email:
            <div class="form-group">
              <input class="form-control" type="email" name="sender-email">
            </div>
          </p>
          <p class="lead">
            Receiver email:
            <div class="form-groupe">
              <input class="form-control" type="email" name="receiver-email">
            </div>
          </p>
          <p class="lead">
            Message:
            <div class="form-group">
              <textarea class="form-control" name="email-message" cols="50" rows="8"></textarea>
            </div>
          </p>
          <p>
            <div class="form-group">
              <button class="btn btn-lg btn-dark text-white" type="submit" name"send-button">Send</button>
            </div>
          </p>
        </fieldset>
      </form>
    </section>
    <?php
    $content = ob_get_clean();
    require('templates/template.php');
  }
}
