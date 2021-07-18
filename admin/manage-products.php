<?php
session_start();
error_reporting(0);
include('../config/config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{
   $query=mysqli_query($con,"SELECT setting_description FROM genaralsetting where id=3");
                     while($row=mysqli_fetch_array($query)) 
                     {
date_default_timezone_set($row['setting_description']);
$currentTime = date( 'd-m-Y h:i:s A', time () );

if(isset($_GET['del']))
		  {
		          mysqli_query($con,"delete from products where id = '".$_GET['id']."'");
                  $_SESSION['delmsg']="Product deleted !!";
		  }
}

if(isset($_GET['spe']))
	{
		$spe=intval($_GET['spe']);
		$sql=mysqli_query($con,"UPDATE products SET specialstatus=1 WHERE  id='$spe'");
		$msg="Successfully Added To Special Product";
		}

		if(isset($_GET['removespe']))
	{
		$removespe=intval($_GET['removespe']);
		$sql=mysqli_query($con,"UPDATE products SET specialstatus=0 WHERE  id='$removespe'");
		$msg="Successfully Removed From Special Product";
		}

if(isset($_GET['featured']))
	{
		$featured=intval($_GET['featured']);
		$sql=mysqli_query($con,"UPDATE products SET featuredstatus=1 WHERE  id='$featured'");
		$msg="Successfully Added To Featured Product";
		}

		if(isset($_GET['removefeatured']))
	{
		$removefeatured=intval($_GET['removefeatured']);
		$sql=mysqli_query($con,"UPDATE products SET featuredstatus=0 WHERE  id='$removefeatured'");
		$msg="Successfully Removed From Featured Product";
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

		<script language="javascript" type="text/javascript">
var popUpWin=0;
function popUpWindow(URLStr, left, top, width, height)
{
 if(popUpWin)
{
if(!popUpWin.closed) popUpWin.close();
}
popUpWin = open(URLStr,'popUpWin', 'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no,copyhistory=yes,width='+600+',height='+600+',left='+left+', top='+top+',screenX='+left+',screenY='+top+'');
}

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

						<h2 class="page-title">Product Details</h2>
	<?php if(isset($_GET['del']))
{?>
									<div class="alert alert-error">
										<button type="button" class="close" data-dismiss="alert">×</button>
									<strong></strong> 	<?php echo htmlentities($_SESSION['delmsg']);?><?php echo htmlentities($_SESSION['delmsg']="");?>
									</div>
<?php } ?>

<?php if(isset($_GET['spe']))
{?>
									<div class="alert alert-error">
										<button type="button" class="close" data-dismiss="alert">×</button>
									<strong></strong> 	<?php echo htmlentities($_SESSION['spemsg']);?><?php echo htmlentities($_SESSION['spemsg']="");?>
									</div>
<?php } ?>

<?php if(isset($_GET['featured']))
{?>
									<div class="alert alert-error">
										<button type="button" class="close" data-dismiss="alert">×</button>
									<strong></strong> 	<?php echo htmlentities($_SESSION['spemsg']);?><?php echo htmlentities($_SESSION['spemsg']="");?>
									</div>
<?php } ?>
						<!-- Zero Configuration Table -->
						<div class="panel panel-default">
							<div class="panel-heading">Product Details</div>
							<div class="panel-body">
				<a href="reports/all-products.php" target="_blank" style="color:red; font-size:16px;">Download Product List</a>
								<table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
									<thead>
										<tr>
											<th>#</th>
											<th>Product Image</th>
											<th width="300">Product Name</th>
											<th>Category </th>
											<th>Subcategory</th>
											<th>Product Brand</th>

											<th width="300">Action</th>
										</tr>
									</thead>
									<tfoot>
										<tr>
											<th>#</th>
											<th>Product Image</th>
											<th>Product Name</th>
											<th>Category </th>
											<th>Subcategory</th>
											<th>Product Brand</th>

											<th width="300" >Action</th>
										</tr>
									</tfoot>
									<tbody>

<?php $query=mysqli_query($con,"select products.*,category.categoryName,subcategory.subcategory,brands.brandName from products join category on category.id=products.category join subcategory on subcategory.id=products.subCategory JOIN brands on brands.id = products.productCompany ORDER BY products.id ASC");
$cnt=1;
while($row=mysqli_fetch_array($query))
{
	$stats = $row['specialstatus'];
	$featurestats = $row['featuredstatus'];
?>										
										<tr>
										    
											<td><?php echo htmlentities($cnt);?></td>
											<td>
											    <?php $banner=$row['productImage3'];
														if($banner==""):
														?>
														<img src="../images/subcategory/no_image.jpg" width="50" height="50" >
														<?php else:?>
															<img src="productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($banner);?>" width="50" height="50" >
															
														<?php endif;?>
											</td>
											<td><?php echo htmlentities($row['productName']);?></td>
											<td><?php echo htmlentities($row['categoryName']);?></td>
											<td> <?php echo htmlentities($row['subcategory']);?></td>
											<td> <?php echo htmlentities($row['brandName']);?></td>

<form method="post">
<td align="center"><a href="edit-product.php?id=<?php echo $row['id']?>" title="View Details">
<button type="button" class="btn btn-primary btn-sm">View</button>
											</a>
<a href="manage-products.php?id=<?php echo $row['id']?>&del=delete" onClick="return confirm('Are you sure you want to delete?')" title="Delete" >
<button type="button" class="btn btn-danger btn-sm">Delete</button></a>

<?php 
    if ($featurestats == 0) {?>

    		<a href="manage-products.php?featured=<?php echo htmlentities($row['id']);?>" onclick="return confirm('Enable This to Special Item')" ><button type="button" class="btn btn-dark btn-sm">Enable Featured</button></a>
    		
    	
    <?php } else {?>
    	<a href="manage-products.php?removefeatured=<?php echo htmlentities($row['id']);?>" onclick="return confirm('Disable This to Special Item')" >
	<button type="button" class="btn btn-success btn-sm">Disable Featured</button>	</a><?php } ?>

<?php 
    if ($stats == 0) {?>

    		<a href="manage-products.php?spe=<?php echo htmlentities($row['id']);?>" onclick="return confirm('Enable This to Special Item')" ><button type="button" class="btn btn-info btn-sm">Make Special</button></a>
    		
    	
    <?php } else {?>
    	<a href="manage-products.php?removespe=<?php echo htmlentities($row['id']);?>" onclick="return confirm('Disable This to Special Item')" >
	<button type="button" class="btn btn-warning btn-sm">Disable Special</button>	</a><?php } ?>
</form>

											</td>
											
										</tr>
										<?php $cnt=$cnt+1; } ?>	
								</table>	
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