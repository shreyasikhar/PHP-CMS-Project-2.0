<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <!-- <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-laugh-wink"></i>
        </div> -->
        <img src="../images/blog.svg" class="img-fluid" width="42" height="42"> 
        <div class="sidebar-brand-text mx-3">CMS Blog Dashboard</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <li class="nav-item">
        <a class="nav-link" href="../index.php">
          <i class="fas fa-house-user"></i>
          <span>Home</span></a>
      </li>

      <?php if(isset($_SESSION['username'])): ?> 
      <li class="nav-item">
          <a class="nav-link" href="#">
            <i class="fas fa-users"></i>
            <span>Online Users: </span><span class="usersonline"> <?php //echo users_online(); ?></span></a>
        </li> 
      <?php endif; ?>   

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item">
        <a class="nav-link" href="index.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>My Data</span></a>
      </li>
     
     <?php if(is_admin()): ?> 
      <li class="nav-item">
        <a class="nav-link" href="dashboard.php">
          <i class="fas fa-user-secret"></i>
          <span>Admin Dashboard</span></a>
      </li>
     <?php endif; ?> 

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Blog Components
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-file-alt"></i>
          <span>Posts</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Post Components:</h6>
            <a class="collapse-item" href="posts.php">View All Posts</a>
            <a class="collapse-item" href="posts.php?source=add_post">Add New Post</a>
          </div>
        </div>
      </li>
      
      <li class="nav-item">
        <a class="nav-link" href="categories.php">
          <i class="fas fa-list-alt"></i>
          <span>Categories</span></a>
      </li>
      
      <li class="nav-item">
        <a class="nav-link" href="comments.php">
          <i class="fas fa-comments"></i>
          <span>Comments</span></a>
      </li>

      <!-- Nav Item - Utilities Collapse Menu -->
      <?php if(is_admin()): ?>  
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
          <i class="fas fa-users"></i>
          <span>Users</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Blog Users Components:</h6>
            <a class="collapse-item" href="users.php">View All Users</a>
            <a class="collapse-item" href="users.php?source=add_user">Add New User</a>
          </div>
        </div>
      </li>
    <?php endif; ?> 
	
	<!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Profile
      </div>
      <li class="nav-item">
        <a class="nav-link" href="profile.php">
          <i class="fa fa-user"></i>
          <span>View Profile</span></a>
      </li>
	
      <!-- Divider -->
      <hr class="sidebar-divider">
      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
