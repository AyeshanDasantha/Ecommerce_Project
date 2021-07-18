            <?php
			$query=mysqli_query($con,"SELECT * FROM customcontent where id=1");
			while($row=mysqli_fetch_array($query))
			{
			?>	
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