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
                <h1>Search Results</h1><hr/>
          </div>
          <?php
               if(isset($_POST['submit']))
               {
                   $search = escape($_POST['search']);
                   $searchQuery = "select * from posts where post_tags like '%$search%'";
                   $searchResult = mysqli_query($connection, $searchQuery);
                   if(!$searchQuery)
                   {
                       die("QUERY ERROR : " . mysqli_error($connection));
                   }
                   $count = mysqli_num_rows($searchResult);
                   if($count == 0)
                   {
                       echo "<h1>NO RESULT</h1>";
                   }
                   else
                   {
                       while($row = mysqli_fetch_assoc($searchResult))
                       {
                           $post_title = $row['post_title'];
                           $post_user = $row['post_user'];
                           $post_author = $row['post_author'];
                           $post_date = $row['post_date'];
                           $post_image = $row['post_image'];
                           $post_content = $row['post_content'];
                           $post_id = $row['post_id'];
               ?>
   
                   <!-- Blog Post -->
                   <h2>
                       <a href="/cms/post/<?php echo $post_id; ?>"><?php echo $post_title; ?></a>
                   </h2>
                   <p class="lead">
                       by <a href="/cms/author_posts/<?php echo $post_user; ?>"><?php echo $post_user; ?></a>
                   </p>
                   <p><span class="fas fa-clock"></span> <?php echo $post_date; ?></p>
                   <hr>
                   <a href="post.php?p_id=<?php echo $post_id; ?>">
                       <img class="img-fluid" src="/cms/images/<?php echo $post_image; ?>" alt="">
                   </a>
                   <hr>
                   <p><?php echo $post_content; ?></p>
                   <a class="btn btn-primary" href="/cms/post/<?php echo $post_id; ?>">Read More <span class="fas fa-angle-right"></span></a>
   
                   <hr>
   
               <?php
                   }
               }



               
                   
               ?>

               
               <?php        
                   }        
            ?>

            <!-- Blog Post -->
        </div>
        <!-- /.container-fluid -->
          
        <hr>
      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <?php include "includes/footer.php"; ?>