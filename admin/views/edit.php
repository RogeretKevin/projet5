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
            <h1>Modifier</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Modifier</li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title">Modifier l'article</h3>
              </div>
              <!-- formulaire -->
              <form method="post" action="index.php?p=edit" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="form-group">
                    <input class="form-control" placeholder="Titre:" name="newtitle" required="required" value=<?php if(isset($title)): echo $title;else: echo $post['title']; endif; ?>>
                  </div>
                  <div class="form-group">
                      <textarea id="compose-textarea" class="form-control" name="newtext" style="height: 300px" required="required"><?php if(isset($content)): echo $content;else: echo $post['content']; endif; ?></textarea>
                  </div>
                  <input type="hidden" name="id" value=<?php if(isset($id)): echo $id;else: echo $post['id']; endif; ?>>
                  <input type="hidden" name="image" value=<?php if(isset($image)): echo $image;else: echo $post['lien_image']; endif; ?>>
                  <div class="form-group">
                    <div class="btn btn-default btn-file">
                      <i class="fas fa-paperclip"></i> Image
                      <input type="file" name="file" accept="image/*">
                    </div>
                    <p class="help-block">Format image seulement !</p>
                    <?php if(isset($error)):?> <p class="text-danger"><i class="fas fa-exclamation-circle"></i> Un fichier au format Image est attendu</p> <?php endif; ?>
                  </div>
                </div>
                <div class="card-footer">
                  <div class="float-right">
                    <button type="submit" class="btn btn-primary"><i class="far fa-envelope"></i> Valider</button>
                  </div>
                </div>
              </form>
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