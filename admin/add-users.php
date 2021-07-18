<?php
session_start();
include('../config/config.php');
error_reporting(0);
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{
if(isset($_POST['submit']))
{
	$firstname=$_POST['firstname'];
  $lastname=$_POST['lastname'];
	$email=$_POST['email'];
	$password=md5($_POST['password']);
  $pw=$_POST['password'];
	$contactno=$_POST['contactno'];
	$address=$_POST['address'];
	$company=$_POST['company'];
	$zipcode=$_POST['zipcode'];
	$city=$_POST['city'];
	$region=$_POST['region'];
  $country=$_POST['country'];
	$status=1;
	$query=mysqli_query($con,"insert into users(firstname,lastname,email,contactno,postcode,address,city,region,country,company,status,password) values
    ('$firstname','$lastname','$email','$contactno','$zipcode','$address','$city','$region','$country','$company','$status','$password')");
	$msg="User Added successfully..";

 
  $weburl=mysqli_query($con,"SELECT * FROM genaralsetting where id=2");
  while($row=mysqli_fetch_array($weburl)) 
  {
      $sitelink = $row['setting_description'];
      if ($query) {
        require '../phpmailer/addusermail.php';
      }
      
  }
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
<script>
		function userAvailability() {
		$("#loaderIcon").show();
		jQuery.ajax({
		url: "check_availability.php",
		data:'email='+$("#email").val(),
		type: "POST",
		success:function(data){
		$("#user-availability-status1").html(data);
		$("#loaderIcon").hide();
		},
		error:function (){}
		});
		}
</script>

   <script >
      function userPhone() {
      $("#loaderIcon").show();
      jQuery.ajax({
      url: "check_phone.php",
      data:'contactno='+$("#contactno").val(),
      type: "POST",
      success:function(data){
      $("#messge2").html(data);
      $("#loaderIcon").hide();
      },
      error:function (){}
      });
      }
  </script>

  <script>
       function phoneno()
      {
        var a = document.getElementById("contactno").value;
        if(a=="")
        {
            document.getElementById("messge").innerHTML="";
            return false;
            document.getElementById("submit").disabled = true;
        }
        if(isNaN(a))
        {
            document.getElementById("messge").innerHTML="Numbers Only";
            return false;
            document.getElementById("submit").disabled = true;
        }
        else if(isNaN(a))
        {
            document.getElementById("messge").innerHTML="Numbers Only Please Check Your Phone No";
            return false;
            document.getElementById("submit").disabled = true;
        }
        else if(a.length<10)
        {
            document.getElementById("messge").innerHTML="Phone No is Wrong Please Check Your Phone No";
            return false;
            document.getElementById("submit").disabled = true;
        }
        else if(a.length>10)
        {
            document.getElementById("messge").innerHTML="Phone No is Wrong Please Check Your Phone No";
            return false;
            document.getElementById("submit").disabled = true;
        }
        else if((a.charAt(0)!=0) && (a.charAt(0)!=7))
        {
            document.getElementById("messge").innerHTML="Phone No is Start with 07XXXXXXXX";
            return false;
            document.getElementById("submit").disabled = true;
        }
        else
        {
            document.getElementById("messge").innerHTML="";
            return true;
            document.getElementById("submit").disabled = false;
        }

      }
    </script>

     <script>
function valid()
{
  var passowrd = document.getElementById("find").value;
  var confirmpassword = document.getElementById("confirmpassword").value;

if(passowrd!= confirmpassword)
{
document.getElementById("passerror").innerHTML="Password and Confirm Password Field do not match  !!";
document.getElementById("submit").disabled = true;
}
else
{
  document.getElementById("passerror").innerHTML="";
  document.getElementById("submit").disabled = false;
}

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
					
						<h2 class="page-title">Add Users</h2>

						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-default">
									<div class="panel-heading">Basic Info</div>

									<div class="panel-body">
<form name="state" method="post" class="form-horizontal" onsubmit="return phoneno()">
	<p style="padding-left: 1%; color: green">
              <?php if(isset($msg)){
            echo htmlentities($msg);
                }?>
            </p>
  <p style="padding-left: 1%; color: green">
              <?php if(isset($successmsg)){
            echo htmlentities($successmsg);
                }?>
            </p>
            <p style="padding-left: 1%; color: red">
              <?php if(isset($errormsg)){
            echo htmlentities($errormsg);
                }?>
            </p>
<div class="form-group">
<label class="col-sm-2 control-label">First Name<span style="color:red">*</span></label>
<div class="col-sm-4">
<input type="text" name="firstname" required="required" placeholder="First Name" autofocus class="form-control">
</div>
<label class="col-sm-2 control-label">Last Name<span style="color:red">*</span></label>
<div class="col-sm-4">
<input type="text"  name="lastname" placeholder="Last Name" required="required" class="form-control">
</div>
</div>
<div class="form-group">
<label class="col-sm-2 control-label">Email id<span style="color:red">* </label>
<div class="col-sm-4">
<input type="email" id="email" onBlur="userAvailability()" name="email" placeholder="E-mail" required="required" class="form-control">
<span id="user-availability-status1" style="font-size:12px;"></span>
</div>
<label class="col-sm-2 control-label">Contact No<span style="color:red">*</span></label>
<div class="col-sm-4">
<input type="text" maxlength="10" name="contactno" onBlur="userPhone();phoneno()" id="contactno" placeholder="Contact No" required="required" class="form-control">
<span id="messge" style="font-size:12px; color: red;"></span>
<span id="messge2" style="font-size:12px; color: red;"></span><br>
</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label">Password<span style="color:red">* </label>
<div class="col-sm-4">
<input type="password" name="password" placeholder="Password" id="find" onclick="phoneno()" required="required" class="form-control">
</div>
<label class="col-sm-2 control-label">Confirm Password<span style="color:red">*</span></label>
<div class="col-sm-4">
<input type="password" name="confirmPassword" class="form-control" id="confirmpassword" onmouseout="valid()" placeholder="Confirm Password" required>
<span id="passerror" style="font-size:12px; color: red;"></span>
</div>
</div>


<div class="hr-dashed"></div>
<div class="form-group">
<label class="col-sm-2 control-label">Address</label>
<div class="col-sm-10">
<textarea class="form-control" name="address" placeholder="Address" ></textarea>
</div>
</div>
<div class="form-group">
<label class="col-sm-2 control-label">Company<span style="color:red">* </label>
<div class="col-sm-4">
<input type="text" name="company" class="form-control" placeholder="Company" required>
</div>
<label class="col-sm-2 control-label">Zip Code<span style="color:red">*</span></label>
<div class="col-sm-4">
<input type="text" name="zipcode" class="form-control" placeholder="Ziip Code" required>
</div>
</div>



<div class="form-group">
<label class="col-sm-2 control-label">City <span style="color:red">*</span></label>
<div class="col-sm-4">
<input type="text" name="city" class="form-control" placeholder="City" required>
</div>
<label class="col-sm-2 control-label">Region <span style="color:red">*</span></label>
<div class="col-sm-4">
<input type="text" name="region" class="form-control" placeholder="Region" required>

</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label">County <span style="color:red">*</span></label>
<div class="col-sm-4">
<select name="country" class="form-control"  required>
<option value="">Select Country</option> 
<?php $query=mysqli_query($con,"select * from countries ");
while($row=mysqli_fetch_array($query))
{?>

<option value="<?php echo $row['id'];?>"><?php echo $row['country_name'];?></option>
<?php } ?>
</select>
</div>
</div>







											<div class="form-group">
												<div class="col-sm-8 col-sm-offset-2">
													<button class="btn btn-default" type="reset">Cancel</button>
													<button class="btn btn-primary" name="submit" id="submit" type="submit">Save changes</button>
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
<?php } ?>