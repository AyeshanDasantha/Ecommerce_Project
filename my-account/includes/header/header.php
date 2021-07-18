
<?php 

 if(isset($_Get['action'])){
    if(!empty($_SESSION['cart'])){
    foreach($_POST['quantity'] as $key => $val){
      if($val==0){
        unset($_SESSION['cart'][$key]);
      }else{
        $_SESSION['cart'][$key]['quantity']=$val;
      }
    }
    }
  }
  $query=mysqli_query($con,"SELECT * FROM genaralsetting where id=8");
while($row=mysqli_fetch_array($query)) 
{
  $sitecurrency=$row['setting_description'];
}
?>

<!-- Header Start-->
    <header class="header-row">
      <div class="container">
        <div class="table-container">
          <?php $query=mysqli_query($con,"select setting_description from genaralsetting where id=4");
                while($row=mysqli_fetch_array($query)) 
                {
                ?>
                <?php $logophoto=$row['setting_description'];
                if($logophoto==""):
                ?>
          <!-- Logo Start -->
          <div class="col-table-cell col-lg-6 col-md-6 col-sm-12 col-xs-12 inner">
            <div id="logo"><a href="../index.php"><img class="img-responsive" src="../images/logo/logo.png" /></a></div>
          </div>
          <!-- Logo End -->
          <?php else:?>
<!-- Logo Start -->
          <div class="col-table-cell col-lg-6 col-md-6 col-sm-12 col-xs-12 inner">
            <div id="logo"><a href="../index.php"><img class="img-responsive" src="../images/logo/<?php echo htmlentities($logophoto);?>"  /></a></div>
          </div>
          <!-- Logo End -->
            <?php endif;?><?php } ?>
                      

  
          <!-- Mini Cart Start-->
          <div class="col-table-cell col-lg-3 col-md-3 col-sm-6 col-xs-12">
<?php
if(!empty($_SESSION['cart'])){
  ?>
            <div id="cart">
              <button type="button" data-toggle="dropdown" data-loading-text="Loading..." class="heading dropdown-toggle">
              <span class="cart-icon pull-left flip"></span>
              <span id="cart-total"><?php echo $_SESSION['qnty'];?> item(s) - <?php echo $sitecurrency;?> <?php echo $_SESSION['tp']; ?></span></button>
              <ul class="dropdown-menu">
                <?php
    $sql = "SELECT * FROM products WHERE id IN(";
      foreach($_SESSION['cart'] as $id => $value){
      $sql .=$id. ",";
      }
      $sql=substr($sql,0,-1) . ") ORDER BY id ASC";
      $query = mysqli_query($con,$sql);
      $totalprice=0;
      $totalqunty=0;
      if(!empty($query)){
      while($row = mysqli_fetch_array($query)){
        $quantity=$_SESSION['cart'][$row['id']]['quantity'];
        $subtotal= $_SESSION['cart'][$row['id']]['quantity']*$row['productPrice']+$row['shippingCharge'];
        $totalprice += $subtotal;
        $_SESSION['qnty']=$totalqunty+=$quantity;

  ?>
                <li>
                  <table class="table">
                    <tbody>
                      <tr>
                        <td class="text-center"><a href="product.html"><img class="img-thumbnail" src="../admin/productimages/<?php echo $row['id'];?>/<?php echo $row['productResizeImage50_1'];?>"></a></td>
                        <td class="text-left"><a href="index.php?page-detail"><?php echo $row['productName']; ?></a></td>
                        <td class="text-right"><?php echo $sitecurrency;?> <?php echo ($row['productPrice']+$row['shippingCharge']); ?>*<?php echo $_SESSION['cart'][$row['id']]['quantity']; ?></td>
                        <td class="text-center"><button class="btn btn-danger btn-xs remove" title="Remove" onClick="" type="button"><i class="fa fa-times"></i></button></td>
                      </tr><?php } }?> 
                    </tbody>
                  </table>
                </li>
                <li>
                  <div>
                    <table class="table table-bordered">
                      <tbody>
                        <tr>
                          <td class="text-right"><strong>Sub-Total</strong></td>
                          <td class="text-right"><?php echo $sitecurrency;?> <?php echo $_SESSION['tp']="$totalprice"; ?></td>
                        </tr>
                       
                      </tbody>
                    </table>
                    <p class="checkout"><a href="my-cart.php" class="btn btn-primary"><i class="fa fa-shopping-cart"></i> View Cart</a></p>
                  </div>
                </li>
              </ul>
            </div>
          </div>
          <?php } else { ?>
<div class="col-table-cell col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div id="cart">
              <button type="button" data-toggle="dropdown" data-loading-text="Loading..." class="heading dropdown-toggle">
              <span class="cart-icon pull-left flip"></span>
              <span id="cart-total">0 item(s) - <?php echo $sitecurrency;?> 00.00</span></button>
              <ul class="dropdown-menu">
                <li>
                  <table class="table">
                    <tbody>
                      <tr>
                        
                        <td class="text-left"><a href="product.html">Your Shopping Cart is Empty</a></td>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </li>
                <li>
                  <div>
                    
                    <p class="checkout"><a href="../index.php" class="btn btn-primary"><i class="fa fa-share"></i> Continue Shopping</a></p>
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </div>

          <?php }?>
          <!-- Mini Cart End-->
          <!-- Search Start-->
          <div class="col-table-cell col-lg-3 col-md-3 col-sm-6 col-xs-12 inner">
            <div id="search" class="input-group">
              <form name="search" method="post" action="../search.php">
              <input  name="product" required="required" placeholder="Search here..." class="form-control input-lg" />
              <button type="submit" name="search" class="button-search"><i class="fa fa-search"></i></button>
            </div>
          </div></form>
          <!-- Search End-->
        </div>
      </div>
    </header>


    <!-- Header End-->