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

    require '../profiles/admin/HelpDesk/PHPMailer/src/Exception.php';
    require '../profiles/admin/HelpDesk/PHPMailer/src/PHPMailer.php';
    require '../profiles/admin/HelpDesk/PHPMailer/src/SMTP.php';

    if (isset($_POST['check-email']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
      $email = htmlspecialchars($_POST['email']);

      $emailquery = "SELECT * FROM `teacher` WHERE `email` = '$email'";
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
            $mail->Body = "Hi, $username. Click here to reset your password
            http://localhost/CareerConnect/html/LoginandRegister/teacherNewPassword.php?token=$token";

            $mail->send();

            echo
                "
            <script>
                alert('Check your mail to reset your password $email');
                document.location.href = 'teacherLogin.php';
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
        <form action="#" method="POST">
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
