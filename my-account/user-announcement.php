				
				<?php 
				$query=mysqli_query($con,"SELECT discription FROM user_announcement where id=1");
				while($row=mysqli_fetch_array($query)) 
				{
				?>
			<div class="alert alert-info alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <i class="fa fa-info-circle"></i>
             <?php echo htmlentities($row['discription']);?></div><?php } ?>
									