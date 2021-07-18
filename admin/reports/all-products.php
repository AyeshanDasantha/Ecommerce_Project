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
											<th>Product Name</th>
											<th>Category</th>
											<th>Subcategory</th>
											<th>Brand</th>
											<th>Price</th>
											<th>Shipping Charge</th>
											<th>Discount</th>
											<th>Availability</th>
											<th>Discription</th>

										</tr>
									</thead>

<?php
$filename="All Products";
$query=mysqli_query($con,"SELECT products.productName,category.categoryName,subcategory.subcategory,brands.brandName,products.productPrice,products.shippingCharge,products.productDiscount, products.productAvailability,products.productDescription FROM products JOIN category ON category.id = products.category JOIN subcategory ON subcategory.id = products.subCategory JOIN brands ON brands.id=products.productCompany");
$cnt=1;
while($row=mysqli_fetch_array($query))
{	
$productName = $row['productName'];
$categoryName = $row['categoryName'];	
$subcategory = $row['subcategory'];
$brandName = $row['brandName'];
$productPrice = $row['productPrice'];	
$shippingCharge = $row['shippingCharge'];	
$productDiscount = $row['productDiscount'];
$productAvailability = $row['productAvailability'];	
$productDescription = $row['productDescription'];	


echo '  
<tr>  
<td>'.$cnt.'</td> 
<td>'.$productName.'</td> 
<td>'.$categoryName.'</td> 
<td>'.$subcategory.'</td> 
<td>'.$brandName.'</td> 
<td>'.$productPrice.'</td> 
<td>'.$shippingCharge.'</td> 
<td>'.$productDiscount.' %</td> 
<td>'.$productAvailability.'</td> 
<td>'.$productDescription.'</td> 					
</tr>    '
;
header("Content-Disposition: attachment; filename=".$filename."-report.xls");
			$cnt++;
			}
	}
?>
</table>
