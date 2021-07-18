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
											<th>First Name</th>
											<th>Last Name</th>
											<th>E Mail</th>
											<th>Contact No</th>
											<th>Address</th>
											<th>PostCode</th>
											<th>City</th>
											<th>Region</th>
											<th>Country</th>
											<th>Company</th>
											<th>Register Date</th>
											<th>Newsletter Subscribe</th>
										</tr>
									</thead>

<?php
$filename="All Users";
$query=mysqli_query($con,"SELECT users.*,countries.country_name FROM `users` JOIN countries ON countries.id=users.country");
$cnt=1;
while($row=mysqli_fetch_array($query))
{	
$firstname = $row['firstname'];
$lastname = $row['lastname'];	
$email = $row['email'];
$contactno = $row['contactno'];
$address = $row['address'];	
$postcode = $row['postcode'];	
$country = $row['country_name'];
$city = $row['city'];	
$region = $row['region'];	
$company = $row['company'];
$regDate = $row['regDate'];	
$subscribe = $row['subscribe'];	

echo '  
<tr>  
<td>'.$cnt.'</td> 
<td>'.$firstname.'</td> 
<td>'.$lastname.'</td> 
<td>'.$email.'</td> 
<td>'.$contactno.'</td> 
<td>'.$address.'</td> 
<td>'.$postcode.'</td> 
<td>'.$city.'</td> 
<td>'.$region.'</td> 
<td>'.$country.'</td> 
<td>'.$company.'</td> 
<td>'.$regDate.'</td> 	
<td>'.$subscribe.'</td> 						
</tr>    '
;
header("Content-Disposition: attachment; filename=".$filename."-report.xls");
			$cnt++;
			}
	}
?>
</table>
