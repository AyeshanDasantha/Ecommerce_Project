<?php
session_start();
error_reporting(0);
include('config/config.php');



$query=mysqli_query($con,"SELECT * FROM genaralsetting where id=8");
while($row=mysqli_fetch_array($query)) 
{
  $sitecurrency=$row['setting_description'];
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
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <link rel="stylesheet" href="css/timeline/style.css">

    <!-- CSS Part End-->
</head>
<body>
<div class="wrapper-wide">
  <div id="header">
    <!-- Top Bar Start-->
   <!-- Top header Start-->
    <?php include('includes/header/top-header.php');?>
    <!-- Top header End-->
    <!-- Header Start-->
    <?php include('includes/header/header.php');?>
    <!-- Header End-->
     <!-- Main Menu Start-->
    <?php include('includes/header/menu-bar.php');?>
    <!-- Main Menu End-->
  </div>
  <div id="container">
    <div class="container">
      <!-- Breadcrumb Start-->
      <ul class="breadcrumb">
        <li><a href="index.html"><i class="fa fa-home"></i></a></li>
        <li><a href="about-us.html">dsd</a></li>
      </ul>
      <!-- Breadcrumb End-->
      <div class="row">
<!--Middle Part Start-->
        <div class="col-sm-12" id="content">
          <form class="form-horizontal" role="form" method="post" name="register" onSubmit="return valid();">
            <fieldset id="account">
              <legend>Your Personal Details</legend>
              
              <div style="display: none;" class="form-group required">
                <label class="col-sm-2 control-label">Customer Group</label>
                <div class="col-sm-10">
                  <div class="radio">
                    <label>
                      <input type="radio" checked="checked" value="1" name="customer_group_id">
                      Default</label>
                  </div>
                </div>
              </div>
                                 
 <form class="form-horizontal" role="form" method="post" name="register">
              <div class="form-group required">
                <label for="input-firstname" class="col-sm-2 control-label">Order Code</label>
                <div class="col-sm-10">
                   <input type="text" class="form-control"  placeholder="Enter Your Tracking Code"  name="trakingcode">
                </div>
              </div>
              <div class="form-group required">
                <label for="input-lastname" class="col-sm-2 control-label">Check Securtiy</label>
                <div class="col-sm-10">
                  <?php $query=mysqli_query($con,"SELECT * FROM googlerecapcha");
                               while($row=mysqli_fetch_array($query)) 
                               {
                               ?> 
                                <div class="g-recaptcha" data-sitekey="<?php echo htmlentities($row['site_key']);?>" data-callback="enableBtn"></div> <?php } ?>
                                
                </div>
              </div>
              
              <div class="form-group">
                <label for="input-lastname" class="col-sm-2 control-label"> </label>
                <div class="col-sm-10">
                  <input type="submit" name="submit" class="btn btn-primary" value="Track Your Order" style="cursor:pointer">
                </div>
              </div>
            </form>

            <?php if($emptymsg){?><div class="alert alert-warning"><i class="fa fa-warning"></i><strong>ERROR</strong>:<?php echo htmlentities($emptymsg); ?> </div><?php } 
            else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
            
        <!--Middle Part End -->
              
                        <?php
                        if(isset($_POST['submit']))
                        {
                          $query=mysqli_query($con,"SELECT * FROM googlerecapcha where id=1");
                          while($row=mysqli_fetch_array($query)) 
                          {
                            $secretKey = $row['secret_key'];?>  <?php } ?>
                            <?php
                            $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secretKey."&response=".$_POST['g-recaptcha-response']);
                            $response = json_decode($response,true);
                            if($response["success"] == true)
                            {
                          
                                $trackingcode=$_POST['trakingcode'];
                                $query=mysqli_query($con,"SELECT * FROM orders where orderTrackingCode='$trackingcode'");
                                while($row=mysqli_fetch_array($query)) 
                                {
                                  $trackcd=$row['id'];
                                }
                                if(!empty($trackcd))
                                {
                                    include('timeline/ordersummary.php');
                                    include('timeline/timeline.php');
                                    include('timeline/productsummary.php');                    
                                }
                                else
                                {
                                  $emptymsg =" No Record Found";
                                }
                              }
                              else
                              {
                                $message = "Error..!!! Please Check the google recaptcha";
                              }
                            

                        }
                        ?>
                        <?php if($message){?> <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i><strong>ERROR</strong>:<?php echo htmlentities($message); ?> </div><?php }?>

                        <?php if($emptymsg){?> <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i><strong>ERROR</strong>:<?php echo htmlentities($emptymsg); ?> </div><?php }?>
           
          </div>    
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
<script src='https://www.google.com/recaptcha/api.js'></script>
<!-- JS Part End-->
</body>
</html>