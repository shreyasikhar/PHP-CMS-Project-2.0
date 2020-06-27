<?php  
    use PHPMailer\PHPMailer\PHPMailer; 
    // use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
?>
<?php  include "includes/db.php"; ?>
<?php  session_start(); ?>
<?php include "admin/functions.php" ?>
<?php
    require './vendor/autoload.php';
    //On terminal write 
    //composer dump-autoload -o
    //to load all classes by using autoload.php

    if(!isset($_GET['forgot']))
    {
        redirect('/cms-theme');
    }
    if(ifItIsMethod('post'))
    {
        require 'PHPMailer/src/Exception.php';
        require 'PHPMailer/src/PHPMailer.php';
        require 'PHPMailer/src/SMTP.php';
        require 'classes/Config.php';
        $error='';
        if(empty($_POST['email']))
        {
            $error="*Email cannot be empty";
        }
        if(isset($_POST['email']))
        {
            $email = $_POST['email'];
            $length = 50;
            $token = bin2hex(openssl_random_pseudo_bytes($length));

            if(email_exists($email))
            {
                if($stmt = mysqli_prepare($connection, "update users set token = ? where user_email = ?"))
                {
                    mysqli_stmt_bind_param($stmt, "ss", $token, $email);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_close($stmt);

                    /*
                        Configure PHPMailer
                    */
                    $mail = new PHPMailer();
                    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      
                    //$mail->SMTPDebug = 2;                      
                    $mail->isSMTP();                                           
                    $mail->Host       = Config::SMTP_HOST;                    
                    $mail->Username   = Config::SMTP_USER;                    
                    $mail->Password   = Config::SMTP_PASSWORD; 
                    $mail->Port       = Config::SMTP_PORT;                              
                    $mail->SMTPSecure = 'ssl';           
                    $mail->SMTPAuth   = true;  
                    $mail->isHTML(true);  
                    $mail->CharSet = 'UTF-8'; 
                    
                    $mail->setFrom('enlectic@gmail.com', 'Blog Admin');
                    $mail->addAddress($email, "Blog User");
                    $mail->Subject = 'Reset your password';
                    $mail->Body = '<p>Please click to reset your password
                    <a href="http://localhost/cms-theme/reset.php?email='.$email.'&token='.$token.'">http://localhost/cms-theme/reset.php?email='.$email.'&token='.$token.'</a>
                    </p>';

                    if($mail->send())
                    {
                        $emailSent = true;
                    }
                    else
                    {
                        echo 'Not sent';
                    }

                }
                else
                {
                    echo "QUERY ERROR: ".mysqli_error($connection);
                }
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>CMS Blog | Forgot Password</title>

  <link rel="icon" href="images/blog.svg">

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block" style="padding: 9% 0 0 15%">
                <img class="img-fluid" src="images/icon3.svg" width="250px" height="250px">
              </div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h2 text-gray-900 mb-4">CMS Blog</h1>
                    <h2 class="h4 text-gray-900 mb-4">Forgot Your Password?</h2>
                    <p class="mb-4">We get it, stuff happens. Just enter your email address below and we'll send you a link to reset your password!</p>
                  </div>
                  <form class="user" method="post">
                    <div class="form-group">
                      <input type="email" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Email Address..." name="email">
                      <p class="text-danger"><?php if(isset($error)) echo $error; ?></p>
                    </div>
                    <button type="submit" class="btn btn-danger btn-user btn-block" name="reset">Reset Password</button>
                  </form>
                  <hr>
                  <div class="text-center">
                    <a class="small" href="registration.php">Create an Account!</a>
                  </div>
                  <div class="text-center">
                    <a class="small" href="login.php">Already have an account? Login!</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>
</body>

</html>
