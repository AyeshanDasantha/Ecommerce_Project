<?php 
session_start();
error_reporting(0);
include('../config/config.php');
if(strlen($_SESSION['login'])==0)
    {   
header('location:../login.php');
}
else{
if(isset($_POST['submit'])){
    if(!empty($_SESSION['cart'])){
    foreach($_POST['quantity'] as $key => $val){
      if($val==0){
        unset($_SESSION['cart'][$key]);
      }else{
        $_SESSION['cart'][$key]['quantity']=$val;
      }
    }
      echo "<script>alert('Your Cart hasbeen Updated');</script>";
    }
  }
// Code for Remove a Product from Cart
if(isset($_POST['remove_code']))
  {

if(!empty($_SESSION['cart'])){
    foreach($_POST['remove_code'] as $key){
      
        unset($_SESSION['cart'][$key]);
    }
      echo "<script>alert('Your Cart has been Updated');</script>";
  }
}
// code for insert product in order table


if(isset($_POST['ordersubmit'])) 
{
  
if(strlen($_SESSION['login'])==0)
    {   
header('location:login.php');
}
else{

  $_SESSION['cartqty']=$_POST['quantity'];

header('location:payment.php');
}
}
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
    header('location:../Maintenance/index.php');
}
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
        <li><a href="profile.php">Account</a></li>
        <li><a href="#">Shopping Cart</a></li>
      </ul>
      <!-- Breadcrumb End-->
      <div class="row">
        <!--Middle Part Start-->
        <div id="content" class="col-sm-12">
          <h1 class="title">Shopping Cart</h1>
          
            <div class="table-responsive">
              <form name="cart" method="post">  
<?php
if(!empty($_SESSION['cart'])){
  ?>
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <td class="text-center"><strong>Remove</strong></td>
                    <td class="text-center"><strong>Image</strong></td>
                    <td class="text-center"><strong>Product Name</strong></td>
                    <td class="text-center"><strong>Quantity</strong></td>
                    <td class="text-center"><strong>Price Per unit</strong></td>
                    <td class="text-center"><strong>Shipping Charge</strong></td>
                    <td class="text-center"><strong>Total</strong></td>
                  </tr>
                </thead>
                <tbody>

                  <tr>
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
                    <td class="text-center">

                      <input type="checkbox" name="remove_code[]" value="<?php echo htmlentities($row['id']);?>" />
                    </td>
                    <td class="text-center"><a href="../product.php?pid=<?php echo htmlentities($pd=$row['id']);?>"><img src="../admin/productimages/<?php echo $row['id'];?>/<?php echo $row['productImage1'];?>" alt="" width="114" height="146" class="img-thumbnail" /></a></td>
                    <td class="text-center"><a href="../product.php?pid=<?php echo htmlentities($pd=$row['id']);?>"><?php echo $row['productName'];

$_SESSION['sid']=$pd;
             ?></a><br />
             <?php $rt=mysqli_query($con,"select * from productreviews where productId='$pd'");
$num=mysqli_num_rows($rt);
{
?>
                      <small>Reward Points: <?php echo htmlentities($num);?></small></td><?php } ?>
                    <td class="text-center">
                      <div class="input-group btn-block quantity">
                        <input type="number" name="quantity[<?php echo $row['id']; ?>]" value="<?php echo $_SESSION['cart'][$row['id']]['quantity']; ?>" size="1" class="form-control" />
                      </div>
                    </td>
                    <td class="text-center"><?php echo $sitecurrency." ".$row['productPrice']; ?>.00</td>
                    <td class="text-center"><?php echo $sitecurrency." ".$row['shippingCharge']; ?>.00</td>
                    <td class="text-center"><?php echo $sitecurrency.($_SESSION['cart'][$row['id']]['quantity']*$row['productPrice']+$row['shippingCharge']); ?>.00</td>
                  </tr>
                 <?php } }
$_SESSION['pid']=$pdtid;
        ?>
                </tbody>
                
              </table>
            </div>
            
            <div class="row">
            <div class="col-sm-4 col-sm-offset-8">
              <table class="table table-bordered">
                <tr>
                  <td class="text-right"><strong>Grand-Total:</strong></td>
                  <td class="text-right"><?php echo $sitecurrency;?> <?php echo $_SESSION['tp']="$totalprice". ".00"; ?></td>
                  
                </tr>              
              </table>
            </div>
          
            </div>
          </div>
          <div class="buttons">
            <div class="pull-left">
            <input type="submit" name="submit" value="Update shopping cart" class="btn btn-primary btn-lg pull-right outer-left-xs"></div>
            <div class="pull-right"><button  class="btn btn-primary btn-lg" type="submit" name="ordersubmit">Checkout</button></div>
            <?php } else {?>
               <h4 >Shopping Cart Empty</h4><?php } ?>
          </div>
        </div>

        <!--Middle Part End -->
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