 <div class="marketshop-banner">
            <div class="row">
              <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
              	<?php $query=mysqli_query($con,"select * from advertising where id=12");
                $cnt=1;
                while($row=mysqli_fetch_array($query))
                {?>

                <a href="<?php echo htmlentities($row['link']);?>">
                  <?php 
                  $image=$row['image'];
                  if($image==""):?>
                    <img src="images/advertising/3-image/sample-banner.jpg" alt="<?php echo htmlentities($row['link']);?>" title="<?php echo htmlentities($row['link']);?>" >
                  <?php else:?>
                    <img src="images/advertising/3-image/<?php echo htmlentities($image);?>" alt="<?php echo htmlentities($row['link']);?>" title="<?php echo htmlentities($row['link']);?>" >
                  <?php endif;?>
                </a>
                </div><?php } ?>

              <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
              	<?php $query=mysqli_query($con,"select * from advertising where id=13");
                $cnt=1;
                while($row=mysqli_fetch_array($query))
                {?>

                <a href="<?php echo htmlentities($row['link']);?>">
                  <?php 
                  $image=$row['image'];
                  if($image==""):?>
                    <img src="images/advertising/3-image/sample-banner.jpg" alt="<?php echo htmlentities($row['link']);?>" title="<?php echo htmlentities($row['link']);?>" >
                  <?php else:?>
                    <img src="images/advertising/3-image/<?php echo htmlentities($image);?>" alt="<?php echo htmlentities($row['link']);?>" title="<?php echo htmlentities($row['link']);?>" >
                  <?php endif;?>
                </a>
                </div><?php } ?>

              <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
              	<?php $query=mysqli_query($con,"select * from advertising where id=14");
                $cnt=1;
                while($row=mysqli_fetch_array($query))
                {?>

                <a href="<?php echo htmlentities($row['link']);?>">
                  <?php 
                  $image=$row['image'];
                  if($image==""):?>
                    <img src="images/advertising/3-image/sample-banner.jpg" alt="<?php echo htmlentities($row['link']);?>" title="<?php echo htmlentities($row['link']);?>" >
                  <?php else:?>
                    <img src="images/advertising/3-image/<?php echo htmlentities($image);?>" alt="<?php echo htmlentities($row['link']);?>" title="<?php echo htmlentities($row['link']);?>" >
                  <?php endif;?>
                </a>
                </div><?php } ?>
            </div>
          </div>