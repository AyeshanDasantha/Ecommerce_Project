<?php
session_start();
error_reporting(0);
include('../config/config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{


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

						<h2 class="page-title">Complaint Details</h2>
						
						<h4>Personal Details</h4>
<?php 
$query=mysqli_query($con,"SELECT countries.country_name, users.* FROM countries INNER JOIN users ON countries.id = users.country WHERE users.id ='".$_GET['uid']."'");
while($row=mysqli_fetch_array($query))
{

?>	
          <?php $userphoto=$row['userimage'];
    if($userphoto==""):
    ?>
    <!-- <img src="../users/userimages/noimage.png"  class="img-circle" width="100" height="100" > -->

    <?php else:?>
      <img src="../my-account/userimages/<?php echo htmlentities($userphoto);?>" width="100" height="100">

    <?php endif;?>
    <p> </p>
    

						<div class="module-body table">
								<table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped	 display" width="100%">
									
									<tbody>

								
										<tr>
											<td><b>First Name</b></td>
											<td><?php echo htmlentities($row['firstname']);?></td>
											<td><b>Last Name</b></td>
											<td> <?php echo htmlentities($row['lastname']);?></td>
											<td><b>Reg Date</b></td>
											<td><?php echo htmlentities($row['regDate']);?>
											</td>
										</tr>

<tr>
											<td><b>Email </b></td>
											<td><?php echo htmlentities($row['email']);?></td>
											<td><b>Contact No</b></td>
											<td> <?php echo htmlentities($row['contactno']);?></td>
											<td><b>Address</b></td>
											<td><?php echo htmlentities($row['address']);?>
											</td>
										</tr>
<tr>
											<td><b>Company </b></td>
											<td><?php echo htmlentities($row['company']);?></td>
											<td><b>Postcode</b></td>
											<td> <?php echo htmlentities($row['postcode']);?></td>
											<td><b>City</b></td>
											<td><?php echo htmlentities($row['city']);?>
											</td>
										</tr>
<tr>
											<td><b>State / Region </b></td>
											<td><?php echo htmlentities($row['region']);?></td>
											<td><b>County Name</b></td>
											<td> <?php echo htmlentities($row['country_name']);?></td>
											<td><b>Account Status</b></td>
											<td>
												<?php if($row['status']==1)
												      { echo "Active";
												} else{
												  echo "Not Activate";
												}?>

											</td>
										</tr>

											</tr>
											
										<?php  } ?>
										
								</table>

<h4>Shipping / Billing Details</h4>
<div class="module-body table">
								<table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped	 display" width="100%">
									
									<tbody>

<?php 
$query=mysqli_query($con,"SELECT billaddres.*, users.id,countries.country_name FROM billaddres INNER JOIN users ON billaddres.uid = users.id INNER JOIN countries ON billaddres.country=countries.id
 WHERE users.id ='".$_GET['uid']."'");
while($row=mysqli_fetch_array($query))
{

?>									
										
											<tr>
											<td><b>Billing Address 1</b></td>
											
											<td colspan="5"><?php echo htmlentities($row['address1']);?></td>
											
										</tr>
										<tr>
											<td><b>Billing Address 2</b></td>
											
											<td colspan="5"><?php echo htmlentities($row['address2']);?></td>
											
										</tr>
										<tr>
											<td><b>Billing Post Code </b></td>
											<td><?php echo htmlentities($row['postcode']);?></td>
											<td><b>Billing City</b></td>
											<td> <?php echo htmlentities($row['city']);?></td>
											<td><b>Billing State / Region</b></td>
											<td><?php echo htmlentities($row['region']);?>
											</td>

										</tr>
										<tr>
											<td><b>Billing Country</b></td>
											
											<td colspan="5"><?php echo htmlentities($row['country_name']);?></td>
											
										</tr>
											
										<?php  } ?>
										
								</table>











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
	
	<script>
		
	window.onload = function(){
    
		// Line chart from swirlData for dashReport
		var ctx = document.getElementById("dashReport").getContext("2d");
		window.myLine = new Chart(ctx).Line(swirlData, {
			responsive: true,
			scaleShowVerticalLines: false,
			scaleBeginAtZero : true,
			multiTooltipTemplate: "<%if (label){%><%=label%>: <%}%><%= value %>",
		}); 
		
		// Pie Chart from doughutData
		var doctx = document.getElementById("chart-area3").getContext("2d");
		window.myDoughnut = new Chart(doctx).Pie(doughnutData, {responsive : true});

		// Dougnut Chart from doughnutData
		var doctx = document.getElementById("chart-area4").getContext("2d");
		window.myDoughnut = new Chart(doctx).Doughnut(doughnutData, {responsive : true});

	}
	</script>
</body>
</html>
<?php } ?>