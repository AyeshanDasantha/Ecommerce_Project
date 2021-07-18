<?php
session_start();
error_reporting(0);
include("config/config.php");
if(isset($_POST['submit']))
{
  $email=($_POST['email']);

    $ret=mysqli_query($con,"SELECT * FROM users WHERE email='$email'");
    $num=mysqli_fetch_array($ret);
    if($num>0)
    {
      $forgotcode = md5(rand());
      $query=mysqli_query($con,"UPDATE users SET recoveryPassword='$forgotcode' WHERE email='$email'");

      $query=mysqli_query($con,"SELECT * FROM genaralsetting where id=1");
      while($row=mysqli_fetch_array($query)) 
      {
        $sitename=$row['setting_description'];
      }
      $querys=mysqli_query($con,"SELECT * FROM genaralsetting where id=4");
      while($rows=mysqli_fetch_array($querys)) 
      {
        $logo=$rows['setting_description'];
      }
      $host=$_SERVER['HTTP_HOST'];
      $uri=rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
      require 'phpmailer/forgotpwmail.php'; 

      $successmsg="Password Reset Link Sent Your Email.";  
    }
    else
    {
      $errormsg="Cant Find Your Account.";
    }

}
$query=mysqli_query($con,"SELECT status FROM sitemaintenance where id=1");
while($row=mysqli_fetch_array($query)) 
{
$maintincestatus = $row['status'];
if($maintincestatus==1)
{
    header('location:Maintenance/index.php');
}
}
?>


<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<meta name="format-detection" content="telephone=no" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<?php $query=mysqli_query($con,"SELECT * FROM genaralsetting where id=9");
    while($row=mysqli_fetch_array($query)) 
    {
     ?>
  <meta name="description" content="<?php echo htmlentities($row['setting_description']);?>"><?php }?>
  <?php $query=mysqli_query($con,"SELECT * FROM genaralsetting where id=10");
    while($row=mysqli_fetch_array($query)) 
    {
     ?>
    <meta name="keywords" content="<?php echo htmlentities($row['setting_description']);?>"><?php }?>

    <?php $query=mysqli_query($con,"SELECT * FROM genaralsetting where id=11");
    while($row=mysqli_fetch_array($query)) 
    {
     ?>
     <link rel="shortcut icon" type="image/x-icon" href="images/favicon/<?php echo htmlentities($row['setting_description']);?>"/><?php }?>
  
  <?php $query=mysqli_query($con,"SELECT * FROM genaralsetting where id=1");
    while($row=mysqli_fetch_array($query)) 
    {
     ?>  
    <title><?php echo htmlentities($row['setting_description']);?></title><?php }?>
<!-- CSS Part Start-->
<link rel="stylesheet" type="text/css" href="js/bootstrap/css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="css/font-awesome/css/font-awesome.min.css" />
<link rel="stylesheet" type="text/css" href="css/stylesheet.css" />
<link rel="stylesheet" type="text/css" href="css/owl.carousel.css" />
<link rel="stylesheet" type="text/css" href="css/owl.transitions.css" />
<link rel="stylesheet" type="text/css" href="css/responsive.css" />
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans' type='text/css'>
<!-- CSS Part End-->
</head>
<body>
<div class="wrapper-wide">
  <div id="header">
     <!-- Top header Start-->
    <?php include('includes/header/top-header.php');?>
    <!-- Top header End-->
    <!-- Header Start-->
    <?php include('includes/header/header.php');?>
    <!-- Header End-->
     <!-- Main Menu Start-->
    <?php include('includes/header/menu-bar.php');?>
    <!-- Main Menu End-->
    <!-- Main Menu End-->
  </div>
  <div id="container">
    <div class="container">
      <!-- Breadcrumb Start-->
      <ul class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-home"></i></a></li>
        <li><a href="my-account/profile.php">Account</a></li>
        <li><a href="login.php">Login</a></li>
      </ul>
      <!-- Breadcrumb End-->
      <div class="row">
        <!--Middle Part Start-->
        <div id="content" class="col-sm-9">
          <h1 class="title">Account Login</h1>
          <div class="row">
            <div class="col-sm-6">
              <h2 class="subtitle">New Customer</h2>
              <p><strong>Register Account</strong></p>
              <p>By creating an account you will be able to shop faster, be up to date on an order's status, and keep track of the orders you have previously made.</p>
              <a href="register.php" class="btn btn-primary">Continue</a> </div>
            <div class="col-sm-6">
              <h2 class="subtitle">Forgotten Password</h2>
              <p><strong>Please Enter Your Email Address</strong></p>
                <div class="form-group">
                  <form class="register-form outer-top-xs" method="post">
                  <span style="color:red;" >
                    
                  </span>
                  <?php if($successmsg)
              {?>
                <span style="color:green;" >
                <strong><?php echo htmlentities($successmsg);?><?php }?></strong>
                </span>
                <?php if($errormsg)
              {?>
                <span style="color:red;" ><strong>
                <?php echo htmlentities($errormsg);?><?php }?></strong>

                  
                    
                  </span>
                  <br>
                  <label class="control-label" for="input-email">E-Mail Address</label>
                  <input type="text" name="email" value="" placeholder="E-Mail Address" id="input-email" class="form-control" />
                </div>
                <div class="form-group">
                 </div>
               <button type="submit" class="btn-upper btn btn-primary checkout-page-button" name="submit">Submit</button>
  </form> 
            </div>
          </div>
        </div>
        <!--Middle Part End -->
        <!--Right Part Start -->
        <?php include('includes/side-bar.php');?>
        <!--Right Part End -->
      </div>
    </div>
  </div>
  <!--Footer Start-->
  <?php include('includes/footer/footer.php');?>
  <!--Footer End-->
  <?php include('includes/slide-blocks/slide-blocks.php');?>
  <!-- Custom Side Block End -->
</div>
<!-- JS Part Start-->
<script type="text/javascript" src="js/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="js/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/jquery.easing-1.3.min.js"></script>
<script type="text/javascript" src="js/jquery.dcjqaccordion.min.js"></script>
<script type="text/javascript" src="js/owl.carousel.min.js"></script>
<script type="text/javascript" src="js/custom.js"></script>
<!-- JS Part End-->
</body>
</html>