<?php
error_reporting(0);
session_start();
include('../config/config.php');
$query=mysqli_query($con,"SELECT status FROM sitemaintenance where id=1");
while($row=mysqli_fetch_array($query)) 
{
$maintincestatus = $row['status'];
if($maintincestatus==0)
{
    header('location:../index.php');
}
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <meta name="theme-color" content="#1a1a1a">
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon/faveicon.ico"/>

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
     <link rel="shortcut icon" type="image/x-icon" href="images/favicon/<?php echo htmlentities($row['setting_description']);?>"/><?php }?>

    <?php $query=mysqli_query($con,"SELECT * FROM genaralsetting where id=1 ");
    while($row=mysqli_fetch_array($query)) 
    {
     ?>  
    <title><?php echo htmlentities($row['setting_description']);?></title><?php }?>
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
		function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- //custom-theme -->
<link href="css/font-awesome.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<link href="https://fonts.googleapis.com/css?family=Hind+Siliguri:300,400,500,600,700" rel="stylesheet">
</head>
<body class="bg-agileinfo">
	<?php $query=mysqli_query($con,"SELECT * FROM sitemaintenance where id=1 and status=1");
    while($row=mysqli_fetch_array($query)) 
    {?> 
   <h1 class="agile-head text-center"><?php echo htmlentities($row['title']);?></h1><?php }?>
	<div class="container-w3">
		<div class="content1-w3layouts"> 
			<img src="images/2.png" alt="under-construction">
			<?php $query=mysqli_query($con,"SELECT * FROM sitemaintenance where id=1 and status=1");
		    while($row=mysqli_fetch_array($query)) 
		    {?>
			<p class="text-center"><?php echo htmlentities($row['qutoes']);?></p><?php }?>
		</div>
		<div class="demo2"></div>
		<div class="content2-w3-agileits">
		  <!--  <form action="#" method="post" class="agile-info-form">
				<input type="email" class="email" placeholder="Enter your email address" required="">
				<input type="submit" value="get notified!">
				<div class="clear"> </div> 
			</form>	 -->
		</div>
		    <div class="wthree-social-icons">
				<ul class="w3-links">
					<!-- <li><a href="#"><i class="fa fa-facebook"></i></a></li>
					<li><a href="#"><i class="fa fa-twitter"></i></a></li>
					<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
					<li><a href="#"><i class="fa fa-google-plus"></i></a></li> -->
				</ul>
			</div>
			</form>
		</div>	
	</div>
    <div class="agileits-w3layouts-copyright text-center">
    	<?php $query=mysqli_query($con,"SELECT * from footerlink where id=4");
		            while($row=mysqli_fetch_array($query))
		            {
		            	$copyright = $row['name'];
		            ?>
		            <?php
		            if(empty($copyright))
		            {?>
			        		
			        <?php }     
                    else {?>
		<p>Copyright &copy; <a href="<?php echo htmlentities($row['link']);?>" style="color: white"><?php echo htmlentities($row['name']);?></a> <?php echo $currentyear;?></p>
	<?php } }?>
	</div>
	<script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
	<link rel="stylesheet" href='css/dscountdown.css' type='text/css' media='all' />
	<!-- Counter required files -->
		<script type="text/javascript" src="js/dscountdown.min.js"></script>
		<script>
			jQuery(document).ready(function($){						
				$('.demo2').dsCountDown({
					<?php $query=mysqli_query($con,"SELECT * FROM sitemaintenance where id=1 and status=1");
				    while($row=mysqli_fetch_array($query)) 
				    {?>
					endDate: new Date("<?php echo htmlentities($row['ToDateTIme']);?>"),<?php }?>
					theme: 'black'
				});								
			});
		</script>
	<!-- //Counter required files -->
</body>
</html>