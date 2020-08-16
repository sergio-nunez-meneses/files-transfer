<?php include 'header.php'; ?>

<section>
  <form id="uploadForm" action="transfer.php" method="POST" enctype="multipart/form-data"
  onsubmit="AJAXSubmit(this); return false;">
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
        <button type="submit" name"send-button">Send</button>
      </p>
    </fieldset>
  </form>
</section>
<section>
  <fieldset>
    <legend>Mail format</legend>
    <p id="demo1"></p>
    <p id="demo2"></p>
    <p id="demo3"></p>
    <p id="demo4"></p>
  </fieldset>
</section>

<?php include 'footer.php'; ?>
