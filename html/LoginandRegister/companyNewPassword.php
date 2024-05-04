<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Create a New Password</title>
    <link rel="stylesheet" href="forgotPassword.css" />
    <script
      src="https://kit.fontawesome.com/f540fd6d80.js"
      crossorigin="anonymous"
    ></script>
  </head>

  <?php
    require '../../dbconnect.php';
    // ob_start();

    if (isset($_POST['change-password']) && $_SERVER['REQUEST_METHOD'] == 'POST') {

      if (isset($_GET['token'])) {
        $token = $_GET['token'];
      
        if (isset($_POST['password']) && isset($_POST['cpassword'])) {
          $password = htmlspecialchars($_POST['password']);
          $cpassword = htmlspecialchars($_POST['cpassword']);
        } else {
          echo "<script>alert('Error: Password and confirm-password are required.');</script>";
          // For further error handling or redirect the user as needed.
          exit;
        }

        if ($password === $cpassword) {
          $pass = password_hash($password, PASSWORD_DEFAULT);
          $cpass = password_hash($cpassword, PASSWORD_DEFAULT);

          $updatedata = "UPDATE `company` SET `pass`='$pass' WHERE `token` = '$token'";
          $smt = mysqli_query($conn, $updatedata);

          if ($smt) {
              echo"
              <script>
                alert('Your password has been updated.');
                document.location.href = 'companyLogin.php';
              </script>
              ";
              exit;
          } else {
              echo"
              <script>
                alert('Password reset failed. Please try again.');
                document.location.href = 'companyNewPassword.php';
              </script>
              ";
          }

        }else {
          echo  "<script>alert('Password are not matching.');</script>";
        }

      }else {
        echo  "<script>alert('No token found.');</script>";
      }

    }
  ?>

  <body>
    <div class="container">
      <div class="form">
        <form action="#" method="POST">
            <div class="forg-div-h2">
                <h2 class="forg-h2">New Password</h2>
            </div>

            <div id="foreye" class="forg-input1">
                <input id="password" class="form-control" type="password" name="password" placeholder="Create new password" onpaste="return false;" autocomplete="off" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" oninput="setCustomValidity('')" required/>
                <span class="eye-icon" onclick="togglePassword()">
                  <i class="far fa-eye"></i>
                </span>
            </div>

            <div class="forg-input2">
                <input id="password" class="form-control-mod" type="password" name="cpassword" placeholder="Confirm your password" onpaste="return false;" autocomplete="off" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" oninput="setCustomValidity('')" required/>
            </div>

            <div class="frog-btn">
                <button class="button" type="submit" name="change-password">Change</button>
            </div>  
        </form>
      </div>
    </div>

    <script src="../../javaScripts/theeye.js"></script>
    <script src="../../javaScripts/passvalidation.js"></script>
  </body>
</html>
