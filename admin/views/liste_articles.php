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
            <h1>Articles</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Articles</li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <section class="content">

      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Liste des articles</h3>
        </div>
        <div class="card-body p-0">
              <div class="mailbox-controls">
                <!-- pagination -->
                <div class="float-right">
                   Page : <?= $_GET['page']; ?>
                  <div class="btn-group">
                  <?php if($page >= 2):?><button type="button" onclick="location.href='index.php?p=list&page=<?= $previous ?>'" class="btn btn-default btn-sm"><i class="fas fa-chevron-left"></i></button><?php endif;?>
                    <?php if($page < $nbPages):?><button type="button" onclick="location.href='index.php?p=list&page=<?= $next ?>'" class="btn btn-default btn-sm"><i class="fas fa-chevron-right"></i></button><?php endif;?>
                  </div>
                </div>
              </div>
          <div class="table-responsive">
          <table class="table table-striped projects" >
              <thead>
                  <tr>
                      <th style="width: 1%">
                          #
                      </th>
                      <th style="width: 20%">
                          Date
                      </th>
                      <th style="width: 30%">
                          Titre
                      </th>
                      <th style="width: 20%">
                          Action
                      </th>
                  </tr>
              </thead>
              <tbody>
                  <!-- articles -->
                  <?php while ($data = $listArticles->fetch()): ?>
                  <tr>
                      <td>
                          <?= $data['id'] ?>
                      </td>
                      <td>
                          <a>
                            <?= $data['creation_date_fr'] ?>
                          </a>
                      </td>
                      <td>
                        <?= $data['preview'] ?>
                      </td>  
                      <td>
                          <a class="btn btn-primary btn-sm" href="../index.php?p=post&id=<?= $data['id']; ?>">
                              <i class="fas fa-folder">
                              </i>
                              Voir
                          </a>
                          <a class="btn btn-info btn-sm" href="index.php?p=view_edit&amp;id=<?= $data['id'] ?>">
                              <i class="fas fa-pencil-alt">
                              </i>
                              Modifier
                          </a>
                          <a class="btn btn-danger btn-sm" href="index.php?p=delete_post&amp;id=<?= $data['id'] ?>" onclick="return confirmation()">
                              <i class="fas fa-trash">
                              </i> 
                              Supprimer
                          </a>
                          <a class="btn btn-warning btn-sm" href="index.php?p=comment&amp;page=1&amp;id=<?= $data['id'] ?>">
                              <i class="far fa-comments"></i>
                              </i> 
                              Commentaires
                          </a>
                      </td>
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
                  <?php if($page >= 2):?><button type="button" onclick="location.href='index.php?p=list&page=<?= $previous ?>'" class="btn btn-default btn-sm"><i class="fas fa-chevron-left"></i></button><?php endif;?>
                    <?php if($page < $nbPages):?><button type="button" onclick="location.href='index.php?p=list&page=<?= $next ?>'" class="btn btn-default btn-sm"><i class="fas fa-chevron-right"></i></button><?php endif;?>
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