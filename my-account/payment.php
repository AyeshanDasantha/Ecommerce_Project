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
      
      $unique_id = time() .rand(). $userid;
      $trackingcode=substr("$unique_id",13);
      
      $pdtid=array();
      $sql = "SELECT * FROM products WHERE id IN(";
      foreach($_SESSION['cart'] as $id => $value)
      {
        $sql .=$id. ",";
      }
      $sql=substr($sql,0,-1) . ") ORDER BY id ASC";
      $query = mysqli_query($con,$sql);
      $totalprice=0;
      $totalqunty=0;
      if(!empty($query))
      {
        while($row = mysqli_fetch_array($query))
        {
          $quantity=$_SESSION['cart'][$row['id']]['quantity'];
          $subtotal= $_SESSION['cart'][$row['id']]['quantity']*$row['productPrice']+$row['shippingCharge'];
          $totalprice += $subtotal;
          $_SESSION['qnty']=$totalqunty+=$quantity;

 
          array_push($pdtid,$row['id']);


          $pname= $row['productName'];

          $_SESSION['sid']=$pd;
          $rt=mysqli_query($con,"select * from productreviews where productId='$pd'");
          $num=mysqli_num_rows($rt);
          {
              $productid=$row['id'];
              $productqty=$_SESSION['cart'][$row['id']]['quantity'];
              $productprice=$row['productPrice'];
              $productshippingfee=$row['shippingCharge'];
              $producttotal=$_SESSION['cart'][$row['id']]['quantity']*$row['productPrice']+$row['shippingCharge'];
              $_SESSION['pid']=$pdtid;
              
              $quantity=$_SESSION['cartqty'];
              $pdd=$_SESSION['pid'];
              $value=array_combine($pdd,$quantity);

              $userid = $_SESSION['id'];

            

              foreach($value as $qty=> $val34)
              {
                $done=mysqli_query($con,"insert into orders(userId,productId,quantity,paymentMethod,paymentStatus,orderTrackingCode) values('".$_SESSION['id']."','$qty','$val34','$cod','0','$trackingcode')");

            }
            if ($done) 
            {
              unset($_SESSION['cart']);
              header('location: paymentsuccess.php');
            }
            else
            {

              header('location: paymentfail.php');
            }
            }
          }
        }
      }
      if (isset($_POST['cardpay'])) {
      $cod="Payhere";
      
      $pdtid=array();
      $sql = "SELECT * FROM products WHERE id IN(";
      foreach($_SESSION['cart'] as $id => $value)
      {
        $sql .=$id. ",";
      }
      $sql=substr($sql,0,-1) . ") ORDER BY id ASC";
      $query = mysqli_query($con,$sql);
      $totalprice=0;
      $totalqunty=0;
      if(!empty($query))
      {
        while($row = mysqli_fetch_array($query))
        {
          $quantity=$_SESSION['cart'][$row['id']]['quantity'];
          $subtotal= $_SESSION['cart'][$row['id']]['quantity']*$row['productPrice']+$row['shippingCharge'];
          $totalprice += $subtotal;
          $_SESSION['qnty']=$totalqunty+=$quantity;

 
          array_push($pdtid,$row['id']);


          $pname= $row['productName'];

          $_SESSION['sid']=$pd;
          $rt=mysqli_query($con,"select * from productreviews where productId='$pd'");
          $num=mysqli_num_rows($rt);
          {
              $productid=$row['id'];
              $productqty=$_SESSION['cart'][$row['id']]['quantity'];
              $productprice=$row['productPrice'];
              $productshippingfee=$row['shippingCharge'];
              $producttotal=$_SESSION['cart'][$row['id']]['quantity']*$row['productPrice']+$row['shippingCharge'];
              $_SESSION['pid']=$pdtid;
              
              $quantity=$_SESSION['cartqty'];
              $pdd=$_SESSION['pid'];
              $value=array_combine($pdd,$quantity);

              $userid = $_SESSION['id'];

            

              foreach($value as $qty=> $val34)
              {
                
                $unique_id = time() .rand(). $userid;
                $trackingcode=substr("$unique_id",13);
                $done=mysqli_query($con,"insert into orders(userId,productId,quantity,paymentMethod,paymentStatus,orderTrackingCode) values('".$_SESSION['id']."','$qty','$val34','$cod','0','$trackingcode')");

            }
            if ($done) 
            {
             unset($_SESSION['cart']);
             
        echo "

<script>
function myFunction() {
  document.getElementById('myForm').action = 'https://sandbox.payhere.lk/pay/checkout';
}
</script>




        ";

            }
            else
            {

              header('location: paymentfail.php');
            }
            }
          }
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
  </div>
  <div id="container">
    <div class="container">
      <!-- Breadcrumb Start-->
      <ul class="breadcrumb">
        <li><a href="../index.php"><i class="fa fa-home"></i></a></li>
        <li><a href="#">Pay Now</a></li>
      </ul>
      <!-- Breadcrumb End-->
      <div class="row">
        <!--Middle Part Start-->
        <div id="content" class="col-sm-12">
          <h1 class="title">Payment</h1>

          <h2 class="subtitle">Please Select your Payment Methord</h2>
          <?php 
            echo $_SESSION['qnty'];
            echo "<br>";  
            echo $totalprice;
            echo "<br>";
            $unique_oid = time() .rand(). $userid;
            $uoid=substr("$unique_oid",13);
            
           ?>

             <!-- test end payher -->
          <div class="row">
            <div class="col-sm-4">
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4 class="panel-title"><b>Cash on Deiliver</b></h4>
                </div>
                <div id="collapse-coupon" class="panel-collapse collapse in">
                  <div class="panel-body" data-toggle="tooltip" data-title="Cash on Delivery" align="center">
                    <form name="payment" method="post" >
                    <button style="background-image:url(../images/payment/cod.png); width: 300px; height: 128px;" name="codpay"></button></form>   
                    </div>
                </div>
              </div>
            </div>
          
            
            <div class="col-sm-4">
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4 class="panel-title"><b>Card Payment</b></h4>
                </div>
                <div id="collapse-coupon" class="panel-collapse collapse in">
                  <div class="panel-body" data-toggle="tooltip" data-title="Pay With Your Card" align="center">
                        <form method="post"  id="myForm">
                     <?php $query=mysqli_query($con,"SELECT * FROM paymentsetting where id=1");
    while($row=mysqli_fetch_array($query)) 
    {
    ?>
                      <input type="hidden" name="merchant_id" value="<?php echo htmlentities($row['site_key']);?>"><?php }?>
                      
                      <?php $query=mysqli_query($con,"SELECT * FROM genaralsetting where id=2");
    while($row=mysqli_fetch_array($query)) 
    {
    ?>
                      <input type="hidden" name="return_url" value="<?php echo htmlentities($row['setting_description']);?>/my-account/paymentsuccess.php">
                      <input type="hidden" name="cancel_url" value="<?php echo htmlentities($row['setting_description']);?>/my-account/paymentfail.php">
                      <input type="hidden" name="notify_url" value="<?php echo htmlentities($row['setting_description']);?>/notify.php">  <?php }?>
                      
                      <input type="hidden" name="order_id" value="<?php echo $trackingcode;?>">
                      <input type="hidden" name="items" value="Checkout Payment">
                      <input type="hidden" name="currency" value="LKR">
                      <input type="hidden" name="amount" value="<?php echo $totalprice;?>">  
                     
                      <?php
                      $query=mysqli_query($con,"select * from users where id='".$_SESSION['id']."'");
                      while($row=mysqli_fetch_array($query))
                      {
                      ?>
                      <input type="hidden" name="first_name" value="<?php echo $row['firstname'];?>">
                      <input type="hidden" name="last_name" value="<?php echo $row['lastname'];?>">
                      <input type="hidden" name="email" value="<?php echo $row['email'];?>">
                      <input type="hidden" name="phone" value="<?php echo $row['contactno'];?>">
                      <input type="hidden" name="address" value="<?php echo $row['address'];?>">
                      <input type="hidden" name="city" value="<?php echo $row['city'];?>">
                      <?php $sql=mysqli_query($con,"SELECT countries.country_name, countries.id,users.country FROM countries INNER JOIN users ON countries.id = users.country WHERE users.id='".$_SESSION['id']."'");
                    while ($rw=mysqli_fetch_array($sql)) {
                      ?>

                      <input type="hidden" name="country" value="<?php echo htmlentities($rw['country_name']);?>"><?php }} ?>
                      
                      
                       <button style="background-image:url(../images/payment/cardpay.png); width: 300px; height: 128px;" name="cardpay" type="submit" onclick="myFunction()"></button> 
                    
                      
                  </form> 
                    </div>
                </div>
              </div>
            </div>
          </div>
   
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
</html>