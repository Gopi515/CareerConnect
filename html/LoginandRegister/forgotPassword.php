<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Forgot Password</title>
    <link rel="stylesheet" href="forgotPassword.css" />
  </head>
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
