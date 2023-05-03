<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;

use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';
include 'config.php';

if (isset($_POST['send'], $_POST['name'], $_POST['email'], $_POST['checkin'], $_POST['checkout'], $_POST['room'], $_POST['guest']))
    $mail = new PHPMailer(true);

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';                       // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = '';             // SMTP username
$mail->Password = '';              // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;
// TCP port to connect to

$email = $_POST['email'];
// Recipients
$mail->setFrom('', 'Regency Online Booking');
$mail->addAddress($email);     // Add a recipient
// $mail->addReplyTo('fintechgie@gmail.com', 'fintechgie');

$name = $_POST['name'];
$email = $_POST['email'];
$checkin = $_POST['checkin'];
$checkout = $_POST['checkout'];
$category ="Standard";
$approval ="nope";

$sql ="INSERT INTO `applicants`(`name`, `email`, `checkin`, `checkout`, `category`, `approval`) VALUES ('$name', '$email', '$checkin', '$checkout','$category','$approval')";
$result = mysqli_query($conn,$sql);



// Content
// ob_start();
// include 'standard_template.php';
// $email_template = ob_get_clean();

$mail->isHTML(true);                                  // Set email format to HTML
$mail->Subject = 'Thank you for your registration!';
$mail->Body    = '"<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>Document</title>
</head>
<body style="background-color: whitesmoke;">


   
<br>
    <p style="text-align: center; font-family: Arial, Helvetica, sans-serif;">Thank you for choosing The Regencyinn Hotel, Chennai,Part of the LifeStyle Collection of Preferred Hotels & Resorts for your upcoming visit.To view,change,or cancel your reservation <a href="">please Click Here</a></p>
    <div class="container border border-success" style="margin-top: 30px ;"> Checkin-Date:  "'.$checkin.' <br> Customer Name:"'.$name.'<br> Check-out:'.$checkout.'<div class="row py-2">
    <h3 style="font-family: "Franklin Gothic Medium", "Arial Narrow", Arial, sans-serif;">Reservation Confirmation</h3>
</div>
<div class="row border ">
    <p style="font-family:"Segoe UI", Tahoma, Geneva, Verdana, sans-serif;">Reservation Confirmation on Executive Room</p>
</div>
<div class="row py-2">
    <div class="col-md-4">
       <p></p>
       <p></p>
    </div>
    <div class="col-md-4">
        
    </div>
</div>
<div class="row py-3">
    <div class="col">
        <h6>Poilicies</h6>
        <p>All Bookings must be guranteed by credit card or advance payment. All major cards are accepted. 1night sale of room taxes will be taken, anytime after 12 pm<br> of the arrival date.Any cancellations within 24 hrs of arrival time will attract one night retention fee all bookings must be guaranteed bt credit card or advance payment.</p>
        <br>
        <p>Hotel does not allow unmarried/unrelated couples to check in.This is at full discretion of the management.No Refund would be applicable in case the hotel denies check in under such circumstances.Reservations booked via online,unless cancelled or amended through the booking source will be charged as per the booking clause.<strong> night room and taxes will be charged on the credit card details provided upon reservation.Hotel does not hold any non-guaranteed reservation</strong></p>
        <br>
        <p>For Foreign nationals Original Passport and visa is mandatory upon check in and photocopies are not a valid proof of document</p>
        <p><strong>Any Special requests are subject to availability,like smoking/twin bed rooms.The total amount of your stay to be paid upon check-in at front desk by mode of cash/debit or credit card.</strong></p>
    </div>

</div>

</div>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>"';
$mail->AltBody = '';
$mail->AddCC('');
$result = $mail->send();

if ($result) {

    echo
    "
<script>
alert('Thank You! Your appoinment has been confirmed by our Representative within a day.');
document.location.href = 'index.php';
</script>
";
}
