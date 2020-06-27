<?php include "includes/admin_header.php"; ?>
<?php 
if(isset($_GET['change_to_admin']))
    {
        if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == "admin")
        {
            $user_id  = escape($_GET['change_to_admin']);
            $query = "update users set user_role = 'admin' where user_id = {$user_id}";
            $change_to_admin = mysqli_query($connection, $query);
            header('location:users.php');
        }    
    }

    if(isset($_GET['change_to_sub']))
    {
        if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == "admin")
        {
            $user_id  = escape($_GET['change_to_sub']);
            $query = "update users set user_role = 'subscriber' where user_id = {$user_id}";
            $change_to_sub = mysqli_query($connection, $query);
            header('location:users.php');
        }    
    }

    if(isset($_GET['delete']))
    {
        if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == "admin")
        {
            $user_id  = mysqli_real_escape_string($connection, $_GET['delete']);
            $query = "delete from users where user_id = {$user_id}";
            $delete_user = mysqli_query($connection, $query);
            header('location:users.php');
        }
    }
?>    

    <!-- Sidebar -->
    <?php include "includes/admin_sidebar.php"; ?>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <?php include "includes/admin_topbar.php"; ?>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container">

          <!-- Page Heading -->
          

          <!-- Content Row -->
          <div class="row">
            <?php
                if(isset($_GET['source']))
                {
                    $source = escape($_GET['source']);
                }
                else
                {
                    $source = "";
                }
                switch($source)
                {
                    case 'add_user':
                        include "includes/add_user.php";
                    break;
                    case 'edit_user':
                        include "includes/edit_user.php";
                    break;
                    default:
                        include "includes/view_all_users.php";
                break;
                }
            ?>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <?php include "includes/admin_footer.php"; ?>