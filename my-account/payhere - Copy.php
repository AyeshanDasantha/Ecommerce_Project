
<?php 
session_start();
error_reporting(0);
include('../config/config.php');
if(strlen($_SESSION['login'])==0)
    {   
header('location:login.php');
}
else{
  if (isset($_POST['codpay'])) {
      $cod="COD";
     mysqli_query($con,"update orders set  paymentMethod='$cod' where userId='".$_SESSION['id']."' and paymentMethod is null ");
     unset($_SESSION['cart']);
     header('location:order-history.php');


  }
  else if (isset($_POST['cardpay'])) {
      $cod="cardpay";
     mysqli_query($con,"update orders set  paymentMethod='$cod' where userId='".$_SESSION['id']."' and paymentMethod is null ");
     unset($_SESSION['cart']);
     header('location:order-history.php');


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
        <li><a href="index.html"><i class="fa fa-home"></i></a></li>
        <li><a href="cart.html">Shopping Cart</a></li>
      </ul>
      <!-- Breadcrumb End-->
      <div class="row">
        <!--Middle Part Start-->
        <div id="content" class="col-sm-12">
          <h1 class="title">Shopping Cart</h1>

          <h2 class="subtitle">What would you like to do next?</h2>
          <p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p>
          <div class="row">
             <?php
$query=mysqli_query($con,"select * from users where id='".$_SESSION['id']."'");
while($row=mysqli_fetch_array($query))
{
  $fname=$row['firstname'];
  $lname=$row['lastname'];
  $email=$row['email'];
  $contactno=$row['contactno'];
  $address=$row['address'];
  $city=$row['city'];
?>

<?php $query=mysqli_query($con,"SELECT * FROM paymentsetting where id=1");
while($row=mysqli_fetch_array($query)) 
{
  $merchantid=$row['site_key'];
?>

<?php $query=mysqli_query($con,"SELECT * FROM genaralsetting where id=2");
while($row=mysqli_fetch_array($query)) 
{
  $siteurl=$row['setting_description'];
?>


             <?php
 $pdtid=array();
    $sql = "SELECT * FROM products WHERE id IN(";
      foreach($_SESSION['cart'] as $id => $value){
      $sql .=$id. ",";
      }
      $sql=substr($sql,0,-1) . ") ORDER BY id ASC";
      $query = mysqli_query($con,$sql);
      $totalprice=0;
      $totalqunty=0;
      if(!empty($query)){
      while($row = mysqli_fetch_array($query)){
        $quantity=$_SESSION['cart'][$row['id']]['quantity'];
        $subtotal= $_SESSION['cart'][$row['id']]['quantity']*$row['productPrice']+$row['shippingCharge'];
        $totalprice += $subtotal;
        $_SESSION['qnty']=$totalqunty+=$quantity;

        array_push($pdtid,$row['id']);
//print_r($_SESSION['pid'])=$pdtid;exit;
  ?>
              <div class="col-sm-12">
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <h4 class="panel-title"><i class="fa fa-shopping-cart"></i> Shopping cart</h4>
                    </div>
                      <div class="panel-body">
                        <div class="table-responsive">
                          <table class="table table-bordered">
                            <thead>
                              <tr>
                                <td class="text-left"><b>Product Name</b></td>
                                <td class="text-left"><b>Total</b></td>
                                <td class="text-center"><b>Action</b></td>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td class="text-left"><?php echo $row['productName'];?></td>
                                <td class="text-left"><?php echo $sitecurrency.($_SESSION['cart'][$row['id']]['quantity']*$row['productPrice']+$row['shippingCharge']); ?>.00</td>
                               
                                <form method="post" action="https://sandbox.payhere.lk/pay/checkout">   
                                    <input type="hidden" name="merchant_id" value="<?php echo $merchantid;?>">
                                    <input type="hidden" name="return_url" value="<?php echo $siteurl;?>/return">
                                    <input type="hidden" name="cancel_url" value="<?php echo $siteurl;?>/cancel">
                                    <input type="hidden" name="notify_url" value="<?php echo $siteurl;?>/notify">  

                                    <input type="hidden" name="order_id" value="<?php echo $row['id'];?>">
                                    <input type="hidden" name="items" value="<?php echo $row['productName'];?>">
                                    <input type="hidden" name="currency" value="LKR">
                                    <input type="hidden" name="amount" value="<?php echo ($_SESSION['cart'][$row['id']]['quantity']*$row['productPrice']+$row['shippingCharge']); ?>">  
                                   
                                     
                                    <input type="hidden" name="first_name" value="<?php echo $fname;?>">
                                    <input type="hidden" name="last_name" value="<?php echo $lname;?>">
                                    <input type="hidden" name="email" value="<?php echo $email;?>">
                                    <input type="hidden" name="phone" value="<?php echo $contactno;?>">
                                    <input type="hidden" name="address" value="<?php echo $address;?>">
                                    <input type="hidden" name="city" value="<?php echo $city;?>">
                                    <input type="hidden" name="country" value="Sri Lanka">
                                     <td class="text-center"><button class="btn btn-primary btn-sm" type="submit">Pay Now</button></td>
                                </form> 
                              </tr>
                            </tbody>
                           
                          </table>
                        </div>
                      </div>
                  </div>
                </div>
                   <?php } }
$_SESSION['pid']=$pdtid;
        ?>
          </div> <?php } ?><?php }?> <?php }?> 
   
          <!-- <div class="buttons">
            <div class="pull-right"><a href="checkout.html" class="btn btn-primary">Checkout</a></div>
          </div> -->
        </div>
        <!--Middle Part End -->
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
</html><?php } ?>