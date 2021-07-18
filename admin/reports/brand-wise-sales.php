<?php 
session_start();
error_reporting(0);
session_regenerate_id(true);
include('../../config/config.php');

if(strlen($_SESSION['alogin'])==0)
	{	
	header("Location: index.php"); //
	}
	else{?>
<table border="1">
									<thead>
										<tr>
											<th>#</th>
											<th>User Name</th>
											<th>Email</th>
											<th>Contact No</th>
											<th>Adress</th>
											<th>Postcode</th>
											<th>City</th>
											<th>Region</th>
											<th>Product Name</th>
											<th>Product Category</th>
											<th>Product Subcategory</th>
											<th>Product Brand</th>
											<th>Product Price</th>
											<th>Shipping Charge</th>
											<th>Qty</th>
											<th>Total</th>
											<th>Order Date</th>
											<th>Order Tracking Code</th>
											<th>Payment Methord</th>
											<th>Payment Status</th>

										</tr>
									</thead>

<?php
$filename="Brand Wise Sales";
$brand=$_SESSION['brand'];
$query=mysqli_query($con,"SELECT users.firstname as fname,users.lastname as lname, users.email as useremail, users.contactno as usercontact, billaddres.address1 as shippingaddress, billaddres.city as shippingcity, billaddres.region as shippingstate, billaddres.postcode as shippingpincode, products.productName as productname, products.shippingCharge as shippingcharge, products.productPrice as productprice, orders.quantity as quantity, orders.orderDate as orderdate, orders.id as id, orders.paymentMethod as paymethord,orders.paymentStatus as paystat,orders.orderTrackingCode as ordertrack,category.categoryName as pcat,subcategory.subcategory as psubcat,brands.brandName as pbrand FROM orders INNER JOIN users ON orders.userId=users.id INNER JOIN billaddres ON users.id=billaddres.uid INNER JOIN products ON products.id=orders.productId JOIN category ON category.id=products.category JOIN subcategory ON subcategory.id=products.subCategory JOIN brands ON brands.id=products.productCompany where products.productCompany='$brand'
");
$cnt=1;
while($row=mysqli_fetch_array($query))
{	
$fname = $row['fname'];
$lname = $row['lname'];	
$email = $row['useremail'];
$usercontact = $row['usercontact'];
$shippingaddress = $row['shippingaddress'];	
$shippingcity = $row['shippingcity'];	
$shippingstate = $row['shippingstate'];
$shippingpincode = $row['shippingpincode'];	
$productname = $row['productname'];	
$shippingcharge = $row['shippingcharge'];	
$productprice = $row['productprice'];	
$quantity = $row['quantity'];	
$orderdate = $row['orderdate'];	
$paymethord = $row['paymethord'];
$paystat = $row['paystat'];
$paystat = $row['ordertrack'];

$category = $row['pcat'];
$subcategory = $row['psubcat'];
$brand = $row['pbrand'];

$tot=$quantity*($productprice+$shippingcharge);

echo '  
<tr>  
<td>'.$cnt.'</td> 
<td>'.$fname.' '.$lname.'</td> 
<td>'.$email.'</td> 
<td>'.$usercontact.'</td> 
<td>'.$shippingaddress.'</td> 
<td>'.$shippingpincode.'</td> 
<td>'.$shippingcity.'</td> 
<td>'.$shippingstate.'</td> 
<td>'.$productname.'</td> 
<td>'.$category.'</td> 
<td>'.$subcategory.'</td> 
<td>'.$brand.'</td> 
<td>'.$productprice.'</td> 	
<td>'.$shippingcharge.'</td> 
<td>'.$quantity.'</td> 		
<td>'.$tot.'</td> 					
<td>'.$orderdate.'</td> 	
<td>'.$paystat.'</td> 
<td>'.$paymethord.'</td> 	
<td>'.$paystat.'</td> 
</tr>    '
;
header("Content-Disposition: attachment; filename=".$filename."-report.xls");
			$cnt++;
			}
	}
?>
</table>