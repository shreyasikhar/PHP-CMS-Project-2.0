<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <!-- <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-laugh-wink"></i>
        </div> -->
        <img src="images/blog.svg" class="img-fluid" width="42" height="42"> 
        <div class="sidebar-brand-text mx-3">CMS Blog</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item">
        <a class="nav-link" href="admin/index.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>
      

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Categories
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-list-alt"></i>
          <span>Categories</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">View Posts by Category</h6>
              <?php
                  $query = "SELECT * FROM categories";
                  $result = mysqli_query($connection, $query);
                  while($row = mysqli_fetch_assoc($result))
                  {
                      $cat_id = $row['cat_id'];
                      $cat_title = $row['cat_title'];

                      $category_class = '';
                      $contact_class = '';
                      $contact = 'contact.php';

                      $pageName = basename($_SERVER['PHP_SELF']);
                      if(isset($_GET['category']) && $_GET['category'] == $cat_id)
                      {
                          $category_class = 'active';
                      }
                      else if($pageName == $contact)
                      {
                          $contact_class = 'active';
                      }
                        if(isset($category_class))
                        {
                          echo "<a class='collapse-item'.'{$category_class}' href='/cms-theme/category.php?cat_id={$cat_id}'>{$cat_title}</a> ";
                        }
                        else
                        {
                          echo "<a class='collapse-item' href='/cms-theme/category?cat_id={$cat_id}'>{$cat_title}</a> ";
                        }
                      
                  }
                ?>
          </div>
        </div>
      </li>
                  
      <!-- Divider -->
      <hr class="sidebar-divider">
      <?php if(isset($_SESSION['username'])): ?>  
      <li class="nav-item">
          <a class="nav-link" href="#">
            <i class="fas fa-users"></i>
            <span>Online Users: </span><span class="usersonline"> <?php //echo users_online(); ?></span></a>
        </li>    

        <!-- Divider -->
      <hr class="sidebar-divider">
      <?php endif; ?>

        <li class="nav-item">
          <a class="nav-link" href="contact.php">
            <i class="fa fa-envelope"></i>
            <span>Contact Us</span></a>
        </li>        
	
      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
