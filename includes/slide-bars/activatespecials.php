<h3 class="subtitle">Specials</h3>
          <div class="side-item">
            <?php $query=mysqli_query($con,"SELECT * FROM products WHERE specialstatus=1 ORDER BY RAND ( ) LIMIT 6");
            while($row=mysqli_fetch_array($query)) 
            {
              $discountstat=$row['productDiscount'];
             ?>
            <div class="product-thumb clearfix">
              <div class="image"><a href="product.php?pid=<?php echo htmlentities($row['id']);?>"><img src="admin/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage1']);?>" class="img-responsive" /></a></div>
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