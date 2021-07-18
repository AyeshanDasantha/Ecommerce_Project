<?php
session_start();
error_reporting(0);
include('config/config.php');
if(isset($_POST['send']))
  {
$name=$_POST['fullname'];
$email=$_POST['email'];
$contactno=$_POST['contactno'];
$message=$_POST['message'];
$query=mysqli_query($con,"insert into tblcontactusquery(name,EmailId,ContactNumber,Message) values('$name','$email','$contactno','$message')");
$lastInsertId="Registration successfull. Now You can login !";
if($lastInsertId)
{
$msg="Query Sent. We will contact you shortly";
}
else 
{
$error="Something went wrong. Please try again";
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
  </div>
  <div id="container">
    <div class="container">
      <!-- Breadcrumb Start-->
      <ul class="breadcrumb">
        <li><a href="index.html"><i class="fa fa-home"></i></a></li>
        <li><a href="contact-us.html">Contact Us</a></li>
      </ul>
      <!-- Breadcrumb End-->
      <div class="row">
        <!--Middle Part Start-->
        <div id="content" class="col-sm-9">
          <h1 class="title">Contact Us</h1>
          <h3 class="subtitle">Our Location</h3>
          <div class="row">
            <?php $query=mysqli_query($con,"SELECT image from contactusinfo");
            while($row=mysqli_fetch_array($query))
            {
            ?>  
            <div class="col-sm-3">
              <?php $logophoto=$row['image'];
                          if($logophoto==""):
                          ?>
                          <img src="images/shoplocation/shop.jpg" width="152" height="103" >
                          <?php else:?>
                            <img src="images/shoplocation/<?php echo htmlentities($logophoto);?>" width="152" height="103"  >

                          <?php endif;?>
            </div><?php } ?>
            <?php $query=mysqli_query($con,"SELECT * from contactusinfo");
            while($row=mysqli_fetch_array($query))
            {
            ?>
            <div class="col-sm-3"><strong> <?php echo htmlentities($row['shopname']);?></strong><br />
               
              <address>
              <?php echo htmlentities($row['address']);?>
              </address>
            </div>
            <div class="col-sm-3"><strong>Telephone</strong><br>
              <?php echo htmlentities($row['telephoneno']);?><br />
              <br />
              <strong>Fax</strong><br>
              <?php echo htmlentities($row['faxno']);?> </div>
            <div class="col-sm-3"> <strong>Opening Times</strong><br />
              <?php echo htmlentities($row['openinghours']);?><br />
              <br />
              <strong>Comments</strong><br />
              <?php echo htmlentities($row['comment']);?></div>
          </div><?php } ?>
          <?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
        else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
          <form class="form-horizontal" name="sentMessage"  method="post">
            <fieldset>
              <h3 class="subtitle">Send us an Email</h3>
              <div class="form-group required">
                <label class="col-md-2 col-sm-3 control-label" for="input-name">Your Name</label>
                <div class="col-md-10 col-sm-9">
                  <input type="text" name="fullname" class="form-control" />
                </div>
              </div>
              <div class="form-group required">
                <label class="col-md-2 col-sm-3 control-label" for="input-email">E-Mail Address</label>
                <div class="col-md-10 col-sm-9">
                  <input type="text" name="email"  class="form-control" />
                </div>
              </div>
               <div class="form-group required">
                <label class="col-md-2 col-sm-3 control-label" for="input-name">Contact No</label>
                <div class="col-md-10 col-sm-9">
                  <input type="text" name="contactno" class="form-control" />
                </div>
              </div>
              <div class="form-group required">
                <label class="col-md-2 col-sm-3 control-label" for="input-enquiry">Enquiry</label>
                <div class="col-md-10 col-sm-9">
                  <textarea name="message"  rows="10"  class="form-control"></textarea>
                </div>
              </div>
            </fieldset>
            <div class="buttons">
              <div class="pull-right">
                <input class="btn btn-primary" type="submit" name="send"  value="Submit" />
              </div>
            </div>
          </form>
        </div>
        <aside id="column-right" class="col-sm-3 hidden-xs">
           <?php include('includes/slide-bars/custom-content.php');?>
        </aside>
        <!--Middle Part End -->
      </div>
    </div>
  </div>
    <?php include('includes/footer/footer.php');?>
  <!--Footer End-->
  <?php include('includes/slide-blocks/slide-blocks.php');?>
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