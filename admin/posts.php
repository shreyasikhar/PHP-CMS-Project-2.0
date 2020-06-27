<?php include "includes/admin_header.php"; ?>

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
                    case 'add_post':
                        include "includes/add_post.php";
                    break;
                    case 'edit_post':
                        include "includes/edit_post.php";
                    break;
                    default:
                        include "includes/view_all_posts.php";
                break;
                }
            ?>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <?php include "includes/admin_footer.php"; ?>