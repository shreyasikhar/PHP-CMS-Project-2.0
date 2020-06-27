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
                <h1>All Posts</h1><hr/>
          </div>
          <?php
            if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin')
            {                 
                $query = "select * from posts";
            }
            else
            {
                $query = "select * from posts where post_status = 'published'";
            }    
            $post_count_result = mysqli_query($connection, $query);
            $post_count = mysqli_num_rows($post_count_result);
            $post_count = $post_count /3;
            $post_count = ceil($post_count);

            if(isset($_GET['page']))
            {
                $page = $_GET['page'];
            }
            else
            {
                $page = "";
            }

            if($page == "" || $page == 1)
            {
                $page_1 = 0;
            }
            else
            {
                $page_1 = ($page * 3) - 3;
            }

            if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin')
            {
                $postQuery = "select * from posts LIMIT $page_1, 3";
            }
            else
            {
                $postQuery = "select * from posts where post_status = 'published' LIMIT $page_1, 3";
            }    
            $postResult = mysqli_query($connection, $postQuery);
            if(mysqli_num_rows($postResult))
            {
                while($row = mysqli_fetch_assoc($postResult))
                {
                    $post_id = $row['post_id'];
                    $post_title = $row['post_title'];
                    $post_user = $row['post_user'];
                    $post_date = $row['post_date'];
                    $post_image = $row['post_image'];
                    $post_content = substr($row['post_content'], 0);
                    $post_content = $row['post_content'];
            ?>

            <!-- Blog Post -->
            <h2>
                <a href="/cms-theme/post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title; ?></a>
            </h2>
            <p class="lead">
                by <a href="/cms-theme/author_posts.php?author=<?php echo $post_user; ?>"><?php echo $post_user; ?></a>
            </p>
            <p><span class="fas fa-clock"></span> <?php echo $post_date; ?></p>
            <hr>
            <a href="post.php?p_id=<?php echo $post_id; ?>">
                <img class="img-fluid" src="/cms-theme/images/<?php echo imagePlaceholder($post_image); ?>" alt="">
            </a>
            <hr>
            <p><?php echo $post_content; ?></p>
            <a class="btn btn-primary" href="/cms-theme/post.php?p_id=<?php echo $post_id; ?>">Read More <span class="fas fa-angle-right"></span></a>

            <hr>

            <?php        
                }
            }
            else
            {
                echo "<h1 class='text-center'>No posts available</h1>";
            }    
            ?>

        </div>
        <!-- /.container-fluid -->
          
        <hr>
        <div class="container">
          <ul class="pagination">

          <?php
              for($i = 1; $i <= $post_count; $i++)
              {
                  if($i == $page)
                  {
                      echo "<li class='page-item'><a class='page-link active_link' href='index.php?page={$i}'> {$i}</a></li>";
                  }
                  else
                  {
                      echo "<li class='page-item'><a class='page-link' href='index.php?page={$i}'> {$i}</a></li>";
                  }    
              }
          ?>
              
          </ul>
        </div>
        <!-- End of container -->
      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <?php include "includes/footer.php"; ?>