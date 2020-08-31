<?php session_start();

if(isset($_COOKIE['admin']) OR isset($_SESSION['admin']) AND !empty($_SESSION['admin'])):
  include('includes/header.php');
  include('includes/navbar.php');
?>
  
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div>
        </div>
      </div>
    </div>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?= $countPost ?></h3>

                <p>Nombre de Posts</p>
              </div>
              <div class="icon">
                <i class="nav-icon fas fa-newspaper"></i>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?= $countMessage ?></h3>

                <p>Nombre de Messages</p>
              </div>
              <div class="icon">
                <i class="nav-icon far fa-envelope"></i>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?= $countComment ?></h3>

                <p>Nombre de Commentaires</p>
              </div>
              <div class="icon">
                <i class="fas fa-chart-pie"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <?php include('includes/footer.php'); 
  else:
    header('location:index.php?p=login_page');
  endif;