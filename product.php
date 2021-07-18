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
      header('location:my-account/my-cart.php');
    }else{
      $message="Product ID is invalid";
    }
  }
}
$pid=intval($_GET['pid']);
if(isset($_GET['pid']) && $_GET['action']=="wishlist" ){
  if(strlen($_SESSION['login'])==0)
    {   
header('location:login.php');
}
else
{
mysqli_query($con,"insert into wishlist(userId,productId) values('".$_SESSION['id']."','$pid')");
echo "<script>alert('Product aded in wishlist');</script>";
header('location:my-account/my-wishlist.php');

}
}

if(isset($_GET['pid']) && $_GET['action']=="compare" ){
  if(strlen($_SESSION['login'])==0)
    {   
header('location:login.php');
}
else
{
mysqli_query($con,"insert into compare(userId,productId) values('".$_SESSION['id']."','$pid')");
echo "<script>alert('Product aded in compare');</script>";
header('location:my-account/compare.php');

}

}
if(isset($_POST['submit']))
{
  $qty=$_POST['quality'];
  $price=$_POST['price'];
  $value=$_POST['value'];
  $name=$_POST['name'];
  $summary=$_POST['summary'];
  $review=$_POST['review'];
  mysqli_query($con,"insert into productreviews(productId,quality,price,value,name,summary,review) values('$pid','$qty','$price','$value','$name','$summary','$review')");
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
<link rel="stylesheet" type="text/css" href="js/swipebox/src/css/swipebox.min.css">
<link rel="stylesheet" type="text/css" href="css/responsive.css" />
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
      <ul class="breadcrumb"></ul>
        <?php
$ret=mysqli_query($con,"select category.categoryName as catname,category.id as catid,subCategory.subcategory as subcatname,subCategory.id as subid,products.productName as pname from products join category on category.id=products.category join subcategory on subcategory.id=products.subCategory where products.id='$pid'");
while ($rw=mysqli_fetch_array($ret)) {

?>
        <li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="index.php" itemprop="url"><span itemprop="title"><i class="fa fa-home"></i></span></a></li>
        <li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="category.php?cid=<?php echo htmlentities($rw['catid']);?>" itemprop="url"><span itemprop="title"><?php echo htmlentities($rw['catname']);?></span></a></li>
        <li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="subcategory.php?subcategory=<?php echo htmlentities($rw['subid']);?>&category=<?php echo htmlentities($rw['catid']);?>" itemprop="url"><span itemprop="title"><?php echo htmlentities($rw['subcatname']);?></span></a></li>
      </ul><?php }?>
      <!-- Breadcrumb End-->
      <div class="row">
        <!--Middle Part Start-->
        <div id="content" class="col-sm-9">
          <div itemscope itemtype="http://schema.org/Product">
            <?php 
$ret=mysqli_query($con,"select products.*,brands.brandName from products INNER JOIN brands ON products.productCompany=brands.id WHERE products.id='$pid'");
while($row=mysqli_fetch_array($ret))
{

?>
            <h1 class="title" itemprop="name"><?php echo htmlentities($row['productName']);?></h1>
            <div class="row product-info">
              <div class="col-sm-6">
                <div class="image">

                  <img class="img-responsive" itemprop="image" id="zoom_01" src="admin/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productResizeImage1']);?>" alt="Laptop Silver black" data-zoom-image="admin/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productResizeImage1']);?>" /> 
                </div>
                <div class="center-block text-center"><span class="zoom-gallery"><i class="fa fa-search"></i> Click image for Gallery</span></div>
                <div class="image-additional" id="gallery_01"> 
                  <a class="thumbnail" href="#" data-zoom-image="admin/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productResizeImage1']);?>" data-image="admin/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productResizeImage1']);?>"> 
                  <img src="admin/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productResizeImage1']);?>" title="<?php echo htmlentities($row['productName']);?>"/></a> 

                  <a class="thumbnail" href="#" data-zoom-image="admin/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productResizeImage2']);?>" data-image="admin/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productResizeImage2']);?>">
                  <img src="admin/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage2']);?>" title="<?php echo htmlentities($row['productName']);?>"/></a>

                  <a class="thumbnail" href="#" data-zoom-image="admin/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productResizeImage3']);?>" data-image="admin/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productResizeImage3']);?>">
                  <img src="admin/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productResizeImage3']);?>" title="<?php echo htmlentities($row['productName']);?>" /></a> 
                  
                  </div>
              </div>
              <div class="col-sm-6">
                <ul class="list-unstyled description">
                  <li><b>Brand:</b> <a href="#"><span itemprop="brand"><?php echo htmlentities($row['brandName']);?></span></a></li>
                  <li><b>Reward Points:</b> 700</li>
                  <li><b>Availability:</b> <span class="instock"><?php echo htmlentities($row['productAvailability']);?></span></li>
                  <li><b>Shipping Charge :</b> <span itemprop="mpn">
                    <?php if($row['shippingCharge']==0)
                      {
                        echo "Free";
                      }
                      else
                      {
                        echo htmlentities($row['shippingCharge']);
                      }

                      ?>


                  </span></li>
                </ul>
                <ul class="price-box">
                  <li class="price" itemprop="offers" itemscope itemtype="http://schema.org/Offer"><span class="price-old"><?php echo $sitecurrency;?><?php echo htmlentities($row['productPriceBeforeDiscount']);?></span> <span itemprop="price"><?php echo $sitecurrency;?><?php echo htmlentities($row['productPrice']);?><span itemprop="availability" content="In Stock"></span></span></li>
                  <li></li>
                 
                </ul>
                <div id="product">
                  
                  
                  <div class="cart">
                    <div>
                      
                      <a href="product.php?page=product&action=add&id=<?php echo $row['id']; ?>" class="btn btn-primary btn-lg">Add to Cart</a>
                    </div>
                    <div>
                      <a href="product.php?pid=<?php echo htmlentities($row['id'])?>&&action=wishlist"><button type="button" class="wishlist" ><i class="fa fa-heart"></i> Add to Wish List</button></a>
                      <br />
                      <a href="product.php?pid=<?php echo htmlentities($row['id'])?>&&action=compare"><button type="button" class="wishlist" ><i class="fa fa-exchange"></i> Compare this Product</button>
                    </div>
                  </div>
                </div>
                <div class="rating" itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">
                  <meta itemprop="ratingValue" content="0" />
                  <p>
                    <?php
                    $query1=mysqli_query($con,"select COUNT(productId) FROM productreviews WHERE productId ='$pid'");
                      while($row2=mysqli_fetch_array($query1)) 
                      {
                        $pcount=$row2['COUNT(productId)'];
                      }
                    $ret=mysqli_query($con,"SELECT round(sum((quality/3)+(price/3)+(value/3))/'$pcount') as aws FROM productreviews WHERE productId='$pid'");
                    $num=mysqli_num_rows($ret);
                      if($num>0)
                      {
                        while ($row=mysqli_fetch_array($ret)) 
                        {
                           $ratngpoint=$row['aws'];
                  ?>
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
                     <?php } else {?>
                      
                    <?php }}} ?>

                     <?php $qry=mysqli_query($con,"select count(id) from productreviews where productId='$pid'");
                        while($rvw=mysqli_fetch_array($qry))
                        {
                        ?>
                    <a onClick="$('a[href=\'#tab-review\']').trigger('click'); return false;" href=""><span itemprop="reviewCount"><?php echo htmlentities($rvw['count(id)']);?> reviews</span></a> / <a onClick="$('a[href=\'#tab-review\']').trigger('click'); return false;" href="">Write a review</a></p>
                </div>
                <hr>
                <!-- AddThis Button BEGIN -->
                <div class="addthis_toolbox addthis_default_style"> <a class="addthis_button_facebook_like" fb:like:layout="button_count"></a> <a class="addthis_button_tweet"></a> <a class="addthis_button_google_plusone" g:plusone:size="medium"></a> <a class="addthis_button_pinterest_pinit" pi:pinit:layout="horizontal" pi:pinit:url="http://www.addthis.com/features/pinterest" pi:pinit:media="http://www.addthis.com/cms-content/images/features/pinterest-lg.png"></a> <a class="addthis_counter addthis_pill_style"></a> </div>
                <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-514863386b357649"></script>
                <!-- AddThis Button END -->
              </div>
            </div>
            <ul class="nav nav-tabs">
              <li class="active"><a href="#tab-description" data-toggle="tab">Description</a></li>
             
              <li><a href="#tab-review" data-toggle="tab">Reviews <?php echo htmlentities($rvw['count(id)']);?></a></li><?php } ?>
            </ul>
            <div class="tab-content">
              <div itemprop="description" id="tab-description" class="tab-pane active">
                <div>
                  <?php echo $row['productDescription'];?>
                </div>
              </div>
              <div id="tab-review" class="tab-pane">
                <form class="form-horizontal">
                  <div id="review">
                    <div>
                      <table class="table table-striped table-bordered">
                        <?php $qry=mysqli_query($con,"select * from productreviews where productId='$pid' Order by id desc limit 3");
                        while($rvw=mysqli_fetch_array($qry))
                        {
                          $ratngpoint=$rvw['quality'];
                        ?>
                        <tbody>
                          <tr>
                            <td style="width: 50%;"><strong><span><?php echo htmlentities($rvw['name']);?></span></strong></td>
                            <td class="text-right"><span><?php echo htmlentities($rvw['reviewDate']);?></span></td>
                          </tr>
                          <tr>
                            <td colspan="2"><p><?php echo htmlentities($rvw['summary']);?></p>
                            <div class="rating"><div class="text"><b>Quality :</b> 
                            
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
                                 <?php } else {?>
                                  
                                <?php }?>


                         </div></div>

                            <div class="rating"><div class="text"><b>Price :</b>  
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
                                 <?php } else {?>
                                  
                                <?php }?>
                          </div></div>

                            <div class="rating"><div class="text"><b>value :</b> 
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
                                 <?php } else {?>
                                  
                                <?php }?>

                            </div></div>
                             </td>
                          </tr>
                        </tbody><?php } ?>
                        <br>
                      </table>
                      </div>
                    <div class="text-right"></div>
                  </div>
              </form>
                  <h2>Write a review</h2>
                  <form role="form" name="review" method="post">
                  <div class="form-group required">
                    <div class="col-sm-12">
                      <label for="input-name" class="control-label">Your Name</label>
                      <input type="text" class="form-control txt" id="exampleInputName" placeholder="" name="name" required="required">
                    </div>
                  </div>
                  <div class="form-group required">
                    <div class="col-sm-12">
                      <label for="input-review" class="control-label">Your Review</label>
                      <textarea class="form-control txt txt-review" id="exampleInputReview" rows="4" placeholder="" name="review" required="required"></textarea>
                      <div class="help-block"><span class="text-danger">Note:</span> HTML is not translated!</div>
                    </div>
                  </div>
                  <div class="form-group required">
                    <div class="col-sm-12">
                      <label for="input-name" class="control-label">Summary</label>
                      <input type="text" class="form-control txt" id="exampleInputName" placeholder="" name="summary" required="required">
                    </div>
                  </div>
                  <div class="form-group required">
                    <div class="col-sm-12">
                      <label class="control-label">Rating</label>
                      <table class="table table-bordered">  
                            <thead>
                              <tr>
                                <th class="cell-label">&nbsp;</th>
                                <th>1 star</th>
                                <th>2 stars</th>
                                <th>3 stars</th>
                                <th>4 stars</th>
                                <th>5 stars</th>
                              </tr>
                            </thead>  
                            <tbody>
                              <tr>
                                <td class="cell-label">Quality</td>
                                <td><input type="radio" name="quality" class="radio" value="1"></td>
                                <td><input type="radio" name="quality" class="radio" value="2"></td>
                                <td><input type="radio" name="quality" class="radio" value="3"></td>
                                <td><input type="radio" name="quality" class="radio" value="4"></td>
                                <td><input type="radio" name="quality" class="radio" value="5"></td>
                              </tr>
                              <tr>
                                <td class="cell-label">Price</td>
                                <td><input type="radio" name="price" class="radio" value="1"></td>
                                <td><input type="radio" name="price" class="radio" value="2"></td>
                                <td><input type="radio" name="price" class="radio" value="3"></td>
                                <td><input type="radio" name="price" class="radio" value="4"></td>
                                <td><input type="radio" name="price" class="radio" value="5"></td>
                              </tr>
                              <tr>
                                <td class="cell-label">Value</td>
                                <td><input type="radio" name="value" class="radio" value="1"></td>
                                <td><input type="radio" name="value" class="radio" value="2"></td>
                                <td><input type="radio" name="value" class="radio" value="3"></td>
                                <td><input type="radio" name="value" class="radio" value="4"></td>
                                <td><input type="radio" name="value" class="radio" value="5"></td>
                              </tr>
                            </tbody>
                          </table><!-- /.table .table-bordered -->
                    </div>
                  </div>
                  <div class="buttons">
                    <div class="pull-right">
                      <button class="btn btn-primary" name="submit">Continue</button>
                    </div>
                  </div>
                </form><?php } ?>
              </div>
            </div>
            <h3 class="subtitle">Related Products</h3>
            <div class="owl-carousel related_pro">
              <?php
