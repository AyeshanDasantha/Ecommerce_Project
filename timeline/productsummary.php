<?php 
                          if(isset($_POST['submit']))
                          {
                            $trackcode=$_POST['trakingcode'];
                            $query=mysqli_query($con,"SELECT products.productName,orders.quantity,orders.orderStatus FROM orders join users ON users.id=orders.userId JOIN billaddres ON billaddres.uid=orders.userId JOIN products ON products.id =orders.productId where orderTrackingCode='$trackcode'");
                             while($row=mysqli_fetch_array($query)) 
                             {
                                $status = $row['orderStatus'];
                            ?>
                          <div class="panel-group" id="accordion">
                          <div class="panel panel-default">
                            <div class="panel-heading">
                              <h4 class="panel-title"><a data-parent="#accordion" data-toggle="collapse" class="accordion-toggle" href="#accordion-2">Product Summary
                              <i class="fa fa-caret-down"></i></a></h4>
                            </div>
                            <div id="accordion-2">
                              <div class="panel-body">
                                  <div class="row">
                                    <div class="col-sm-6 col-md-3 col-lg-3">
                                      <p><strong>Product Name : </strong></p>
                                      <p><strong>Quantity : </strong></p>
                                     
                                    </div>
                                    <div class="col-sm-6 col-md-3 col-lg-3">
                                      <p><?php echo htmlentities($row['productName']);?></p>
                                       <p><?php echo htmlentities($row['quantity']);?></p>
                                      
                                    </div>
                                    
                                  </div>
                              </div>
                            </div>
                          </div>
                        </div>

                        <?php }}?>