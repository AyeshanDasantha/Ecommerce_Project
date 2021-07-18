  <!-- Categories Product Slider Start-->
          <div class="category-module" id="latest_category">
             <?php
                  $ret=mysqli_query($con,"select * from category where id=1");
                  while ($row=mysqli_fetch_array($ret)) 
                  {
                  ?>
            <h3 class="subtitle"><?php echo htmlentities($row['categoryName']);?> - <a class="viewall" href="category.php?cid=<?php echo htmlentities($row['id']);?>">view all</a></h3> 
            <?php } ?>
            <div class="category-module-content">
              <ul id="sub-cat" class="tabs">
                <?php
                  $ret=mysqli_query($con,"select subcategory from subcategory where categoryid=1 and id=1");
                  while ($row=mysqli_fetch_array($ret)) 
                  {
                  ?>
                <li><a href="#tab-cat1"><?php echo htmlentities($row['subcategory']);?></a></li><?php } ?>

                <?php
                  $ret=mysqli_query($con,"select subcategory from subcategory where categoryid=1 and id=2");
                  while ($row=mysqli_fetch_array($ret)) 
                  {
                  ?>
                <li><a href="#tab-cat2"><?php echo htmlentities($row['subcategory']);?></a></li><?php } ?>

                <?php
                  $ret=mysqli_query($con,"select subcategory from subcategory where categoryid=1 and id=3");
                  while ($row=mysqli_fetch_array($ret)) 
                  {
                  ?>
                <li><a href="#tab-cat3"><?php echo htmlentities($row['subcategory']);?></a></li><?php } ?>

                <?php
                  $ret=mysqli_query($con,"select subcategory from subcategory where categoryid=1 and id=4");
                  while ($row=mysqli_fetch_array($ret)) 
                  {
                  ?>
                <li><a href="#tab-cat4"><?php echo htmlentities($row['subcategory']);?></a></li><?php } ?>

                <?php
                  $ret=mysqli_query($con,"select subcategory from subcategory where categoryid=1 and id=5");
                  while ($row=mysqli_fetch_array($ret)) 
                  {
                  ?>
                <li><a href="#tab-cat5"><?php echo htmlentities($row['subcategory']);?></a></li><?php } ?>

                <?php
                  $ret=mysqli_query($con,"select subcategory from subcategory where categoryid=1 and id=6");
                  while ($row=mysqli_fetch_array($ret)) 
                  {
                  ?>
                <li><a href="#tab-cat6"><?php echo htmlentities($row['subcategory']);?></a></li><?php } ?>
              </ul>
               <div id="tab-cat1" class="tab_content">
                <div class="owl-carousel latest_category_tabs">
                  <?php
                  $ret=mysqli_query($con,"select * from products where category=1 and subCategory=1");
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
                        <?php } ?>
                      </p>
                      
                    </div>
                    <div class="button-group">
                      <a href="index.php?page=product&action=add&id=<?php echo $row['id']; ?>"><button class="btn-primary" type="button" onClick=""><span>Add to Cart</span></button></a>
                    
                    </div>
                  </div>
                  <?php } ?>
                </div>
              </div>
              <div id="tab-cat2" class="tab_content">
                <div class="owl-carousel latest_category_tabs">
                  <?php
                  $ret=mysqli_query($con,"select * from products where category=1 and subCategory=2");
                  while ($row=mysqli_fetch_array($ret)) 
                  {
                    $discountstat=$row['productDiscount'];
                  ?>
                  <div class="product-thumb">
                    <div class="image"><a href="product.php?pid=<?php echo htmlentities($row['id']);?>"><img src="admin/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage1']);?>" data-echo="admin/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage1']);?>"  width="180" height="300" alt="" class="img-responsive" /></a></div>
                    <div class="caption">
                      <h4><a href="product.php?pid=<?php echo htmlentities($row['id']);?>"><?php echo htmlentities($row['productName']);?></a></h4>
                      <p class="price"> <span class="price-new">Rs. <?php echo htmlentities($row['productPrice']);?></span> <span class="price-old">Rs.<?php echo htmlentities($row['productPriceBeforeDiscount']);?></span>
                        <?php 
                        if ($discountstat == 0) {?>
                        
                        <?php } else {?>
                          <span class="saving">-<?php echo $row['productDiscount'];?>%</span>
                        <?php } ?>

                       </p>
                      <div class="rating"> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span> </div>
                    </div>
                    <div class="button-group">
                      <a href="index.php?page=product&action=add&id=<?php echo $row['id']; ?>"><button class="btn-primary" type="button" onClick=""><span>Add to Cart</span></button></a>
                      
                    </div>
                  </div>
                  <?php } ?>
                </div>
              </div>
              <div id="tab-cat3" class="tab_content">
                <div class="owl-carousel latest_category_tabs">
                  <?php
                  $ret=mysqli_query($con,"select * from products where category=1 and subCategory=3");
                  while ($row=mysqli_fetch_array($ret)) 
                  {
                    $discountstat=$row['productDiscount'];
                  ?>
                  <div class="product-thumb">
                    <div class="image"><a href="product.php?pid=<?php echo htmlentities($row['id']);?>"><img src="admin/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage1']);?>" data-echo="admin/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage1']);?>"  width="180" height="300" alt="" class="img-responsive" /></a></div>
                    <div class="caption">
                      <h4><a href="product.php?pid=<?php echo htmlentities($row['id']);?>"><?php echo htmlentities($row['productName']);?></a></h4>
                      <p class="price"> <span class="price-new">Rs. <?php echo htmlentities($row['productPrice']);?></span> <span class="price-old">Rs.<?php echo htmlentities($row['productPriceBeforeDiscount']);?></span>
                       <?php 
                        if ($discountstat == 0) {?>
                        
                        <?php } else {?>
                          <span class="saving">-<?php echo $row['productDiscount'];?>%</span>
                        <?php } ?>
                     </p>
                      <div class="rating"> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span> </div>
                    </div>
                    <div class="button-group">
                      <a href="index.php?page=product&action=add&id=<?php echo $row['id']; ?>"><button class="btn-primary" type="button" onClick=""><span>Add to Cart</span></button></a>
                     
                    </div>
                  </div>
                  <?php } ?>
                </div>
              </div>
              <div id="tab-cat4" class="tab_content">
                <div class="owl-carousel latest_category_tabs">
                  <?php
                  $ret=mysqli_query($con,"select * from products where category=1 and subCategory=4");
                  while ($row=mysqli_fetch_array($ret)) 
                  {
                    $discountstat=$row['productDiscount'];
                  ?>
                  <div class="product-thumb">
                    <div class="image"><a href="product.php?pid=<?php echo htmlentities($row['id']);?>"><img src="admin/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage1']);?>" data-echo="admin/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage1']);?>"  width="180" height="300" alt="" class="img-responsive" /></a></div>
                    <div class="caption">
                      <h4><a href="product.php?pid=<?php echo htmlentities($row['id']);?>"><?php echo htmlentities($row['productName']);?></a></h4>
                      <p class="price"> <span class="price-new">Rs. <?php echo htmlentities($row['productPrice']);?></span> <span class="price-old">Rs.<?php echo htmlentities($row['productPriceBeforeDiscount']);?></span> 
                        <?php 
                        if ($discountstat == 0) {?>
                        
                        <?php } else {?>
                          <span class="saving">-<?php echo $row['productDiscount'];?>%</span>
                        <?php } ?></p>
                      <div class="rating"> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span> </div>
                    </div>
                    <div class="button-group">
                      <a href="index.php?page=product&action=add&id=<?php echo $row['id']; ?>"><button class="btn-primary" type="button" onClick=""><span>Add to Cart</span></button></a>
                      
                    </div>
                  </div>
                  <?php } ?>
                </div>
              </div>
              <div id="tab-cat5" class="tab_content">
                <div class="owl-carousel latest_category_tabs">
                  <?php
                  $ret=mysqli_query($con,"select * from products where category=1 and subCategory=5");
                  while ($row=mysqli_fetch_array($ret)) 
                  {
                    $discountstat=$row['productDiscount'];
                  ?>
                  <div class="product-thumb">
                    <div class="image"><a href="product.php?pid=<?php echo htmlentities($row['id']);?>"><img src="admin/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage1']);?>" data-echo="admin/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage1']);?>"  width="180" height="300" alt="" class="img-responsive" /></a></div>
                    <div class="caption">
                      <h4><a href="product.php?pid=<?php echo htmlentities($row['id']);?>"><?php echo htmlentities($row['productName']);?></a></h4>
                      <p class="price"> <span class="price-new">Rs. <?php echo htmlentities($row['productPrice']);?></span> <span class="price-old">Rs.<?php echo htmlentities($row['productPriceBeforeDiscount']);?></span> 
                        <?php 
                        if ($discountstat == 0) {?>
                        
                        <?php } else {?>
                          <span class="saving">-<?php echo $row['productDiscount'];?>%</span>
                        <?php } ?>
                      </p>
                      <div class="rating"> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span> </div>
                    </div>
                    <div class="button-group">
                      <a href="index.php?page=product&action=add&id=<?php echo $row['id']; ?>"><button class="btn-primary" type="button" onClick=""><span>Add to Cart</span></button></a>
                      
                    </div>
                  </div>
                  <?php } ?>
                </div>
              </div>
              <div id="tab-cat6" class="tab_content">
                <div class="owl-carousel latest_category_tabs">
                 <?php
                  $ret=mysqli_query($con,"select * from products where category=1 and subCategory=6");
                  while ($row=mysqli_fetch_array($ret)) 
                  {
                    $discountstat=$row['productDiscount'];
                  ?>
                  <div class="product-thumb">
                    <div class="image"><a href="product.php?pid=<?php echo htmlentities($row['id']);?>"><img src="admin/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage1']);?>" data-echo="admin/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage1']);?>"  width="180" height="300" alt="" class="img-responsive" /></a></div>
                    <div class="caption">
                      <h4><a href="product.php?pid=<?php echo htmlentities($row['id']);?>"><?php echo htmlentities($row['productName']);?></a></h4>
                      <p class="price"> <span class="price-new">Rs. <?php echo htmlentities($row['productPrice']);?></span> <span class="price-old">Rs.<?php echo htmlentities($row['productPriceBeforeDiscount']);?></span> 

                       <?php 
                        if ($discountstat == 0) {?>
                        
                        <?php } else {?>
                          <span class="saving">-<?php echo $row['productDiscount'];?>%</span>
                        <?php } ?>
                      </p>
                      <div class="rating"> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span> </div>
                    </div>
                    <div class="button-group">
                      <a href="index.php?page=product&action=add&id=<?php echo $row['id']; ?>"><button class="btn-primary" type="button" onClick=""><span>Add to Cart</span></button></a>
                      
                    </div>
                  </div>
                  <?php } ?>
                </div>
              </div>
            </div>
          </div>
          <!-- Categories Product Slider End-->