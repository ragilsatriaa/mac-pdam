 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-light-primary elevation-1">
     <!-- Brand Logo -->
     <a href="<?= base_url('admin'); ?>" class="brand-link text-center">
         <span class="brand-text font-weight-bold"><i class="fas fa-water"></i> METERAN AIR CERDAS</span>
     </a>

     <!-- Sidebar -->
     <div class="sidebar">

         <div class="user-panel mt-3 pb-3 mb-3 d-flex">
             <div class="image">
                 <img src="<?= base_url('uploads/profile/' . $this->dt_admin->image); ?>" class="img-circle elevation-2" alt="User Image">
             </div>
             <div class="info">
                 <a href="#" class="d-block"><?= $this->dt_admin->name; ?></a>
             </div>
         </div>

         <!-- Sidebar Menu -->
         <nav class="mt-2">
             <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                 <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                 <li class="nav-header">Menu</li>
                 <li class="nav-item">
                     <a href="<?= base_url('admin'); ?>" class="nav-link <?= ($this->uri->segment(1) == 'admin' ? 'active' : ''); ?>">
                         <i class="nav-icon fas fa-home"></i>
                         <p>
                             Dashboard
                         </p>
                     </a>
                 </li>
                 <li class="nav-item">
                     <a href="<?= base_url('pelanggan'); ?>" class="nav-link <?= ($this->uri->segment(1) == 'pelanggan' ? 'active' : ''); ?>">
                         <i class="nav-icon fas fa-users"></i>
                         <p>
                             Pelanggan
                         </p>
                     </a>
                 </li>
                 <li class="nav-item">
                     <a href="<?= base_url('monitoring'); ?>" class="nav-link <?= ($this->uri->segment(1) == 'monitoring' ? 'active' : ''); ?>">
                         <i class="nav-icon fas fa-computer"></i>
                         <p>
                             Monitoring Penggunaan
                         </p>
                     </a>
                 </li>
                 <li class="nav-item">
                     <a href="<?= base_url('Informasi'); ?>" class="nav-link <?= ($this->uri->segment(1) == 'Informasi' ? 'active' : ''); ?>">
                         <i class="nav-icon fas fa-info"></i>
                         <p>
                             Informasi Penggunaan
                         </p>
                     </a>
                 </li>
             </ul>
         </nav>
         <!-- /.sidebar-menu -->
     </div>
     <!-- /.sidebar -->
 </aside>