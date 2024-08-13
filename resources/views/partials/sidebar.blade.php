 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-primary elevation-4">
   <!-- Brand Logo -->
   <form id="logout-form" action="{{ route('logoutAdmin') }}" method="POST" style="display: none;">
     @csrf
   </form>

   <a href="#" class="logout-btn" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
     <i class="nav-icon fas fa-sign-out-alt"></i>
     <span class="brand-text font-weight-light">Logout</span>
   </a>

   <!-- Sidebar -->
   <div class="sidebar">
     <!-- Sidebar user panel (optional) -->
     <div class="user-panel mt-3 pb-3 mb-3 d-flex">
       <div class="image">
         <img src="{{ asset('adminlte\dist\img\AdminLTELogo.png') }}" class="img-circle elevation-2" alt="User Image">
       </div>
       <div class="info">
         <a href="#" class="d-block">Nguyễn Tấn Phát</a> 
       </div>
     </div>

     <!-- SidebarSearch Form -->
     <div class="form-inline">
       <div class="input-group" data-widget="sidebar-search">
         <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
         <div class="input-group-append">
           <button class="btn btn-sidebar">
             <i class="fas fa-search fa-fw"></i>
           </button>
         </div>
       </div>
     </div>

     <!-- Sidebar Menu -->
     <nav class="mt-2">
       <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
         <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
         <li class="nav-item">
           <a href="{{ route('dashboard') }}" class="nav-link">
             <i class="nav-icon fas fa-tachometer-alt"></i>
             <p>
               Dashboard
             </p>
           </a>
         </li>

         <li class="nav-item">
           <a href="{{ route('menus.index') }}" class="nav-link">
             <i class="nav-icon fas fa-list"></i>
             <p>
               Menus
             </p>
           </a>
         </li>

         <li class="nav-item">
           <a href="{{ route('categories.index') }}" class="nav-link">
             <i class="nav-icon fas fa-solid fa-book"></i>
             <p>
               Danh mục sản phẩm
               <span class="right badge badge-danger">New</span>
             </p>
           </a>
         </li>

         <li class="nav-item">
           <a href="{{ route('product.index') }}" class="nav-link">
             <i class="nav-icon fas fa-box-open"></i>
             <p>
               Quản lý sản phẩm
             </p>
           </a>
         </li>

         <li class="nav-item">
           <a href="{{ route('admin.orders.index') }}" class="nav-link">
             <i class="nav-icon fas fa-shopping-cart"></i>
             <p>
               Quản lý đơn hàng
             </p>
           </a>
         </li>

         <li class="nav-item">
           <a href="{{ route('slider.index') }}" class="nav-link">
             <i class="nav-icon fas fa-chevron-right"></i>
             <p>
               Slider
             </p>
           </a>
         </li>

         <li class="nav-item">
           <a href="{{ route('setting.index') }}" class="nav-link">
             <i class="nav-icon fas fa-cog"></i>
             <p>
               Settings
             </p>
           </a>
         </li>

         <li class="nav-item">
           <a href="{{ route('customers.index') }}" class="nav-link">
             <i class="nav-icon fas fa-user"></i>
             <p>
               Danh sách khách hàng
             </p>
           </a>
         </li>

         <li class="nav-item">
           <a href="{{ route('users.index') }}" class="nav-link">
             <i class="nav-icon fas fa-users"></i>
             <p>
               Danh sách nhân viên
             </p>
           </a>
         </li>

         <li class="nav-item">
           <a href="{{ route('roles.index') }}" class="nav-link">
             <i class="nav-icon fas fa-user-tag"></i>
             <p>
               Danh sách vai trò
             </p>
           </a>
         </li>
       </ul>
     </nav>
     <!-- /.sidebar-menu -->
   </div>
   <!-- /.sidebar -->
 </aside>