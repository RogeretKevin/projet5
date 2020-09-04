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
            <h1>Commentaires</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Commentaires</li>
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
              <h3 class="card-title">Liste des Commentaires</h3>
            </div>
            <div class="card-body p-0">
              <div class="mailbox-controls">
                <!-- pagination -->
                <div class="float-right">
                   Page : <?= $_GET['page']; ?>
                  <div class="btn-group">
                  <?php if($page >= 2):?><button type="button" onclick="location.href='index.php?p=comment&id=<?= $_GET['id'] ?>&page=<?= $previous ?>'" class="btn btn-default btn-sm"><i class="fas fa-chevron-left"></i></button><?php endif;?>
                    <?php if($page < $nbPages):?><button type="button" onclick="location.href='index.php?p=comment&id=<?= $_GET['id'] ?>&page=<?= $next ?>'" class="btn btn-default btn-sm"><i class="fas fa-chevron-right"></i></button><?php endif;?>
                  </div>
                </div>
              </div>
              <div class="table-responsive mailbox-messages">
                <table class="table table-hover table-striped">
                  <thead>
                    <tr>
                    
                        <th style="width: 20%">
                            Pseudo
                        </th>
                        <th style="width: 30%">
                            Commentaire
                        </th>
                        <th style="width: 5%">
                            Report
                        </th>
                        <th style="width: 20%">
                            Date
                        </th>
                    </tr>
                  </thead>
                  <tbody>
                  <!-- commentaires -->
                  <?php while ($data = $listComment->fetch()): ?>
                  <tr>
                    <td class="mailbox-name"><?= $data['pseudo'] ?></td>
                    <td class="mailbox-subject"><a href="index.php?p=read_comment&id=<?= $data['id'] ?>"> <?= $data['preview'] ?></a>
                    </td>
                  <td class="mailbox-attachment"><?php if($data['report'] == -1):?><i class="far fa-check-circle"></i><?php else: echo $data['report']; endif;?></td>
                    <td class="mailbox-date"><?= $data['creation_date_fr'] ?></td>
                  </tr>
                  <?php endwhile; ?>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="card-footer p-0">
              <div class="mailbox-controls">
              <!-- pagination -->
              <div class="float-right">
                   Page : <?= $_GET['page']; ?>
                  <div class="btn-group">
                  <?php if($page >= 2):?><button type="button" onclick="location.href='index.php?p=comment&id=<?= $_GET['id'] ?>&page=<?= $previous ?>'" class="btn btn-default btn-sm"><i class="fas fa-chevron-left"></i></button><?php endif;?>
                    <?php if($page < $nbPages):?><button type="button" onclick="location.href='index.php?p=comment&id=<?= $_GET['id'] ?>&page=<?= $next ?>'" class="btn btn-default btn-sm"><i class="fas fa-chevron-right"></i></button><?php endif;?>
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