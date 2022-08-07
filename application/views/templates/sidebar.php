<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?php echo base_url().'home/index'; ?>" class="brand-link">
      <img src="<?php echo base_url()?>/images/elib.png" alt="E-Library Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">E-Library</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?php echo base_url()?>assets/dist/img/avatar4.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <?php
            // print_r(isset($_SESSION['nama']))
            if (isset($_SESSION['nama'])) {
              echo '<a href="" class="d-block">'.$_SESSION['nama'].'</a>';
            }
            else{
              echo '<a href="'.base_url().'login/showSignIn'.'" class="d-block">Guest</a>';
            }
          ?>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <?php 
          if (isset($_SESSION['login']) == TRUE) { 
            if ($_SESSION['akses'] == 'member') { 
          ?>
            <li class="nav-item">
              <a href="<?php echo base_url().'./anggota/displayAnggotaDetail/'.$_SESSION['kode'] ?>" class="nav-link">
                <i class="nav-icon fas fa-user"></i>
                <p>
                  Profile
                </p>
              </a>
            </li>
          <?php   
            } 
          } ?>
          <li class="nav-item">
            <a href="<?php echo base_url().'home/index'; ?>" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Bibliografi
              </p>
            </a>
          </li>
          <?php 
          if (isset($_SESSION['login']) == TRUE) { 
            if ($_SESSION['akses'] == 'admin') {
              echo
              '
              <li class="nav-item">
                <a href="'.base_url().'anggota/displayAnggota'.'" class="nav-link">
                  <i class="nav-icon fas fa-users"></i>
                  <p>
                    Data Anggota
                  </p>
                  <!-- <i class="fas fa-angle-left right"></i> -->
                </a>
              </li>
              <li class="nav-item">
                <a href="" class="nav-link">
                  <i class="nav-icon fas fa-sync-alt"></i>
                  <p>
                    Sirkulasi
                  </p>
                  <i class="fas fa-angle-left right"></i>
                </a>
                <ul class="nav nav-treeview">
                  <li class="ms-2 nav-item">
                    <a href="'.base_url().'sirkulasi/displayRequest'.'" class="nav-link">
                      <i class="fas fa-exclamation nav-icon"></i>
                      <p>Permintaan Peminjaman</p>
                    </a>
                  </li>
                  <li class="ms-2 nav-item">
                    <a href="'.base_url().'sirkulasi/displayData'.'" class="nav-link">
                      <i class="fas fa-upload nav-icon"></i>
                      <p>Peminjaman</p>
                    </a>
                  </li>
                </ul>
              </li>
              
            ';
            }
            else if($_SESSION['akses'] == 'member') {
              $kode = $_SESSION['kode'];
              echo'
              <li class="nav-item">
                <a href="'.base_url().'sirkulasi/displayRequest/'.$kode.'" class="nav-link">
                  <i class="fas fa-shopping-cart nav-icon"></i>
                  <p>Peminjaman</p>
                </a>
              </li>
              ';
            }

            echo'
            <li class="nav-item">
                <a href="'.base_url().'login/signOut'.'" class="nav-link">
                  <i class="nav-icon fas fa-sign-out-alt"></i>
                  <p>
                    Log Out
                  </p>
                  <!-- <i class="fas fa-angle-left right"></i> -->
                </a>
            </li>
            ';
          }
          ?>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>