<?php
session_start();
include('../config/config.php');
error_reporting(0);
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{
$pid=intval($_GET['id']);// product id
if(isset($_POST['submit']))
{
  $category=$_POST['category'];
  $subcat=$_POST['subcategory'];
  $productname=$_POST['productName'];
  $productcompany=$_POST['productCompany'];
  $productprice=$_POST['productprice'];
  $productpricebd=$_POST['productpricebd'];
  $productdescription=$_POST['productDescription'];
  $productscharge=$_POST['productShippingcharge'];
  $productavailability=$_POST['productAvailability'];
  $productdiscount=$_POST['productdiscount'];
  
$sql=mysqli_query($con,"update products set category='$category',subCategory='$subcat',productName='$productname',productCompany='$productcompany',productPrice='$productprice',productDescription='$productdescription',shippingCharge='$productscharge',productAvailability='$productavailability',productPriceBeforeDiscount='$productpricebd',productDiscount='$productdiscount' where id='$pid' ");
$_SESSION['msg']="Product Updated Successfully !!";

}


?>
<!doctype html>
<html lang="en" class="no-js">

<head>
	<meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
  <meta name="theme-color" content="#3e454c">

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

	<!-- Font awesome -->
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<!-- Sandstone Bootstrap CSS -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<!-- Bootstrap Datatables -->
	<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
	<!-- Bootstrap social button library -->
	<link rel="stylesheet" href="css/bootstrap-social.css">
	<!-- Bootstrap select -->
	<link rel="stylesheet" href="css/bootstrap-select.css">
	<!-- Bootstrap file input -->
	<link rel="stylesheet" href="css/fileinput.min.css">
	<!-- Awesome Bootstrap checkbox -->
	<link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
	<!-- Admin Stye -->
	<link rel="stylesheet" href="css/style.css">
<style>
		.errorWrap {
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #dd3d36;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
.succWrap{
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #5cb85c;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
		</style>
<script>
function getSubcat(val) {
  $.ajax({
  type: "POST",
  url: "get_subcat.php",
  data:'cat_id='+val,
  success: function(data){
    $("#subcategory").html(data);
  }
  });
}
function selectCountry(val) {
$("#search-box").val(val);
$("#suggesstion-box").hide();
}
</script>
<script type="text/javascript" src="js/nicEdit_dev.js"></script>
<script type="text/javascript" src="nicEditorIcons.gifs"></script>
<script type="text/javascript" src="nicEdit.js"></script>
<script type="text/javascript">
  bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
</script> 
</head>

<body>
	<?php include('includes/header.php');?>
	<div class="ts-main-content">
	<?php include('includes/leftbar.php');?>
		<div class="content-wrapper">
			<div class="container-fluid">

				<div class="row">
					<div class="col-md-12">
					
						<h2 class="page-title">Update Product</h2>

						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-default">
									<div class="panel-heading">Product Info</div>

									<div class="panel-body">
<form class="form-horizontal row-fluid" name="insertproduct" method="post" enctype="multipart/form-data">
	<p style="padding-left: 1%; color: green">
                                <?php if(isset($_POST['submit']))
{?>
                  <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                  <strong>Well done!</strong> <?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?>
                  </div>
<?php } ?>
            </p>

            <?php 

$query=mysqli_query($con,"select products.*,category.categoryName as catname,category.id as cid,subcategory.subcategory as subcatname,subcategory.id as subcatid,brands.id as bid,brands.brandName as bname from products join category on category.id=products.category join subcategory on subcategory.id=products.subCategory JOIN brands ON brands.id=products.productCompany where products.id='$pid'");
$cnt=1;
while($row=mysqli_fetch_array($query))
{
  
?>
<div class="form-group">
<label class="col-sm-2 control-label">Category <span style="color:red">*</span></label>
<div class="col-sm-4">
<select name="category" class="form-control" onChange="getSubcat(this.value);"  required>
<option value="<?php echo htmlentities($row['cid']);?>"><?php echo htmlentities($row['catname']);?></option> 
<?php $query=mysqli_query($con,"select * from category");
while($rw=mysqli_fetch_array($query))
{
  if($row['catname']==$rw['categoryName'])
  {
    continue;
  }
  else{
  ?>

<option value="<?php echo $rw['id'];?>"><?php echo $rw['categoryName'];?></option>
<?php }} ?>
</select>
</div>
<label class="col-sm-2 control-label">Sub Category <span style="color:red">*</span></label>
<div class="col-sm-4">
<select   name="subcategory"  id="subcategory" class="form-control" required>
  <option value="<?php echo htmlentities($row['subcatid']);?>"><?php echo htmlentities($row['subcatname']);?></option>
</select>

</div>
</div>
<div class="form-group">
<label class="col-sm-2 control-label">Product Name<span style="color:red">* </label>
<div class="col-sm-4">
<input type="text"    name="productName" placeholder="Enter Product Name" value="<?php echo htmlentities($row['productName']);?>" class="form-control">
<span id="user-availability-status1" style="font-size:12px;"></span>
</div>
<label class="col-sm-2 control-label">Product Brand<span style="color:red">*</span></label>
<div class="col-sm-4">

<select name="productCompany" class="form-control"  required>
<option value="<?php echo htmlentities($row['bid']);?>"><?php echo htmlentities($row['bname']);?></option> 
<?php $query=mysqli_query($con,"select * from brands");
while($rw=mysqli_fetch_array($query))
{
  if($row['bname']==$rw['brandName'])
  {
    continue;
  }
  else{
  ?>

<option value="<?php echo $rw['id'];?>"><?php echo $rw['brandName'];?></option>
<?php }} ?>
</select>

</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label">Product Discount "%"<span style="color:red">*</span></label>
<div class="col-sm-4">
<input type="text"    name="productdiscount" value="<?php echo htmlentities($row['productDiscount']);?>" placeholder="Enter Product Discount" class="form-control">
</div>
<label class="col-sm-2 control-label">Product Price Before Discount<span style="color:red">* </label>
<div class="col-sm-4">
<input type="text"    name="productpricebd" value="<?php echo htmlentities($row['productPriceBeforeDiscount']);?>" placeholder="Enter Product Price" class="form-control">
</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label">Product Price After Discount(Selling Price)<span style="color:red">*</span></label>
<div class="col-sm-4">
<input type="text"    name="productprice" value="<?php echo htmlentities($row['productPrice']);?>" placeholder="Enter Product Price" class="form-control"  required>
</div>
<label class="col-sm-2 control-label">Product Shipping Charge<span style="color:red">*</span></label>
<div class="col-sm-4">
<input type="text"    name="productShippingcharge" value="<?php echo htmlentities($row['shippingCharge']);?>" placeholder="Enter Product Shipping Charge" class="form-control"/>
<span id="passerror" style="font-size:12px; color: red;"></span>
</div>
</div>

<div class="hr-dashed"></div>
<div class="form-group">
<label class="col-sm-2 control-label">Product Description</label>
<div class="col-sm-10">
<textarea class="form-control" rows="10" cols="50" name="productDescription"  placeholder="Package Details" required>
  <?php echo htmlentities($row['productDescription']);?>
  </textarea>
</div>
</div>


<div class="hr-dashed"></div>
<div class="form-group">
<label class="col-sm-2 control-label">Product Availability</label>
<div class="col-sm-4">
<select   name="productAvailability"  id="productAvailability" class="form-control" required>
<option value="<?php echo htmlentities($row['productAvailability']);?>"><?php echo htmlentities($row['productAvailability']);?></option>
<option value="In Stock">In Stock</option>
<option value="Out of Stock">Out of Stock</option>
</select>
</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label">Product Image 1 </label>
<div class="col-sm-4">
<img src="productimages/<?php echo htmlentities($pid);?>/<?php echo htmlentities($row['productImage1']);?>" width="200" height="200"> <a href="update-product-image1.php?id=<?php echo $row['id'];?>">Change Image</a>
</div>
<div class="col-sm-4">
</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label">Product Image 2 </label>
<div class="col-sm-4">
<img src="productimages/<?php echo htmlentities($pid);?>/<?php echo htmlentities($row['productImage2']);?>" width="200" height="200"> <a href="update-product-image2.php?id=<?php echo $row['id'];?>">Change Image</a>
</div>
<div class="col-sm-4">
</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label">Product Image 3 </label>
<div class="col-sm-4">
<img src="productimages/<?php echo htmlentities($pid);?>/<?php echo htmlentities($row['productImage3']);?>" width="200" height="200"> <a href="update-product-image3.php?id=<?php echo $row['id'];?>">Change Image</a>
</div><?php } ?>
<div class="col-sm-4">
</div>
</div>
		<div class="form-group">
												<div class="col-sm-8 col-sm-offset-2">
													<button class="btn btn-default" type="reset">Cancel</button>
													<button class="btn btn-primary" type="submit" name="submit">Update Product</button>
												</div>
											</div>

										</form>
									</div>
								</div>
							</div>
						</div>
						
					

					</div>
				</div>
				
			

			</div>
		</div>
	</div>

	<!-- Loading Scripts -->
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap-select.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.dataTables.min.js"></script>
	<script src="js/dataTables.bootstrap.min.js"></script>
	<script src="js/Chart.min.js"></script>
	<script src="js/fileinput.js"></script>
	<script src="js/chartData.js"></script>
	<script src="js/main.js"></script>
</body>
</html>
<?php } ?>