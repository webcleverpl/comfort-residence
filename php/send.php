<?php if (!$_POST) exit;

$to	= "intern@rdbgroup.pl";

$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$subject = $_POST['subject'];
$msg = $_POST['message'];


$subject 	= "Citrus : HTML Template - ( $subject )  You've been contacted by $name";

$content 	= "$name sent you a message from your enquiry form:\r\n\n";
$content   .= "Contact Reason: $msg \n\nEmail: $email \n\nPhone: $phone \n\n";

if(@mail($to, $subject, $content, "From: $email \r\n Reply-To: $email \r\nReturn-Path: $email\r\n")) {
    echo "<h5 class='success'>Wiadomość Wysłana</h5>";
    echo "<br/><p class='success'>Dziękujemy <strong>$name</strong>, twoja wiadomość została wysłana i niedługo ktoś skontaktuje się z tobą.</p>";
}else{
    echo "<h5 class='failure'>Przepraszamy, prosimy spróbować ponownie.</h5>";
}
?>