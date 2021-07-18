<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    // $mail->SMTPDebug = 1;             
    require 'smtpconfig.php';                             
    $mail->addAddress($email);     // Add a recipient
    $body='<!DOCTYPE html>
<html>
<head>
    <title></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    
</head>

<body style="background-color: #f4f4f4; margin: 0 !important; padding: 0 !important;">
<!-- HIDDEN PREHEADER TEXT -->
<div style="display: none; font-size: 1px; color: #fefefe; line-height: 1px; font-family: Lato, Helvetica, Arial, sans-serif; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden;"> We re thrilled to have you here! Get ready to dive into your new account. </div>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
    <!-- LOGO -->
    <tr>
        <td bgcolor="#3e7cb4" align="center">
            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                <tr>
                    <td align="center" valign="top" style="padding: 40px 10px 40px 10px;"> </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td bgcolor="#3e7cb4" align="center" style="padding: 0px 10px 0px 10px;">
            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                <tr>
                    <td bgcolor="#ffffff" align="center" valign="top" style="padding: 20px 20px 20px 20px; border-radius: 4px 4px 0px 0px; color: #111111; font-family:  Lato , Helvetica, Arial, sans-serif; font-size: 43px; font-weight: 400; letter-spacing: 4px; line-height: 48px;">
                        <h1 style="font-size: 43px; font-weight: 400; margin: 2;">Your order '.$status.'. 
                            </h1> <img src="'.$sitelink.'/images/logo/'.$logo.'" width="125" height="120" style="display: block; border: 0px;" />
                    </td>
                </tr>
            </table>
        </td>
    </tr>

    <tr>
        <td bgcolor="#f4f4f4" align="center" style="padding: 0px 10px 0px 10px;">
            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                <tr>
                    
                    <td bgcolor="#ffffff" align="left" style="padding: 20px 30px 40px 30px; color: #666666; font-family:  Lato, Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
                        <h2 style=" color: black;">Hi '.$fname.' '.$lname.'</h2>
                        <p style="margin: 0;">we received your order and your Tracking No '.$trackingcode.' and are your order '.$status.' now.we Well email you an update .</p>

                        <p><b>Order Remark : </b> '.$remark.'</p>
                       
                    </td>
                </tr>
               
                <tr>
                    <td bgcolor="#ffffff" align="left">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td bgcolor="#ffffff" align="center" style="padding: 20px 30px 60px 30px;">
                                    <table border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td align="center" style="border-radius: 3px;" bgcolor="#3e7cb4"><a href="'.$sitelink.'/genarate/invoice/index.php?id='.$orderid.'" target="_blank" style="font-size: 20px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; text-decoration: none; color: #ffffff; text-decoration: none; padding: 15px 25px; border-radius: 2px; border: 1px solid #3cbeb2; display: inline-block;">Order Invoice</td>
                                        </tr>

                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                     <tr>
                <td class="esd-structure es-p15t es-p10b es-p10r es-p10l" style="background-color: #ffffff;" esd-general-paddings-checked="false" bgcolor="#f8f8f8" align="left">
                    <table width="100%" cellspacing="0" cellpadding="0">
                        <tbody>
                            <tr>
                                <td class="esd-container-frame" width="580" valign="top" align="center">
                                    <table width="100%" cellspacing="0" cellpadding="0">
                                        <tbody>
                                            <tr>
                                                <td class="esd-block-text" align="center">
                                                    <h2 style="color: #191919;">Items ordered<br></h2>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <td class="esd-structure es-p25t es-p5b es-p20r es-p20l" esd-general-paddings-checked="false" style="background-color: #ffffff;" bgcolor="#f8f8f8" align="left">
                    <!--[if mso]><table width="560" cellpadding="0" cellspacing="0"><tr><td width="270" valign="top"><![endif]-->
                    <table class="es-left" cellspacing="0" cellpadding="0" align="left">
                        <tbody>
                            <tr>
                                <td class="es-m-p20b esd-container-frame" width="270" align="left">
                                    <table width="100%" cellspacing="0" cellpadding="0">
                                        <tbody>
                                            <tr>
                                                <td class="esd-block-image" align="center" style="font-size:0">
                                                    <img class="adapt-img" src="'.$sitelink.'/admin/productimages/'.$productid.'/'.$productimage.'" alt="item"  width="103" alt></a></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <!--[if mso]></td><td width="20"></td><td width="270" valign="top"><![endif]-->
                    <table class="es-right" cellspacing="0" cellpadding="0" align="right">
                        <tbody>
                            <tr>
                                <td class="esd-container-frame" width="270" align="left">
                                    <table width="100%" cellspacing="0" cellpadding="0">
                                        <tbody>
                                            <tr>
                                                <td class="esd-block-text" align="left">
                                                    <p><span style="font-size:16px;"><strong style="line-height: 150%;">'.$productname.'</strong></span></p>
                                                   
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="esd-block-text es-p20t" align="left">
                                                    <p><span style="font-size:15px;"><strong style="line-height: 150%;">Item Price:</strong>Rs. '.$productprice.'</span></p>
                                                    <p><span style="font-size:15px;"><strong>Qty: </strong>'.$qty.'</span></p>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <!--[if mso]></td></tr></table><![endif]-->
                </td>
            </tr>
            <tr>
                <td class="esd-structure es-p10t es-p10b es-p10r es-p10l" style="background-color: #ffffff;" esd-general-paddings-checked="false" bgcolor="#f8f8f8" align="left">
                    <table width="100%" cellspacing="0" cellpadding="0">
                        <tbody>
                            <tr>
                                <td class="esd-container-frame" width="580" valign="top" align="center">
                                    <table width="100%" cellspacing="0" cellpadding="0">
                                        <tbody>
                                            <tr>
                                                <td class="esd-block-spacer es-p20t es-p20b es-p10r es-p10l" bgcolor="#f8f8f8" align="center" style="font-size:0">
                                                    <table width="100%" height="100%" cellspacing="0" cellpadding="0" border="0">
                                                        <tbody>
                                                            <tr>
                                                                <td style="border-bottom: 1px solid #191919; background: rgba(0, 0, 0, 0) none repeat scroll 0% 0%; height: 1px; width: 100%; margin: 0px;"></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="esd-block-text es-p15b" align="center">
                                                    <table class="cke_show_border" width="240" height="101" cellspacing="1" cellpadding="1" border="0">
                                                        <tbody>
                                                            <tr>
                                                                <td><strong>Subtotal:</strong></td>
                                                                <td style="text-align: right;">Rs. '.$subtot.'</td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>Shipping:</strong></td>
                                                                <td style="text-align: right;">Rs. '.$shippingfee.'</td>
                                                            </tr>
                                                            
                                                            <tr>
                                                                <td><span style="font-size: 18px; line-height: 200%;"><strong>Order Total:</strong></span></td>
                                                                <td style="text-align: right;"><span style="font-size: 18px; line-height: 200%;"><strong>Rs. '.$tot.'</strong></span></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                                                <td class="esd-block-spacer es-p20t es-p20b es-p10r es-p10l" bgcolor="#f8f8f8" align="center" style="font-size:0">
                                                    <table width="100%" height="100%" cellspacing="0" cellpadding="0" border="0">
                                                        <tbody>
                                                            <tr>
                                                                <td style="border-bottom: 1px solid #191919; background: rgba(0, 0, 0, 0) none repeat scroll 0% 0%; height: 1px; width: 100%; margin: 0px;"></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
            <tr>
                <td class="esd-structure es-p15t es-p10b es-p10r es-p10l" style="background-color: #ffffff;" esd-general-paddings-checked="false" bgcolor="#eeeeee" align="left">
                    <table width="100%" cellspacing="0" cellpadding="0">
                        <tbody>
                            <tr>
                                <td class="esd-container-frame" width="580" valign="top" align="center">
                                    <table width="100%" cellspacing="0" cellpadding="0">
                                        <tbody>
                                            <tr>
                                                <td class="esd-block-text" align="center">
                                                    <h2 style="color: #191919;">Order & shipping info</h2>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <td class="esd-structure es-p10t es-p30b es-p20r es-p20l" esd-general-paddings-checked="false" style="background-color: #ffffff;" bgcolor="#eeeeee" align="left">
                    <!--[if mso]><table width="560" cellpadding="0" cellspacing="0"><tr><td width="270" valign="top"><![endif]-->
                    <table class="es-left" cellspacing="0" cellpadding="0" align="left">
                        <tbody>
                            <tr>
                                <td class="es-m-p20b esd-container-frame" width="270" align="left">
                                    <table width="100%" cellspacing="0" cellpadding="0">
                                        <tbody>
                                            <tr>
                                                <td class="esd-block-text es-p10t es-p10b" align="left">
                                                    <h3 style="color: #242424;">&nbsp; Order details</h3>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="esd-block-text" align="left">
                                                    <p><strong>&nbsp; Order Tracking No:</strong> '.$trackingcode.'</p>
                                                    <p><strong>&nbsp; Order date:</strong> '.$orderdate.'</p>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <!--[if mso]></td><td width="20"></td><td width="270" valign="top"><![endif]-->
                    <table class="es-right" cellspacing="0" cellpadding="0" align="right">
                        <tbody>
                            <tr>
                                <td class="esd-container-frame" width="270" align="left">
                                    <table width="100%" cellspacing="0" cellpadding="0">
                                        <tbody>
                                            <tr>
                                                <td class="esd-block-text es-p10t es-p10b" align="left">
                                                    <h3 style="color: #242424;">Shipping Address</h3>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="esd-block-text" align="left">
                                                    <p>'.$fname.' '.$lname.'<strong></strong></p>
                                                    <p>'.$address.', '.$city.', '.$region.'</p>
                                                    <p>'.$country.','.$postcode.'<br></p>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <!--[if mso]></td></tr></table><![endif]-->
                </td>
            </tr>
           

                <tr>
                    <td bgcolor="#ffffff" align="left" style="padding: 0px 30px 20px 30px; color: #666666; font-family:  Lato , Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
                        <p style="margin: 0;">If you have any questions, just reply to this email—we re always happy to help out.</p>
                    </td>
                </tr>
                <tr>
                    <td bgcolor="#ffffff" align="left" style="padding: 0px 30px 40px 30px; border-radius: 0px 0px 4px 4px; color: #666666; font-family:  Lato , Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
                        <p style="margin: 0;">Thanks for choosing our service,<br>'.$sitename.'</p>
                    </td>
                </tr>
            </table>
        </td>
    </tr>

    <tr>
        <td bgcolor="#f4f4f4" align="center" style="padding: 30px 10px 0px 10px;">
            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                <tr>
                    <td bgcolor="#9fccf5" align="center" style="padding: 30px 30px 30px 30px; border-radius: 4px 4px 4px 4px; color: #666666; font-family:  Lato , Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
                        <h2 style="font-size: 20px; font-weight: 400; color: #111111; margin: 0;"><a href="'.$sitelink.'/contact-us.php">Need more help?<?a></h2>
                        <p style="margin: 0;"><a href="#" target="_blank" style="color: #3e7cb4;">We’re here to help you out</a></p>
                    </td>
                </tr>
            </table>
        </td>
    </tr>

    <tr>
        <td bgcolor="#f4f4f4" align="center" style="padding: 0px 10px 0px 10px;">
            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                <tr>
                    <td bgcolor="#f4f4f4" align="left" style="padding: 0px 30px 30px 30px; color: #666666; font-family:  Lato , Helvetica, Arial, sans-serif; font-size: 14px; font-weight: 400; line-height: 18px;"> <br>
                       
                    </td>
                </tr>
            </table>
            
        </td>
    </tr>
</table>
</body>

</html>';
    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Your order is confirmed.';
    $mail->Body    = $body;
    $mail->AltBody = strip_tags($body);

    $mail->send();
    $msg =  'Your One Time Password has been sent to your email id';
} catch (Exception $e) {
    $errormsg = "Failed to Recover your password, try again";
}