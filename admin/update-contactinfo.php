<?php
session_start();
error_reporting(0);
include('../config/config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{
if(isset($_POST['submit']))
{
	$shopname=$_POST['shopname'];
$address=$_POST['address'];
$telephoneno=$_POST['telephoneno'];	
$faxno=$_POST['faxno'];
$openinghours=$_POST['openinghours'];
$comment=$_POST['comment'];
$email=$_POST['email'];


$sql=mysqli_query($con,"update contactusinfo set shopname='$shopname',address='$address',telephoneno='$telephoneno',faxno='$faxno',openinghours='$openinghours',comment='$comment',email='$email' where id=1");
$_SESSION['msg']="Contact Info Updated successful";
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


</head>

<body>
	<?php include('includes/header.php');?>
	<div class="ts-main-content">
	<?php include('includes/leftbar-site-settings.php');?>
		<div class="content-wrapper">
			<div class="container-fluid">

				<div class="row">
					<div class="col-md-12">
					
						<h2 class="page-title">Update Contact Info</h2>

						<!-- <div class="row">
							<div class="col-md-10"> -->
								<div class="panel panel-default">
									<div class="panel-heading">Contact Info</div>
									<div class="panel-body">
										<form method="post" name="chngpwd" class="form-horizontal" onSubmit="return valid();">
										
				  	        	 <?php if(isset($_POST['submit']))
{?>
									<div class="alert alert-success">
										<button type="button" class="close" data-dismiss="alert">×</button>
									<strong>Well done!</strong>	<?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?>
									</div>
<?php } ?>


<?php
$query=mysqli_query($con,"SELECT * from  contactusinfo");
while($row=mysqli_fetch_array($query))
{
?>		
											
											<div class="form-group">
												<label class="col-sm-4 control-label">Image</label>
												<div class="col-sm-8">
													<?php $logophoto=$row['image'];
													if($logophoto==""):
													?>
													<img src="../images/shoplocation/shop.jpg" width="256" height="80" >
													<?php else:?>
														<img src="../images/shoplocation/<?php echo htmlentities($logophoto);?>" width="275" height="180" >

													<?php endif;?><br>
													<strong><a href="update-contactus-image.php">Click Here to Change Shop Image</a></strong>
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-4 control-label"> Shop Name </label>
												<div class="col-sm-8">
													<input type="text" class="form-control" value="<?php echo  htmlentities($row['shopname']);?>" name="shopname" required>
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-4 control-label"> Address </label>
												<div class="col-sm-8">
													<input type="text" class="form-control" value="<?php echo  htmlentities($row['address']);?>" name="address" required>
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-4 control-label"> Telephone </label>
												<div class="col-sm-8">
													<input type="text" class="form-control" value="<?php echo  htmlentities($row['telephoneno']);?>" name="telephoneno"  required>
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-4 control-label"> Email </label>
												<div class="col-sm-8">
													<input type="text" class="form-control" value="<?php echo  htmlentities($row['email']);?>" name="email"  required>
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-4 control-label"> Fax </label>
												<div class="col-sm-8">
													<input type="text" class="form-control" value="<?php echo  htmlentities($row['faxno']);?>" name="faxno"  required>
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-4 control-label"> Opening Times </label>
												<div class="col-sm-8">
													<input type="text" class="form-control" value="<?php echo  htmlentities($row['openinghours']);?>" name="openinghours"  required>
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-4 control-label"> Comments </label>
												<div class="col-sm-8">
													<input type="text" class="form-control" value="<?php echo  htmlentities($row['comment']);?>" name="comment"  required>
												</div>
											</div>

<?php }} ?>
											<div class="hr-dashed"></div>
											
										
								
											
											<div class="form-group">
												<div class="col-sm-8 col-sm-offset-4">
								
													<button class="btn btn-primary" name="submit" type="submit">Update</button>
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
