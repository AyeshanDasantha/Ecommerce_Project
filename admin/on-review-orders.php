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
popUpWin = open(URLStr,'popUpWin', 'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no,copyhistory=yes,width='+500+',height='+350+',left='+left+', top='+top+',screenX='+left+',screenY='+top+'');
}

function popUpWindow1(URLStr, left, top, width, height)
{
 if(popUpWin)
{
if(!popUpWin.closed) popUpWin.close();
}
popUpWin = open(URLStr,'popUpWin', 'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no,copyhistory=yes,width='+750+',height='+600+',left='+left+', top='+top+',screenX='+left+',screenY='+top+'');
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

						<h2 class="page-title">On Review Orders</h2>

						<!-- Zero Configuration Table -->
						<div class="panel-default">
							<div class="panel-heading">On Review Orders</div>
							<div class="panel-body">
							<!--  -->
								<table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
									<thead>
										<tr>
											<th>#</th>
											<th> Name</th>
											<th>Email /Contact no</th>
											<th>Shipping Address</th>
											<th>Product </th>
											<th>Qty </th>
											<th>Amount </th>
											<th>Order Date</th>
											<th>Payment Methord</th>
											<th>Payment Status</th>
											<th>Action</th>
										</tr>
									</thead>
									<tfoot>
										<tr>
											<th>#</th>
											<th>Name</th>
											<th >Email /Contact no</th>
											<th>Shipping Address</th>
											<th>Product </th>
											<th>Qty </th>
											<th>Amount </th>
											<th>Order Date</th>
											<th>Payment Methord</th>
											<th>Payment Status</th>
											<th>Action</th>
										</tr>
										</tr>
									</tfoot>
									<tbody>
<?php 
$st='On Review';
$query=mysqli_query($con,"SELECT users.firstname as fname,users.lastname as lname, users.email as useremail, users.contactno as usercontact, billaddres.address1 as shippingaddress, billaddres.city as shippingcity, billaddres.region as shippingstate, billaddres.postcode as shippingpincode, products.productName as productname, products.shippingCharge as shippingcharge, products.productPrice as productprice, orders.quantity as quantity, orders.orderDate as orderdate, orders.id as id, orders.paymentMethod as paymethord,orders.paymentStatus,orders.id  FROM orders INNER JOIN users ON orders.userId=users.id INNER JOIN billaddres ON users.id=billaddres.uid INNER JOIN products ON products.id=orders.productId where orders.orderStatus='$st' AND orders.paymentMethod is not null");
$cnt=1;
while($row=mysqli_fetch_array($query))
{
?>										
										<tr>
											<td><?php echo htmlentities($cnt);?></td>
											<td><?php echo htmlentities($row['fname']);?> <?php echo htmlentities($row['lname']);?></td>
											<td><?php echo htmlentities($row['useremail']);?><br><?php echo htmlentities($row['usercontact']);?></td>
											<td><?php echo htmlentities($row['shippingaddress']);?><br><?php echo htmlentities($row['shippingcity'].",".$row['shippingstate']."-".$row['shippingpincode']);?></td>
											<td><?php echo htmlentities($row['productname']);?></td>
											<td><?php echo htmlentities($row['quantity']);?></td>
											<td>Rs. <?php echo htmlentities($row['quantity']*$row['productprice']+$row['shippingcharge']);?>
												<br><br><a href="../genarate/invoice/index.php?id=<?php echo htmlentities($row['id']);?>" target="_blank"><button class="btn btn-success btn-sm">Invoice Download</button></a>
											</td>
											<td><?php echo htmlentities($row['orderdate']);?></td>
											<td><?php echo htmlentities($row['paymethord']);?></td>
											<td > <?php $paystat=$row['paymentStatus'];
											if($paystat == 0)
											{?>
											  <p style="color: red;"><strong>Un Paid</strong></p>
											
											<?php }
											else
											{?>
												<p style="color: green;"><strong>Paid</strong></p>
											
										 	<?php } ?>
											<td> 
												<a href="javascript:void(0);" onClick="popUpWindow1('updateorder.php?oid=<?php echo htmlentities($row['id']);?>');" title="Track order">
												<button class="btn btn-primary btn-sm">Update Status</button></a>
												
												<?php $paystat=$row['paymentStatus'];
												if($paystat == 0)
												{?>
													<br>
													<br>
													<a href="javascript:void(0);" onClick="popUpWindow('updateorderpayment.php?oid=<?php echo htmlentities($row['id']);?>');" title="Track order">
													
												<button class="btn btn-info btn-sm">Update Payment</button></a>
												
												<?php }
												else
												{?>
													
												
											 	<?php } ?>
												
											</td>
											</tr>

										<?php $cnt=$cnt+1; } ?>
										</tbody>
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
