<div class="slideshow single-slider owl-carousel">
            <div class="item"> <a href="#">
              <?php $query=mysqli_query($con,"select setting_description from genaralsetting where id=5");
                     while($row=mysqli_fetch_array($query)) 
                     {
                     ?>
                     <?php $banner=$row['setting_description'];
                          if($banner==""):
                          ?>
                          <img src="images/slider/banner-1.jpg"class="img-responsive" ></a>
                          <?php else:?>
                            <img src="images/slider/<?php echo htmlentities($banner);?>" class="img-responsive" ></a>

                          <?php endif;?><?php } ?>   
               </div>
            <div class="item"> <a href="#">
              <?php $query=mysqli_query($con,"select setting_description from genaralsetting where id=6");
                     while($row=mysqli_fetch_array($query)) 
                     {
                     ?>
                     <?php $banner=$row['setting_description'];
                          if($banner==""):
                          ?>
                          <img src="images/slider/banner-2.jpg"class="img-responsive" ></a>
                          <?php else:?>
                            <img src="images/slider/<?php echo htmlentities($banner);?>" class="img-responsive" ></a>

                          <?php endif;?><?php } ?>   
               </div>
            <div class="item"> <a href="#">
              <?php $query=mysqli_query($con,"select setting_description from genaralsetting where id=7");
                     while($row=mysqli_fetch_array($query)) 
                     {
                     ?>
                     <?php $banner=$row['setting_description'];
                          if($banner==""):
                          ?>
                          <img src="images/slider/banner-3.jpg"class="img-responsive" ></a>
                          <?php else:?>
                            <img src="images/slider/<?php echo htmlentities($banner);?>" class="img-responsive" ></a>

                          <?php endif;?><?php } ?>   
               </div>
          </div>