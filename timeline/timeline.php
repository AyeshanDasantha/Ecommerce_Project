<?php 
                          if(isset($_POST['submit']))
                          {
                            $trackcode=$_POST['trakingcode'];
                            $query=mysqli_query($con,"SELECT products.productName,orders.quantity,orders.orderStatus FROM orders join users ON users.id=orders.userId JOIN billaddres ON billaddres.uid=orders.userId JOIN products ON products.id =orders.productId where orderTrackingCode='$trackcode'");
                             while($row=mysqli_fetch_array($query)) 
                             {
                                $status = $row['orderStatus'];
                                //echo  $status;
                            
                                $orderplaced="Order placed";
                                $onreview="On review";
                                $ondelivey="On delivery";
                                $deliverd="Delivered";


                                if ($status == $orderplaced) {
                                     include('timeline/order-placed.php');
                                }
                                else if($status == $onreview)
                                {
                                    include('timeline/on-review.php');
                                }
                                else if($status == $ondelivey)
                                {
                                    include('timeline/on-delivery.php');
                                }
                                else if($status == $deliverd)
                                {
                                    include('timeline/deliverd.php');
                                }
                                else 
                                {
                                    include('timeline/not-process.php');
                                }
                               }
                               } 
                            ?>
                            <br>
                            <br>