<footer id="footer">
    <div class="fpart-first">
      <div class="container">
        <div class="row">
          <div class="contact col-lg-4 col-md-4 col-sm-12 col-xs-12">
            <h5>Contact Details</h5>
            <ul>
              <?php $query=mysqli_query($con,"SELECT address,telephoneno from contactusinfo");
            while($row=mysqli_fetch_array($query))
            {
            ?> 
              <li class="address"><i class="fa fa-map-marker"></i> <?php echo htmlentities($row['address']);?></li>
              <li class="mobile"><i class="fa fa-phone"></i><?php echo htmlentities($row['telephoneno']);?></li>
              <li class="email"><i class="fa fa-envelope"></i>Send email via our <a href="contact-us.php">Contact Us</a><?php } ?>
            </ul>
          </div>
          <div class="column col-lg-2 col-md-2 col-sm-3 col-xs-12">
            <h5>Information</h5>
            <ul>
              <li><a href="page.php?type=about-us">About Us</a></li>
              <li><a href="page.php?type=delivery-info">Delivery Information</a></li>
              <li><a href="page.php?type=privacy-policy">Privacy Policy</a></li>
              <li><a href="page.php?type=terms-condition">Terms &amp; Conditions</a></li>
            </ul>
          </div>
          <div class="column col-lg-2 col-md-2 col-sm-3 col-xs-12">
            <h5>Customer Service</h5>
            <ul>
              <li><a href="contact-us.php">Contact Us</a></li>
              <li><a href="page.php?type=returns">Returns</a></li>
              <li><a href="faq.php">FAQ</a></li>
            </ul>
          </div>
          <div class="column col-lg-2 col-md-2 col-sm-3 col-xs-12">
            <h5>Extras</h5>
            <ul>
              <li><a href="brands.php">Brands</a></li>
              <li><a href="#">All Products</a></li>
            </ul>
          </div>
          <div class="column col-lg-2 col-md-2 col-sm-3 col-xs-12">
            <h5>My Account</h5>
            <ul>
              <li><a href="my-account/profile.php">My Account</a></li>
              <li><a href="my-account/order-history.php">Order History</a></li>
              <li><a href="my-account/my-wishlist.php">Wish List</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="fpart-second">
      <div class="container">
        <div id="powered" class="clearfix">
          <div class="powered_text pull-left flip">
          </div>
          <div class="social pull-right flip">
            <!-- Facebook -->
            <?php $query=mysqli_query($con,"SELECT discription from footer where id=2");
            while($row=mysqli_fetch_array($query))
            {
              $fb = $row['discription'];
              $empty= "#";          
            ?>
            <?php
            if($fb==$empty)
                {?>
                  
                <?php }     
                else {?>
                <a href="<?php echo $fb;?>" target="_blank"> <img data-toggle="tooltip" src="images/socialicons/facebook.png" alt="Facebook" title="Facebook"></a> 
            <?php } ?>
          <?php }?>
            <!-- End Facebook -->
             <!-- Twitter -->
             <?php $query=mysqli_query($con,"SELECT discription from footer where id=3");
            while($row=mysqli_fetch_array($query))
            {
              $tw = $row['discription'];
              $empty= "#";          
            ?>
            <?php
            if($tw==$empty)
                {?>
                  
                <?php }     
                else {?>
                <a href="<?php echo $tw;?>" target="_blank"> <img data-toggle="tooltip" src="images/socialicons/twitter.png" alt="Twitter" title="Twitter"> </a> 
            <?php } ?>
          <?php }?>
            <!-- End Twitter -->
             <!-- Youtube -->
             <?php $query=mysqli_query($con,"SELECT discription from footer where id=4");
            while($row=mysqli_fetch_array($query))
            {
              $yt = $row['discription'];
              $empty= "#";          
            ?>
            <?php
            if($yt==$empty)
                {?>
                  
                <?php }     
                else {?>
                <a href="<?php echo $yt;?>" target="_blank"> <img data-toggle="tooltip" src="images/socialicons/youtube.png" alt="Youtube" title="Youtube"> </a> 
            <?php } ?>
          <?php }?>
            <!-- End Youtube -->
            <!-- pinterest -->
             <?php $query=mysqli_query($con,"SELECT discription from footer where id=5");
            while($row=mysqli_fetch_array($query))
            {
              $pin = $row['discription'];
              $empty= "#";          
            ?>
            <?php
            if($pin==$empty)
                {?>
                  
                <?php }     
                else {?>
                <a href="<?php echo $pin;?>" target="_blank"> <img data-toggle="tooltip" src="images/socialicons/pinterest.png" alt="Pinterest" title="Pinterest"> </a> 
            <?php } ?>
          <?php }?>
            <!-- End pinterest -->

            <!-- Blog -->
             <?php $query=mysqli_query($con,"SELECT discription from footer where id=6");
            while($row=mysqli_fetch_array($query))
            {
              $blog = $row['discription'];
              $empty= "#";          
            ?>
            <?php
            if($blog==$empty)
                {?>
                  
                <?php }     
                else {?>
                <a href="<?php echo $blog;?>" target="_blank"> <img data-toggle="tooltip" src="images/socialicons/blogger.png" alt="Blog" title="Blog"> </a> 
            <?php } ?>
          <?php }?>
            <!-- End Blog -->
    </div>
        </div>
        <div class="bottom-row">
          <div class="custom-text text-center">
            <?php
      
                          $query=mysqli_query($con,"SELECT discription from footer where id=1");
                          while($row=mysqli_fetch_array($query))
                          {
                        ?>  
            <p><?php echo $row['discription'];?></p><?php } ?>  
          </div>
          <div class="payments_types"> 
            <a href="#" target="_blank"> <img data-toggle="tooltip" src="images/payment/payment_paypal.png" alt="paypal" title="PayPal"></a> 
            <a href="#" target="_blank"> <img data-toggle="tooltip" src="images/payment/payment_american.png" alt="american-express" title="American Express"></a> 
            <a href="#" target="_blank"> <img data-toggle="tooltip" src="images/payment/payment_2checkout.png" alt="2checkout" title="2checkout"></a> 
            <a href="#" target="_blank"> <img data-toggle="tooltip" src="images/payment/payment_maestro.png" alt="maestro" title="Maestro"></a> 
            <a href="#" target="_blank"> <img data-toggle="tooltip" src="images/payment/payment_discover.png" alt="discover" title="Discover"></a> 
            <a href="#" target="_blank"> <img data-toggle="tooltip" src="images/payment/payment_mastercard.png" alt="mastercard" title="MasterCard"></a> </div>
        </div>
      </div>
    </div>
    <div id="back-top"><a data-toggle="tooltip" title="Back to Top" href="javascript:void(0)" class="backtotop"><i class="fa fa-chevron-up"></i></a></div>
  </footer>