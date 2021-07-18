<?php
session_start();
error_reporting(0);


$currentTime = $_SESSION['datetime'];

include('../config/config.php');
if(strlen($_SESSION['login'])==0)
{   
      header('location:index.php');
}
else
{
  if(isset($_POST['submit']))
{
$imgfile=$_FILES["image"]["name"];

// get the image extension
$extension = substr($imgfile,strlen($imgfile)-4,strlen($imgfile));
// allowed extensions
$allowed_extensions = array(".jpg",".jpeg",".png",".gif",".JPG");

// Validation for allowed extensions .in_array() function searches an array for a specific value.
if(!in_array($extension,$allowed_extensions))
{
echo "<script>alert('Invalid format. Only jpg / jpeg/ png /gif format allowed');</script>";
}
else
{
//rename the image file
$imgnewfile=md5($imgfile).$extension;
// Code for move image into directory
move_uploaded_file($_FILES["image"]["tmp_name"],"userimages/".$imgnewfile);
// Query for insertion data into database
$query=mysqli_query($con,"update users set userimage='$imgnewfile' where email='".$_SESSION['login']."'");
if($query)
{
$successmsg="Profile photo Successfully !!";
}
else
{
$errormsg="Profile photo not updated !!";
}
}
}
$query=mysqli_query($con,"SELECT status FROM sitemaintenance where id=1");
while($row=mysqli_fetch_array($query)) 
{
$maintincestatus = $row['status'];
if($maintincestatus==1)
{
    header('location:../Maintenance/index.php');
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
     <link rel="shortcut icon" type="image/x-icon" href="../images/favicon/<?php echo htmlentities($row['setting_description']);?>"/><?php }?>
  
  <?php $query=mysqli_query($con,"SELECT * FROM genaralsetting where id=1");
    while($row=mysqli_fetch_array($query)) 
    {
     ?>  
    <title><?php echo htmlentities($row['setting_description']);?></title><?php }?>
<!-- CSS Part Start-->
<link rel="stylesheet" type="text/css" href="../js/bootstrap/css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="../css/font-awesome/css/font-awesome.min.css" />
<link rel="stylesheet" type="text/css" href="../css/stylesheet.css" />
<link rel="stylesheet" type="text/css" href="../css/owl.carousel.css" />
<link rel="stylesheet" type="text/css" href="../css/owl.transitions.css" />
<link rel="stylesheet" type="text/css" href="../css/responsive.css" />
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
        <li><a href="../index.php"><i class="fa fa-home"></i></a></li>
        <li><a href="Profile.php">Account</a></li>
        <li><a href="#">Profile Picture</a></li>
      </ul>
      <!-- Breadcrumb End-->
      <div class="row">
        <!--Middle Part Start-->
        <div class="col-sm-9" id="content">
          
              <legend>Update Your Profile Picture</legend>
              <div style="display: none;" class="form-group required">
                <label class="col-sm-2 control-label">Customer Group</label>
                <div class="col-sm-10">
                  <div class="radio">
                    <label>
                      <input type="radio" checked="checked" value="1" name="customer_group_id">
                      Default</label>
                  </div>
                </div>
              </div></fieldset></form>

        <form class="form-horizontal" role="form" method="post" name="register"  enctype="multipart/form-data" >
          <div class="form-group required">
                <label for="input-firstname" class="col-sm-2 control-label">Current Password</label>
                <div class="col-sm-6">
                     <?php }?>
                     <?php $query=mysqli_query($con,"select * from users where email='".$_SESSION['login']."'");
                     while($row=mysqli_fetch_array($query)) 
                     {
                     ?>    
                     <?php $userphoto=$row['userimage'];
          if($userphoto==""):
          ?>
          <img src="userimages/noimage.png" width="256" height="256" class="img-circle">
          <?php else:?>
            <img src="userimages/<?php echo htmlentities($userphoto);?>" width="256" height="256" class="img-circle">

          <?php endif;?><?php } ?>
                </div>
              </div>
              <div class="form-group required">
                <label for="input-firstname" class="col-sm-2 control-label">Upload New Photo</label>
                <div class="col-sm-6">
                   <input type="file" name="image"  class="form-control" required />
                </div>
              </div>
            
            
            </fieldset>
            <div class="buttons">
              <div class="pull-right">
                <button type="submit" name="submit" class="btn-upper btn btn-primary checkout-page-button" id="submit">Update</button>
  </form>
              </div>
            </div>
          </form>
        </div>
        <!--Middle Part End -->
        <?php include('includes/account-side-bar.php');?>
        
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
<script type="text/javascript" src="../js/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="../js/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../js/jquery.easing-1.3.min.js"></script>
<script type="text/javascript" src="../js/jquery.dcjqaccordion.min.js"></script>
<script type="text/javascript" src="../js/owl.carousel.min.js"></script>
<script type="text/javascript" src="../js/custom.js"></script>
<!-- JS Part End-->
</body>
</html>
