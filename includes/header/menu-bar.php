<?php 
//session_start();
?>
<div class="container">
      <nav id="menu" class="navbar">
        <div class="navbar-header"> <span class="visible-xs visible-sm"> Menu <b></b></span></div>
        <div class="collapse navbar-collapse navbar-ex1-collapse">
          <ul class="nav navbar-nav">
            <li><a class="home_link" title="Home" href="index.php"><span>Home</span></a></li>
            <li class="contact-link"><a href="all-products.php">All Products</a></li>
            <li class="menu_brands dropdown"><a href="#">Brands</a>
              <div class="dropdown-menu">
                <?php
                  $ret=mysqli_query($con,"select * from brands limit 11");
                  while ($row=mysqli_fetch_array($ret)) 
                  {
                  ?>
                <div class="col-lg-1 col-md-2 col-sm-3 col-xs-6"><a href="brand.php?brand=<?php echo $row['id'];?>"><img src="images/brands/<?php echo htmlentities($row['brandImage']);?>" width="60" height="60" /></a><a href="brand.php?brand=<?php echo $row['id'];?>"><?php echo htmlentities($row['brandName']);?></a></div><?php } ?>

                <div class="col-lg-1 col-md-2 col-sm-3 col-xs-6"><a href="brands.php"><img src="images/brands/see_more.jpg" width="60" height="60" /></a><a href="brands.php">See More</a></div>
              </div>
            </li>
            
            <li class="contact-link"><a href="contact-us.php">Contact Us</a></li>
            <li class="dropdown information-link"><a>More</a>
              <div class="dropdown-menu">
                <ul>
                	<li><a href="index.php">Home</a></li>
                  <li><a href="login.php">Login</a></li>
                  <li><a href="register.php">Register</a></li>
                  <li><a href="all-products.php">All Product</a></li>
                  <li><a href="brands.php">All Brands</a></li>
                </ul>
                <ul>
                  <li><a href="page.php?type=about-us">About Us</a></li>
                  <li><a href="faq.php">Faq</a></li>
                </ul>
              </div>
            </li>
            
            <?php if(strlen($_SESSION['login']))
    {   ?>
            <li class="custom-link-right"><a href="my-account/profile.php" target="_blank"><?php echo htmlentities($_SESSION['username']);?> <?php echo htmlentities($_SESSION['lastname']);?></a></li><?php } ?>
          </ul>
        </div>
      </nav>
    </div>