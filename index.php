<?php
session_start();
error_reporting(0);
include('config/config.php');
if(isset($_GET['action']) && $_GET['action']=="add"){
  $id=intval($_GET['id']);
  if(isset($_SESSION['cart'][$id])){
    $_SESSION['cart'][$id]['quantity']++;
  }else{
    $sql_p="SELECT * FROM products WHERE id={$id}";
    $query_p=mysqli_query($con,$sql_p);
    if(mysqli_num_rows($query_p)!=0){
      $row_p=mysqli_fetch_array($query_p);
      $_SESSION['cart'][$row_p['id']]=array("quantity" => 1, "price" => $row_p['productPrice']);
      header('location:index.php');
    }else{
      $message="Product ID is invalid";
    }
  }
}
$query=mysqli_query($con,"SELECT * FROM genaralsetting where id=8");
while($row=mysqli_fetch_array($query)) 
{
  $sitecurrency=$row['setting_description'];
}
//index.php?page=product&action=add&id=<?php echo $row['id']
$query=mysqli_query($con,"SELECT status FROM sitemaintenance where id=1");
while($row=mysqli_fetch_array($query)) 
{
$maintincestatus = $row['status'];
if($maintincestatus==1)
{
    header('location:Maintenance/index.php');
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
     <link rel="shortcut icon" type="image/x-icon" href="images/favicon/<?php echo htmlentities($row['setting_description']);?>"/><?php }?>
  
  <?php $query=mysqli_query($con,"SELECT * FROM genaralsetting where id=1");
    while($row=mysqli_fetch_array($query)) 
    {
     ?>  
    <title><?php echo htmlentities($row['setting_description']);?></title><?php }?>
<!-- CSS Part Start-->
<link rel="stylesheet" type="text/css" href="js/bootstrap/css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="css/font-awesome/css/font-awesome.min.css" />
<link rel="stylesheet" type="text/css" href="css/stylesheet.css" />
<link rel="stylesheet" type="text/css" href="css/owl.carousel.css" />
<link rel="stylesheet" type="text/css" href="css/owl.transitions.css" />
<link rel="stylesheet" type="text/css" href="css/responsive.css" />
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans' type='text/css'>
<!-- CSS Part End-->


</head>
<body>
  <!-- fb messenger Start -->
  <?php include('fbmessenger.php');?>
<!-- fb messenger Start -->
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
    <!-- Feature Box Start-->
   <?php include('includes/sections/featurebox.php');?>
    <!-- Feature Box End-->
    <div class="container">
      <div class="row">
        <!-- Left Part Start-->
        <!-- Top header Start-->
    <?php include('includes/slide-bars/category.php');?>
    <?php include('includes/slide-bars/bestsellers.php');?>
    <?php include('includes/slide-bars/specials.php');?>
    <?php include('includes/slide-bars/custom-content.php');?>
    <?php include('includes/slide-bars/latest.php');?>

          
        <!-- Left Part End-->
        <!--Middle Part Start-->
        <div id="content" class="col-sm-9">

          <!-- Slideshow Start-->
          <?php include('includes/sections/slider.php');?>
          
          <!-- Slideshow End-->

          <!-- Featured Product Start-->
          <h3 class="subtitle">Featured</h3>
          
            <div class="owl-carousel product_carousel">
              <?php include('includes/sections/featured.php');?> 
            </div>
          <!-- Featured Product End-->

          <!-- Featured Banner Start-->
            <?php include('includes/advertising/Activation/featured.php');?>
          <!-- Featured Banner End-->


          <!-- Electronic Product Slider Start-->
            <?php include('includes/sections/category-01.php');?>
          <!-- Electronic Product Slider End-->

          <!-- Electronic Banner Start-->
            <?php include('includes/advertising/Activation/category-01.php');?>
          <!-- Electronic Banner End-->
          

          <!-- Health & Beauty Product Slider Start -->
            <?php include('includes/sections/category-02.php');?>
          <!-- Health & Beauty Product Slider End -->

          <!-- Health & Beauty Banner Start-->
            <?php include('includes/advertising/Activation/category-02.php');?>
          <!-- Health & Beauty Banner End-->

           <!-- Apple Product Slider Start -->
         
            <?php include('includes/sections/bestbrand.php');?>
          <!-- Apple Product Slider End -->

          <!-- Brand Product Slider Start -->
            <?php include('includes/sections/brands.php');?>
          <!-- Brand Product Slider End -->

          <!-- Brand Banner Start-->
            <?php include('includes/advertising/Activation/brand.php');?>
          <!-- Brand Banner End-->
          
        </div>
        <!--Middle Part End-->
      </div>
    </div>
  </div>
  <!--Footer Start-->
  <!--Footer Start-->
  <?php include('includes/footer/footer.php');?>
  <!--Footer End-->
  <?php include('includes/slide-blocks/slide-blocks.php');?>
  <!-- Custom Side Block End -->
  <!-- Custom Side Block End -->
</div>
<!-- JS Part Start-->
<script type="text/javascript" src="js/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="js/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/jquery.easing-1.3.min.js"></script>
<script type="text/javascript" src="js/jquery.dcjqaccordion.min.js"></script>
<script type="text/javascript" src="js/owl.carousel.min.js"></script>
<script type="text/javascript" src="js/custom.js"></script>

<!-- JS Part End-->
</body>
</html>