<?php  
    use PHPMailer\PHPMailer\PHPMailer; 
    // use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
?>
<?php  include "includes/db.php"; ?>
<?php  session_start(); ?>
<?php include "admin/functions.php" ?>
<?php
    if(isset($_SESSION['username']))
    {
        header('location:/cms-theme/');
    }
    require './vendor/autoload.php';
?>
<?php
    // Setting language variables 
    if(isset($_GET['lang']) && !empty($_GET['lang']))
    {
        $_SESSION['lang'] = $_GET['lang'];

        if(isset($_SESSION['lang']) && $_SESSION['lang'] != $_GET['lang'])
        {
            echo "<script type='text/javascript'>location.reload();</script>";
        }
    }    
    if(isset($_SESSION['lang']))
    {
        include "includes/".$_SESSION['lang'].".php";
    }
    else
    {
        include "includes/en.php";
    }

    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        $fname = trim($_POST['fname']);
        $lname = trim($_POST['lname']);
        $username = trim($_POST['username']);
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);
        

        $error = [
            'username' => '',
            'email' => '',
            'password' => '',
            'fname' => '',
            'lname' => ''
        ];

        if(($fname) == '')
        {
            $error['fname'] = '*First Name cannot be empty';
        }
        if(($lname) == '')
        {
            $error['lname'] = '*Last Name cannot be empty';
        }
        if(strlen($username) < 4)
        {
            $error['username'] = '*Username needs to be longer';
        }
        if(($username) == '')
        {
            $error['username'] = '*Username cannot be empty';
        }
        if(username_exists($username))
        {
            $error['username'] = '*Username already exists, pick another one';
        }
        if(($email) == '')
        {
            $error['email'] = '*Email cannot be empty';
        }
        if(email_exists($email))
        {
            $error['email'] = '*Email already exists <a href="login.php">Please login</a>';
        }
        if(($password) == '')
        {
            $error['password'] = '*Password cannot be empty';
        }

        foreach($error as $key => $value)
        {
            if(empty($value))
            {
                unset($error[$key]);
            }
        } //foreach
        if(empty($error))
        {
            temp_register_user($fname, $lname, $username, $email, $password);
            $result = query("select otp from temp_users where user_email='$email'");
            $row = mysqli_fetch_array($result);
            $otpmail = $row['otp'];
            /*
                Configure PHPMailer
            */
            require 'PHPMailer/src/Exception.php';
            require 'PHPMailer/src/PHPMailer.php';
            require 'PHPMailer/src/SMTP.php';
            require 'classes/Config.php';
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
            $mail->Subject = 'Verify Email using OTP';
            $mail->Body = '<p style="background-color:#000; color:#fff;">Your OTP is '. $otpmail .'.<br/>Please click to enter OTP and verify email
            <a href="http://localhost/cms-theme/checkemail.php?email='.$email.'">http://localhost/cms-theme/checkemail.php?email='.$email.'</a>
            </p>';

            if($mail->send())
            {
                $emailSent = true;
                $success = "You will receive an OTP on your mail account for verification purpose only!";
            }
            else
            {
                echo 'Email send limit exceeded, try after sometime';
            }

            //header("location:checkemail.php?email='$email'");
            // login_user($_POST['username'], $_POST['password']);
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

  <title>CMS Blog | Registration</title>

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

    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-5 d-none d-lg-block" style="padding: 16% 0 0 12%">
            <img class="img-fluid" src="images/icon2.svg" width="250px" height="250px">
          </div>
          <div class="col-lg-7">
            <div class="p-5">
              <div class="text-center">
                    <h1 class="h2 text-gray-900 mb-4">CMS Blog</h1>
                    <h2 class="h4 text-gray-900 mb-4">Create an Account!</h2>
              </div>
              <b><p class="text-primary"><?php if(isset($success)) echo $success; ?></p></b>
              <form class="user" method="post">
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user" id="exampleFirstName" placeholder="First Name" name="fname">
                    <p class="text-danger"><?php echo isset($error['fname']) ? $error['fname'] : '' ?></p>
                  </div>
                  <div class="col-sm-6">
                    <input type="text" class="form-control form-control-user" id="exampleLastName" placeholder="Last Name" name="lname">
                    <p class="text-danger"><?php echo isset($error['lname']) ? $error['lname'] : '' ?></p>
                  </div>
                </div>
                <div class="form-group">
                  <input type="email" class="form-control form-control-user" id="exampleInputEmail" placeholder="Email Address" name="email">
                  <p class="text-danger"><?php echo isset($error['email']) ? $error['email'] : '' ?></p>
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user" id="exampleInputPassword" placeholder="Create Username" name="username">
                    <p class="text-danger"><?php echo isset($error['username']) ? $error['username'] : '' ?></p>
                  </div>
                  <div class="col-sm-6">
                    <input type="password" class="form-control form-control-user" id="exampleRepeatPassword" placeholder="Create Password" name="password">
                    <p class="text-danger"><?php echo isset($error['password']) ? $error['password'] : '' ?></p>
                  </div>
                </div>
                <button type="submit" class="btn btn-primary btn-user btn-block" name="registration">Register Account</button>
                <hr>
                <a href="#" class="btn btn-google btn-user btn-block">
                  <i class="fab fa-google fa-fw"></i> Register with Google
                </a>
                <a href="#" class="btn btn-facebook btn-user btn-block">
                  <i class="fab fa-facebook-f fa-fw"></i> Register with Facebook
                </a>
              </form>
              <hr>
              <div class="text-center">
                <a class="small" href="forgot.php?forgot=<?php echo uniqid(true); ?>">Forgot Password?</a>
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

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>
</body>

</html>
