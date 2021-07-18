<?php
session_start();
error_reporting(0);
include('config/config.php');
$query=mysqli_query($con,"SELECT * FROM genaralsetting where id=8");
while($row=mysqli_fetch_array($query)) 
{
  $sitecurrency=$row['setting_description'];
}
$query=mysqli_query($con,"SELECT status FROM sitemaintenance where id=1");
while($row=mysqli_fetch_array($query)) 
{
$maintincestatus = $row['status'];
if($maintincestatus==1)
{
    header('location:Maintenance/index.php');
}
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<meta name="format-detection" content="telephone=no" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<?php $query=mysqli_query($con,"SELECT * FROM genaralsetting where id=9");
    while($row=mysqli_fetch_array($query)) 
    {
     ?>
  <meta name="description" content="<?php echo htmlentities($row['setting_description']);?>"><?php }?>
  <?php $query=mysqli_query($con,"SELECT * FROM genaralsetting where id=10");
    while($row=mysqli_fetch_array($query)) 
    {
     ?>
    <meta name="keywords" content="<?php echo htmlentities($row['setting_description']);?>"><?php }?>

    <?php $query=mysqli_query($con,"SELECT * FROM genaralsetting where id=11");
    while($row=mysqli_fetch_array($query)) 
    {
     ?>
     <link rel="shortcut icon" type="image/x-icon" href="images/favicon/<?php echo htmlentities($row['setting_description']);?>"/><?php }?>
  
  <?php $query=mysqli_query($con,"SELECT * FROM genaralsetting where id=1");
    while($row=mysqli_fetch_array($query)) 
    {
     ?>  
    <title><?php echo htmlentities($row['setting_description']);?></title><?php }?>
    <!-- CSS Part Start-->
    <link rel="stylesheet" type="text/css" href="js/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="css/font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="css/stylesheet.css" />
    <link rel="stylesheet" type="text/css" href="css/owl.carousel.css" />
    <link rel="stylesheet" type="text/css" href="css/owl.transitions.css" />
    <link rel="stylesheet" type="text/css" href="css/responsive.css" />
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans' type='text/css'>
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <link rel="stylesheet" href="css/timeline/style.css">

    <!-- CSS Part End-->
</head>
<body>


            <?php if($emptymsg){?><div class="alert alert-warning"><i class="fa fa-warning"></i><strong>ERROR</strong>:<?php echo htmlentities($emptymsg); ?> </div><?php } 
            else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
            
        <!--Middle Part End -->
              
                        <?php 
                            $oid=intval($_GET['oid']);
                            $query=mysqli_query($con,"SELECT orders.orderTrackingCode,users.firstname,users.lastname,users.email,users.contactno,billaddres.address1,billaddres.city,billaddres.region,countries.country_name,billaddres.postcode,orders.orderDate,SUM(products.productPrice+products.shippingCharge),orders.paymentMethod,products.productName,orders.quantity,orders.orderStatus FROM orders join users ON users.id=orders.userId JOIN billaddres ON billaddres.uid=orders.userId JOIN products ON products.id =orders.productId JOIN countries ON countries.id=users.country where orders.id='$oid'");
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
              <?php }}?>
              
               <?php 
                          
                            $oid=intval($_GET['oid']);
                            $query=mysqli_query($con,"SELECT products.productName,orders.quantity,orders.orderStatus FROM orders join users ON users.id=orders.userId JOIN billaddres ON billaddres.uid=orders.userId JOIN products ON products.id =orders.productId where orders.id='$oid'");
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
                                
                            ?>
                            
    


</br>
</br>
 <div class="panel-group" id="accordion">
                            <div class="panel panel-default">
                              <div class="panel-heading">
                                <h4 class="panel-title"><a data-parent="#accordion" data-toggle="collapse" class="accordion-toggle" href="#accordion-3">Order Tracking Details
                                <i class="fa fa-caret-down"></i></a></h4>
                              </div>
                              <div id="accordion-3">
                                <div class="panel-body">
                                    <div class="row">
                                      <div class="col-sm-6 col-md-3 col-lg-3">
                                         <?php 
                                        $ret = mysqli_query($con,"SELECT * FROM ordertrackhistory WHERE orderId='$oid'");
                                        $num=mysqli_num_rows($ret);
                                        if($num>0)
                                        {
                                        while($row=mysqli_fetch_array($ret))
                                              {
                                             ?>
                                            
                                            
                                            
                                              <tr height="20">
                                              <td class="fontkink1" ><b>At Date:</b></td>
                                              <td  class="fontkink"><?php echo $row['postingDate'];?></td>
                                              <td> | </td>
                                            </tr>
                                             <tr height="20">
                                              <td  class="fontkink1"><b>Status:</b></td>
                                              <td  class="fontkink"><?php echo $row['status'];?></td>
                                              <td> | </td>
                                            </tr>
                                             <tr height="20">
                                              <td  class="fontkink1"><b>Remark:</b></td>
                                              <td  class="fontkink"><?php echo $row['remark'];?></td>
                                                                                          </tr>

                                           
                                            <tr>
                                              <td colspan="2"><hr /></td>
                                            </tr>
                                           <?php } }
                                        else{
                                           ?>
                                           <tr>
                                           <td colspan="2">Order Not Process Yet</td>
                                           </tr>
                                           <?php  }
                                        $st='Delivered';
                                           $rt = mysqli_query($con,"SELECT * FROM orders WHERE id='$oid'");
                                             while($num=mysqli_fetch_array($rt))
                                             {
                                             $currrentSt=$num['orderStatus'];
                                           }
                                             if($st==$currrentSt)
                                             { ?>
                                           <tr><td colspan="2"><b>
                                              Product Delivered successfully </b></td>
                                           <?php } 
                                         
                                          ?>
                                       
                                    </div>
                                </div>
                              </div>
                            </div>
                             </div>

<br>



                        <?php 
                         
                            $oid=intval($_GET['oid']);
                            $query=mysqli_query($con,"SELECT products.productName,orders.quantity,orders.orderStatus FROM orders join users ON users.id=orders.userId JOIN billaddres ON billaddres.uid=orders.userId JOIN products ON products.id =orders.productId where orders.id='$oid'");
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
                        
                        <?php }?>


     
                       
         
<script type="text/javascript" src="js/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="js/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/jquery.easing-1.3.min.js"></script>
<script type="text/javascript" src="js/jquery.dcjqaccordion.min.js"></script>
<script type="text/javascript" src="js/owl.carousel.min.js"></script>
<script type="text/javascript" src="js/custom.js"></script>
<script src='https://www.google.com/recaptcha/api.js'></script>
<!-- JS Part End-->
</body>
</html>