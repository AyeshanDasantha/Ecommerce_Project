<?php
session_start();
error_reporting(0);
include("../config/config.php");
$_SESSION['login']=="";

$ldate=$_SESSION['datetime'];
mysqli_query($con,"UPDATE userlog  SET logout = '$ldate' WHERE userEmail = '".$_SESSION['login']."' ORDER BY id DESC LIMIT 1");
session_unset();
$_SESSION['errmsg']="You have successfully logout";
?>
<script language="javascript">
document.location="../index.php";
</script>
