<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" style="transition-duration: 400ms"
  id="accordionSidebar">

  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('home') }}">
    <div class="sidebar-brand-icon rotate-n-15">
      <i class="fas fa-th-large"></i>
    </div>
    <div class="sidebar-brand-text mx-3">Z-Blog</div>
  </a>

  <!-- Divider -->
  <hr class="sidebar-divider my-0">

  <!-- Nav Item - Dashboard -->
  <li class="nav-item  {{ Request::is('dashboard') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('dashboard') }}">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dashboard</span></a>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider">

  <!-- Heading -->
  <div class="sidebar-heading">
    MAIN
  </div>

  <!-- Nav Item - My Post -->
  <li class="nav-item {{ Request::is('dashboard/posts') ? 'active' : '' }}">
    <a class="nav-link pb-2" href="/dashboard/posts">
      <i class="far fa-file-alt"></i>
      <span>My Post</span></a>
  </li>

  <!-- Nav Item - Add Post -->
  <li class="nav-item {{ Request::is('dashboard/posts/create') ? 'active' : '' }}">
    <a class="nav-link pt-0" href="/dashboard/posts/create">
      <i class="far fa-file"></i>
      <span>Add Post</span></a>
  </li>

  <!-- Heading -->
  <div class="sidebar-heading">
    SETTINGS
  </div>

  <!-- Nav Item - Profile -->
  <li class="nav-item {{ Request::is('profile') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('profile.index') }}">
      <i class="fas fa-user-edit"></i>
      <span>Profile</span></a>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider d-none d-md-block">

  <!-- Sidebar Toggler (Sidebar) -->
  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>
</ul>
<!-- End of Sidebar -->
