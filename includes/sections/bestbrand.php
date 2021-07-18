<!-- Brand Product Slider Start-->
<?php
                  $ret=mysqli_query($con,"SELECT brands.brandName,brands.id FROM products INNER JOIN brands ON products.productCompany=brands.id GROUP BY brands.id ORDER BY products.productCompany ASC LIMIT 1");
                  while ($row=mysqli_fetch_array($ret)) 
                  {
                  ?>
          <h3 class="subtitle"><?php echo htmlentities($row['brandName']);?> Products - <a class="viewall" href="brand.php?brand=<?php echo htmlentities($row['id']);?>">view all</a></h3><?php } ?>
          <div class="owl-carousel latest_brands_carousel">
            <?php
                  $ret2=mysqli_query($con,"SELECT brands.id as bid FROM products INNER JOIN brands ON products.productCompany=brands.id GROUP BY brands.id ORDER BY products.productCompany ASC LIMIT 1");
                    while ($row2=mysqli_fetch_array($ret2)) 
                    {
                      $bestbrand = $row2['bid'];
                      $ret=mysqli_query($con,"select * from products where productCompany='$bestbrand'");
                      while ($row=mysqli_fetch_array($ret)) 
                      {
                         $discountstat=$row['productDiscount'];
                      
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
                  <?php } ?> </p>
                     
                    </div>
                    <div class="button-group">
                      <a href="index.php?page=product&action=add&id=<?php echo $row['id']; ?>"><button class="btn-primary" type="button" onClick=""><span>Add to Cart</span></button></a>
                     
                    </div>
                  </div>
                  <?php  }}?>
          </div>