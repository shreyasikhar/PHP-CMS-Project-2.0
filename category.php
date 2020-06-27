<?php include "includes/db.php"; ?>
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
        <div class="container-fluid">
        <!-- Content Row -->
          <div class="page-header">
                <h1>Posts By Category</h1>
          </div>
          <?php  
                    if(isset($_GET['cat_id']))
                    {
                        $p_id = $_GET['cat_id'];
                    
                        if(isset($_SESSION['username']) && $_SESSION['user_role'] == 'admin')
                        {
                            $stmt1 = mysqli_prepare($connection, "select post_id, post_title, post_author, post_user, post_date, post_image, post_content from posts where post_category_id = ?");
                        }
                        else
                        {
                            $stmt2 = mysqli_prepare($connection, "select post_id, post_title, post_author, post_user, post_date, post_image, post_content from posts where post_category_id = ? and post_status = ?");
                            $published = 'published';
                        }    
                        if(isset($stmt1))
                        {
                            mysqli_stmt_bind_param($stmt1, 'i', $p_id);
                            mysqli_stmt_execute($stmt1);
                            mysqli_stmt_bind_result($stmt1, $post_id, $post_title, $post_author, $post_user, $post_date, $post_image, $post_content);
                            mysqli_stmt_store_result($stmt1);
                            $stmt = $stmt1;
                        }
                        else if(isset($stmt2))
                        {
                            mysqli_stmt_bind_param($stmt2, 'is', $p_id, $published);
                            mysqli_stmt_execute($stmt2);
                            mysqli_stmt_bind_result($stmt2, $post_id, $post_title, $post_author, $post_user, $post_date, $post_image, $post_content);
                            mysqli_stmt_store_result($stmt2);
                            $stmt = $stmt2;
                        }
                        $post_count = mysqli_stmt_num_rows($stmt);
                        if(mysqli_stmt_num_rows($stmt) == 0)
                        {
                            echo "<h1 class='text-center'>No posts available</h1>";
                        }
                        else
                        {
                            while(mysqli_stmt_fetch($stmt))
                            {
                        ?>
                            <!-- Blog Post -->
                            <h2>
                                <a href="/cms-theme/post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title; ?></a>
                            </h2>
                            <p class="lead">
                                by <a href="author_posts.php?author=<?php echo $post_user; ?>"><?php echo $post_user; ?></a>
                            </p>
                            <p><span class="fas fa-clock"></span> <?php echo $post_date; ?></p>
                            <hr>
                            <img class="img-fluid" src="images/<?php echo $post_image; ?>" alt="">
                            <hr>
                            <p><?php echo $post_content; ?></p>
                            <a class="btn btn-primary" href="/cms-theme/post.php?p_id=<?php echo $post_id; ?>">Read More <span class="fas fa-angle-right"></span></a>

                            <hr>

                    <?php        
                            }
                            mysqli_stmt_close($stmt);
                        }
                    }    
                    else
                    {
                        header('location:index.php');
                    }    
                ?>
        </div>
        <!-- /.container-fluid -->
          
        <hr>
        <!-- End of container -->
      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <?php include "includes/footer.php"; ?>