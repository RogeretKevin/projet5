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
            <h1>Messages</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Messages</li>
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
              <h3 class="card-title">Liste des messages</h3>
            </div>
            <div class="card-body p-0">
              <div class="mailbox-controls">
                <!-- pagination -->
                <div class="float-right">
                   Page : <?= $_GET['page']; ?>
                  <div class="btn-group">
                    <?php if($page >= 2):?><button type="button" onclick="location.href='index.php?p=message&page=<?= $previous ?>'" class="btn btn-default btn-sm"><i class="fas fa-chevron-left"></i></button><?php endif;?>
                    <?php if($page < $nbPages):?><button type="button" onclick="location.href='index.php?p=message&page=<?= $next ?>'" class="btn btn-default btn-sm"><i class="fas fa-chevron-right"></i></button><?php endif;?>
                  </div>
                </div>
              </div>
              <div class="table-responsive mailbox-messages">
                <table class="table table-hover table-striped">
                  <thead>
                    <tr>
                        <th style="width: 1%">
                            Lu
                        </th>
                        <th style="width: 20%">
                            Nom
                        </th>
                        <th style="width: 30%">
                            Apercu
                        </th>
                        <th style="width: 5%">
                            Ville
                        </th>
                        <th style="width: 20%">
                            Date
                        </th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php while ($data = $listMessages->fetch()): ?>
                  <tr>
                  <td class="mailbox-attachment"><?php if($data['lu'] == 0):?><i class="fas fa-eye-slash"></i><?php else:?><i class="fas fa-eye"></i><?php endif;?></td>
                    <td class="mailbox-name"><?= $data['name'] ?></td>
                    <td class="mailbox-subject"><a href="index.php?p=read_message&id=<?= $data['id'] ?>"> <?= $data['preview'] ?></a>
                    </td>
                  <td class="mailbox-attachment"><?php if($data['resident'] == "oui"):?><i class="far fa-check-circle"></i><?php endif;?></td>
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
                    <?php if($page >= 2):?><button type="button" onclick="location.href='index.php?p=message&page=<?= $previous ?>'" class="btn btn-default btn-sm"><i class="fas fa-chevron-left"></i></button><?php endif;?>
                    <?php if($page < $nbPages):?><button type="button" onclick="location.href='index.php?p=message&page=<?= $next ?>'" class="btn btn-default btn-sm"><i class="fas fa-chevron-right"></i></button><?php endif;?>
                  </div>
                </div>
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