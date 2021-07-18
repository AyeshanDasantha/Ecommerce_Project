<?php
session_start();
error_reporting(0);
include('config/config.php');
$brandid=intval($_GET['brand']);
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
      header('location:my-cart.php');
    }else{
      $message="Product ID is invalid";
    }
  }
}
// COde for Wishlist
if(isset($_GET['pid']) && $_GET['action']=="wishlist" ){
  if(strlen($_SESSION['login'])==0)
    {   
header('location:login.php');
}
else
{
mysqli_query($con,"insert into wishlist(userId,productId) values('".$_SESSION['id']."','".$_GET['pid']."')");
echo "<script>alert('Product aaded in wishlist');</script>";
header('location:my-wishlist.php');

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
        <li><a href="index.html"><i class="fa fa-home"></i></a></li>
        <li><a href="search.html">Search</a></li>
      </ul>
      <!-- Breadcrumb End-->
      <div class="row">
        <!--Middle Part Start-->
        <div id="content" class="col-sm-12">
          <h1 class="title">Search - iphone</h1>
          <label>Search Criteria</label>
          <div class="row">
            <div class="col-sm-4">
              <input type="text" class="form-control" placeholder="Keywords" value="" name="search">
            </div>
            <div class="col-sm-3">
              <select class="form-control" name="category_id">

                <option value="0">All Categories</option>
                
                <option>Clothing</option>
                <?php $sql=mysqli_query($con,"select id,brandName  from brands");
        while($row=mysqli_fetch_array($sql))
        {
          ?>
                <option><?php echo $row['brandName'];?></option><?php }?>
              </select>
            </div>
            <div class="col-sm-3">
              <input type="button" class="btn btn-primary" id="button-search" value="Search">
            </div>
          </div>
          <br>
          <div class="product-filter">
            <div class="row">
              <div class="col-md-4 col-sm-5">
                <div class="btn-group">
                  <button type="button" id="list-view" class="btn btn-default" data-toggle="tooltip" title="List"><i class="fa fa-th-list"></i></button>
                  <button type="button" id="grid-view" class="btn btn-default" data-toggle="tooltip" title="Grid"><i class="fa fa-th"></i></button>
                </div>
                <a href="compare.html" id="compare-total">Product Compare (0)</a> </div>
              <div class="col-sm-2 text-right">
                <label class="control-label" for="input-sort">Sort By:</label>
              </div>
              <div class="col-md-3 col-sm-2 text-right">
                <select id="input-sort" class="form-control col-sm-3">
                  <option value="" selected="selected">Default</option>
                  <option value="">Name (A - Z)</option>
                  <option value="">Name (Z - A)</option>
                  <option value="">Price (Low &gt; High)</option>
                  <option value="">Price (High &gt; Low)</option>
                  <option value="">Rating (Highest)</option>
                  <option value="">Rating (Lowest)</option>
                  <option value="">Model (A - Z)</option>
                  <option value="">Model (Z - A)</option>
                </select>
              </div>
              <div class="col-sm-1 text-right">
                <label class="control-label" for="input-limit">Show:</label>
              </div>
              <div class="col-sm-2 text-right">
                <select id="input-limit" class="form-control">
                  <option value="" selected="selected">20</option>
                  <option value="">25</option>
                  <option value="">50</option>
                  <option value="">75</option>
                  <option value="">100</option>
                </select>
              </div>
            </div>
          </div>
          <br />
          <div class="row products-category">
            
           

                <?php
                if (isset($_GET['pageno'])) 
                {
                  $pageno = $_GET['pageno'];
                } 
                else 
                {
                  $pageno = 1;
                }
                $no_of_records_per_page = 15;
                $offset = ($pageno-1) * $no_of_records_per_page;
                $total_pages_sql = "SELECT COUNT(*) FROM products where productCompany='$brandid'";
                $result = mysqli_query($con,$total_pages_sql);
                $total_rows = mysqli_fetch_array($result)[0];
                $total_pages = ceil($total_rows / $no_of_records_per_page);

                $ret=mysqli_query($con,"select * from products where productCompany='$brandid' LIMIT $offset, $no_of_records_per_page");
                $num=mysqli_num_rows($ret);
                if($num>0)
                {
                while ($row=mysqli_fetch_array($ret)) 
                {?>


           
           
            <div class="product-layout product-list col-xs-12">
              <div class="product-thumb">
                <div class="image"><a href="product.php?pid=<?php echo htmlentities($row['id']);?>"><img src="admin/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage1']);?>" class="img-responsive" /></a></div>
                <div>
                  <div class="caption">
                    <h4><a href="product.php?pid=<?php echo htmlentities($row['id']);?>"><?php echo htmlentities($row['productName']);?></a></h4>
                    <p class="description"><?php echo htmlentities($row['productName']);?></p>
                    <p class="price"> <span class="price-new"><?php echo $sitecurrency;?> <?php echo htmlentities($row['productPrice']);?></span> <span class="price-old"><?php echo $sitecurrency;?> <?php echo htmlentities($row['productPriceBeforeDiscount']);?></span> <span class="saving">-5%</span> <span class="price-tax">Ex Tax: $190.00</span> </p>
                    <div class="rating"> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span> </div>
                  </div>
                  <div class="button-group">
                    <a href="category.php?page=product&action=add&id=<?php echo $row['id']; ?>"><button class="btn-primary" type="button"><span>Add to Cart</span></button></a>
                    <div class="add-to-links">
                      <a href="category.php?pid=<?php echo htmlentities($row['id'])?>&&action=wishlist"><button type="button" data-toggle="tooltip" title="Add to Wish List"><i class="fa fa-heart"></i> <span>Add to Wish List</span></button></a>
                      <button type="button" data-toggle="tooltip" title="Compare this Product" onClick=""><i class="fa fa-exchange"></i> <span>Compare this Product</span></button>
                    </div>
                  </div>
                </div>
              </div>
            </div><?php } } else {?>


              <div class="col-sm-6 col-md-4 wow fadeInUp"> <h3>No Brands Found</h3>
    </div>
    <?php } ?>
          </div>
          <div class="row">
            <div class="col-sm-6 text-left">
              <ul class="pagination"> 
                <li class="active"><a href="brand.php?brand=<?php echo $brandid;?>&pageno=1"><span>First</span></a></li>
                <li class="<?php if($pageno <= 1){ echo 'disabled'; } ?>"><a href="<?php if($pageno <= 1){ echo '#'; } else { echo "brand.php?brand=$brandid&pageno=".($pageno - 1); } ?>">Privious</a></li>
                <li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?>"><a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "brand.php?brand=$brandid&pageno=".($pageno + 1); } ?>">Next</a></li>

                <li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?>"><a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "brand.php?brand=$brandid&pageno=$total_pages"; } ?>">Last</a></li>

                
              </ul>
          </div>
            <div class="col-sm-6 text-right"><!-- Showing 1 to 12 of 15 (2 Pages) -->Showing <?php echo $total_pages;?> Pages</div>
          </div>
        </div>
        <!--Middle Part End -->
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