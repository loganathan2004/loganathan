<?php 

include 'config1.php';

$Name=$_POST['name'];
$Mail=$_POST['email'];
$Message=$_POST['message'];
$sql="INSERT INTO `webmail`(`Name`, `Mail`, `Message`) VALUES ('$Name','$Mail','$Message')" or die('query failed');

$res = mysqli_query($con,$sql) or die('not successfull');


?>