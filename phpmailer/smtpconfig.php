<?php
include('../config/config.php');

$query=mysqli_query($con,"SELECT * FROM emailsetting");
while($row=mysqli_fetch_array($query)) 
{
	$sendername=$row['senderName'];
	$server=$row['host'];
	$username=$row['username'];
	$password=$row['password'];
	$securetype=$row['secureType'];
	$port=$row['port'];

	$replyemail=$row['replyEmail'];
	$replyname=$row['replyName'];


	$mail->isSMTP();
	$mail->Host       = $server;                    
    $mail->SMTPAuth   = true;                                   
    $mail->Username   = $username;                     
    $mail->Password   = $password;                              
    $mail->SMTPSecure = $securetype;       
    $mail->Port       = $port; 

    $mail->setFrom($username, $sendername);
    $mail->addReplyTo($replyemail, $replyname);

}
?>