$ret=mysqli_query($con,"select subCategory.id from subcategory INNER join products on products.subCategory=subcategory.id WHERE products.id='$pid'");
while ($row=mysqli_fetch_array($ret)) 
{
  $subid=$row['id'];
  // echo $subid;
?><?php } ?>

<?php
$ret=mysqli_query($con,"select * from products where subCategory ='$subid' and id !='$pid'");
while ($row=mysqli_fetch_array($ret)) 
{
  $discountstat=$row['productDiscount'];
?>
            <div class="product-thumb">
              <div class="image"><a href="product.php?pid=<?php echo htmlentities($row['id']);?>"><img src="admin/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage1']);?>" class="img-responsive" data-echo="admin/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage1']);?>"/></a></div>
              <div class="caption">
                <h4><a href="product.php?pid=<?php echo htmlentities($row['id']);?>"><?php echo htmlentities($row['productName']);?></a></h4>
                 <p class="price"> <span class="price-new">Rs. <?php echo htmlentities($row['productPrice']);?></span> <span class="price-old">Rs.<?php echo htmlentities($row['productPriceBeforeDiscount']);?></span>  <?php 
                  if ($discountstat == 0) {?>
                    
                  <?php } else {?>
                    <span class="saving">-<?php echo $row['productDiscount'];?>%</span>
                  <?php } ?> </p>
                
              </div>
              <div class="button-group">
                <a href="index.php?page=product&action=add&id=<?php echo $row['id']; ?>"><button class="btn-primary" type="button" ><span>Add to Cart</span></button></a>
                
              </div>
            </div>
            <?php } ?>
            </div>
          </div>
        </div>
        <!--Middle Part End -->
        <!--Right Part Start -->
        <aside id="column-right" class="col-sm-3 hidden-xs">
          <!-- Best Sellers Side Bar -->
          <?php include('includes/slide-bars/bestsellers.php');?>
          <!-- END Best Sellers Side Bar -->
          <!-- custom content Side Bar -->
          <?php include('includes/slide-bars/custom-content.php');?>
          <!-- End custom content Side Bar -->
          <!-- specials Side Bar -->
          <?php include('includes/slide-bars/specials.php');?>
          <!--End specials Side Bar -->
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
<script type="text/javascript" src="js/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="js/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/jquery.easing-1.3.min.js"></script>
<script type="text/javascript" src="js/jquery.dcjqaccordion.min.js"></script>
<script type="text/javascript" src="js/owl.carousel.min.js"></script>
<script type="text/javascript" src="js/jquery.elevateZoom-3.0.8.min.js"></script>
<script type="text/javascript" src="js/swipebox/lib/ios-orientationchange-fix.js"></script>
<script type="text/javascript" src="js/swipebox/src/js/jquery.swipebox.min.js"></script>
<script type="text/javascript" src="js/custom.js"></script>
<script type="text/javascript">
// Elevate Zoom for Product Page image
$("#zoom_01").elevateZoom({
	gallery:'gallery_01',
	cursor: 'pointer',
	galleryActiveClass: 'active',
	imageCrossfade: true,
	zoomWindowFadeIn: 500,
	zoomWindowFadeOut: 500,
	lensFadeIn: 500,
	lensFadeOut: 500,
	loadingIcon: 'image/progress.gif'
	}); 
//////pass the images to swipebox
$("#zoom_01").bind("click", function(e) {
  var ez =   $('#zoom_01').data('elevateZoom');
	$.swipebox(ez.getGalleryList());
  return false;
});
</script>
<!-- JS Part End-->
</body>
</html>