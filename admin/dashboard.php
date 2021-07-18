<?php
session_start();
error_reporting(0);
include('../config/config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{
//category wise bar chart qry
 $categorywisesales=mysqli_query($con,"SELECT category.categoryName,COUNT(orders.productId),SUM(products.productPrice+products.shippingCharge) FROM `orders` JOIN products ON products.id=orders.productId JOIN category ON category.id = products.category WHERE  orders.paymentStatus=1 and orders.paymentMethod is not null GROUP BY category.categoryName");
 
 //brands wise bar chart qry
 $brandswisesales=mysqli_query($con,"SELECT brands.brandName,COUNT(orders.productId),SUM(products.productPrice+products.shippingCharge) FROM `orders` JOIN products ON products.id=orders.productId JOIN brands ON brands.id = products.productCompany WHERE orders.paymentStatus=1 and orders.paymentMethod is not null GROUP BY brands.brandName");

  //last sale chart qry
 $lastdaysales=mysqli_query($con,"SELECT Date(orders.orderDate),COUNT(orders.id),SUM(products.productPrice+products.shippingCharge) FROM `orders` JOIN products on products.id=orders.productId WHERE orders.paymentStatus=1 and orders.paymentMethod is not null GROUP BY Date(orderDate) ORDER BY Date(orders.orderDate) DESC LIMIT 7");

//sales month wise bar chart qry
$salesmonthwise = mysqli_query($con,"SELECT MONTHNAME(orders.orderDate),YEAR(orders.orderDate),COUNT(orders.id),SUM(products.productPrice+products.shippingCharge) FROM `orders` JOIN products ON products.id=orders.productId WHERE orders.paymentStatus=1 and YEAR(orders.orderDate)= YEAR(CURDATE()) AND orders.paymentMethod is not null GROUP BY MONTHNAME(orders.orderDate) ORDER BY Month(orders.orderDate)");

//user registation month wise bar chart qry
$userregmonthwise = mysqli_query($con,"SELECT MONTHNAME(regDate),YEAR(regDate),COUNT(id) FROM `users` WHERE YEAR(regDate)= YEAR(CURDATE()) GROUP BY MONTHNAME(regDate) ORDER BY Month(regDate)");

//order status pie chart
$orderstatus = mysqli_query($con,"SELECT COUNT(id),orderStatus FROM orders WHERE orderStatus is not null GROUP BY orderStatus");

//payment status dornet chat
$paymentstatuss = mysqli_query($con,"SELECT IF(paymentStatus = 1, 'Paid','Un Paid')as paidstatus,COUNT(id) FROM orders WHERE orderStatus is not null GROUP BY paymentStatus");
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

	<link href="web/css/bootstrap.css" rel='stylesheet' type='text/css' />

	<!-- Custom CSS -->
	<link href="web/css/style.css" rel='stylesheet' type='text/css' />

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


	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Order Status', 'Count'],
          <?php 
          while($row=mysqli_fetch_array($orderstatus)) 
          {
            echo "['".$row['orderStatus']."',".$row['COUNT(id)']."],";
          }

          ?>
         
        ]);

        var options = {
           title: 'Orders Status Statics',
           is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('orderstatuspiechar'));

        chart.draw(data, options);
      }
    </script>


    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['payment Status', 'Count' ],
          <?php 
          while($row=mysqli_fetch_array($paymentstatuss))
          {
            echo "['".$row['paidstatus']."',".$row['COUNT(id)']."],";

          }

          ?>
        ]);

        var options = {
          title: 'Gender Wise Active Users',
          pieHole: 0.4,
        };

        var chart = new google.visualization.PieChart(document.getElementById('paymentststusdounetchart'));
        chart.draw(data, options);
      }
    </script>

    <!-- Last 7 Day Sales Start -->
     <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);


      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Year', 'Sales'],
           <?php 
          while($row=mysqli_fetch_array($lastdaysales))
          {
            echo "['".$row['Date(orders.orderDate)'].'- No of item: '.$row['COUNT(orders.id)']."',".$row['SUM(products.productPrice+products.shippingCharge)']."],";

          }

          ?>
        ]);

        var options = {
          title: 'Last 7 Day Sales',
          hAxis: {title: 'Year',  titleTextStyle: {color: '#333'}},
          vAxis: {minValue: 0}
        };

        var chart = new google.visualization.LineChart(document.getElementById('lastsales'));

        chart.draw(data, options);
      }
    </script>
    <!-- Last 7 Day Sales End -->

    <!-- Category Wise Sales Start Bar Chart -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Category Name', 'Sales' ],
          <?php 
          while($row=mysqli_fetch_array($categorywisesales))
          {
            echo "['".$row['categoryName'].' : '.$row['COUNT(orders.productId)']."',".$row['SUM(products.productPrice+products.shippingCharge)']."],";
          }

          ?>
        ]);

        var options = {
          chart: {
            title: '',
            subtitle: '',
          },
          bars: 'verticle' // Required for Material Bar Charts.
        };

        var chart = new google.charts.Bar(document.getElementById('categorywisebarchart'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>
    <!-- Category Wise Sales End Bar Chart -->

    <!-- Brands Wise Sales Start Bar Chart -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Brand Name', 'Sales' ],
          <?php 
          while($row=mysqli_fetch_array($brandswisesales))
          {
            echo "['".$row['brandName'].' : '.$row['COUNT(orders.productId)']."',".$row['SUM(products.productPrice+products.shippingCharge)']."],";
          }

          ?>
        ]);

        var options = {
          chart: {
            title: '',
            subtitle: '',
          },
          bars: 'verticle' ,// Required for Material Bar Charts.
          colors: ["#0bdea6"]
        };

        var chart = new google.charts.Bar(document.getElementById('brandswisebarchart'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>
    <!-- Brands Wise Sales End Bar Chart -->

<!-- Month Wise User Registation Start Bar Chart -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Month Name', 'User Registation Count'],
          <?php 
          while($row=mysqli_fetch_array($userregmonthwise))
          {
            echo "['".$row['MONTHNAME(regDate)']."',".$row['COUNT(id)']."],";
          }

          ?>
        ]);

        var options = {
          chart: {
            title: 'Month Wise User Registation Count',
          },
          bars: 'horizontal' ,// Required for Material Bar Charts.
          colors: ["#0000FF"]
        };

        var chart = new google.charts.Bar(document.getElementById('monthwiseusersregchart'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>
<!-- Month Wise User Registation End Bar Chart -->

<!-- Month Wise Sales Start Bar Chart -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Month Name', 'User Registation Count'],
          <?php 
          while($row=mysqli_fetch_array($salesmonthwise))
          {
            echo "['".$row['MONTHNAME(orders.orderDate)']."',".$row['SUM(products.productPrice+products.shippingCharge)']."],";
          }

          ?>
        ]);

        var options = {
          chart: {
            title: 'Month Wise User Registation Count',
          },
          bars: 'verticle', // Required for Material Bar Charts.
          colors: ["#00FF00"]
        };

        var chart = new google.charts.Bar(document.getElementById('monthwisesaleschart'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>
<!-- Month Wise Sales End Bar Chart -->

</head>

<body>
<?php include('includes/header.php');?>

	<div class="ts-main-content">
<?php include('includes/leftbar.php');?>
		<div class="content-wrapper">
			<div class="container-fluid">

				<div class="row">
					<div class="col-md-12">

						<h2 class="page-title">Dashboard</h2>
						
						<div class="row">
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-3">
										<div class="panel panel-default">
											<div class="panel-body bk-danger text-light">
												<div class="stat-panel text-center">
                             <?php
$rt = mysqli_query($con,"SELECT * FROM products");
$num1 = mysqli_num_rows($rt);
{?>
													<div class="stat-panel-number h1 "><?php echo htmlentities($num1);?></div>
													<?php }?>
                          <i class="fa fa-hourglass" aria-hidden="true"></i>
													<div class="stat-panel-title text-uppercase">Total published products</div>
												</div>
											</div>
											<a href="manage-products.php" class="block-anchor panel-footer text-center">Full Detail &nbsp; <i class="fa fa-arrow-right"></i></a>
										</div>
									</div>
									<div class="col-md-3">
										<div class="panel panel-default">
											<div class="panel-body bk-info text-light">
												<div class="stat-panel text-center">
                   <?php                  
$rt = mysqli_query($con,"SELECT * FROM category");
$num1 = mysqli_num_rows($rt);
{?>									<div class="stat-panel-number h1 "><?php echo htmlentities($num1);?></div>
<i class="fa fa-hourglass-half" aria-hidden="true"></i>
													<div class="stat-panel-title text-uppercase">Total product category</div>
													  <?php }?>
												</div>
											</div>
											<a href="category.php" class="block-anchor panel-footer text-center">Full Detail &nbsp; <i class="fa fa-arrow-right"></i></a>
										</div>
									</div>








									<div class="col-md-3">
										<div class="panel panel-default">
											<div class="panel-body bk-success text-light">
												<div class="stat-panel text-center">
												     <?php                
$rt = mysqli_query($con,"SELECT * FROM subcategory");
$num1 = mysqli_num_rows($rt);
{?>
													<div class="stat-panel-number h1 "><?php echo htmlentities($num1);?></div>
													<?php }?>
                          <i class="fa fa-hourglass-end" aria-hidden="true"></i>
													<div class="stat-panel-title text-uppercase">Total product sub category</div>
												</div>
											</div>
											<a href="subcategory.php" class="block-anchor panel-footer text-center">Full Detail &nbsp; <i class="fa fa-arrow-right"></i></a>
										</div>
									</div>

									<div class="col-md-3">
                    <div class="panel panel-default">
                      <div class="panel-body bk-good text-light">
                        <div class="stat-panel text-center">
												     <?php                
$rt = mysqli_query($con,"SELECT * FROM brands");
$num1 = mysqli_num_rows($rt);
{?>
													<div class="stat-panel-number h1 "><?php echo htmlentities($num1);?></div>
													<?php }?>
                          <i class="fa fa-hourglass-end" aria-hidden="true"></i>
													<div class="stat-panel-title text-uppercase">Total product Brands</div>
												</div>
											</div>
											<a href="brands.php" class="block-anchor panel-footer text-center">Full Detail &nbsp; <i class="fa fa-arrow-right"></i></a>
										</div>
									</div>		

									<div class="col-md-3">
										<div class="panel panel-default">
											<div class="panel-body bk-warning text-light">
												<div class="stat-panel text-center">
                   <?php 
  $status=1;                   
$rt = mysqli_query($con,"SELECT * FROM users where status='$status' and usertype is null");
$num1 = mysqli_num_rows($rt);
{?>									<div class="stat-panel-number h1 "><?php echo htmlentities($num1);?></div>
<i class="fa fa-user" aria-hidden="true"></i>
													<div class="stat-panel-title text-uppercase">Total Varifyed users</div>
													  <?php }?>
												</div>
											</div>
											<a href="manage-varified-users.php" class="block-anchor panel-footer text-center">Full Detail &nbsp; <i class="fa fa-arrow-right"></i></a>
										</div>
									</div>

                  <div class="col-md-3">
                    <div class="panel panel-default">
                      <div class="panel-body bk-excelent text-light">
                        <div class="stat-panel text-center">
                   <?php 
$status=0;                   
$rt = mysqli_query($con,"SELECT * FROM users where status='$status' and usertype is null");
$num1 = mysqli_num_rows($rt);
{?>                 <div class="stat-panel-number h1 "><?php echo htmlentities($num1);?></div>
<i class="fa fa-user-times" aria-hidden="true" ></i>
                          <div class="stat-panel-title text-uppercase">Pendig Activation users</div>
                            <?php }?>
                        </div>
                      </div>
                      <a href="manage-pending-users.php" class="block-anchor panel-footer text-center">Full Detail &nbsp; <i class="fa fa-arrow-right"></i></a>
                    </div>
                  </div>

                  
                  <div class="col-md-3">
                    <div class="panel panel-default">
                      <div class="panel-body bk-verypoor text-light">
                        <div class="stat-panel text-center">
<?php $query=mysqli_query($con,"SELECT setting_description from genaralsetting WHERE id=8");
while($row=mysqli_fetch_array($query))
{
  $currency=$row['setting_description'];
  ?> 
<?php $query=mysqli_query($con,"SELECT sum(products.productPrice+products.shippingCharge) as mothearning FROM orders JOIN products ON products.id=orders.productId WHERE orders.paymentStatus=1 and MONTH(orders.orderDate) = MONTH(CURRENT_DATE()) AND orders.paymentMethod is not null");
while($row=mysqli_fetch_array($query))
{?>               <div class="stat-panel-number h1 "><?php echo $currency ;?> <?php echo htmlentities($row['mothearning']);?> </div>
<i class="fa fa-credit-card" aria-hidden="true"></i>
                          <div class="stat-panel-title text-uppercase">This Month Earning</div>
                            <?php }?>
                            <?php }?>
                        </div>
                      </div>
                      <a href="total-earning.php" class="block-anchor panel-footer text-center">Full Detail &nbsp; <i class="fa fa-arrow-right"></i></a>
                    </div>
                  </div> 


                    <div class="col-md-3">
                    <div class="panel panel-default">
                      <div class="panel-body bk-poor text-light">
                        <div class="stat-panel text-center">
<?php $query=mysqli_query($con,"SELECT setting_description from genaralsetting WHERE id=8");
while($row=mysqli_fetch_array($query))
{
  $currency=$row['setting_description'];
  ?> 
<?php $query=mysqli_query($con,"SELECT sum(products.productPrice+products.shippingCharge) as fullearning FROM orders JOIN products ON products.id=orders.productId WHERE orders.paymentStatus=1 and orders.paymentMethod is not null");
while($row=mysqli_fetch_array($query))
{?>               <div class="stat-panel-number h1 "><?php echo $currency ;?> <?php echo htmlentities($row['fullearning']);?> </div>
<i class="fa fa-credit-card" aria-hidden="true"></i>
                          <div class="stat-panel-title text-uppercase">Total Earning</div>
                            <?php }?>
                            <?php }?>
                        </div>
                      </div>
                      <a href="total-earning.php" class="block-anchor panel-footer text-center">Full Detail &nbsp; <i class="fa fa-arrow-right"></i></a>
                    </div>
                  </div>  
						</div>
					</div>
				</div>

							

						<div class="panel panel-default">
							<div class="panel-heading">Last & Days Sales</div>
							<div class="panel-body">
							<!--  -->
								<table  cellspacing="0" width="100%">
									<thead>
										<tr><tbody>
											<th><div id="lastsales" style="width: 1000px; height: 300px;" ></th>
										</tr></tbody>
									</thead>
								</table>
							</div>
							</div>



							<div class="panel panel-default">
							<div class="panel-heading">Latest Sales</div>
							<div class="panel-body">
							<!--  -->
								<table  cellspacing="0" width="100%">
									<thead>
										<tr>
					                      <th>User Name</th>
					                      <th>User Email </th>
					                      <th>Order Date/Time</th>
					                      <th>Product Name</th>
					                      <th>Payment Methord</th>
										</tr>
									</thead>
								<tbody>

					                    <?php $query=mysqli_query($con,"SELECT users.firstname,users.lastname,users.email,orders.orderDate,products.productName,orders.paymentMethod FROM `orders` JOIN users ON users.id=orders.userId JOIN products ON products.id=orders.productId where orders.paymentMethod is not null ORDER BY orders.id DESC limit 5");
					                    $cnt=1;
					                    while($row=mysqli_fetch_array($query))
					                    {
					                    ?>                  
					                    <tr>
					                      
					                      <td><?php echo htmlentities($row['firstname']);?> <?php echo htmlentities($row['lastname']);?></a></td>
					                      <td><?php echo htmlentities($row['email']);?></a></td>
					                      <td> <?php echo htmlentities($row['orderDate']);?></td>
					                      <td> <?php echo htmlentities($row['productName']);?></td>
					                      <td> <?php echo htmlentities($row['paymentMethod']);?></td>
					                    <?php $cnt=$cnt+1; } ?>
					                </table>
								</div>
							</div>



							<div class="panel panel-default">
							<div class="panel-heading">Category Wise Sales</div>
							<div class="panel-body">
							<!--  -->
								<table  cellspacing="0" width="100%">
									<thead>
										<tr><tbody>
											<th><div id="categorywisebarchart" style="width: 1000px;"></th>
										</tr></tbody>
									</thead>
								</table>
							</div>
							</div>


						<div class="panel panel-default">
							<div class="panel-heading">Brands Wise Sales</div>
							<div class="panel-body">
							<!--  -->
								<table  cellspacing="0" width="100%">
									<thead>
										<th>
											<th><div id="brandswisebarchart" style="width: 1000px;"></th>
										</th>
									</thead>
								</table>
							</div>
						</div>



							<div class="panel panel-default">
							<div class="panel-heading">Latest Users</div>
							<div class="panel-body">
							<!--  -->
								<table  cellspacing="0" width="100%">
									<thead>
										<tr>
					                      <th>Email</th>
					                      <th>Ip Address </th>
					                      <th>Login Time</th>
										</tr>
									</thead>
								<tbody>

					                    <?php $query=mysqli_query($con,"SELECT userEmail,userip,loginTime FROM `userlog` ORDER BY id DESC limit 5");
					                    $cnt=1;
					                    while($row=mysqli_fetch_array($query))
					                    {
					                    ?>                  
					                    <tr>
					                      
					                      <td><?php echo htmlentities($row['userEmail']);?></a></td>
					                      <td><?php echo htmlentities($row['userip']);?></a></td>
					                      <td> <?php echo htmlentities($row['loginTime']);?></td>
					                    <?php $cnt=$cnt+1; } ?>
					                </table>
								</div>
							</div>




		<div class="panel panel-default">
							<div class="panel-heading">Category And Sub Category Wise Complaint</div>
							<div class="panel-body">
							<!--  -->
								<table  cellspacing="0" width="100%">
								<thead>
									<tr>
										<th>
											<div id="paymentststusdounetchart" style="width: 400px; height: 300px;"></div>
										</th>
										<th>
											<div id="orderstatuspiechar" style="width: 400px; height: 300px;"></div>
										</th>
									</tr>
								</thead>
								
								</table>
							</div>
						</div>

			            <div class="panel panel-default">
			              <div class="panel-heading">Month Wise Complaint & User Static</div>
			              <div class="panel-body">
			              <!--  -->
			                <table  cellspacing="0" width="100%">
			                  <thead>
			                    <th>
			                      <div id="monthwiseusersregchart" style="width: 500px; height: 390px;"></div>
			                    </th>
			                    <th>
			                     <div id="monthwisesaleschart" style="width: 500px; height: 390px;"></div>
			                    </th>
			                  </thead>
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