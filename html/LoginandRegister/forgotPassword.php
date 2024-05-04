<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Forgot Password</title>
    <link rel="stylesheet" href="forgotPassword.css" />
  </head>
  <?php
    require '../../dbconnect.php';
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require 'phpmailer/src/Exception.php';
    require 'phpmailer/src/PHPMailer.php';
    require 'phpmailer/src/SMTP.php';

    if (isset($_POST['check-email']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
      $email = htmlspecialchars($_POST['email']);

      $emailquery = "SELECT * FROM `student` WHERE `email` = '$email'";
        $result = mysqli_query($conn, $emailquery);
        $count = mysqli_num_rows($result);

        if ($count > 0) {
            $userdata = mysqli_fetch_assoc($result);
            $username = $userdata['user_name'];
            $token = $userdata['token'];

            $mail = new PHPMailer(true);

            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'careerconnect383@gmail.com';
            $mail->Password = 'xnpkowctrjukzgcc';
            $mail->SMTPSecure = 'tls'; // Use TLS encryption
            $mail->Port = 587; // Use port 587 for TLS

            $mail->setFrom('careerconnect383@gmail.com');

            $mail->addAddress($email);

            $mail->isHTML(true);

            $mail->Subject = "Password Reset";
            $mail->Body = "Hi, $username. Click here too reset your password
            http://localhost/CareerConnect/html/LoginandRegister/newPassword.php";

            $mail->send();

            echo
                "
            <script>
                alert('Check your mail to reset your password $email');
                document.location.href = 'studentLogin.php';
            </script>
            ";
        }else {
            echo
                "
            <script>
                alert('Please enter a valid email.');
            </script>
            ";
        }
    }
  ?>
  <body>
    <div class="container">
      <div class="form">
        <form action="forgot-password.php" method="POST">
            <h2 class="forg-h2">Forgot Password</h2>
            <p class="forg-p">Enter your email address</p>
            <div>
                <input class="form-control-mod" type="email" name="email" placeholder="Enter email address" required/>
            </div>
            <div class="frog-btn">
                <button class="button" type="submit" name="check-email">Continue</button>
            </div>
        </form>
      </div>
    </div>
  </body>
</html>
