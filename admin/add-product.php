<?php
session_start();
include('../config/config.php');
error_reporting(0);
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{
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
  // $productimage1=$_FILES["productimage1"]["name"];

  // $productimage3=$_FILES["productimage3"]["name"];
	//for getting product id
$query=mysqli_query($con,"select max(id) as pid from products");
  $result=mysqli_fetch_array($query);
   $productid=$result['pid']+1;
  $dir="productimages/$productid";
if(!is_dir($dir)){
    mkdir("productimages/".$productid);
  }


  function resizeImage($resourceType,$image_width,$image_height,$resizeWidth,$resizeHeight) {
    // $resizeWidth = 100;
    // $resizeHeight = 100;
    $imageLayer = imagecreatetruecolor($resizeWidth,$resizeHeight);
    imagecopyresampled($imageLayer,$resourceType,0,0,0,0,$resizeWidth,$resizeHeight, $image_width,$image_height);
    return $imageLayer;
}

        $imageProcess = 0;
        if(is_array($_FILES)) {
        $new_width = 200;
        $new_height = 200;

        $new_width11 = 500;
        $new_height11 = 500;

        $new_width111 = 50;
        $new_height111 = 50;
        $fileName = $_FILES['productimage1']['tmp_name'];
        $sourceProperties = getimagesize($fileName);
        $resizeFileName = time()+10;
        $uploadPath = "productimages/$productid/";
        $fileExt = pathinfo($_FILES['productimage1']['name'], PATHINFO_EXTENSION);
        $uploadImageType = $sourceProperties[2];
        $sourceImageWidth = $sourceProperties[0];
        $sourceImageHeight = $sourceProperties[1];
        switch ($uploadImageType) {
            case IMAGETYPE_JPEG:
                $resourceType = imagecreatefromjpeg($fileName); 
                $imageLayer = resizeImage($resourceType,$sourceImageWidth,$sourceImageHeight,$new_width,$new_height);
                imagejpeg($imageLayer,$uploadPath."thump1_".$resizeFileName.'.'. $fileExt);

                $imageLayer11 = resizeImage($resourceType,$sourceImageWidth,$sourceImageHeight,$new_width11,$new_height11);
                imagejpeg($imageLayer11,$uploadPath."thump11_".$resizeFileName.'.'. $fileExt);

                $imageLayer111 = resizeImage($resourceType,$sourceImageWidth,$sourceImageHeight,$new_width111,$new_height111);
                imagejpeg($imageLayer111,$uploadPath."thump111_".$resizeFileName.'.'. $fileExt);
                break;

            case IMAGETYPE_GIF:
                $resourceType = imagecreatefromgif($fileName); 
                $imageLayer = resizeImage($resourceType,$sourceImageWidth,$sourceImageHeight,$new_width,$new_height);
                imagegif($imageLayer,$uploadPath."thump1_".$resizeFileName.'.'. $fileExt);

                $imageLayer11 = resizeImage($resourceType,$sourceImageWidth,$sourceImageHeight,$new_width11,$new_height11);
                imagejpeg($imageLayer11,$uploadPath."thump11_".$resizeFileName.'.'. $fileExt);

                $imageLayer111 = resizeImage($resourceType,$sourceImageWidth,$sourceImageHeight,$new_width111,$new_height111);
                imagejpeg($imageLayer111,$uploadPath."thump111_".$resizeFileName.'.'. $fileExt);
                break;

            case IMAGETYPE_PNG:
                $resourceType = imagecreatefrompng($fileName); 
                $imageLayer = resizeImage($resourceType,$sourceImageWidth,$sourceImageHeight,$new_width,$new_height);
                imagepng($imageLayer,$uploadPath."thump1_".$resizeFileName.'.'. $fileExt);

                $imageLayer11 = resizeImage($resourceType,$sourceImageWidth,$sourceImageHeight,$new_width11,$new_height11);
                imagejpeg($imageLayer11,$uploadPath."thump11_".$resizeFileName.'.'. $fileExt);

                $imageLayer111 = resizeImage($resourceType,$sourceImageWidth,$sourceImageHeight,$new_width111,$new_height111);
                imagejpeg($imageLayer111,$uploadPath."thump111_".$resizeFileName.'.'. $fileExt);
                break;

            default:
                $imageProcess = 0;
                break;
        }
        move_uploaded_file($fileName, $uploadPath. $resizeFileName. ".". $fileExt);
        $imagesize200_1= "thump1_".$resizeFileName. ".". $fileExt;
        $imagesize350_1="thump11_".$resizeFileName.'.'. $fileExt;
        $imagesize50_1="thump111_".$resizeFileName.'.'. $fileExt;
        $imageProcess = 1;

  function resizeImage2($resourceType2,$image_width2,$image_height2,$resizeWidth2,$resizeHeight2) {
    // $resizeWidth = 100;
    // $resizeHeight = 100;
    $imageLayer2 = imagecreatetruecolor($resizeWidth2,$resizeHeight2);
    imagecopyresampled($imageLayer2,$resourceType2,0,0,0,0,$resizeWidth2,$resizeHeight2, $image_width2,$image_height2);
    return $imageLayer2;
}
        $imageProcess2 = 0;
        if(is_array($_FILES)) {
        $new_width2 = 200;
        $new_height2 = 200;

        $new_width12 = 500;
        $new_height12 = 500;

        $new_width122 = 50;
        $new_height122 = 50;
        $fileName2 = $_FILES['productimage2']['tmp_name'];
        $sourceProperties2 = getimagesize($fileName2);
        $resizeFileName2 = time()+50;
        $uploadPath2 = "productimages/$productid/";
        $fileExt2 = pathinfo($_FILES['productimage2']['name'], PATHINFO_EXTENSION);
        $uploadImageType2 = $sourceProperties2[2];
        $sourceImageWidth2 = $sourceProperties2[0];
        $sourceImageHeight2 = $sourceProperties2[1];
        switch ($uploadImageType2) {
            case IMAGETYPE_JPEG:
                $resourceType2 = imagecreatefromjpeg($fileName2); 
                $imageLayer2 = resizeImage($resourceType2,$sourceImageWidth2,$sourceImageHeight2,$new_width2,$new_height2);
                imagejpeg($imageLayer2,$uploadPath2."thump2_".$resizeFileName2.'.'. $fileExt2);

               	$imageLayer12 = resizeImage($resourceType2,$sourceImageWidth2,$sourceImageHeight2,$new_width12,$new_height12);
                imagejpeg($imageLayer12,$uploadPath2."thump12_".$resizeFileName2.'.'. $fileExt2);

                $imageLayer122 = resizeImage($resourceType2,$sourceImageWidth2,$sourceImageHeight2,$new_width122,$new_height122);
                imagejpeg($imageLayer122,$uploadPath2."thump122_".$resizeFileName2.'.'. $fileExt2);

                break;

            case IMAGETYPE_GIF:
                $resourceType2 = imagecreatefromgif($fileName2); 
                $imageLayer2 = resizeImage($resourceType2,$sourceImageWidth2,$sourceImageHeight2,$new_width2,$new_height2);
                imagegif($imageLayer2,$uploadPath2."thump2_".$resizeFileName2.'.'. $fileExt2);

                $imageLayer12 = resizeImage($resourceType2,$sourceImageWidth2,$sourceImageHeight2,$new_width12,$new_height12);
                imagejpeg($imageLayer12,$uploadPath2."thump12_".$resizeFileName2.'.'. $fileExt2);

                $imageLayer122 = resizeImage($resourceType2,$sourceImageWidth2,$sourceImageHeight2,$new_width122,$new_height122);
                imagejpeg($imageLayer122,$uploadPath2."thump122_".$resizeFileName2.'.'. $fileExt2);

                break;

            case IMAGETYPE_PNG:
                $resourceType2 = imagecreatefrompng($fileName2); 
                $imageLayer2 = resizeImage($resourceType2,$sourceImageWidth2,$sourceImageHeight2,$new_width2,$new_height2);
                imagepng($imageLayer2,$uploadPath2."thump2_".$resizeFileName2.'.'. $fileExt2);

                $imageLayer12 = resizeImage($resourceType2,$sourceImageWidth2,$sourceImageHeight2,$new_width12,$new_height12);
                imagejpeg($imageLayer12,$uploadPath2."thump12_".$resizeFileName2.'.'. $fileExt2);

                $imageLayer122 = resizeImage($resourceType2,$sourceImageWidth2,$sourceImageHeight2,$new_width122,$new_height122);
                imagejpeg($imageLayer122,$uploadPath2."thump122_".$resizeFileName2.'.'. $fileExt2);

                break;

            default:
                $imageProcess2 = 0;
                break;
        }
        move_uploaded_file($fileName2, $uploadPath2. $resizeFileName2. ".". $fileExt2);
        $imagesize200_2= "thump2_".$resizeFileName2. ".". $fileExt2;
        $imagesize350_2="thump12_".$resizeFileName2.'.'. $fileExt2;
        $imagesize50_2="thump122_".$resizeFileName2.'.'. $fileExt2;
        $imageProcess2 = 1;


        function resizeImage3($resourceType3,$image_width3,$image_height3,$resizeWidth3,$resizeHeight3) {
    // $resizeWidth = 100;
    // $resizeHeight = 100;
    $imageLayer3 = imagecreatetruecolor($resizeWidth3,$resizeHeight3);
    imagecopyresampled($imageLayer3,$resourceType3,0,0,0,0,$resizeWidth3,$resizeHeight3, $image_width3,$image_height3);
    return $imageLayer3;
}
        $imageProcess3 = 0;
        if(is_array($_FILES)) {
        $new_width3 = 200;
        $new_height3 = 200;

        $new_width13 = 500;
        $new_height13 = 500;

        $new_width133 = 50;
        $new_height133 = 50;
        $fileName3 = $_FILES['productimage3']['tmp_name'];
        $sourceProperties3 = getimagesize($fileName3);
        $resizeFileName3 = time();
        $uploadPath3 = "productimages/$productid/";
        $fileExt3 = pathinfo($_FILES['productimage3']['name'], PATHINFO_EXTENSION);
        $uploadImageType3 = $sourceProperties3[2];
        $sourceImageWidth3 = $sourceProperties3[0];
        $sourceImageHeight3 = $sourceProperties3[1];
        switch ($uploadImageType3) {
            case IMAGETYPE_JPEG:
                $resourceType3 = imagecreatefromjpeg($fileName3); 
                $imageLayer3 = resizeImage($resourceType3,$sourceImageWidth3,$sourceImageHeight3,$new_width3,$new_height3);
                imagejpeg($imageLayer3,$uploadPath3."thump3_".$resizeFileName3.'.'. $fileExt3);

                $imageLayer13 = resizeImage($resourceType3,$sourceImageWidth3,$sourceImageHeight3,$new_width13,$new_height13);
                imagejpeg($imageLayer13,$uploadPath3."thump13_".$resizeFileName3.'.'. $fileExt3);

                 $imageLayer133 = resizeImage($resourceType3,$sourceImageWidth3,$sourceImageHeight3,$new_width133,$new_height133);
                imagejpeg($imageLayer133,$uploadPath3."thump133_".$resizeFileName3.'.'. $fileExt3);
                break;

            case IMAGETYPE_GIF:
                $resourceType3 = imagecreatefromgif($fileName3); 
                $imageLayer3 = resizeImage($resourceType3,$sourceImageWidth3,$sourceImageHeight3,$new_width3,$new_height3);
                imagegif($imageLayer3,$uploadPath3."thump3_".$resizeFileName3.'.'. $fileExt3);

                $imageLayer13 = resizeImage($resourceType3,$sourceImageWidth3,$sourceImageHeight3,$new_width13,$new_height13);
                imagejpeg($imageLayer13,$uploadPath3."thump13_".$resizeFileName3.'.'. $fileExt3);

                 $imageLayer133 = resizeImage($resourceType3,$sourceImageWidth3,$sourceImageHeight3,$new_width133,$new_height133);
                imagejpeg($imageLayer133,$uploadPath3."thump133_".$resizeFileName3.'.'. $fileExt3);
                break;

            case IMAGETYPE_PNG:
                $resourceType3 = imagecreatefrompng($fileName3); 
                $imageLayer3 = resizeImage($resourceType3,$sourceImageWidth3,$sourceImageHeight3,$new_width3,$new_height3);
                imagepng($imageLayer3,$uploadPath3."thump3_".$resizeFileName3.'.'. $fileExt3);

               $imageLayer13 = resizeImage($resourceType3,$sourceImageWidth3,$sourceImageHeight3,$new_width13,$new_height13);
                imagejpeg($imageLayer13,$uploadPath3."thump13_".$resizeFileName3.'.'. $fileExt3);

                 $imageLayer133 = resizeImage($resourceType3,$sourceImageWidth3,$sourceImageHeight3,$new_width133,$new_height133);
                imagejpeg($imageLayer133,$uploadPath3."thump133_".$resizeFileName3.'.'. $fileExt3);
                break;

            default:
                $imageProcess3 = 0;
                break;
        }
        move_uploaded_file($fileName3, $uploadPath3. $resizeFileName3. ".". $fileExt3);
        $imagesize200_3= "thump3_".$resizeFileName3. ".". $fileExt3;
        $imagesize350_3="thump13_".$resizeFileName3.'.'. $fileExt3;
        $imagesize50_3="thump133_".$resizeFileName3.'.'. $fileExt3;
        $imageProcess3 = 1;


$sql=mysqli_query($con,"insert into products(category,subCategory,productName,productCompany,productPrice,productDescription,shippingCharge,productAvailability,productImage1,productImage2,productImage3,productPriceBeforeDiscount,productResizeImage1,productResizeImage2,productResizeImage3,productResizeImage50_1,productResizeImage50_2,productResizeImage50_3,productDiscount) values('$category','$subcat','$productname','$productcompany','$productprice','$productdescription','$productscharge','$productavailability','$imagesize200_1','$imagesize200_2','$imagesize200_3','$productpricebd','$imagesize350_1','$imagesize350_2','$imagesize350_3','$imagesize50_1','$imagesize50_2','$imagesize50_3','$productdiscount')");
$_SESSION['msg']="Product Inserted Successfully !!";
}
}
}
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
					
						<h2 class="page-title">Add Product</h2>

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
<div class="form-group">
<label class="col-sm-2 control-label">Category <span style="color:red">*</span></label>
<div class="col-sm-4">
<select name="category" class="form-control" onChange="getSubcat(this.value);"  required>
<option value="">Select Category</option> 
<?php $query=mysqli_query($con,"select * from category");
while($row=mysqli_fetch_array($query))
{?>

<option value="<?php echo $row['id'];?>"><?php echo $row['categoryName'];?></option>
<?php } ?>
</select>
</div>
<label class="col-sm-2 control-label">Sub Category <span style="color:red">*</span></label>
<div class="col-sm-4">
<select   name="subcategory"  id="subcategory" class="form-control" required>
  <option value="">Select Sub Category</option> 
</select>

</div>
</div>
<div class="form-group">
<label class="col-sm-2 control-label">Product Name<span style="color:red">* </label>
<div class="col-sm-4">
<input type="text"    name="productName"  placeholder="Enter Product Name" required="required" class="form-control">
<span id="user-availability-status1" style="font-size:12px;"></span>
</div>
<label class="col-sm-2 control-label">Product Brand<span style="color:red">*</span></label>
<div class="col-sm-4">
<select name="productCompany" class="form-control"  required>
<option value="">Select Brand</option> 
<?php $query=mysqli_query($con,"select * from brands");
while($row=mysqli_fetch_array($query))
{?>

<option value="<?php echo $row['id'];?>"><?php echo $row['brandName'];?></option>
<?php } ?>
</select>
</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label">Product Discount "%"</label>
<div class="col-sm-4">
<input type="text"    name="productdiscount"  placeholder="Enter Product Discount" class="form-control">
</div>
<label class="col-sm-2 control-label">Product Price Before Discount</label>
<div class="col-sm-4">
<input type="text"    name="productpricebd"  placeholder="Enter Discount Product Price" class="form-control">
</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label">Product Price After Discount(Selling Price)<span style="color:red">*</span></label>
<div class="col-sm-4">
<input type="text"    name="productprice"  placeholder="Enter Product Selling Price" class="form-control"  required>
</div>
<label class="col-sm-2 control-label">Product Shipping Charge<span style="color:red">*</span></label>
<div class="col-sm-4">
<input type="text"    name="productShippingcharge"  placeholder="Enter Product Shipping Charge" class="form-control" required/>
<span id="passerror" style="font-size:12px; color: red;"></span>
</div>
</div>



<div class="hr-dashed"></div>
<div class="form-group">
<label class="col-sm-2 control-label">Product Description<span style="color:red">*</label>
<div class="col-sm-10">
<textarea class="form-control" rows="10" cols="50" name="productDescription"  placeholder="Package Details" required>
  </textarea>
</div>
</div>


<div class="hr-dashed"></div>
<div class="form-group">
<label class="col-sm-2 control-label">Product Availability<span style="color:red">*</label>
<div class="col-sm-4">
<select   name="productAvailability"  id="productAvailability" class="form-control" required>
<option value="">Select</option>
<option value="In Stock">In Stock</option>
<option value="Out of Stock">Out of Stock</option>
</select>
</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label">Product Image 1 <span style="color:red">*</label>
<div class="col-sm-4">
<input type="file" name="productimage1" id="productimage1" value="" class="form-control" required>
</div>
<div class="col-sm-4">
</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label">Product Image 2 <span style="color:red">*</label>
<div class="col-sm-4">
<input type="file" name="productimage2" id="productimage2" value="" class="form-control" required>
</div>
<div class="col-sm-4">
</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label">Product Image 3 <span style="color:red">*</label>
<div class="col-sm-4">
<input type="file" name="productimage3" id="productimage3" value="" class="form-control" required>
</div>
<div class="col-sm-4">
</div>
</div>
		<div class="form-group">
												<div class="col-sm-8 col-sm-offset-2">
													<button class="btn btn-default" type="reset">Cancel</button>
													<button class="btn btn-primary" type="submit" name="submit">Add Product</button>
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