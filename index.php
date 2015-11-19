<?php 

require 'UsersDatabase.php';

session_start();

$usersData = new UsersDatabase('data/users.json');

if ( isset($_SESSION['username']) ) {
 $username = $_SESSION['username'];
 $name= $usersData->userFullName($username);
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
        <title>100Acres - Login</title>
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
        <div class="container">
        <?php if( !isset($_SESSION['username']) ):  ?>
         <center><h1 class ="loginBox__topHeading">Welcome to 100acres!</h1></center>
          <div class="loginBox">
            <form action="login.php" method="POST" role="form">
             <div class="form-group">
               <input type="text" class="form-control loginBox__input" id="" placeholder="Username" name = "username">

               <input type="password" class="form-control loginBox__input" id="" placeholder="Password" name="password">
               </div>
               
               <center><button type="submit" class="btn btn-lg btn-primary loginBox__button">Login</button></center>
            </form> 
          </div>
        <?php endif; ?>

        <?php if( isset($_SESSION['username']) ): ?>
         <div class="header">
          <div class="row">
           <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7 header__userinfo">
            <i class="fa fa-user"></i>&nbsp;&nbsp;<a href="#"><?php echo $name; ?></a>
           </div> 
           <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
            <button type="button" class="btn btn-danger header__button--sell" onclick="location.href='./logout.php'">LOG OUT</button>
            <button type="button" class="btn btn-success header__button--logout"><i class="fa fa-plus"></i>&nbsp;SELL</button>
           </div>
           </div>
          </div>
         <div class="content">


         </div>
        <?php endif; ?>
        </div>
    </body>
</html>