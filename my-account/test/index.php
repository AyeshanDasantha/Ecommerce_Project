<?php
$myfile = fopen("newfile2.txt", "r") or die("Unable to open file!");
$txt = "John Doe\n";
fwrite($myfile, $txt);
fclose($myfile);
?>