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
        <?php  
            if(isset($_GET['author']))
            {
                $post_author = $_GET['author'];
            }
            $postQuery = "select * from posts where post_user = '$post_author'";
            $postResult = mysqli_query($connection, $postQuery);
        ?>
         <h1>Posts By <?php echo $post_author; ?></h1><hr/>
        <?php    
            while($row = mysqli_fetch_assoc($postResult))
            {
                $post_id =$row['post_id'];
                $post_title = $row['post_title'];
                $post_author = $row['post_user'];
                $post_date = $row['post_date'];
                $post_image = $row['post_image'];
                $post_content = $row['post_content'];
            ?>
                <!-- Blog Post -->
                <h2>
                    <a href="/cms-theme/post.php?p_id=<?php echo $post_id ?>"><?php echo $post_title; ?></a>
                </h2>
                <p class="lead">
                    by <a href="/cms-theme/author_posts.php?author=<?php echo $post_author; ?>"><?php echo $post_author; ?></a>
                </p>
                <p><span class="fas fa-clock"></span> <?php echo $post_date; ?></p>
                <hr>
                <img class="img-fluid" src="/cms-theme/images/<?php echo $post_image; ?>" alt="">
                <hr>
                <p><?php echo $post_content; ?></p>
                <a class="btn btn-primary" href="/cms-theme/post.php?p_id=<?php echo $post_id; ?>">Read More <span class="fas fa-angle-right"></span></a>
                <hr>

            <?php        
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