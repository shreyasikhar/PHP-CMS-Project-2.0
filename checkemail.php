<?php  include "includes/db.php"; ?>
<?php  session_start(); ?>
<?php include "admin/functions.php" ?>
<?php
    if(isset($_SESSION['username']))
    {
        header('location:/');
    }
    if(!isset($_GET['email']))
    {
        header('location:/');
    }
    require './vendor/autoload.php';
?>
<?php
    if(isset($_GET['email']))
    {
        $email = $_GET['email'];
    }
    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        $otp = trim($_POST['otp']);

        $error = [
            'otp' => ''
        ];

        if(($otp) == '')
        {
            $error['otp'] = 'OTP cannot be empty';
        }
        $result = query("select * from temp_users where user_email='$email'");
        $row = mysqli_fetch_array($result);
        $db_fname = $row['user_firstname'];
        $db_lname = $row['user_lastname'];
        $db_email = $row['user_email'];
        $db_username = $row['username'];
        $db_password = $row['user_password'];
        $db_otp = $row['otp'];
        if($db_otp != $otp)
        {
            $error['otp'] = '*Wrong OTP entered';
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
            // login_user($_POST['username'], $_POST['password']);
            query("update temp_users set flag = 1 where user_email='$email'");
            register_user($db_fname, $db_lname, $db_username, $db_email, $db_password);
            $result = query("select user_id from users where user_email='$db_email'");
            $row = mysqli_fetch_array($result);
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['username'] = $db_username;
            $_SESSION['firstname'] = $db_fname;
            $_SESSION['lastname'] = $db_lname;
            $_SESSION['user_role'] = 'subscriber';
            $_SESSION['user_email'] = $db_email;
            header("location:admin/");
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

  <title>CMS Blog | Verify Email</title>

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
              <div class="col-lg-6 d-none d-lg-block" style="padding: 5% 0 0 14.5%">
              <img class="img-fluid" src="images/icon5.svg" width="250px" height="250px">
              </div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Verify Email</h1>
                  </div>
                  <form class="user" method="post">
                    <div class="form-group">
                      <input type="text" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" name="otp" placeholder="Enter OTP">
                      <p class="text-danger"><?php echo isset($error['otp']) ? $error['otp'] : '' ?></p>
                    </div>
                    <button type="submit" class="btn btn-primary btn-user btn-block" name="verify">Submit OTP</button>
                  </form>
                  <hr>
                  <div class="text-center">
                    <a class="small" href="login.php">Login Here!</a>
                  </div>
                  <div class="text-center">
                    <a class="small" href="registration.php">Create an Account!</a>
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
  <script>
		function changeLanguage()
		{
			document.getElementById('language_form').submit();
		}
	</script>
</body>

</html>

