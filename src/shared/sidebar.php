<?php

  use VacationPortal\Helpers\Enumerations\UserType;

?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <span class="brand-text font-weight-light">Vacation Portal</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info">
          <a href="#" class="d-block"><?=$user->first_name . ' ' . $user->last_name?></a>
        </div>
      </div>


      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
         
          <li class="nav-item">
            <a href="/applications" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                You Applications
              </p>
            </a>
          </li>
          <?php if($user->role_id == UserType::Manager) : ?>
          <li class="nav-item">
            <a href="/users" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Users
              </p>
            </a>
          </li>
          <?php endif; ?>
          <?php if($user->role_id == UserType::Manager) : ?>
            <li class="nav-item menu-closed">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Applications
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/pending-applications" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pendings</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/complete-applications" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Completed</p>
                </a>
              </li>
            </ul>
          </li>
          <?php endif; ?>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>