<?php include "includes/db.php"; ?>
<?php   
    if(isset($_POST['submit']))
    {
        $to = "enlectic@gmail.com";
        $subject = wordwrap($_POST['subject'], 70);
        $body = $_POST['body'];
        $header = "From: ".$_POST['email'];
        mail($to, $subject, $body, $header);
        $success = "<p class='bg-success'>Your message is submitted</p>";
    }    
?>
<?php include "includes/header.php"; ?>

    <!-- Sidebar -->
    <?php include "includes/sidebar.php"; ?>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <?php include "includes/topbar.php"; ?>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container">
        <!-- Content Row -->

                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-2 col-xs-1"> 
                    </div>
                    <div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 col-xs-10 col-xs-offset-1">
                        <div class="form-wrap">
                        <h1>Contact</h1>
                            <form role="form" class="user" action="" method="post" id="login-form" autocomplete="off">
                            <?php
                                if(isset($success))
                                    echo $success;
                                else
                                    $success = "";
                            ?>
                                <div class="form-group">
                                    <label for="email" class="sr-only">Email</label>
                                    <input type="email" name="email" id="email" class="form-control form-control-user" placeholder="Enter your email">
                                </div>
                                <div class="form-group">
                                    <label for="subject" class="sr-only">Subject</label>
                                    <input type="text" name="subject" id="subject" class="form-control form-control-user" placeholder="Enter your subject">
                                </div>
                                <div class="form-group">
                                    <textarea class="form-control form-control-user" name="body" id="body" cols="50" rows="3"></textarea>
                                </div>
                        
                                <input type="submit" name="submit" id="btn-login" class="btn btn-primary btn-user btn-block" value="Submit">
                            </form>
                        
                        </div>
                    </div> <!-- /.col-xs-12 -->
                </div> <!-- /.row -->

        </div>
        <!-- /.container-fluid -->
          
        <hr>
      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <?php include "includes/footer.php"; ?>