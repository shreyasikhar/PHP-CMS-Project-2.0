<?php  include "includes/db.php"; ?>
<?php  session_start(); ?>
<?php include "admin/functions.php"; ?>
<?php
	if(!isset($_GET['email']) && !isset($_GET['token']))
    {
        redirect('/cms-theme');
    }
    if($stmt = mysqli_prepare($connection, "select username, user_email, token from users where token = ?"))
    {
        mysqli_stmt_bind_param($stmt, "s", $_GET['token']);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $username, $user_email, $token);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);
        
        if($_GET['token'] != $token || $_GET['email'] != $user_email)
        {
            redirect('/cms-theme');
        }

        if(isset($_POST['password']) && isset($_POST['confirmPassword']))
        {
            if($_POST['password'] === $_POST['confirmPassword'])
            {
                $password = $_POST['password'];
                $hashed_password = password_hash($password, PASSWORD_BCRYPT, array('cost'=>12));
                if($stmt = mysqli_prepare($connection, "update users set token='', user_password = '{$hashed_password}' where user_email = ?"))
                {
                    mysqli_stmt_bind_param($stmt, 's', $_GET['email']);
                    mysqli_stmt_execute($stmt);
                    if(mysqli_stmt_affected_rows($stmt) >= 1)
                    {
                        redirect('/cms-theme/login.php');
                    }
                    mysqli_stmt_close($stmt);
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

  <title>CMS Blog | Reset Password</title>

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
              <div class="col-lg-6 d-none d-lg-block" style="padding: 7.5% 0 0 14.5%">
              <img class="img-fluid" src="images/icon4.svg" width="250px" height="250px">
              </div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h2 text-gray-900 mb-4">CMS Blog</h1>
                    <h2 class="h4 text-gray-900 mb-4">Reset Your Password</h2>
                  </div>
                  <form class="user" method="post">
                    <div class="form-group">
                      <input type="password" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" name="password" placeholder="Enter Password ...">
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control form-control-user" id="exampleInputPassword" name="confirmPassword" placeholder="Re-Enter Password">
                    </div>
                    <button type="submit" class="btn btn-success btn-user btn-block" name="reset">Reset</button>
                    <hr>
                    <input type="hidden" class="hide" name="token" id="token" value="">
                  </form>
                  <div class="text-center">
                    <a class="small" href="login.php">Login Here!</a>
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
