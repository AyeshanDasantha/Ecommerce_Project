<?php 
                          if(isset($_POST['submit']))
                          {
                            $trackcode=$_POST['trakingcode'];
                            $query=mysqli_query($con,"SELECT orders.orderTrackingCode,users.firstname,users.lastname,users.email,users.contactno,billaddres.address1,billaddres.city,billaddres.region,countries.country_name,billaddres.postcode,orders.orderDate,SUM(products.productPrice+products.shippingCharge),orders.paymentMethod,products.productName,orders.quantity,orders.orderStatus FROM orders join users ON users.id=orders.userId JOIN billaddres ON billaddres.uid=orders.userId JOIN products ON products.id =orders.productId JOIN countries ON countries.id=users.country where orderTrackingCode='$trackcode'");
                             while($row=mysqli_fetch_array($query)) 
                             {
                                $status = $row['orderTrackingCode'];

                                if(empty($status))
                                {
                                    
                                }
                                else
                                {
                                   
                            ?>
    

                          <div class="panel-group" id="accordion">
                            <div class="panel panel-default">
                              <div class="panel-heading">
                                <h4 class="panel-title"><a data-parent="#accordion" data-toggle="collapse" class="accordion-toggle" href="#accordion-1">Order Summary
                                <i class="fa fa-caret-down"></i></a></h4>
                              </div>
                              <div id="accordion-1">
                                <div class="panel-body">
                                    <div class="row">
                                      <div class="col-sm-6 col-md-3 col-lg-3">
                                        <p><strong>Order Code : </strong></p>
                                        <p><strong>Customer : </strong></p>
                                        <p><strong>Email : </strong></p>
                                        <p><strong>Contact No : </strong></p>
                                      </div>
                                      <div class="col-sm-6 col-md-3 col-lg-3">
                                      
                                        <p><?php echo htmlentities($row['orderTrackingCode']);?></p>
                                        <p><?php echo htmlentities($row['firstname']);?> <?php echo htmlentities($row['lastname']);?></p>
                                        <p><?php echo htmlentities($row['email']);?></p>
                                        <p><?php echo htmlentities($row['contactno']);?></p>
                                        
                                      </div>
                                      <div class="col-sm-6 col-md-3 col-lg-3">
                                        <p><strong>Shipping address :  </strong></p>
                                        <p><strong>Order Date :  </strong></p>
                                        <p><strong>Total order amount :    </strong></p>
                                        <p><strong>Payment method :  </strong></p>
                                        
                                      </div>
                                      <div class="col-sm-6 col-md-3 col-lg-3">
                                        <p><?php echo htmlentities($row['address1']);?> , <?php echo htmlentities($row['city']);?> , <?php echo htmlentities($row['region']);?> , <?php echo htmlentities($row['country_name']);?> , <?php echo htmlentities($row['postcode']);?></p>
                                        <p><?php echo htmlentities($row['orderDate']);?></p>
                                        <p><?php echo $sitecurrency;?> <?php echo htmlentities($row['SUM(products.productPrice+products.shippingCharge)']);?></p>
                                        <p><?php echo htmlentities($row['paymentMethod']);?></p>
                                        
                                      </div>
                                    </div>
                                </div>
                              </div>
                            </div>
              <?php }}}?>