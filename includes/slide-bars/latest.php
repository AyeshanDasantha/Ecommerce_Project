  <h3 class="subtitle">Latest</h3>
          <div class="side-item">
            <?php
            $ret=mysqli_query($con,"select * from products ORDER BY id DESC LIMIT 7");
            while ($row=mysqli_fetch_array($ret)) 
            {
              $discountstat=$row['productDiscount'];
            ?>
               <div class="product-thumb clearfix">
              <div class="image"><a href="product.html"><img src="admin/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage1']);?>" class="img-responsive" /></a></div>
              <div class="caption">
                <h4><a href="product.php?pid=<?php echo htmlentities($row['id']);?>"><?php echo htmlentities($row['productName']);?></a></h4>
                <p class="price"> <span class="price-new"><?php echo $sitecurrency;?> <?php echo htmlentities($row['productPrice']);?></span> <span class="price-old"><?php echo $sitecurrency;?> <?php echo htmlentities($row['productPriceBeforeDiscount']);?></span> 
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
        </aside>