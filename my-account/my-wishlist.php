<?php
session_start();
error_reporting(0);
include('../config/config.php');
if(strlen($_SESSION['login'])==0)
    {   
header('location:../login.php');
}
else{
// Code forProduct deletion from  wishlist  
$wid=intval($_GET['del']);
if(isset($_GET['del']))
{
$query=mysqli_query($con,"delete from wishlist where id='$wid'");
}


if(isset($_GET['action']) && $_GET['action']=="add"){
  $id=intval($_GET['id']);
  $query=mysqli_query($con,"delete from wishlist where productId='$id'");
  if(isset($_SESSION['cart'][$id])){
    $_SESSION['cart'][$id]['quantity']++;
  }else{
    $sql_p="SELECT * FROM products WHERE id={$id}";
    $query_p=mysqli_query($con,$sql_p);
    if(mysqli_num_rows($query_p)!=0){
      $row_p=mysqli_fetch_array($query_p);
      $_SESSION['cart'][$row_p['id']]=array("quantity" => 1, "price" => $row_p['productPrice']);  
header('location:my-wishlist.php');
}
    else{
      $message="Product ID is invalid";
    }
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
        <li><a href="..index.php"><i class="fa fa-home"></i></a></li>
        <li><a href="profile.php">Account</a></li>
        <li><a href="#">wishlist</a></li>
      </ul>
      <!-- Breadcrumb End-->
      <div class="row">
        <!--Middle Part Start-->
        <div id="content" class="col-sm-12">
          <h1 class="title">Wishlist</h1>
            <div class="table-responsive">
              <form name="cart" method="post">  

              <div class="table-responsive">
    <table class="table">
      <thead>
        <tr>
          <th colspan="4">my wishlist</th>
        </tr>
      </thead>
      <tbody>
<?php
$ret=mysqli_query($con,"select products.productName as pname,products.productName as proid,products.productImage1 as pimage,products.productPrice as pprice,wishlist.productId as pid,wishlist.id as wid from wishlist join products on products.id=wishlist.productId where wishlist.userId='".$_SESSION['id']."'");
$num=mysqli_num_rows($ret);
  if($num>0)
  {
while ($row=mysqli_fetch_array($ret)) {

?>

        <tr>
          <td class="col-md-2"><img src="../admin/productimages/<?php echo htmlentities($row['pid']);?>/<?php echo htmlentities($row['pimage']);?>" alt="<?php echo htmlentities($row['pname']);?>" width="60" height="100"></td>
          <td class="col-md-6">
            <div class="product-name"><a href="product-details.php?pid=<?php echo htmlentities($pd=$row['pid']);?>"><?php echo htmlentities($row['pname']);?></a></div>
<?php $rt=mysqli_query($con,"select * from productreviews where productId='$pd'");
$num=mysqli_num_rows($rt);
{
?>

            <div class="rating">
              <i class="fa fa-star rate"></i>
              <i class="fa fa-star rate"></i>
              <i class="fa fa-star rate"></i>
              <i class="fa fa-star rate"></i>
              <i class="fa fa-star non-rate"></i>
              <span class="review">( <?php echo htmlentities($num);?> Reviews )</span>
            </div>
            <?php } ?>
            <div class="price">
              <span><?php echo $sitecurrency;?> <?php echo htmlentities($row['pprice']);?>.00</span>
            </div>
          </td>
          <td class="col-md-2">
            <a href="my-wishlist.php?page=product&action=add&id=<?php echo $row['pid']; ?>" class="btn-upper btn btn-primary">Add to cart</a>
          </td>
          <td class="col-md-2 close-btn">
            <a href="my-wishlist.php?del=<?php echo htmlentities($row['wid']);?>" onClick="return confirm('Are you sure you want to delete?')" class=""><i class="fa fa-times" style="color: red;"></i></a>
          </td>
        </tr>
        <?php } } else{ ?>
        <tr>
          <td style="font-size: 18px; font-weight:bold ">Your Wishlist is Empty</td>

        </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
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
<?php } ?>