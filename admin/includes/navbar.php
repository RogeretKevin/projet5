<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
    
      <!-- navbar -->
      <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
          </li>
        </ul>
    
        <ul class="navbar-nav ml-auto">
          <li class="nav-item dropdown no-arrow">
          <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            <!-- affiche le pseudo -->
            <span><?php if(isset($_COOKIE['admin'])): echo $_COOKIE['admin']; else: echo $_SESSION['admin']; endif;?></span>
          </a>
          <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
              <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
              Déconnexion
            </a>
          </div>
        </li>
        </ul>
      </nav>
    
      <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <a href="index.php" class="brand-link">
          <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
               style="opacity: .8">
          <span class="brand-text font-weight-light">Panel Admin</span>
        </a>
    
          <!-- menu -->
          <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                   <li class="nav-item">
                    <a href="index.php" class="nav-link">
                      <i class="nav-icon fas fa-tachometer-alt"></i>
                      <p>
                        Dashboard
                      </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="../index.php" class="nav-link">
                    <i class="nav-icon far fa-eye"></i>
                      <p>
                        Voir le site
                      </p>
                    </a>
                  </li>
              <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                <i class="nav-icon fas fa-newspaper"></i>
                  <p>
                    Articles
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="index.php?p=list&page=1" class="nav-link">
                    <i class="fas fa-list nav-icon"></i>
                      <p>Liste</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="index.php?p=view_create" class="nav-link">
                    <i class="fas fa-plus nav-icon"></i>
                      <p>Créer</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item">
                <a href="index.php?p=message&page=1" class="nav-link">
                  <i class="nav-icon far fa-envelope"></i>
                  <p>
                    Messages
                  </p>
                </a>
              </li>
            </ul>
          </nav>
      </aside>

      <!-- menu logout-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
      aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Se déconnecter ?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Sélectionnez «Déconnexion» ci-dessous si vous êtes prêt à terminer votre session en
            cours.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Annuler</button>
            <a class="btn btn-primary" href="index.php?p=logout">Déconnexion</a>
          </div>
        </div>
      </div>
    </div>