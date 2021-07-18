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
    $uid=$_SESSION['id'];
    $address1=$_POST['address1'];
    $address2=$_POST['address2'];
    $city=$_POST['city'];
    $postcode=$_POST['postcode'];
    $country=$_POST['country'];
    $region=$_POST['region'];
     $query=mysqli_query($con,"update billaddres set uid='$uid',address1='$address1',address2='$address2',city='$city',country='$country',postcode='$postcode',region='$region' where uid='".$_SESSION['id']."'");
    if($query)
    {
        $successmsg="Your Billing/Shipping has been Updated";
    }
}

if(isset($_POST['insertsubmit']))
  {
    $uid=$_SESSION['id'];
    $address1=$_POST['address1'];
    $address2=$_POST['address2'];
    $city=$_POST['city'];
    $postcode=$_POST['postcode'];
    $country=$_POST['country'];
    $region=$_POST['region'];
    $query=mysqli_query($con,"insert into billaddres(uid,address1,address2,city,postcode,country,region) values('$uid','$address1','$address2','$city','$postcode','$country','$region')");
    if($query)
    {
        $successmsg="Your Billing/Shipping has been Inserted";
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
        <li><a href="profile.php">Account</a></li>
        <li><a href="#">Shipping & BIlling Details</a></li>
      </ul>
      <!-- Breadcrumb End-->
      <div class="row">
        <!--Middle Part Start-->
        <div class="col-sm-9" id="content">
        
          <form class="form-horizontal" role="form" method="post" name="register" onSubmit="return valid();">
            <fieldset id="account">
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

 
              
            <fieldset id="address">
              <?php if($successmsg)
              {?>
              <div class="alert alert-success alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <i class="fa fa-check-circle"></i>
              <b>Success -</b> <?php echo htmlentities($successmsg);?></div>
              <?php }?>


              <legend>Your Shipping & BIlling Details</legend>
               <?php
$query=mysqli_query($con,"select * from billaddres where uid='".$_SESSION['id']."'");
$num=mysqli_fetch_array($query);
if($num>0)
{?>

  <form class="form-horizontal" role="form" method="post" name="register">
                  <div class="form-group">
                    <?php
                    $query=mysqli_query($con,"select * from billaddres where uid='".$_SESSION['id']."'");
                    while($row=mysqli_fetch_array($query))
                    {
                    ?>
                <label for="input-company" class="col-sm-2 control-label">Address 1</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="address1" placeholder="Address 1" value="<?php echo $row['address1'];?>" name="address1">
                </div>
              </div>
              <div class="form-group required">
                <label for="input-address-1" class="col-sm-2 control-label">Address 2</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="address2" placeholder="Address 1" value="<?php echo $row['address2'];?>" name="address2">
                </div>
              </div>
              <div class="form-group required">
                <label for="input-city" class="col-sm-2 control-label">City</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="city" placeholder="City" value="<?php echo $row['city'];?>" name="city">
                </div>
              </div>
              <div class="form-group required">
                <label for="input-postcode" class="col-sm-2 control-label">Post Code</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="postcode" placeholder="Post Code" value="<?php echo $row['postcode'];?>" name="postcode">
                </div>
              </div>
              <div class="form-group required">
                <label for="input-country" class="col-sm-2 control-label">Country</label>
                <div class="col-sm-10">
                  <select class="form-control" id="input-country" name="country">
                    <?php $sql=mysqli_query($con,"SELECT countries.country_name, countries.id,billaddres.country FROM countries INNER JOIN billaddres ON countries.id = billaddres.country ");
                    while ($rw=mysqli_fetch_array($sql)) {
                      ?>
                      <option value="<?php echo htmlentities($rw['id']);?>"><?php echo htmlentities($rw['country_name']);?></option>
                    <?php }?>
                    <?php $sql=mysqli_query($con,"select id,country_name from countries ");
                    while ($rw=mysqli_fetch_array($sql)) {
                      ?>
                      <option value="<?php echo htmlentities($rw['id']);?>"><?php echo htmlentities($rw['country_name']);?></option>
                    <?php
                    }
                    ?>
                     
                    </select>
                </div>
              </div>
              <div class="form-group required">
                <label for="input-zone" class="col-sm-2 control-label">Region / State</label>
                <div class="col-sm-10">
                  <input type="text"class="form-control" placeholder="Region / State" value="<?php echo $row['region'];?>" name="region">
                </div> <?php } ?>
              </div>
            </fieldset>
            <div class="buttons">
              <div class="pull-right">
                <button type="submit" name="submit" class="btn-upper btn btn-primary checkout-page-button" id="submit">Update</button>
  </form>
              </div>
            </div>
          </form>


  <?php } else {?>
    <form class="form-horizontal" role="form" method="post" name="register">
<div class="form-group">
                <label for="input-company" class="col-sm-2 control-label">Address 1</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="address1" placeholder="Address 1"  name="address1">
                </div>
              </div>
              <div class="form-group required">
                <label for="input-address-1" class="col-sm-2 control-label">Address 2</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="address2" placeholder="Address 1"  name="address2">
                </div>
              </div>
              <div class="form-group required">
                <label for="input-city" class="col-sm-2 control-label">City</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="city" placeholder="City"  name="city">
                </div>
              </div>
              <div class="form-group required">
                <label for="input-postcode" class="col-sm-2 control-label">Post Code</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="postcode" placeholder="Post Code" name="postcode">
                </div>
              </div>
              <div class="form-group required">
                <label for="input-country" class="col-sm-2 control-label">Country</label>
                <div class="col-sm-10">
                  <select class="form-control" id="input-country" name="country">
                     <option value=""> --- Please Select --- </option>
                     <?php $sql=mysqli_query($con,"select id,country_name from countries ");
                    while ($rw=mysqli_fetch_array($sql)) {
                      ?>
                      <option value="<?php echo htmlentities($rw['id']);?>"><?php echo htmlentities($rw['country_name']);?></option>
                    <?php
                    }
                    ?>
                    </select>
                     
                    </select>
                </div>
              </div>
              <div class="form-group required">
                <label for="input-zone" class="col-sm-2 control-label">Region / State</label>
                <div class="col-sm-10">
                  <input type="text"class="form-control" placeholder="Region / State"  name="region">
                </div>
              </div>
            </fieldset>
            <div class="buttons">
              <div class="pull-right">
                <button type="submit" name="insertsubmit" class="btn-upper btn btn-primary checkout-page-button" id="submit">Continue</button>
  </form>
              </div>
            </div>
          </form>

    <?php } ?>



        </div>
        <!--Middle Part End -->
        <?php include('includes/account-side-bar.php');?>
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
<script type="text/javascript" src="../js/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="../js/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../js/jquery.easing-1.3.min.js"></script>
<script type="text/javascript" src="../js/jquery.dcjqaccordion.min.js"></script>
<script type="text/javascript" src="../js/owl.carousel.min.js"></script>
<script type="text/javascript" src="../js/custom.js"></script>
<!-- JS Part End-->
</body>
</html>
<?php } ?>