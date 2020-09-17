<?php require_once('functions/functions.php'); ?>
<!doctype html>
<html>
  <head>
    <meta http-equiv="Content-Type" charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Sergio Núñez Meneses" name="author">
    <base href="<?php echo url(); ?>">
    <link rel="icon" type="image/png" href="<?php echo url(); ?>/public/img/favicon.png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo url(); ?>/public/css/normalize.css">
    <link rel="stylesheet" href="<?php echo url(); ?>/public/less/style.css">
    <title><?php echo $title; ?></title>
  </head>
  <body>

    <header>
      <h2>Transfer IT!</h2>
      <p class="lead">Send files up to 4Go</p>
    </header>

    <main>
      <?php echo $content; ?>
      <section id="mailContainer" class="d-none">
        <fieldset>
          <legend>Mail format</legend>
          <p id="errors" class="lead"></p>
          <p id="subject" class="lead"></p>
          <p id="messages" class="lead"></p>
        </fieldset>
      </section>
    </main>

    <footer>
      <h3>Made by</h3>
      <p class="lead">Sergio Núñez Meneses - 2020</p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="<?php echo url(); ?>/public/js/ajax.js"></script>
  </body>
</html>
