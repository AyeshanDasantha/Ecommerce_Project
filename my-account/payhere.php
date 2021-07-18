<?php 
session_start();
error_reporting(0);
include('../config/config.php');
if(strlen($_SESSION['login'])==0)
    {   
header('location:login.php');
}
else{

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
<script type="text/javascript">
  window.onload = function(){
  document.forms['payhere_submit_form'].submit();
}
</script>

</head>
<body>

  <div id="header">
    <?php include('includes/header/header.php');?>


  

          <h2 class="subtitle">Please Select your Payment Methord</h2>
          <?php 
            echo $_SESSION['qnty'];
            echo "<br>";  
            echo $totalprice;
            echo "<br>";
            $unique_oid = time() .rand(). $userid;
            $uoid=substr("$unique_oid",13);
            
           ?>

                        <form method="post" action="https://sandbox.payhere.lk/pay/checkout" id="payhere_submit_form" name="payhere_submit_form">
                     
                      <input type="hidden" name="merchant_id" value="1213160">    <!-- Replace your Merchant ID -->
                      <input type="hidden" name="return_url" value="http://sample.com/return">
                      <input type="hidden" name="cancel_url" value="http://sample.com/cancel">
                      <input type="hidden" name="notify_url" value="http://sample.com/notify">  
                      
                      <input type="hidden" name="order_id" value="<?php echo $uoid;?>">
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
                      <input type="submit" value="submit">
                  </form> 
                  
    
</body>
</html>