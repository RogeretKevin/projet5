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
            <h1>Message</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Message</li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
        <div class="row">
        <div class="col-md-12">
          <div class="card card-primary card-outline">
            <div class="card-header">
              <h3 class="card-title">Lire Message</h3>
            </div>
            <div class="card-body p-0">
              <div class="mailbox-read-info">
                <h5><?= $message['name'] ?></h5>
                <h6>Resident de la ville : <?= $message['resident'] ?>
                  <span class="mailbox-read-time float-right"><?= $message['message_date'] ?></span></h6>
              </div>
              <div class="mailbox-read-message">
                <p><?= $message['message'] ?></p>
              </div>
            </div>
            <div class="card-footer">
              <div class="float-right">
                <button type="button" onclick="location.href='mailto:<?= $message['email'] ?>'" class="btn btn-default"><i class="fas fa-reply"></i> Répondre</button>
              </div>
              <button type="button" onclick="location.href='index.php?p=delete_message&id=<?= $message['id'] ?>'" class="btn btn-default"><i class="far fa-trash-alt"></i> Supprimer</button>
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