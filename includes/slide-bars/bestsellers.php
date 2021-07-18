<h3 class="subtitle">Best Sales</h3>
          <div class="side-item">
            <?php $query=mysqli_query($con,"SELECT products.*, COUNT(orders.productId) FROM products INNER JOIN orders ON products.id=orders.productId GROUP BY orders.productId ORDER BY id DESC LIMIT 7");
            while($row=mysqli_fetch_array($query)) 
            {
              $discountstat=$row['productDiscount'];
             ?>
            <div class="product-thumb clearfix">
              <div class="image"><a href="product.php?pid=<?php echo htmlentities($row['id']);?>"><img src="admin/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productResizeImage50_1']);?>" class="img-responsive" /></a></div>
              <div class="caption">
                <h4><a href="product.php?pid=<?php echo htmlentities($row['id']);?>"><?php echo htmlentities($row['productName']);?></a></h4>
                <p class="price"><?php echo $sitecurrency;?> <?php echo htmlentities($row['productPrice']);?> 
                <span class="price-old"><?php echo $sitecurrency;?> <?php echo htmlentities($row['productPriceBeforeDiscount']);?></span> 
                  <?php 
                  if ($discountstat == 0) {?>
                    
                  <?php } else {?>
                    <span class="saving">-<?php echo $row['productDiscount'];?>%</span>
                  <?php } ?>

              </p>
              </div>
            </div>
            <?php } ?>
          </div>