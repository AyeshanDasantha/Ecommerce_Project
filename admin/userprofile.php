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
<script language="javascript" type="text/javascript">
function f2()
{
window.close();
}ser
function f3()
{
window.print();
}
</script>
<!DOCTYPE>
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
     <link rel="shortcut icon" type="image/x-icon" href="../images/favicon/<?php echo htmlentities($row['setting_description']);?>"/><?php }?>
     
<?php $query=mysqli_query($con,"SELECT * FROM genaralsetting where id=1");
    while($row=mysqli_fetch_array($query)) 
    {
     ?>  
    <title><?php echo htmlentities($row['setting_description']);?></title><?php }?>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="anuj.css" rel="stylesheet" type="text/css">
</head>
<body>

<div style="margin-left:50px;">
 <form name="updateticket" id="updateticket" method="post"> 
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<?php 

$ret1=mysqli_query($con,"SELECT countries.country_name, users.* FROM countries INNER JOIN users ON countries.id = users.country WHERE users.id ='".$_GET['uid']."'");
while($row=mysqli_fetch_array($ret1))
{
?>

    

    
             
		
    <tr>
      <td colspan="2"><b><?php echo $row['firstname'];?> <?php echo $row['lastname'];?>'s profile</b></td>
      
    </tr>
    
    
    <tr>
      <td  >&nbsp;</td>
      <td >&nbsp;</td>
    </tr>

    <tr>
      <td>
          <?php $userphoto=$row['userImage'];
    if($userphoto==""):
    ?>
    <!-- <img src="../users/userimages/noimage.png"  class="img-circle" width="100" height="100" > -->

    <?php else:?>
      <img src="../my-account/userimages/<?php echo htmlentities($userphoto);?>" width="100" height="100">

    <?php endif;?></li></td>
    </tr>  

    <tr height="50">
      <td><b>Reg Date:</b></td>
      <td><?php echo htmlentities($row['regDate']); ?></td>
    </tr>
    <tr height="50">
      <td><b>User Email:</b></td>
      <td><?php echo htmlentities($row['email']); ?></td>
    </tr>

      <tr height="50">
      <td><b>Contact no:</b></td>
      <td><?php echo htmlentities($row['contactno']); ?></td>
    </tr>


        <tr height="50">
      <td><b>Address:</b></td>
      <td><?php echo htmlentities($row['address']); ?></td>
    </tr>

    <tr height="50">
      <td><b>Company:</b></td>
      <td><?php echo htmlentities($row['company']); ?></td>
    </tr>

        <tr height="50">
      <td><b>Post Code:</b></td>
      <td><?php echo htmlentities($row['postcode']); ?></td>
    </tr>

    <tr height="50">
      <td><b>City:</b></td>
      <td><?php echo htmlentities($row['city']); ?></td>
    </tr>


        <tr height="50">
      <td><b>State / Region:</b></td>
      <td><?php echo htmlentities($row['region']); ?></td>
    </tr>  


        <tr height="50">
      <td><b>Country:</b></td>
      <td><?php echo htmlentities($row['country_name']); ?></td>
    </tr>
     <tr height="50">
      <td><b>Status:</b></td>
      <td><?php if($row['status']==1)
      { echo "Active";
} else{
  echo "Not Activate";
}
        ?></td><?php } 

 
    ?>
    </tr>



    <tr height="50">
      <td><b>User Email:</b></td>
      <td><?php echo htmlentities($row['email']); ?></td>
    </tr>

      <tr height="50">
      <td><b>Contact no:</b></td>
      <td><?php echo htmlentities($row['contactno']); ?></td>
    </tr>


        <tr height="50">
      <td><b>Address:</b></td>
      <td><?php echo htmlentities($row['address']); ?></td>
    </tr>

    <tr height="50">
      <td><b>Company:</b></td>
      <td><?php echo htmlentities($row['company']); ?></td>
    </tr>

        <tr height="50">
      <td><b>Post Code:</b></td>
      <td><?php echo htmlentities($row['postcode']); ?></td>
    </tr>
    
    <tr>
     <td colspan="2">   
      <input name="Submit2" type="submit" class="txtbox4" value="Close this window " onClick="return f2();" style="cursor: pointer;"  /></td>
      <td colspan="2">   
      <input name="Submit2" type="submit" class="txtbox4" value="Print " onClick="return f3();" style="cursor: pointer;"  /></td>
    </tr>
    
 
</table>
 </form>
</div>

</body>
</html>

     <?php } ?>