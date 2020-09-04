<?php session_start();

if(isset($_COOKIE['admin']) OR isset($_SESSION['admin']) AND !empty($_SESSION['admin'])):
  include('includes/header.php');
  include('includes/navbar.php');
?>

  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>404 Page d'erreur</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">404 Page d'erreur</li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="error-page">
        <h2 class="headline text-warning"> 404</h2>

        <div class="error-content">
          <h3><i class="fas fa-exclamation-triangle text-warning"></i> Oups! Page non trouvée.</h3>

          <p>
            Nous n'avons pas trouvé la page que vous cherchez.
            En attendant, vous pouvez <a href="index.php">retourner au dashboard</a>.
          </p>
        </div>
      </div>
    </section>
  </div>
  
  <?php include('includes/footer.php');
  else:
    header('location:index.php?p=login_page');
  endif;
