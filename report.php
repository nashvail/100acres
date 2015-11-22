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
    $error = "You are not authorized to access this content, please login with an admin account.";
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
        <title>Sales Report</title>
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
        <div class="container report_container">
          <?php if( empty($error) ): ?>
            <div role="tabpanel">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#all_properties" aria-controls="home" role="tab" data-toggle="tab">All Properties</a>
                    </li>
                    <li role="presentation">
                        <a href="#sold_properties" aria-controls="tab" role="tab" data-toggle="tab">Sold Properties</a>
                    </li>
                    <li role="presentation">
                        <a href="#unsold_properties" aria-controls="tab" role="tab" data-toggle="tab">Unsold Properties</a>
                    </li>

                </ul>
            
                <!-- Tab panes -->
                <div class="tab-content">
                    <?php 
                      $totalPriceAllProperties = 0;
                      $totalPriceSoldProperties= 0;
                      $totalPriceUnsoldProperties = 0;
                     ?>
                     <!-- All properties -->
                    <div role="tabpanel" class="tab-pane active" id="all_properties">
                      <?php foreach( $allProperties as $property ): ?>
                      <div class="report__propertyRow">
                        <div class="row">
                          <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 report__propertyRow__name">
                          <?php echo $property['name']; ?>
                          </div>
                          <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 report__propertyRow__price">
                          &#8377;<?php 
                            $currentPropertyPrice = $property['price'];
                            $totalPriceAllProperties += $currentPropertyPrice;
                            echo $currentPropertyPrice;
                          ?>
                          </div>
                        </div>
                      </div>
                      <?php endforeach; ?>

                      <div class="report__propertyRow--total">
                        <div class="row">
                          <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 report__propertyRow--total__name">
                          TOTAL
                          </div>
                          <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 report__propertyRow__price">
                          &#8377;<?php 
                            echo $totalPriceAllProperties;
                          ?>
                          </div>
                        </div>
                      </div>
                    </div>

                    <!-- Sold Properties -->
                    <div role="tabpanel" class="tab-pane" id="sold_properties">
                      <?php foreach( $soldProperties as $property ): ?>
                      <div class="report__propertyRow">
                        <div class="row">
                          <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 report__propertyRow__name">
                          <?php echo $property['name']; ?>
                          </div>
                          <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 report__propertyRow__price">
                          &#8377;<?php 
                            $currentPropertyPrice = $property['price'];
                            $totalPriceSoldProperties += $currentPropertyPrice;
                            echo $currentPropertyPrice;
                          ?>
                          </div>
                        </div>
                      </div>
                      <?php endforeach; ?>

                      <div class="report__propertyRow--total">
                        <div class="row">
                          <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 report__propertyRow--total__name">
                          TOTAL
                          </div>
                          <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 report__propertyRow__price">
                          &#8377;<?php 
                            echo $totalPriceSoldProperties;
                          ?>
                          </div>
                        </div>
                      </div>

                    </div>

                    <!-- Unsold Properties -->
                    <div role="tabpanel" class="tab-pane" id="unsold_properties">
                      <?php foreach( $unsoldProperties as $property ): ?>
                      <div class="report__propertyRow">
                        <div class="row">
                          <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 report__propertyRow__name">
                          <?php echo $property['name']; ?>
                          </div>
                          <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 report__propertyRow__price">
                          &#8377;<?php 
                            $currentPropertyPrice = $property['price'];
                            $totalPriceUnsoldProperties += $currentPropertyPrice;
                            echo $currentPropertyPrice;
                          ?>
                          </div>
                        </div>
                      </div>
                      <?php endforeach; ?>

                      <div class="report__propertyRow--total">
                        <div class="row">
                          <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 report__propertyRow--total__name">
                          TOTAL
                          </div>
                          <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 report__propertyRow__price">
                          &#8377;<?php 
                            echo $totalPriceUnsoldProperties;
                          ?>
                          </div>
                        </div>
                      </div>

                    </div>
                </div>
            </div>
          <?php else: ?>
            <br>
            <br>
            <div class="panel panel-danger">
                <div class="panel-heading">
                  <h3 class="panel-title">Unauthorized access!</h3>
                </div>
                <div class="panel-body">
                <?php echo $error; ?>
                </div>
            </div>
          <?php  endif; ?>
        </div>


        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
        <script src = "js/jquery.min.js"></script>
        <script src = "js/bootstrap.min.js"></script>
        <script src = "js/main.js"></script>

    </body>
</html>