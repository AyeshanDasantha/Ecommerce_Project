<?php
session_start();
error_reporting(0);

$currentTime = $_SESSION['datetime'];

include('../config/config.php');
if(strlen($_SESSION['login'])==0)
{   
      header('location:../login.php');
}
else
{
  if(isset($_POST['updateprofile']))
  {
    $fname=$_POST['firstname'];
    $lname=$_POST['lastname'];
    $contactno=$_POST['contactno'];
    $company=$_POST['company'];
    $address=$_POST['address'];
    $city=$_POST['city'];
    $postcode=$_POST['postcode'];
    $country=$_POST['country'];
    $region=$_POST['region'];
    $newsletter=$_POST['newsletter'];
    $query=mysqli_query($con,"update users set firstname='$fname',lastname='$lname',contactno='$contactno',company='$company',address='$address',city='$city',country='$country',postcode='$postcode',region='$region',subscribe='$newsletter' where id='".$_SESSION['id']."'");
    if($query)
    {
      $successmsg = "Your info has been updated";
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
  </div>
  <div id="container">
    <div class="container">
      <!-- Breadcrumb Start-->
      <ul class="breadcrumb">
        <li><a href="../index.php"><i class="fa fa-home"></i></a></li>
        <li><a href="#">Account</a></li>
        <li><a href="#">Profile</a></li>
      </ul>
      <!-- Breadcrumb End-->
      <div class="row">
        <!--Middle Part Start-->
        <div class="col-sm-9" id="content">
          <form class="form-horizontal" role="form" method="post" name="register" onSubmit="return valid();">
            <fieldset id="account">
              <?php if($successmsg)
              {?>
              <div class="alert alert-success alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <i class="fa fa-check-circle"></i>
              <b>Success -</b> <?php echo htmlentities($successmsg);?></div>
              <?php }?>
              
              <?php
                      $query=mysqli_query($con,"SELECT * FROM user_announcement where id=1");
                      while($row=mysqli_fetch_array($query)) 
                      {
                          $row = $row['status'];
                          if ($row == 1)
                          { 
                              $query=mysqli_query($con,"SELECT * FROM user_announcement where id=1");
                              while($row2=mysqli_fetch_array($query)) 
                                  {
                                         $query=mysqli_query($con,"SELECT setting_description FROM genaralsetting where id=3");
                           while($row=mysqli_fetch_array($query)) 
                           {
                        date_default_timezone_set($row['setting_description']);
                                            $currentdate = date('Y-m-d');
                                            $row2 = $row2['expire'];
                                            
                                            if ($row2 >= $currentdate) 
                                            {
                                                $query=mysqli_query($con,"SELECT * FROM user_announcement where id=1");
                                                while($row3=mysqli_fetch_array($query))
                                                {
                                                    $row3 = $row3['startdate'];
                                                    if ($row3 <= $currentdate) 
                                                    {
                                                         include('user-announcement.php');
                                                    }
                                                }
                                            }
                                         }
                                    }
                            }
                      ?>  <?php }?>

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
                                  <?php
$query=mysqli_query($con,"select * from users where id='".$_SESSION['id']."'");
while($row=mysqli_fetch_array($query))
{
?>
 <form class="form-horizontal" role="form" method="post" name="register">
              <div class="form-group required">
                <label for="input-firstname" class="col-sm-2 control-label">First Name</label>
                <div class="col-sm-10">
                   <input type="text" class="form-control" id="firstname" placeholder="First Name" value="<?php echo $row['firstname'];?>" name="firstname">
                </div>
              </div>
              <div class="form-group required">
                <label for="input-lastname" class="col-sm-2 control-label">Last Name</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="lastname" placeholder="Last Name" value="<?php echo $row['lastname'];?>" name="lastname">
                </div>
              </div>
              <div class="form-group required">
                <label for="input-email" class="col-sm-2 control-label">E-Mail</label>
                <div class="col-sm-10">
                  <input type="email" class="form-control" id="email" placeholder="E-Mail" value="<?php echo $row['email'];?>" name="email" readonly>
                  <span id="user-availability-status1" style="font-size:12px;"></span>
                </div>
              </div>
              <div class="form-group required">
                <label for="input-telephone" class="col-sm-2 control-label">Contact No</label>
                <div class="col-sm-10">
                  <input type="tel" class="form-control"  id="contactno" placeholder="Telephone" value="<?php echo $row['contactno'];?>" name="contactno">
                </div>
              </div>
            <fieldset id="address">
              <legend>Your Address</legend>
              <div class="form-group">
                <label for="input-company" class="col-sm-2 control-label">Company</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="company" placeholder="Company" value="<?php echo $row['company'];?>" name="company">
                </div>
              </div>
              <div class="form-group required">
                <label for="input-address-1" class="col-sm-2 control-label">Address 1</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="address" placeholder="Address 1" value="<?php echo $row['address'];?>" name="address">
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
                    <?php $sql=mysqli_query($con,"SELECT countries.country_name, countries.id,users.country FROM countries INNER JOIN users ON countries.id = users.country ");
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
                  <input type="text"class="form-control" value="<?php echo $row['region'];?>" name="region">
                </div>
              </div>
            </fieldset>
            <fieldset>
              <legend>Newsletter</legend>
              <div class="form-group">
                <label class="col-sm-2 control-label">Subscribe</label>
                <div class="col-sm-10">
                  <label class="radio-inline">


                    <?php 
                        $id=$_SESSION['id'];
                        $query=mysqli_query($con,"SELECT subscribe FROM users where id='$id'");
                        while($row=mysqli_fetch_array($query)) 
                        $subscribe = $row['subscribe'];
                        if($subscribe==1)
                        {
                        ?>
                       <input type="checkbox" class="awesome-bootstrap-checkbox" checked value="0"  name="newsletter" > Activated
                        <?php } else {?>
                        <label class="radio-inline">
                    <input type="checkbox" class="awesome-bootstrap-checkbox" unchecked value="1"  name="newsletter" > Deactivated
                        <?php } ?>


                    
                  
                </div>
              </div>
            </fieldset>
            <div class="buttons">
              <div class="pull-right"><?php } ?>
                
                <button type="submit" name="updateprofile" class="btn-upper btn btn-primary checkout-page-button" id="submit">Update</button>
  </form>
              </div>
            </div>
          </form>
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