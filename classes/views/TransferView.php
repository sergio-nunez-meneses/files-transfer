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
      method="POST" enctype="multipart/form-data" onsubmit="ajaxQuery(query('transfer_file', this));">
        <fieldset>
          <legend>Upload</legend>
          <p>
            Files:<br>
            <input type="file" multiple name="files[]">
          </p>
          <p>
            Sender email:<br>
            <input type="email" name="sender-email"/>
          </p>
          <p>
            Receiver email:<br>
            <input type="email" name="receiver-email" />
          </p>
          <p>
            Message:<br>
            <textarea name="email-message" cols="50" rows="8"></textarea>
          </p>
          <p>
            <button type="button" name"send-button">Send</button>
          </p>
        </fieldset>
      </form>
    </section>
    <section id="mailContainer" class="hidden">
      <fieldset>
        <legend>Mail format</legend>
        <p id="errors"></p>
        <p id="subject"></p>
        <p id="messages"></p>
      </fieldset>
    </section>
    <?php
    $content = ob_get_clean();
    require('templates/template.php');
  }
}
