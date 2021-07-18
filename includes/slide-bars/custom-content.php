<div class="list-group">
            <h3 class="subtitle">Custom Content</h3>
            <?php
			$query=mysqli_query($con,"SELECT * FROM customcontent where id=1");
			while($row=mysqli_fetch_array($query))
			{
			?>	
            <p><?php echo $row['text'];?></p>
          </div>
          <div class="banner owl-carousel">
            <div class="item"> <a href="#">
            	<?php $banner=$row['image'];
				if($banner==""):
				?>
				<img src="images/custom/small-banner1-265x350.jpg" class="img-responsive" />
				<?php else:?>
				<img src="images/custom/<?php echo htmlentities($banner);?>" class="img-responsive">
				<?php endif;?>


            </a> </div>
            <div class="item"> <a href="#">
            	<?php $banner=$row['image2'];
				if($banner==""):
				?>
				<img src="images/custom/small-banner1-265x350.jpg" class="img-responsive" />
				<?php else:?>
				<img src="images/custom/<?php echo htmlentities($banner);?>" class="img-responsive">
				<?php endif;?>
            </a> </div>
          </div>
          <?php } ?>