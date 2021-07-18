<?php
require "config/config.php";
error_reporting(0);
?>
<!doctype html>
<html>
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
     <link rel="shortcut icon" type="image/x-icon" href="images/favicon/<?php echo htmlentities($row['setting_description']);?>"/><?php }?>
     
<?php $query=mysqli_query($con,"SELECT * FROM genaralsetting where id=1");
    while($row=mysqli_fetch_array($query)) 
    {
     ?>  
    <title><?php echo htmlentities($row['setting_description']);?></title><?php }?>
</head>

<body>
<?php

$email = $_GET['email'];
$code = $_GET['code'];

$query = mysqli_query($con,"SELECT * FROM users WHERE `email`='$email'");
  while($row=mysqli_fetch_array($query))
{
	$db_code = $row['confirm_Code'];
}
if($code == $db_code)
{
	mysqli_query($con,"UPDATE users SET `status`='1' WHERE `email`='$email'");
	mysqli_query($con,"UPDATE users SET `confirm_Code`='0' WHERE `email`='$email'");
	
	// echo "Thank You. Your email has been confimed and you may now login";
	include "emailconfirmsuccess.php";
}
else
{
	// echo "Username and code dont match";	
	include "emailconfirmfail.php";
}

?>
</body>
</html>