<?php 

require 'UsersDatabase.php';
require 'PropertiesDatabase.php';
require 'helpers/adminManager.php';

session_start();

// Array to store login errors if they occur
$loginerrors = isset($_SESSION['loginerrors']) ? $_SESSION['loginerrors'] : [];
$fields= isset($_SESSION['fields']) ? $_SESSION['fields'] : [];

// Database connections
$usersData = new UsersDatabase('data/users.json');
$propertiesData = new PropertiesDatabase('data/properties.json');


if ( isset($_SESSION['username']) ) {
 $username = $_SESSION['username'];
 $name= $usersData->userFullName($username);

 $properties = $propertiesData->dataArray();
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
        <title>100Acres - Buy Sell Properties</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
        <!-- <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css'> -->
        <link rel="stylesheet" href="css/font-awesome.min.css">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/styles.css">
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <div class="container">
        <?php if( !isset($_SESSION['username']) ):  ?>
         <center><h1 class ="loginBox__topHeading">Welcome to 100acres!</h1></center>

         <?php if ( !empty($loginerrors) ) : ?>
         <div class="alert alert-danger loginBox__errorbox">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <?php echo $loginerrors[0];?>
         </div>
         <?php endif; ?>

          <div class="loginBox">
            <form action="login.php" method="POST" role="form">
             <div class="form-group">
               <input type="text" class="form-control loginBox__input" id="" placeholder="Username" name = "username" <?php echo !empty($fields) ? 'value="'. $fields['username'] .'"' : ''; ?>>

               <input type="password" class="form-control loginBox__input" id="" placeholder="Password" name="password">
               </div>
               
               <center><button type="submit" class="btn btn-lg btn-primary loginBox__button">Login</button></center>
            </form> 
          </div>
        <?php endif; ?>

        <?php if( isset($_SESSION['username']) ): ?>
         <div class="header">
          <div class="row">
           <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 header__userinfo">
            <i class="fa fa-user"></i>&nbsp;&nbsp;<a href="#"><?php echo $name; ?></a>
           </div> 
           <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
            <button type="button" class="btn btn-danger header__button--logout" onclick="location.href='./logout.php'"><i class="fa fa-sign-out"></i>&nbsp;LOG OUT</button>
            <?php if( isAdmin($username) ): ?>
            <button type="button" class="btn btn-primary header__button" data-toggle="modal" data-target="#modal_adduser"><i class="fa fa-user-plus"></i>&nbsp;ADD USER</button>
            <button type="button" class="btn btn-primary header__button--report"><i class="fa fa-file"></i>&nbsp; SALES REPORT</button>
            <?php endif; ?>

            <button type="button" class="btn btn-success header__button--sell" data-toggle="modal" data-target="#modal_addproperty"><i class="fa fa-plus"></i>&nbsp;SELL</button>
           </div>
           </div>
          </div>
         <div class="content">
          

         <?php foreach($properties as $id => $property): ?> 
          <a href= <?php echo "buyproperty.php?propertyId=". $id . "&buyer=" . $username; ?> class = "propertyCard">
          <!-- <div class="propertyCard"> -->
            <div class="propertyCard__buyIndicator">CLICK TO BUY THIS PROPERTY</div>
           <span class="propertyCard__name"><?php echo $property['name'] ?></span><br/>
           <span class="propertyCard__location"><?php echo $property['location'] ?></span><br/>
           <span class = "propertyCard__price">&#8377;<?php echo $property['price'] ?></span>
          <!-- </div> -->
            </a>
         <?php endforeach; ?>

         </div>
        <?php endif; ?>
        </div>


        <!-- Modal window to add new user  -->
        <div class="modal fade" id="modal_adduser">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Add New User</h4>
              </div>
              <div class="modal-body">
                <?php 
                  // username
                  // firstname
                  // lastname
                  // password
                 ?>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
              </div>
            </div>
          </div>
        </div>

        <!-- Modal window to sell new property -->
        <div class="modal fade" id="modal_addproperty">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Property details</h4>
              </div>
              <div class="modal-body">
                <?php 
                  //name
                  //location
                  //price
                 ?> 
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
              </div>
            </div>
          </div>
        </div>

        <script src = "js/jquery.min.js"></script>
        <script src = "js/bootstrap.min.js"></script>
    </body>
</html>
<?php 
unset($_SESSION['loginerrors']);
?>