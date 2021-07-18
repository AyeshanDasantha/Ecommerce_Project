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
$fbname=$_POST['fbname'];
$fblink=$_POST['fblink'];
$twittername=$_POST['twittername'];	
$twitterlink=$_POST['twitterlink'];
$youtubename=$_POST['youtubename'];
$youtubelink=$_POST['youtubelink'];
$imgdiscrip=$_POST['imgdiscrip'];


$sql=mysqli_query($con,"update sideblock set name='$fbname',discription='$fblink' where id=1");
$sql=mysqli_query($con,"update sideblock set name='$twittername',discription='$twitterlink' where id=2");
$sql=mysqli_query($con,"update sideblock set name='$youtubename',discription='$youtubelink' where id=3");
$sql=mysqli_query($con,"update sideblock set discription='$imgdiscrip' where id=4");
$_SESSION['msg']="Info Updated successful";
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
											$query=mysqli_query($con,"SELECT * from  sideblock where id=1");
											while($row=mysqli_fetch_array($query))
											{
											?>		
											
											
											<div class="form-group">
												<label class="col-sm-4 control-label"> Facebook Name </label>
												<div class="col-sm-8">
													<input type="text" class="form-control" value="<?php echo  htmlentities($row['name']);?>" name="fbname" required>
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-4 control-label"> Facebook Profile/Page URL </label>
												<div class="col-sm-8">
													<input type="text" class="form-control" value="<?php echo  htmlentities($row['discription']);?>" name="fblink" required>
												</div>
											</div>
											<?php } ?>
											<div class="hr-dashed"></div>
											<?php
											$query=mysqli_query($con,"SELECT * from  sideblock where id=2");
											while($row=mysqli_fetch_array($query))
											{
											?>	
											<div class="form-group">
												<label class="col-sm-4 control-label"> Twitter Name </label>
												<div class="col-sm-8">
													<input type="text" class="form-control" value="<?php echo  htmlentities($row['name']);?>" name="twittername"  required>
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-4 control-label"> Twitter Profile/Page URL </label>
												<div class="col-sm-8">
													<input type="text" class="form-control" value="<?php echo  htmlentities($row['discription']);?>" name="twitterlink"  required>
												</div>
											</div>
											<?php } ?>
											<div class="hr-dashed"></div>
											<?php
											$query=mysqli_query($con,"SELECT * from  sideblock where id=3");
											while($row=mysqli_fetch_array($query))
											{
											?>	
											<div class="form-group">
												<label class="col-sm-4 control-label"> Youtube Video Name </label>
												<div class="col-sm-8">
													<input type="text" class="form-control" value="<?php echo  htmlentities($row['name']);?>" name="youtubename"  required>
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-4 control-label"> Youtube Embed Src URL </label>

												<div class="col-sm-8">
													<input type="text" class="form-control" value="<?php echo  htmlentities($row['discription']);?>" name="youtubelink"  required>
													<span style="color: green">Eg: https://www.youtube.com/embed/ph_tY62F8Wg</span>
												</div>
											</div>
											<?php } ?>
											<div class="hr-dashed"></div>
											<?php
											$query=mysqli_query($con,"SELECT * from  sideblock where id=4");
											while($row=mysqli_fetch_array($query))
											{
											?>	
											<div class="form-group">
												<label class="col-sm-4 control-label"> Image </label>
												<div class="col-sm-8">
													<?php $logophoto=$row['name'];
													if($logophoto==""):
													?>
													<img src="../images/sideblock/defult.jpg" width="330" height="120" >
													<?php else:?>
														<img src="../images/sideblock/<?php echo htmlentities($logophoto);?>" width="330" height="120" >

													<?php endif;?>
													<strong><a href="update-sideblock-image.php">Click Here to Change Image</a></strong>
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-4 control-label"> Discription(max 50 Words) </label>
												<div class="col-sm-8">
													<input type="text" class="form-control" value="<?php echo  htmlentities($row['discription']);?>" name="imgdiscrip"  required>
												</div>
											</div>
											<?php } ?>

											<?php } ?>
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
