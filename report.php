<?php 
  session_start();

  require 'helpers/adminManager.php';
  require 'JSONStream.php';
  require 'PropertiesDatabase.php';

  $error;

  if ( isset($_SESSION['username']) && isAdmin($_SESSION['username']) ) {

    $propertiesDatabase = new PropertiesDatabase('data/properties.json');

    $allProperties = $propertiesDatabase->dataArray();
    $soldProperties = $propertiesDatabase->soldProperties();
    $unsoldProperties = $propertiesDatabase->unsoldProperties();
    
  } else {
    // unauthorised accces
    $error = "Unauthorized Access";
  }

?>

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
        <link rel="stylesheet" href="css/font-awesome.min.css">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/styles.css">

    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <!-- Add your site or application content here -->
        <div class="container">
          <?php if( empty($error) ): ?>
            <p>Hello world! This is HTML5 Boilerplate.</p>
          <?php endif; ?>
        </div>


        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
        <script src = "js/jquery.min.js"></script>
        <script src = "js/bootstrap.min.js"></script>
        <script src = "js/main.js"></script>

    </body>
</html>