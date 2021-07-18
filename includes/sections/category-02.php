<?php
                  $ret=mysqli_query($con,"select * from category where id=2");
                  while ($row=mysqli_fetch_array($ret)) 
                  {
                    $discountstat=$row['productDiscount'];
                  ?>
<h3 class="subtitle"><?php echo htmlentities($row['categoryName']);?> - <a class="viewall" href="category.php?cid=<?php echo htmlentities($row['id']);?>">view all</a></h3><?php } ?>
<div class="owl-carousel latest_category_carousel">
            <?php
                  $ret=mysqli_query($con,"select * from products where category=2");
                  while ($row=mysqli_fetch_array($ret)) 
                  {
                  ?>
                  <div class="product-thumb">
                    <div class="image"><a href="product.php?pid=<?php echo htmlentities($row['id']);?>"><img src="admin/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage1']);?>" data-echo="admin/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage1']);?>"  width="180" height="300" alt="" class="img-responsive" /></a></div>
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
                    <div class="button-group">
                      <a href="index.php?page=product&action=add&id=<?php echo $row['id']; ?>"><button class="btn-primary" type="button" onClick=""><span>Add to Cart</span></button></a>
                      
                    </div>
                  </div>
                  <?php } ?>
          </div>
          <!-- Categories Product Slider End -->
          