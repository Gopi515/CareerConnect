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
  <body>
    <div class="container">
      <div class="form">
        <form action="new-password.php" method="POST">
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
