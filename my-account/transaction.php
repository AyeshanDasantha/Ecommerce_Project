<?php 
session_start();
error_reporting(0);
include('../config/config.php');
if(strlen($_SESSION['login'])==0)
    {   
header('location:../login.php');
}
else{
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

<script language="javascript" type="text/javascript">
var popUpWin=0;
function popUpWindow(URLStr, left, top, width, height)
{
 if(popUpWin)
{
if(!popUpWin.closed) popUpWin.close();
}
popUpWin = open(URLStr,'popUpWin', 'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no,copyhistory=yes,width='+950+',height='+650+',left='+left+', top='+top+',screenX='+left+',screenY='+top+'');
}

</script>
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
        <li><a href="../index.php"><i class="fa fa-home"></i></a></li>
        <li><a href="profile.php">Account</a></li>
        <li><a href="#">Transaction</a></li>
      </ul>
      <!-- Breadcrumb End-->
      <div class="row">
       <form name="cart" method="post"> 
         <fieldset id="account">
              <legend>My Transaction</legend>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th class="cart-romove item">#</th>
          <th class="cart-description item">Image</th>
          <th class="cart-product-name item">Product Name</th>
      
          <th class="cart-qty item">Quantity</th>
          <th class="cart-sub-total item">Price Per unit</th>
          <th class="cart-sub-total item">Shipping Charge</th>
          <th class="cart-total item">Grandtotal</th>
          <th class="cart-total item">Payment Method</th>
          <th class="cart-description item">Order Date</th>
          <th class="cart-description item">Payment Status</th>
        </tr>
      </thead><!-- /thead -->
      
      <tbody>

<?php $query=mysqli_query($con,"select products.productResizeImage50_1 as pimg1,products.productName as pname,products.id as proid,orders.productId as opid,orders.quantity as qty,products.productPrice as pprice,products.shippingCharge as shippingcharge,orders.paymentMethod as paym,orders.orderDate as odate,orders.id as orderid,orders.paymentStatus as paystatus from orders join products on orders.productId=products.id where orders.userId='".$_SESSION['id']."' and orders.paymentMethod is not null ORDER BY orders.orderDate DESC");
$cnt=1;
while($row=mysqli_fetch_array($query))
{
?>
        <tr>
          <td><?php echo $cnt;?></td>
          <td class="cart-image">
            <a class="entry-thumbnail" href="../product.php?pid=<?php echo $row['opid'];?>">
                <img src="../admin/productimages/<?php echo $row['proid'];?>/<?php echo $row['pimg1'];?>" alt="" >
            </a>
          </td>
          <td class="cart-product-name-info">
            <h4 class='cart-product-description'><a href="../product.php?pid=<?php echo $row['opid'];?>">
            <?php echo $row['pname'];?></a></h4>
            
            
          </td>
          <td class="cart-product-quantity">
            <?php echo $qty=$row['qty']; ?>   
                </td>
          <td class="cart-product-sub-total"><?php echo $sitecurrency;?> <?php echo $price=$row['pprice']; ?>  </td>
          <td class="cart-product-sub-total"><?php echo $sitecurrency;?> <?php echo $shippcharge=$row['shippingcharge']; ?>  </td>
          <td class="cart-product-grand-total"><?php echo $sitecurrency;?> <?php echo (($qty*$price)+$shippcharge);?></td>
          <td class="cart-product-sub-total"><?php echo $row['paym']; ?>  </td>
          <td class="cart-product-sub-total"><?php echo $row['odate']; ?>  </td>
          <td class="cart-product-sub-total" align="center"><?php $paystat=$row['paystatus'];
            if($paystat == 0)
                      {?>
                        <p style="color: red;"><strong>Un Paid</strong></p>
                      
                      <?php }
                      else
                      {?>
                        <p style="color: green;"><strong>Paid</strong></p>
                      
                      <?php } ?>
           </td>
          
        </tr>
<?php $cnt=$cnt+1;} ?>
        
      </tbody><!-- /tbody -->
    </table><!-- /table -->
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
<?php } ?>