<!--Right Part Start -->
        <aside id="column-right" class="col-sm-3 hidden-xs">
          <h3 class="subtitle">Account</h3>
          <div class="list-group">
            <ul class="list-item">
         
              <a href="#">     
                <?php $query=mysqli_query($con,"select userimage from users where id='".$_SESSION['id']."'");
 while($row=mysqli_fetch_array($query)) 
 {
 ?> 
<p class="centered"><a href="update-image.php">
<?php $userphoto=$row['userimage'];
if($userphoto==""):
?>
<img src="userimages/noimage.png"  class="img-circle" width="100" height="100" >
<?php else:?>
  <img src="userimages/<?php echo htmlentities($userphoto);?>" class="img-circle" width="100" height="100" data-toggle="tooltip" data-title="Update Profile Picture" align="center">

<?php endif;?><?php } ?></a></li>
              <li><a href="profile.php">Edit Profile</a></li>
              <li><a href="billing-address.php">Shipping / Billing Address</a></li>
              <li><a href="change-password.php">Change Password</a></li>
              <li><a href="order-history.php">Order History</a></li>
              <li><a href="transaction.php">Transactions</a></li>
              <li><a href="my-wishlist.php">Wish List</a></li>
            </ul>
          </div>
        </aside>
        <!--Right Part End -->