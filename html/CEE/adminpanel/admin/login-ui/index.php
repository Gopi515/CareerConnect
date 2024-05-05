<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Skill Test</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link
      rel="icon"
      type="login-ui/image/png"
      href="images/icons/favicon.ico"
    />
    <link
      rel="stylesheet"
      type="text/css"
      href="login-ui/vendor/bootstrap/css/bootstrap.min.css"
    />
    <link
      rel="stylesheet"
      type="text/css"
      href="login-ui/fonts/font-awesome-4.7.0/css/font-awesome.min.css"
    />
    <link
      rel="stylesheet"
      type="text/css"
      href="login-ui/fonts/Linearicons-Free-v1.0.0/icon-font.min.css"
    />
    <link
      rel="stylesheet"
      type="text/css"
      href="login-ui/vendor/animate/animate.css"
    />
    <link
      rel="stylesheet"
      type="text/css"
      href="login-ui/vendor/css-hamburgers/hamburgers.min.css"
    />
    <link
      rel="stylesheet"
      type="text/css"
      href="login-ui/vendor/select2/select2.min.css"
    />
    <link
      rel="stylesheet"
      type="text/css"
      href="login-ui/vendor/daterangepicker/daterangepicker.css"
    />
    <link rel="stylesheet" type="text/css" href="login-ui/css/util.css" />
    <link rel="stylesheet" type="text/css" href="login-ui/css/main.css" />
    <script
      src="https://kit.fontawesome.com/f540fd6d80.js"
      crossorigin="anonymous"
    ></script>
    <style>
      .login100-form-title::before {
        content: "";
        display: block;
        position: absolute;
        z-index: -1;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        background-color: #0081faa2;
      }
      .regallclosebtn {
        position: absolute;
        padding: 5px 20px;
        background-color: #0083fa;
        color: white;
        font-weight: 700;
        border-radius: 20%;
        font-size: 25px;
        cursor: pointer;
        transition: all 0.3s ease-in-out;
        border: 3px var white solid;
        margin-left: -100px;
        margin-top: -248px;
      }

      @media screen and (max-width: 768px) {
        .regallclosebtn {
          right: 24%;
        }
      }

      .regallclosebtn:hover {
        background-color: #16c9d5;
        border: 3px var white solid;
      }
    </style>
  </head>
  <body>
    <div class="limiter">
      <div class="container-login100">
         <a href="../../../../html/landingPage/landingTeacher.php"
        ><div class="regallclosebtn"><i class="fa-solid fa-caret-left"></i></div
      ></a>
        <div class="wrap-login100">
          <div
            class="login100-form-title"
            style="background-image: url(login-ui/images/bg-01.jpg)"
          >
            <span class="login100-form-title-1"> Sign In </span>
          </div>

          <form
            method="post"
            id="adminLoginFrm"
            class="login100-form validate-form"
          >
            <div
              class="wrap-input100 validate-input m-b-26"
              data-validate="Username is required"
            >
              <span class="label-input100">Username</span>
              <input
                class="input100"
                type="text"
                name="username"
                placeholder="Enter username"
              />
              <span class="focus-input100"></span>
            </div>

            <div
              class="wrap-input100 validate-input m-b-18"
              data-validate="Password is required"
            >
              <span class="label-input100">Password</span>
              <input
                class="input100"
                type="password"
                name="pass"
                placeholder="Enter password"
              />
              <span class="focus-input100"></span>
            </div>

            <div class="container-login100-form-btn" align="right">
              <button
                type="submit"
                class="login100-form-btn"
                style="background-color: #0083fa"
              >
                Login
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <script src="login-ui/vendor/jquery/jquery-3.2.1.min.js"></script>
    <script src="login-ui/vendor/animsition/js/animsition.min.js"></script>
    <script src="login-ui/vendor/bootstrap/js/popper.js"></script>
    <script src="login-ui/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="login-ui/vendor/select2/select2.min.js"></script>
    <script src="login-ui/vendor/daterangepicker/moment.min.js"></script>
    <script src="login-ui/vendor/daterangepicker/daterangepicker.js"></script>
    <script src="login-ui/vendor/countdowntime/countdowntime.js"></script>
    <script src="login-ui/js/main.js"></script>
  </body>
</html>
