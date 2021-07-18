<div class="marketshop-banner">
            <div class="row">
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <?php $query=mysqli_query($con,"select * from advertising where id=7");
                $cnt=1;
                while($row=mysqli_fetch_array($query))
                {?>

              	<a href="<?php echo htmlentities($row['link']);?>">
                  <?php 
                  $image=$row['image'];
                  if($image==""):?>
                    <img src="images/advertising/2-image/sample-banner.jpg" alt="<?php echo htmlentities($row['link']);?>" title="<?php echo htmlentities($row['link']);?>" >
                  <?php else:?>
                    <img src="images/advertising/2-image/<?php echo htmlentities($image);?>" alt="<?php echo htmlentities($row['link']);?>" title="<?php echo htmlentities($row['link']);?>" >
                  <?php endif;?>
              	</a>
              	</div><?php } ?>

              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <?php $query=mysqli_query($con,"select * from advertising where id=8");
                $cnt=1;
                while($row=mysqli_fetch_array($query))
                {?>

                <a href="<?php echo htmlentities($row['link']);?>">
                  <?php 
                  $image=$row['image'];
                  if($image==""):?>
                    <img src="images/advertising/2-image/sample-banner.jpg" alt="<?php echo htmlentities($row['link']);?>" title="<?php echo htmlentities($row['link']);?>" >
                  <?php else:?>
                    <img src="images/advertising/2-image/<?php echo htmlentities($image);?>" alt="<?php echo htmlentities($row['link']);?>" title="<?php echo htmlentities($row['link']);?>" >
                  <?php endif;?>
                </a>
                </div><?php } ?>


            </div>
          </div>          
