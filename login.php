<?php  include "includes/db.php"; ?>
<?php  session_start(); ?>
<?php include "admin/functions.php" ?>
<?php
	checkIfUserIsLoggedInAndRedirect('/cms-theme/admin/index.php');

    if(ifItIsMethod('post'))
    {
      $username = trim($_POST['username']);
      $password = trim($_POST['password']);
      $error = [
              'username' => '',
              'credentials' => '',
              'password' => ''
      ];
		  if(($username) == '')
      {
          $error['username'] = '*Username cannot be empty';
		  }
      if(!username_exists($username) && !empty($username) && !empty($password))
      {
          $error['credentials'] = 'Wrong credentials entered';
      }
      if(($password) == '')
      {
          $error['password'] = '*Password cannot be empty';
      }
      if(!username_password_match($username, $password) && !empty($username) && !empty($password))
      {
        $error['credentials'] = '*Wrong credentials entered';
      }
      $result = query("select flag from temp_users where username='$username'");
      $row = mysqli_fetch_array($result);
      if(mysqli_num_rows($result) > 0)
      {
        $flag = $row['flag'];
        if(!$flag)
        {
          $error['credentials'] = '*Email not verified, Register again with your email';
          query("delete from users where username='$username'");
        }
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
        if(isset($_POST['username']) && isset($_POST['password']))
        {
          login_user($_POST['username'], $_POST['password']);
        }
        else
        {
          redirect('/cms-theme/login.php');
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

  <title>CMS Blog | Login</title>
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
              <div class="col-lg-6 d-none d-lg-block" style="padding: 22% 0 0 14%">
              <img class="img-fluid" src="images/icon1.svg" width="250px" height="250px">
              </div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h2 text-gray-900 mb-4">CMS Blog</h1>
                    <h2 class="h4 text-gray-900 mb-4">Welcome Back! Login Here</h2>
                  </div>
                  <form class="user" method="post">
                    <div class="form-group">
                      <input type="text" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" name="username" placeholder="Enter Registered Username ...">
                    </div>
                    <p class="text-danger"><?php echo isset($error['username']) ? $error['username'] : '' ?></p>
                    <div class="form-group">
                      <input type="password" class="form-control form-control-user" id="exampleInputPassword" name="password" placeholder="Password">
                    </div>
                    <p class="text-danger"><?php echo isset($error['password']) ? $error['password'] : '' ?></p>
                    <div class="form-group">
                      <div class="custom-control custom-checkbox small">
                        <input type="checkbox" class="custom-control-input" id="customCheck">
                        <label class="custom-control-label" for="customCheck">Remember Me</label>
                      </div>
                    </div>
                    <p class="text-danger"><?php echo isset($error['credentials']) ? $error['credentials']."<br/>" : "<br/>" ?></p>
                    <button type="submit" class="btn btn-primary btn-user btn-block" name="login">Login</button>
                    <hr>
                    <a href="#" class="btn btn-google btn-user btn-block">
                      <i class="fab fa-google fa-fw"></i> Login with Google
                    </a>
                    <a href="#" class="btn btn-facebook btn-user btn-block">
                      <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
                    </a>
                  </form>
                  <hr>
                  <div class="text-center">
                    <a class="small" href="forgot.php?forgot=<?php echo uniqid(true); ?>">Forgot Password?</a>
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
</body>

</html>
