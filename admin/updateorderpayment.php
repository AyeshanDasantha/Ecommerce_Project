<?php
session_start();

include_once '../config/config.php';
if(strlen($_SESSION['alogin'])==0)
  { 
header('location:index.php');
}
else{
$oid=intval($_GET['oid']);
if(isset($_POST['submit2'])){
$paystatus=$_POST['paystatus'];//space char

$sql=mysqli_query($con,"update orders set paymentStatus='$paystatus' where id='$oid'");
echo "<script>alert('Order updated sucessfully...');</script>";
//}
}

 ?>
<script language="javascript" type="text/javascript">
function f2()
{
window.close();
}ser
function f3()
{
window.print(); 
}
</script>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Update Order Payment!</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="anuj.css" rel="stylesheet" type="text/css">
</head>
<body>

<div style="margin-left:50px;">
 <form name="updateticket" id="updateticket" method="post"> 
<table width="100%" border="0" cellspacing="0" cellpadding="0">

    <tr height="50">
      <td colspan="2" class="fontkink2" style="padding-left:0px;"><div class="fontpink2"> <b>Update Order Payment!</b></div></td>
      
    </tr>
    <tr height="30">
      <td  class="fontkink1"><b>order Id:</b></td>
      <td  class="fontkink"><?php echo $oid;?></td>
    </tr>

   
    <?php 
                $ret = mysqli_query($con,"SELECT paymentStatus FROM orders WHERE id='$oid'");
                while($row=mysqli_fetch_array($ret))
                {
                  $paymentStatus=$row['paymentStatus'];
                ?>
                <?php 
                        $paymentStatus=$row['paymentStatus'];
                        if($paymentStatus==1)
                          {
                            ?>
                            

                            <?php } 
                        else {?>
                          <tr height="50">
                                <td class="fontkink1">Payment Status: </td>
                                <td  class="fontkink"><span class="fontkink1" >
                                  <select name="paystatus" class="fontkink"  >
                                    <option value="">Select Payment Status</option>
                                          <option value="1">Paid</option>
                                          <option value="0">Up Paid</option>
                                        </select>
                                  </span></td>
                              </tr>
                          

                        <?php } }?>

     
    <tr>
      <td class="fontkink1">&nbsp;</td>
      <td  >&nbsp;</td>
    </tr>
    <tr>
      <td class="fontkink">       </td>
      <td  class="fontkink"> <input type="submit" name="submit2"  value="update"   size="40" style="cursor: pointer;" /> &nbsp;&nbsp;   
      <input name="Submit2" type="submit" class="txtbox4" value="Close this Window " onClick="return f2();" style="cursor: pointer;"  /></td>
    </tr>

</table>
 </form>
</div>

</body>
</html>
<?php } ?>

     