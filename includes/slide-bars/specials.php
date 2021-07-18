<?php 
$query=mysqli_query($con,"SELECT status FROM activestatus where id=1");
while($row=mysqli_fetch_array($query)) 
{

    $row = $row['status'];

    if ($row == 1) {
         include('includes/slide-bars/activatespecials.php');
    }
?>  
<?php }?>