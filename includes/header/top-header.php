<?php 
//session_start();

?>
<nav id="top" class="htop">
      <div class="container">
        <div class="row"> <span class="drop-icon visible-sm visible-xs"><i class="fa fa-align-justify"></i></span>

          <div class="pull-left flip left-top">
            <div class="links">
              <ul>
              	 <?php $query=mysqli_query($con,"SELECT * from contactusinfo");
            while($row=mysqli_fetch_array($query))
            {
            ?>
                <li class="mobile"><a href="tel:<?php echo htmlentities($row['telephoneno']);?>"><i class="fa fa-phone"></i><?php echo htmlentities($row['telephoneno']);?></li>
                <li class="email"><a href="mailto:<?php echo htmlentities($row['email']);?>"><i class="fa fa-envelope"></i><?php echo htmlentities($row['email']);?></a></li>
               <?php } ?>
                    <?php $query=mysqli_query($con,"SELECT COUNT(id) as nowl FROM `wishlist` where userId='".$_SESSION['id']."'");
            while($row=mysqli_fetch_array($query))
            {
            ?>
                <li><a href="my-account/my-wishlist.php">Wish List (<?php echo htmlentities($row['nowl']);?>)</a></li><?php } ?>
                <li><a href="my-account/my-cart.php">Checkout</a></li>
              </ul>
            </div>
           
          </div>
          <div id="top-links" class="nav pull-right flip">
            <ul>
              
              <?php if(strlen($_SESSION['login'])==0)
    {   ?>
      <li><a href="track-order.php">Track Order</a></li>
      <li><a href="register.php">Register</a></li>
<li><a href="login.php">Login</a></li>
<?php }
else{ ?>
        <li><a href="track-order.php">Track Order</a></li>
        <li><a href="my-account/profile.php">My Account</a></li>
        <li><a href="my-account/logout.php"><i class="icon fa fa-sign-out"></i>Logout</a></li>
        <?php } ?>  
            </ul>
          </div>
        </div>
      </div>
    </nav>