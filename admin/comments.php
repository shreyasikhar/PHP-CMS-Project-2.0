<?php include "includes/admin_header.php"; ?>

<?php
    if(isset($_GET['approve']))
    {
        if(isset($_SESSION['user_role']))
        {
            $the_comment_id  = escape($_GET['approve']);
            $query = "update comments set comment_status = 'approved' where comment_id = {$the_comment_id}";
            $approve_comment = mysqli_query($connection, $query);
            header('location:comments.php');
        }    
    }

    if(isset($_GET['disapprove']))
    {
        if(isset($_SESSION['user_role']))
        {
            $the_comment_id  = escape($_GET['disapprove']);
            $query = "update comments set comment_status = 'disapproved' where comment_id = {$the_comment_id}";
            $disapprove_comment = mysqli_query($connection, $query);
            header('location:comments.php');
        }    
    }

    if(isset($_POST['delete']))
    {
        if(isset($_SESSION['user_role']))
        {
            $the_comment_id  = escape($_POST['comment_id']);
            $query = "delete from comments where comment_id = {$the_comment_id}";
            $delete_comment = mysqli_query($connection, $query);
            header('location:comments.php');
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
          <h1>View All Comments</h1><hr/>

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
                    case 'add_post':
                        include "includes/add_post.php";
                    break;
                    case 'edit_post':
                        include "includes/edit_post.php";
                    break;
                    default:
                        include "includes/view_all_comments.php";
                break;
                }
            ?>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <?php include "includes/admin_footer.php"; ?>