<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

if (isset($_POST["send"])) {
    try {
        $mail = new PHPMailer(true);

        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'careerconnect383@gmail.com'; // Your Gmail address
        $mail->Password = 'xnpkowctrjukzgcc'; // Your Gmail password (not recommended to hardcode it here)
        $mail->SMTPSecure = 'tls'; // Use TLS encryption
        $mail->Port = 587; // Use port 587 for TLS

        $mail->setFrom('careerconnect383@gmail.com'); // Your email address

        $mail->addAddress($_POST["email"]); // User's email address
        $mail->addAddress('careerconnect383@gmail.com');

        $mail->isHTML(true); // Set email format to HTML

        // Prepend custom message to the user's message
        $customMessage = "We have received your message. We will connect to you soon. This is the message you sent to us:<br><br>";
        $userMessage = $customMessage . $_POST["message"];

        $mail->Subject = $_POST["subject"];
        $mail->Body = $userMessage;

        $mail->send();

        echo
            "
        <script>
            alert('Message Sent Successfully');
            document.location.href = 'contactUs.php';
        </script>
        ";
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>