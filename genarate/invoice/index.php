<?php
include('../InvoicePrinter.php');
include('../../config/config.php');
$invoice = new InvoicePrinter();
  /* Header Settings */
  $query=mysqli_query($con,"SELECT setting_description FROM genaralsetting where id=3");
  while($row=mysqli_fetch_array($query)) 
  {
     date_default_timezone_set($row['setting_description']);
     $currentTime = date( 'd-m-Y h:i:s A', time () );

  $invoice->setTimeZone($currentTime);
  $query=mysqli_query($con,"SELECT setting_description FROM genaralsetting where id=4");
  while($row=mysqli_fetch_array($query)) 
  {
    $logo=$row['setting_description'];
    $invoice->setLogo("../../images/logo/".$logo);
    $invoice->setColor("#007fff");
    $invoice->setType("Sale Invoice");

  $link=mysqli_query($con,"SELECT orderTrackingCode,DATE_FORMAT(orderDate,'%a %b %e %Y') as date,TIME_FORMAT(orderDate,'%h:%i %p') as time FROM orders where id='".$_GET['id']."'");
  while($row=mysqli_fetch_array($link))
  {
    $orderTrackingCode=$row['orderTrackingCode'];
    $orderdate=$row['date'];
    $ordertime=$row['time'];


    $invoice->setReference("INV-".$orderTrackingCode);
    $invoice->setDate($orderdate);
    $invoice->setTime($ordertime);
    // $invoice->setDue(date('M dS ,Y',strtotime('+3 months')));

    $link=mysqli_query($con,"SELECT * from contactusinfo");
    while($row=mysqli_fetch_array($link))
    {

    $shopname=$row['shopname'];
    $address=$row['address'];
    $telephoneno=$row['telephoneno'];
    $faxno=$row['faxno'];

    $invoice->setFrom(array("Seller Name",$shopname,$address,"Tel : ".$telephoneno,"Fax : ".$faxno));

    $link=mysqli_query($con,"SELECT users.firstname,users.lastname,billaddres.address1,billaddres.city,billaddres.region,countries.country_name,billaddres.postcode FROM `orders` JOIN users ON users.id= orders.userId JOIN billaddres ON billaddres.uid=users.id JOIN countries ON countries.id = users.country WHERE orders.id='".$_GET['id']."'");
    while($row=mysqli_fetch_array($link))
    {

    $firstname=$row['firstname'];
    $lastname=$row['lastname'];
    $address1=$row['address1'];
    $city=$row['city'];
    $region=$row['region'];
    $country=$row['country_name'];
    $postcode=$row['postcode'];

    $invoice->setTo(array("Purchaser Name",$firstname." ".$lastname,$address1,$city.",".$region.",".$postcode, $country));
    /* Adding Items in table */
    $invoice->addItem("Product (Item)","Price",6,0,580,0,3480);
    $link=mysqli_query($con,"SELECT products.productName,products.productPrice,products.shippingCharge,orders.quantity FROM `orders` JOIN products ON products.id =orders.productId WHERE orders.id='".$_GET['id']."'");
    while($row=mysqli_fetch_array($link))
    {
      $productName=$row['productName'];
      $productPrice=$row['productPrice'];
      $shippingCharge=$row['shippingCharge'];
      $quantity=$row['quantity'];

    $invoice->addItem($productName ,"Rs. ".$productPrice,4,0,645,0,2580);
    $invoice->addItem("Quantity","$quantity",4,0,645,0,2580);

    /* Add totals */
    $invoice->addTotal("Shipping",$shippingCharge);
    $invoice->addTotal("Total due",$productPrice+$shippingCharge,true);
    /* Set badge */ 
    $link=mysqli_query($con,"SELECT paymentStatus FROM `orders` WHERE id='".$_GET['id']."'");
    while($row=mysqli_fetch_array($link))
    {
      $paymentStatus=$row['paymentStatus'];
      if($paymentStatus==1)
      {
        $invoice->addBadge("Payment Paid");
      }
      else
      {
        $invoice->setColor("#FF0000");
        $invoice->addBadge("Payment Not Paid");
      }
      /* Add title */
      $invoice->addTitle("Important Notice");
      /* Add Paragraph */
      $invoice->addParagraph("No item will be replaced or refunded if you don't have the invoice with you. You can refund within 2 days of purchase.");
      /* Set footer note */
    $query=mysqli_query($con,"SELECT setting_description FROM genaralsetting where id=3");
    while($row=mysqli_fetch_array($query)) 
    {
    date_default_timezone_set($row['setting_description']);
    $currentTime = date( 'd-m-Y h:i:s A', time () );
  $invoice->setFooternote($currentTime);
    /* Render */
    $invoice->render('example1.pdf','I'); /* I => Display on browser, D => Force Download, F => local path save, S => return document path */
}}}}}}}}?>
