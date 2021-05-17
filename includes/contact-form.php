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
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-K6VMCF6');</script>
<!-- End Google Tag Manager -->
    <meta charset="UTF-8">
</head>
<body>
  <!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-K6VMCF6"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
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