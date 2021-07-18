<?php
session_start();
error_reporting(0);
include_once '../config/config.php';
if(strlen($_SESSION['alogin'])==0)
  { 
header('location:index.php');
}
else{
$oid=intval($_GET['oid']);
if(isset($_POST['submit2'])){
$status=$_POST['status'];
$remark=$_POST['remark'];//space char

$query=mysqli_query($con,"insert into ordertrackhistory(orderId,status,remark) values('$oid','$status','$remark')");
$sql=mysqli_query($con,"update orders set orderStatus='$status' where id='$oid'");
echo "<script>alert('Order updated sucessfully...');</script>";

  $query=mysqli_query($con,"SELECT * FROM genaralsetting where id=1");
  while($row=mysqli_fetch_array($query)) 
  {
    $sitename=$row['setting_description'];
  }
  $query=mysqli_query($con,"SELECT * FROM genaralsetting where id=2");
  while($row=mysqli_fetch_array($query)) 
  {
    $sitelink=$row['setting_description'];
  }
  $querys=mysqli_query($con,"SELECT * FROM genaralsetting where id=4");
  while($rows=mysqli_fetch_array($querys)) 
  {
    $logo=$rows['setting_description'];
  }
  $queryss=mysqli_query($con,"SELECT users.firstname,users.lastname,users.email,orders.id,products.productName,products.id as pid,products.productImage1,products.productPrice,products.shippingCharge,orders.quantity,orders.orderDate,billaddres.address1,billaddres.postcode,billaddres.city,billaddres.region,countries.country_name,orders.orderTrackingCode FROM `orders` JOIN users ON users.id=orders.userId JOIN products ON products.id=orders.productId JOIN billaddres ON billaddres.uid=users.id JOIN countries ON countries.id=users.country WHERE orders.id='$oid'");
  while($rowss=mysqli_fetch_array($queryss)) 
  {
    $productimage=$rowss['productImage1'];
    $email=$rowss['email'];
    $fname=$rowss['firstname'];
    $lname=$rowss['lastname'];
    $orderid=$rowss['id'];
    $productid=$rowss['pid'];
    $productname=$rowss['productName'];
    $productprice=$rowss['productPrice'];
    $shippingfee=$rowss['shippingCharge'];
    $qty=$rowss['quantity'];
    $orderdate=$rowss['orderDate'];
    $address=$rowss['address1'];
    $postcode=$rowss['postcode'];
    $city=$rowss['city'];
    $region=$rowss['region'];
    $country=$rowss['country_name'];
    $trackingcode=$rowss['orderTrackingCode'];

    $subtot=$productprice*$qty;
    $tot=$subtot+$shippingfee;

  }
  require '../phpmailer/orderconfirmmail.php';
}

 ?>
<script language="javascript" type="text/javascript">
function f2()
{
window.close();
}ser
function f3()
{
window.print(); 
}
</script>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Update Order !</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="anuj.css" rel="stylesheet" type="text/css">
</head>
<body>

<div style="margin-left:50px;">
 <form name="updateticket" id="updateticket" method="post"> 
<table width="100%" border="0" cellspacing="0" cellpadding="0">

    <tr height="50">
      <td colspan="2" class="fontkink2" style="padding-left:0px;"><div class="fontpink2"> <b>Update Order !</b></div></td>
      
    </tr>
    <tr height="30">
      <td  class="fontkink1"><b>Order Id:</b></td>
      <td  class="fontkink"><?php echo $oid;?></td>
    </tr>
    <tr height="30">
      <td  class="fontkink1"><b>Order Tracking Code:</b></td>
       <?php 
      $ret = mysqli_query($con,"SELECT orderTrackingCode FROM orders WHERE id='$oid'");
       while($row=mysqli_fetch_array($ret))
      {
     ?>
      <td  class="fontkink"><?php echo $row['orderTrackingCode'];?></td>
    </tr> <?php } ?>
    <?php 
$ret = mysqli_query($con,"SELECT * FROM ordertrackhistory WHERE orderId='$oid'");
     while($row=mysqli_fetch_array($ret))
      {
     ?>
		
    
    
      <tr height="20">
      <td class="fontkink1" ><b>At Date:</b></td>
      <td  class="fontkink"><?php echo $row['postingDate'];?></td>
    </tr>
     <tr height="20">
      <td  class="fontkink1"><b>Status:</b></td>
      <td  class="fontkink"><?php echo $row['status'];?></td>
    </tr>
     <tr height="20">
      <td  class="fontkink1"><b>Remark:</b></td>
      <td  class="fontkink"><?php echo $row['remark'];?></td>
    </tr>

   
    <tr>
      <td colspan="2"><hr /></td>
    </tr>
   <?php } ?>
   <?php 
$st='Delivered';
   $rt = mysqli_query($con,"SELECT * FROM orders WHERE id='$oid'");
     while($num=mysqli_fetch_array($rt))
     {
     $currrentSt=$num['orderStatus'];
   }
     if($st==$currrentSt)
     { ?>
   <tr><td colspan="2"><b>
      Product Delivered </b></td>
   <?php }else  {
      ?>
   
    <tr height="50">
      <td class="fontkink1">Status: </td>
      <td  class="fontkink"><span class="fontkink1" >
        <select name="status" class="fontkink" required="required" >
          <option value="">Select Status</option>
                <option value="Order Placed">Order placed</option>
                <option value="On Review">On review</option>
                <option value="On Delivery">On delivery</option>
                <option value="Delivered">Delivered</option>
        </select>
        </span></td>
    </tr>

     <tr style=''>
      <td class="fontkink1" >Remark:</td>
      <td class="fontkink" align="justify" ><span class="fontkink">
        <textarea cols="50" rows="7" name="remark"  required="required" ></textarea>
        </span></td>
    </tr>
    <tr>
      <td class="fontkink1">&nbsp;</td>
      <td  >&nbsp;</td>
    </tr>
    <tr>
      <td class="fontkink">       </td>
      <td  class="fontkink"> <input type="submit" name="submit2"  value="update"   size="40" style="cursor: pointer;" /> &nbsp;&nbsp;   
      <input name="Submit2" type="submit" class="txtbox4" value="Close this Window " onClick="return f2();" style="cursor: pointer;"  /></td>
    </tr>
<?php } ?>
</table>
 </form>
</div>

</body>
</html>
<?php } ?>

     