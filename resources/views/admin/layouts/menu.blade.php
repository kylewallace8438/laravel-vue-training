 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-primary elevation-4">
     <!-- Brand Logo -->
     <a href="{{ route('admin.home') }}" class="brand-link">
         <img src="{{ asset('admin_css/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
             class="brand-image img-circle elevation-3" style="opacity: .8">
         <span class="brand-text font-weight-light">AdminLTE 3</span>
     </a>

     <!-- Sidebar -->
     <div class="sidebar">
         <!-- Sidebar user panel (optional) -->
         <div class="user-panel mt-3 pb-3 mb-3 d-flex">
             <table>
                 <tr>
                     <td>
                         <div class="image info">
                             <img src="{{ asset('admin_css/dist/img/user2-160x160.jpg') }}"
                                 class="img-circle elevation-2" alt="User Image">
                         </div>
                     </td>
                     <td>
                         <div class="info">
                             <a class="d-block">{{ Auth::user()->name }} </a>
                         </div>
                     </td>
                     <td>
                         <div class="info">
                             <a href="{{ route('admin.logout') }}" style="margin-right: 5px"> <span
                                     data-feather="box-arrow-in-left"></span> Logout</a>
                         </div>
                     </td>
                 </tr>
             </table>
         </div>

         <!-- SidebarSearch Form -->
         <div class="form-inline">
             <div class="input-group" data-widget="sidebar-search">
                 <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                     aria-label="Search">
                 <div class="input-group-append">
                     <button class="btn btn-sidebar">
                         <i class="fas fa-search fa-fw"></i>
                     </button>
                 </div>
             </div>
         </div>

         <!-- Sidebar Menu -->
         <nav class="mt-2">
             <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                 data-accordion="false">
                 <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->


                 <li class="nav-item">
                     <a href="{{ route('admin.home') }}" class="nav-link active">
                         <i class="nav-icon fas fa-tachometer-alt"></i>
                         <p>
                             Dashboard
                         </p>
                     </a>
                 </li>
                 <li class="nav-item">
                     <a href="/admin/products" class="nav-link">
                         <i class="nav-icon fas fa-th"></i>
                         <p>
                             Products
                         </p>
                     </a>
                 </li>
                 <li class="nav-item">
                     <a href="/admin/orders" class="nav-link">
                         <i class="nav-icon fas fa-copy"></i>
                         <p>
                             Orders
                         </p>
                     </a>
                 </li>

                 <li class="nav-item">

                     <a href="#" class="nav-link">
                         <i class="nav-icon fas fa-edit"></i>
                         <p>
                             Coupon
                             <i class="fas fa-angle-left right"></i>
                         </p>
                     </a>
                     <ul class="nav nav-treeview">
                         <li class="nav-item">
                             <a href="/admin/coupon/list" class="nav-link">

                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Coupon</p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="/admin/exchange" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Exchange</p>
                             </a>
                         </li>

                     </ul>
                 </li>


                 <li class="nav-item">
                     <a href="/admin/events" class="nav-link">
                         <i class="nav-icon fas fa-tree"></i>
                         <p>
                             Events
                         </p>
                     </a>
                 </li>
                 <li class="nav-item">
                     <a href="#" class="nav-link">
                         <i class="nav-icon fas fa-user"></i>
                         <p>
                             Users
                             <i class="fas fa-angle-left right"></i>
                         </p>
                     </a>
                     <ul class="nav nav-treeview">
                         <li class="nav-item">
                             <a href="/admin/customers" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Customers</p>
                             </a>
                         </li>

                         <li class="nav-item">
                             <a href="/admin/list" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Admins</p>
                             </a>
                         </li>

                         <li class="nav-item">
                             <a href="{{ route('formRegisterAdmin') }}" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>New admin account</p>
                             </a>
                         </li>

                     </ul>
                 </li>
                 <li>
                 <li class="nav-item">
                     <a href="/admin/role" class="nav-link">
                         <i class="nav-icon fas fa-user  "></i>
                         <p>
                             Role
                         </p>
                     </a>
                 </li>
                 </li>
             </ul>
         </nav>
         <!-- /.sidebar-menu -->
     </div>
     <!-- /.sidebar -->
 </aside>
