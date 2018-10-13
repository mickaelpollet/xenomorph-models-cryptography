<?php

/*************************************
 * @project:  Xenomorph - Models - Cryptography
 * @file:     Demonstration Page
 * @author:   Mickaël POLLET
 *************************************/

try {

  // Auto-chargement des classes
  if (file_exists(__DIR__ . '/vendor/autoload.php')) {
  	require_once(__DIR__ . '/vendor/autoload.php');
  } else {
    throw new Exception("L'Auto-chargement des classes n'a pas été trouvé");
  }

?>

<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">

    <head>
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">

      <title>Xenomorph - Models : Cryptography</title>

      <!-- Déclaration CSS
      ================================================== -->
      <!-- Bootstrap -->
      <link rel="stylesheet" href="vendor/twbs/bootstrap/dist/css/bootstrap.min.css">
      <link rel="stylesheet" href="vendor/twbs/bootstrap/dist/css/bootstrap-theme.min.css">
      <!-- FontAwsome -->
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

      <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
      <!-- WARNING: Respond.js doesn\'t work if you view the page via file:// -->
      <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->

      <!--[if lt IE 10]>
          <div style="position:relative; color:#fff; top:0px; width:100%; height:40px; background-color:#A0152D; margin-top:0px; padding:5px; border-bottom:solid 5px #791022; text-align: center">
              <p>Cette application a été conçue pour fonctionner <b>à partir de la version 10 d\'Internet Explorer</b>. Mettez votre navigateur à jour ou utilisez un navigateur alternatif.</p>
          </div>
      <![endif]-->

    </head>

    <body>

      <?php

        echo "<h1>Xenomorph - Models : Cryptography</h1>";

        // Appel du code
        require_once(__DIR__ . '/exemple.php');

      ?>

      <!-- Déclaration Javascript
      ================================================== -->
      <!-- Bootstrap -->
      <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"                          integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
      <script src="vendor/twbs/bootstrap/dist/js/bootstrap.min.js"></script>

    </body>

  <html>

<?php

} catch (Exception $e) {
  $error_message = $e->getMessage();
  include (__DIR__ . '/views/critical_error.vew.php');
  exit;
}

?>
