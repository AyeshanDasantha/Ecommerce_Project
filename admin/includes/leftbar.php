	<nav class="ts-sidebar">
			<ul class="ts-sidebar-menu">
			
				<li class="ts-label">Main</li>
				<li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
			
				<li><a href="#"><i class="fa fa-barcode"></i>Order Management</a>
					<ul>
						  <?php
						  $f1="00:00:00";
						$from=date('Y-m-d')." ".$f1;
						$t1="23:59:59";
						$to=date('Y-m-d')." ".$t1;
						 $result = mysqli_query($con,"SELECT * FROM Orders where orderDate Between '$from' and '$to' AND paymentMethod is not null");
						$num_rows1 = mysqli_num_rows($result);
						{
						?>
						<li><a href="todays-orders.php">Today's Order &nbsp;&nbsp; <span class="label danger">&nbsp;<?php echo htmlentities($num_rows1); ?>&nbsp;</span></a></li><?php } ?>

																<?php	
									 
$ret = mysqli_query($con,"SELECT * FROM Orders where orderStatus is null AND paymentMethod is not null");
$num = mysqli_num_rows($ret);
{?>
						<li><a href="pending-orders.php">Pending Order &nbsp;&nbsp; <span class="label warning">&nbsp;<?php echo htmlentities($num); ?>&nbsp;</span></a></li><?php } ?>
						<?php	
	$status='Order Placed';									 
$rt = mysqli_query($con,"SELECT * FROM Orders where orderStatus='$status' AND paymentMethod is not null");
$num1 = mysqli_num_rows($rt);
{?>					
						<li><a href="placed-orders.php">Placed Order &nbsp;&nbsp; <span class="label info">&nbsp;<?php echo htmlentities($num1); ?>&nbsp;</span></a></li><?php } ?>
						<?php	
	$status='On Review';									 
$rt = mysqli_query($con,"SELECT * FROM Orders where orderStatus='$status' AND paymentMethod is not null");
$num1 = mysqli_num_rows($rt);
{?>					
						<li><a href="on-review-orders.php">On Review Order&nbsp;&nbsp; <span class="label review">&nbsp;<?php echo htmlentities($num1); ?>&nbsp;</span></a></li><?php } ?>
						<?php	
	$status='On Delivery';									 
$rt = mysqli_query($con,"SELECT * FROM Orders where orderStatus='$status' AND paymentMethod is not null");
$num1 = mysqli_num_rows($rt);
{?>					
						<li><a href="on-delivery-orders.php">On Delivered Order &nbsp;&nbsp; <span class="label ondelivery">&nbsp;<?php echo htmlentities($num1); ?>&nbsp;</span></a></li><?php } ?>
						<?php	
	$status='Delivered';									 
$rt = mysqli_query($con,"SELECT * FROM Orders where orderStatus='$status' AND paymentMethod is not null");
$num1 = mysqli_num_rows($rt);
{?>					
						<li><a href="delivered-orders.php">Delivered Order &nbsp;&nbsp; <span class="label success">&nbsp;<?php echo htmlentities($num1); ?>&nbsp;</span></a></li><?php } ?>
					</ul>
				</li>
				
				<li><a href="#"><i class="fa fa-users"></i>Manage Users</a>
					<ul>
						<li><a href="manage-users.php">Manage users</a></li>
						<li><a href="add-users.php">Add users</a></li>
					</ul>
				</li>

				<li><a href="#"><i class="fa fa-cubes"></i>Manage Product</a>
					<ul>
						<li><a href="add-product.php">Add Product</a></li>
						<li><a href="manage-products.php">Product Details</a></li>
						<li><a href="specials-slide-bar.php">Specials Item</a></li>
					</ul>
				</li>

				<li><a href="#"><i class="fa fa-list-alt"></i>Manage Category</a>
					<ul>
						<li><a href="category.php">Add Category</a></li>
						<li><a href="subcategory.php">Add Sub-Category</a></li>
					</ul>
				</li>
				<li><a href="brands.php"><i class="fa fa-puzzle-piece"></i>Manage Brands</a></li>
				<?php
				$rt = mysqli_query($con,"SELECT * from tblcontactusquery WHERE status is null");
				$num1 = mysqli_num_rows($rt);
				{?>
				<li><a href="manage-conactusquery.php"><i class="fa fa-desktop"></i> Manage Conatctus Query&nbsp;<span class="label danger">&nbsp;<?php echo htmlentities($num1); ?>&nbsp;</span></a></li><?php } ?>
				<li><a href="manage-pages.php"><i class="fa fa-book"></i> Manage Pages</a></li>
				<li><a href="custom-content.php"><i class="fa fa-crosshairs"></i>Update Custom Content</a></li>
				<li><a href="user-logs.php"><i class="fa fa-list"></i>User Login Log</a></li>

				<li><a href="#"><i class="fa fa-file"></i>Reports</a>
					<ul>
						<li><a href="users-announcement.php">Sales Report</a>
							<ul>
								<li><a href="reports/all-sales.php"><i class="fa fa-circle-o"></i>All Sales Report</a></li>
								<li><a href="sales-category.php"><i class="fa fa-circle-o"></i>Category Wise Sales Report</a></li>
								<li><a href="sales-brand.php"><i class="fa fa-circle-o"></i>Brand Wise Sales Report</a></li>
								<li><a href="date-sales.php"><i class="fa fa-circle-o"></i>Day Sales Report</a></li>
							</ul>
						</li>
						
						<li><a href="users-announcement.php">Products Report</a>
							<ul>
								<li><a href="reports/all-products.php"><i class="fa fa-circle-o"></i>All Products Report</a></li>
								<li><a href="product-category.php"><i class="fa fa-circle-o"></i>Category Wise Products Report</a></li>
								<li><a href="product-brand.php"><i class="fa fa-circle-o"></i>Brand Wise Products Report</a></li>
							</ul>
						</li>
						<li><a href="users-announcement.php">Users Report</a>
							<ul>
								<li><a href="reports/all-users.php"><i class="fa fa-circle-o"></i>All Users Report</a></li>
								<li><a href="reports/verified-users.php"><i class="fa fa-circle-o"></i>Verified Users Report</a></li>
								<li><a href="reports/unverified-users.php"><i class="fa fa-circle-o"></i>Unverified Users Report</a></li>
							</ul>

						</li>
						
					</ul>
				</li>

				<li><a href="#"><i class="fa fa-bullhorn"></i>Announcement</a>
					<ul>
						<li><a href="users-announcement.php">To Users Profile </a></li>
						<li><a href="newsletters.php">Newsletters</a></li>
					</ul>
				</li>

				<li><a href="#"><i class="fa fa-cogs"></i>Advertising Settings</a>
					<ul>
						<li><a href="activate-site-advertising.php">Activate System</a></li>
						<li><a href="site-advertising.php">Advertising Section</a></li>
					</ul>
				</li>
				<li class="logout"><a href="logout.php"><i class="fa fa-sign-out"> </i> Log Out</a></li>
			</ul>
		</nav>