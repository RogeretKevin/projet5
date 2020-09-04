<!DOCTYPE html>
<html lang="fr">
<head>
  
  <meta charset="UTF-8">
  <!--<meta http-equiv="X-UA-Compatible" content="IE=edge">-->
  <title>AdminLTE 3 | Log in</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- css -->
  <link rel="stylesheet" href="dist/css/adminlte.css">

  <!-- police d'ecriture -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <b>Admin</b>LTE
  </div>
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Connectez-vous pour démarrer votre session</p>
      <!-- formulaire -->
      <form action="index.php?p=login" method="post">
        <div class="input-group mb-3">
          <input type="text" name="pseudo" class="form-control" placeholder="Pseudo" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <i class="fas fa-user"></i>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="pass" class="form-control" placeholder="Mot de passe" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" name="remember" id="remember">
              <label for="remember">
                Se souvenir de moi ?
              </label>
            </div>
          </div>
          <div class="col-4">
            <button type="submit" class="btn btn-primary">Connection</button>
          </div>
        </div>
      </form>

      <p class="mb-0">
        <a href="../index.php" class="text-center"><i class="fas fa-arrow-left"></i> Retour au site </a>
      </p>
    </div>
  </div>
  <!-- erreur validation -->
  <?php if(isset($error)){ ?>
    <div class="login-box-msg"> <?= $error; ?></div>
  <?php } ?>
</div>

<!-- javascript -->
<script src="https://kit.fontawesome.com/900200da29.js" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
<script src="dist/js/adminlte.min.js"></script>

</body>
</html>
