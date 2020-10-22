<?php
//trieuau@gmail.com
$mail_host = "intern@rdbgroup.pl";
$mail_title = "[TATEE] Formularz kontaktowy - Comfort Residence";

define("MAIL_HOST", $mail_host);
define("MAIL_TITLE", $mail_title);

$name = "";
$email_from = "";
$message = "";
$phone = "";
$flat = '';
$financing = '';
$mail_body = "";
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
</head>
<body>
    <?php
    if (isset($_POST['name'])) {
    $name = $_POST['name'];
    $mail_body = "<h3>Imię: " . $name . "</h3>";
}


if (isset($_POST['email'])) {
    $email_from = $_POST['email'];
    $mail_body .= "<h3>Adres e-mail: " . $email_from . "</h3>";
}

if (isset($_POST['phone'])) {
    $phone = $_POST['phone'];
    $mail_body .= "<h3>Numer telefonu: </h3><p>" . $phone . "</p>";
}

if (isset($_POST['mieszkanie'])) {
    $phone = $_POST['mieszkanie'];
    $mail_body .= "<h3>Mieszkanie: </h3><p>" . $phone . "</p>";
}
if (isset($_POST['finansowanie'])) {
    $phone = $_POST['finansowanie'];
    $mail_body .= "<h3>Finansowanie: </h3><p>" . $phone . "</p>";
}

if (isset($_POST['message'])) {
    $message = nl2br($_POST['message']);
    $mail_body .= "<h3>Wiadomość: </h3><p>" . $message . "</p>";
}

?>
</body>
</html>

<?php

if( isset($_POST['name']) && isset($_POST['email']) && isset($_POST['message']) ){
    $headers = "From: $email_from\nMIME-Version: 1.0\nContent-type: text/html; charset=iso-8859-1\n";
    if( mail($email_from, $mail_title, $mail_body, $headers) ) {
        $serialized_data = '{"type":1, "message":"Contact form successfully submitted. Thank you, I will get back to you soon!"}';
        echo $serialized_data;
    } else {
        $serialized_data = '{"type":0, "message":"Contact form failed. Please send again later!"}';
        echo $serialized_data;
    }
};



?>