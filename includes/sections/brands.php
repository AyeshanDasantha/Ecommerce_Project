<!-- Brand Logo Carousel Start-->
          <div id="carousel" class="owl-carousel nxt">
          	<?php
                  $ret=mysqli_query($con,"select * from brands");
                  while ($row=mysqli_fetch_array($ret)) 
                  {
                  ?>
            <div class="item text-center"> <a href="#">
            	<img src="images/brands/<?php echo htmlentities($row['brandImage']);?>" alt="Palm" class="img-responsive" /></a> 
            </div>
             <?php } ?>
          </div>
          <!-- Brand Logo Carousel End -->