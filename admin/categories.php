<?php include "includes/admin_header.php"; ?>
<?php deleteCategories(); ?>
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
          
          <h1>Blog Categories</h1><hr/>
          <!-- Content Row -->
          <div class="row">
            <div class="col-lg-6">

                <?php
                    insert_categories();
                ?>

                    <form action="" method="post">
                        <div class="form-group" data-toggle="tooltip" data-placement="top" title="Only admin can add category">
                            <label for="cat-title">Add Category</label>
                            <?php if(is_admin()): ?>
                            <input type="text" class="form-control" name="cat_title">
                            <?php else: ?>
                                <input type="text" class="form-control" name="cat_title" disabled>
                            <?php endif; ?>    
                        </div> 
                        <div class="form-group">
                            <?php if(is_admin()): ?>
                            <input class="btn btn-primary" type="submit" name="submit" value="Add Category">
                            <?php else: ?>
                            <input class="btn btn-primary" type="submit" name="submit" value="Add Category" disabled>
                            <?php endif; ?>
                        </div>    
                    </form>

                <?php 
                    //UPDATE AND INCLUDE QUERY
                    if(isset($_GET['edit']))
                    {
                        $cat_id = escape($_GET['edit']);
                        include "includes/update_categories.php";
                    }
                ?>    

                </div> 
                <div class="col-lg-6">
                <?php
                    $count = get_all_categories_count();
                    if($count == 0)
                    {
                        echo "<h1 class='text-center'>No categories available</h1>";
                    }
                    else
                    {
                ?>
                <div class="table-responsive">   
                    <table class="table table-bordered table-hover" style="background-color:#fff;">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Category Title</th>
                    <?php if(is_admin()): ?>
                            <th>Edit</th>
                            <th>Delete</th>
                    <?php endif; ?>        
                        </tr>
                        </thead>
                        <tbody>

                        <?php findAllCategories(); ?>

                        
                        
                        </tbody>
                    </table>
                </div>    
                <?php }  ?>    
            </div> 

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <?php include "includes/admin_footer.php"; ?>