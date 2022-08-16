<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\SMTP;

    require __DIR__ . '/PHPMailer/src/Exception.php';
    require __DIR__ . '/PHPMailer/src/PHPMailer.php';
    require __DIR__ . '/PHPMailer/src/SMTP.php';

    $isSuccess = '';
    $msg = '';

    $subject = trim($_POST['message_title']);
    $name = trim($_POST['lead_name']);
    $email = trim($_POST['lead_email']);
    $phone = $_POST['lead_phone'];
    $message = $_POST['lead_message'];

    $marketing = $_POST['marketing-accept'];
    $marketing_val = $marketing == true ? 'TAK' : '';
    
    $form_page = $_POST['form_page'];

    $output = '';

    if($name && $email && $phone){
  		if(!filter_var($email, FILTER_VALIDATE_EMAIL))
  		{
        $isSuccess = false;
        $msg = 'Nieprawidłowy adres email. Spróbuj ponownie.';
      }
      else{

          $mail = new PHPMailer(true);
          $mail->CharSet = "UTF-8";
          $mail->isSMTP();                                      // Set mailer to use SMTP
          $mail->Host = 'smtp.dpoczta.pl';  // Specify main and backup SMTP servers
          $mail->SMTPAuth = true;                               // Enable SMTP authentication
          $mail->Username = 'noreply@comfortresidence.pl';                 // SMTP username
          $mail->Password = '8bzP8wPv8E';                           // SMTP password
          $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
          $mail->Port = 587;                                    // TCP port to connect to

          $mail->setFrom('noreply@comfortresidence.pl', 'Comfort Residence');
          $mail->addAddress('rw@rdbgroup.pl');     // Add a recipient
          $mail->addReplyTo($email, $name);
        //   $mail->addBcc($email);
          $mail->isHTML(true);                                  // Set email format to HTML

          $mail->Subject = $subject;
          $mail->Body    = 'Imię i nazwisko: ' . $name . ' <br />Email: ' . $email . ' <br />Telefon: ' . $phone;

          $output         = 'Imię i nazwisko: ' . $name . ' <br />';
          $output        .= 'Email: ' . $email . ' <br />';
          $output        .= 'Telefon: ' . $phone;

          if( isset( $message ) && $message ) {
            $output        .= ' <br /><br />Wiadomość: ' . $message;
          }

          if( isset( $marketing ) && $marketing ) {
            $output        .= ' <br /><br />Zgoda marketingowa: ' . $marketing_val;
          }

          $output        .= ' <br /><br />Wiadmość wysłana z formularza na stronie: ' . $form_page;

          $mail->Body    = $output;

          if(!$mail->send()) {
              echo 'Twoja wiadomość nie mogła zostać wysłana.';
              echo 'Kod błędu: ' . $mail->ErrorInfo;
          } else {
              $isSuccess = true;
              $msg = 'Dziękujemy, twoja wiadomość została wysłana i&nbsp;niedługo&nbsp;ktoś&nbsp;skontaktuje&nbsp;się&nbsp;z&nbsp;Tobą.';
          }
      }
    }
    else{
        $isSuccess = false;
        $msg = 'Uzupełnij wymagane pola zaznaczone *';
    }
    $data = array(
        'isSuccess' => $isSuccess,
        'msg' => $msg
    );

    echo json_encode($data);