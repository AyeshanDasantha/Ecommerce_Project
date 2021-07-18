<?php
session_start();
error_reporting(0);
include('../config/config.php');
if(strlen($_SESSION['login'])==0)
    {   
header('location:../index.php');
}
else{
// Code forProduct deletion from  wishlist  
$wid=intval($_GET['del']);
if(isset($_GET['del']))
{
$query=mysqli_query($con,"delete from compare where id='$wid'");
}


if(isset($_GET['action']) && $_GET['action']=="add"){
  $id=intval($_GET['id']);
  $query=mysqli_query($con,"delete from compare where productId='$id'");
  if(isset($_SESSION['cart'][$id])){
    $_SESSION['cart'][$id]['quantity']++;
  }else{
    $sql_p="SELECT * FROM products WHERE id={$id}";
    $query_p=mysqli_query($con,$sql_p);
    if(mysqli_num_rows($query_p)!=0){
      $row_p=mysqli_fetch_array($query_p);
      $_SESSION['cart'][$row_p['id']]=array("quantity" => 1, "price" => $row_p['productPrice']);  
header('location:compare.php');
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
  <!-- Popup Box Module Start -->
  
<!-- Popup Box Module Start -->
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
        <li><a href="#">Product Comparison</a></li>
      </ul>
      <!-- Breadcrumb End-->
      <div class="row">
        <!--Middle Part Start-->
        <div id="content" class="col-sm-12">
          <h1 class="title">Product Comparison</h1>
          <div class="table-responsive">
            
            <table class="table table-bordered table-hover">
              <thead>
                <?php $query=mysqli_query($con,"SELECT count(id) FROM compare");
                while($row=mysqli_fetch_array($query)) 
                {
                  $count=$row['count(id)']
                 ?>  
                 <?php 
                  if ($count > 0) {?>
                <tr>
                  <td colspan="4"><strong>Product Details</strong></td>
                </tr>
              </thead>
              <tbody>
                
                <tr>
                  <td>Product</td>

                  <?php
                    $ret=mysqli_query($con,"select products.productName as pname,products.productName as proid,products.productImage1 as pimage,products.productPrice as pprice,compare.productId as pid,compare.id as wid from compare join products on products.id=compare.productId where compare.userId='".$_SESSION['id']."'");
                    $num=mysqli_num_rows($ret);
                      if($num>0)
                      {
                    while ($row=mysqli_fetch_array($ret)) {
                  ?>
                  <td align="center"><a href="../product.php?pid=<?php echo htmlentities($row['pid']);?>"><strong><?php echo htmlentities($row['pname']);?></strong></a></td>
                  <?php }} ?>
                  
                </tr>
                <tr>
                  <td>Image</td>
                  <?php
                    $ret=mysqli_query($con,"select products.productName as pname,products.productName as proid,products.productImage1 as pimage,products.productPrice as pprice,compare.productId as pid,compare.id as wid from compare join products on products.id=compare.productId where compare.userId='".$_SESSION['id']."'");
                    $num=mysqli_num_rows($ret);
                      if($num>0)
                      {
                    while ($row=mysqli_fetch_array($ret)) {
                  ?>

                  <td class="text-center"><img class="img-thumbnail" title="<?php echo htmlentities($row['pname']);?>" alt="<?php echo htmlentities($row['pname']);?>" src="../admin/productimages/<?php echo htmlentities($row['pid']);?>/<?php echo htmlentities($row['pimage']);?>"></td>

                  <?php }} ?>
                </tr>
                <tr>
                  <td>Price</td>
                  <?php
                    $ret=mysqli_query($con,"select products.*,compare.productId as pid,compare.id as wid from compare join products on products.id=compare.productId where compare.userId='".$_SESSION['id']."'");
                    $num=mysqli_num_rows($ret);
                      if($num>0)
                      {
                    while ($row=mysqli_fetch_array($ret)) {
                  ?>

                  <td><span class="price-old"><?php echo $sitecurrency;?> <?php echo htmlentities($row['productPrice']);?></span> <span class="price-new"><?php echo $sitecurrency;?> <?php echo htmlentities($row['productPriceBeforeDiscount']);?></span></td><?php }} ?>
                </tr>
                <tr>
                  <td>Brand</td>
                  <?php
                    $ret=mysqli_query($con,"select products.*,brands.brandName,compare.productId as pid,compare.id as wid from compare join products on products.id=compare.productId join brands on brands.id=products.productCompany where compare.userId='".$_SESSION['id']."'");
                    $num=mysqli_num_rows($ret);
                      if($num>0)
                      {
                    while ($row=mysqli_fetch_array($ret)) {
                  ?>
                  <td><?php echo htmlentities($row['brandName']);?></td>
                  <?php }} ?>
                </tr>
                <tr>
                  <td>Availability</td>
                  <?php
                    $ret=mysqli_query($con,"select products.*,compare.productId as pid,compare.id as wid from compare join products on products.id=compare.productId where compare.userId='".$_SESSION['id']."'");
                    $num=mysqli_num_rows($ret);
                      if($num>0)
                      {
                    while ($row=mysqli_fetch_array($ret)) {
                  ?>
                  <td><?php echo htmlentities($row['productAvailability']);?></td>
                  <?php }} ?>

                </tr>
                <tr>
                  <td>Rating</td>
                  <?php
                  $query1=mysqli_query($con,"select products.id as pid from compare join products on products.id=compare.productId where compare.userId='".$_SESSION['id']."'
                  ");
                  while($row2=mysqli_fetch_array($query1)) 
                  {
                    $getpid=$row2['pid'];
                  
                  $query11=mysqli_query($con,"select COUNT(productId) FROM productreviews WHERE productId ='$getpid'");
                      while($row22=mysqli_fetch_array($query11)) 
                      {
                        $pcount=$row22['COUNT(productId)'];
                      
                    $ret=mysqli_query($con,"SELECT round(sum((quality/3)+(price/3)+(value/3))/'$pcount') as aws,COUNT(productId) FROM productreviews WHERE productId='$getpid'");
                    $num=mysqli_num_rows($ret);
                      if($num>0)
                      {
                        while ($row=mysqli_fetch_array($ret)) 
                        {
                           $ratngpoint=$row['aws'];


                  ?>
                  <td class="rating">
                  <?php 
                  if ($ratngpoint == 1) {?>
                    <span class="fa fa-stack">
                      <i class="fa fa-star fa-stack-2x"></i>
                      <i class="fa fa-star-o fa-stack-2x"></i>
                    </span>
                    <span class="fa fa-stack">
                      <i class="fa fa-star-o fa-stack-2x"></i>
                    </span>
                    <span class="fa fa-stack">
                      <i class="fa fa-star-o fa-stack-2x"></i>
                    </span>
                    <span class="fa fa-stack">
                      <i class="fa fa-star-o fa-stack-2x"></i>
                    </span>
                    <span class="fa fa-stack">
                      <i class="fa fa-star-o fa-stack-2x"></i>
                    </span>
                    <br>
                    Based on <?php echo htmlentities($row['COUNT(productId)']);?> reviews.</td>
                    <?php } elseif($ratngpoint ==2) {?>
                    <span class="fa fa-stack">
                      <i class="fa fa-star fa-stack-2x"></i>
                      <i class="fa fa-star-o fa-stack-2x"></i>
                    </span>
                    <span class="fa fa-stack">
                      <i class="fa fa-star fa-stack-2x"></i>
                      <i class="fa fa-star-o fa-stack-2x"></i>
                    </span>
                    <span class="fa fa-stack">
                      <i class="fa fa-star-o fa-stack-2x"></i>
                    </span>
                    <span class="fa fa-stack">
                      <i class="fa fa-star-o fa-stack-2x"></i>
                    </span>
                    <span class="fa fa-stack">
                      <i class="fa fa-star-o fa-stack-2x"></i>
                    </span>
                    <br>
                    Based on <?php echo htmlentities($row['COUNT(productId)']);?> reviews.</td>
                    <?php } elseif($ratngpoint ==3) {?>
                      <span class="fa fa-stack">
                      <i class="fa fa-star fa-stack-2x"></i>
                      <i class="fa fa-star-o fa-stack-2x"></i>
                    </span>
                    <span class="fa fa-stack">
                      <i class="fa fa-star fa-stack-2x"></i>
                      <i class="fa fa-star-o fa-stack-2x"></i>
                    </span>
                    <span class="fa fa-stack">
                      <i class="fa fa-star fa-stack-2x"></i>
                      <i class="fa fa-star-o fa-stack-2x"></i>
                    </span>
                    <span class="fa fa-stack">
                      <i class="fa fa-star-o fa-stack-2x"></i>
                    </span>
                    <span class="fa fa-stack">
                      <i class="fa fa-star-o fa-stack-2x"></i>
                    </span>
                    <br>
                    Based on <?php echo htmlentities($row['COUNT(productId)']);?> reviews.</td>
                    <?php } elseif($ratngpoint ==4) {?>
                      <span class="fa fa-stack">
                      <i class="fa fa-star fa-stack-2x"></i>
                      <i class="fa fa-star-o fa-stack-2x"></i>
                    </span>
                    <span class="fa fa-stack">
                      <i class="fa fa-star fa-stack-2x"></i>
                      <i class="fa fa-star-o fa-stack-2x"></i>
                    </span>
                    <span class="fa fa-stack">
                      <i class="fa fa-star fa-stack-2x"></i>
                      <i class="fa fa-star-o fa-stack-2x"></i>
                    </span>
                    <span class="fa fa-stack">
                      <i class="fa fa-star fa-stack-2x"></i>
                      <i class="fa fa-star-o fa-stack-2x"></i>
                    </span>
                    <span class="fa fa-stack">
                      <i class="fa fa-star-o fa-stack-2x"></i>
                    </span>
                    Based on <?php echo htmlentities($row['COUNT(productId)']);?> reviews.</td>
                    <?php } elseif($ratngpoint ==5) {?>
                      <span class="fa fa-stack">
                      <i class="fa fa-star fa-stack-2x"></i>
                      <i class="fa fa-star-o fa-stack-2x"></i>
                    </span>
                    <span class="fa fa-stack">
                      <i class="fa fa-star fa-stack-2x"></i>
                      <i class="fa fa-star-o fa-stack-2x"></i>
                    </span>
                    <span class="fa fa-stack">
                      <i class="fa fa-star fa-stack-2x"></i>
                      <i class="fa fa-star-o fa-stack-2x"></i>
                    </span>
                    <span class="fa fa-stack">
                      <i class="fa fa-star fa-stack-2x"></i>
                      <i class="fa fa-star-o fa-stack-2x"></i>
                    </span>
                    <span class="fa fa-stack">
                      <i class="fa fa-star fa-stack-2x"></i>
                      <i class="fa fa-star-o fa-stack-2x"></i>
                    </span>
                    Based on <?php echo htmlentities($row['COUNT(productId)']);?> reviews.</td>
                    <?php } else {?>
                      No reviews yet
                    <?php }}} ?>
                    
                   <?php }} ?>
                </tr>

                
              </tbody>
              <tbody>
                <tr>
                  <td></td>
                  <?php
                    $ret=mysqli_query($con,"select products.productName as pname,products.productName as proid,products.productImage1 as pimage,products.productPrice as pprice,compare.productId as pid,compare.id as wid from compare join products on products.id=compare.productId where compare.userId='".$_SESSION['id']."'");
                    $num=mysqli_num_rows($ret);
                      if($num>0)
                      {
                    while ($row=mysqli_fetch_array($ret)) {
                  ?>
                  <td>
                    <a href="compare.php?page=product&action=add&id=<?php echo $row['pid']; ?>" class="btn btn-primary btn-block">Add to cart</a>
                    <a class="btn btn-danger btn-block" href="compare.php?del=<?php echo htmlentities($row['wid']);?>" onClick="return confirm('Are you sure you want to delete?')">Remove</a></td> <?php }} ?>
                </tr>
                <?php } else {?>
                  <td style="font-size: 18px; font-weight:bold ">No Compare Products</td>
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
<?php }} ?>