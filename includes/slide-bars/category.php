 <aside id="column-left" class="col-sm-3 hidden-xs">
          <h3 class="subtitle">Categories</h3>
          <div class="box-category">
            <ul id="cat_accordion">
              	<?php $sql=mysqli_query($con,"select id,categoryName  from category");
				while($row=mysqli_fetch_array($sql))
				{
			    ?>
           <li><a href="category.php?cid=<?php echo $row['id'];?>"><?php echo $row['categoryName'];?></a> <span class="up"></span>

           </li><?php }?>
              
          </div>