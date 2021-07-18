<!-- Facebook Side Block Start -->
  <div id="facebook" class="fb-left sort-order-1">
    <div class="facebook_icon"><i class="fa fa-facebook"></i></div>
    <?php
                      $query=mysqli_query($con,"SELECT * from  sideblock where id=1");
                      while($row=mysqli_fetch_array($query))
                      {
                      ?>  
    <div class="fb-page" data-href="<?php echo  htmlentities($row['discription']);?>" data-small-header="true" data-adapt-container-width="true" data-hide-cover="true" data-show-facepile="true" data-show-posts="false">
      <div class="fb-xfbml-parse-ignore">
        <blockquote cite="<?php echo  htmlentities($row['discription']);?>"><a href="<?php echo  htmlentities($row['discription']);?>"><?php echo  htmlentities($row['name']);?></a></blockquote>
      </div><?php } ?>
    </div>
    <div id="fb-root"></div>
    <script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.4";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
  </div>
  <!-- Facebook Side Block End -->
  <!-- Twitter Side Block Start -->
  <div id="twitter_footer" class="twit-left sort-order-2">
    <div class="twitter_icon"><i class="fa fa-twitter"></i></div>
     <?php
                      $query=mysqli_query($con,"SELECT * from  sideblock where id=2");
                      while($row=mysqli_fetch_array($query))
                      {
                      ?>  
    <a class="twitter-timeline" href="<?php echo  htmlentities($row['discription']);?>" data-chrome="nofooter noscrollbar transparent" data-theme="light" data-tweet-limit="2" data-related="twitterapi,twitter" data-aria-polite="assertive" data-widget-id="347621595801608192">Tweets by @</a><?php } ?>
    <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
  </div>
  <!-- Twitter Side Block End -->
  <!-- Video Side Block Start -->
  <div id="video_box" class="vb-left sort-order-3">
    <div id="video_box_icon"><i class="fa fa-play"></i></div>
    <p>
        <?php
                      $query=mysqli_query($con,"SELECT * from  sideblock where id=3");
                      while($row=mysqli_fetch_array($query))
                      {
                      ?>  
      <iframe allowfullscreen="" src="<?php echo  htmlentities($row['discription']);?>" height="315" width="560"></iframe><?php } ?>
    </p>
  </div>
  <!-- Video Side Block End -->
  <!-- Custom Side Block Start -->
  <div id="custom_side_block" class="custom_side_block_left sort-order-4">
    <div class="custom_side_block_icon"> <i class="fa fa-chevron-right"></i> </div>
    <table>
      <tbody>
        <tr>
          <!-- <td><h2>CMS Blocks</h2></td> -->
        </tr>
        <tr>
          <td><?php
                      $query=mysqli_query($con,"SELECT * from  sideblock where id=4");
                      while($row=mysqli_fetch_array($query))
                      {
                      ?> 
            <?php $logophoto=$row['name'];
                          if($logophoto==""):
                          ?>
                          <img src="../images/sideblock/defult.jpg" width="330" height="120" >
                          <?php else:?>
                            <img src="../images/sideblock/<?php echo htmlentities($logophoto);?>" width="330" height="120" >

                          <?php endif;?>
          </td>
        </tr>
        <tr>
          <td><?php echo  htmlentities($row['discription']);?></td>
        </tr>
        <tr><?php } ?>
          
        </tr>
      </tbody>
    </table>
  </div>