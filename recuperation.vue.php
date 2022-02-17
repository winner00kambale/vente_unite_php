
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="Winner">
  <meta name="keyword" content="winner, gestion, vente, unites, Responsive, Fluid">
  <title>Recuperation password</title>

  <!-- Favicons -->
  <link href="img/logo.png" rel="icon">
  <link href="img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Bootstrap core CSS -->
  <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!--external css-->
  <link href="lib/font-awesome/css/font-awesome.css" rel="stylesheet" />
  <!-- Custom styles for this template -->
  <link href="style.css" rel="stylesheet">
  <link href="css/style-responsive.css" rel="stylesheet">
  
 
</head>

<body>
  <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
  <div id="login-page">
    <div class="container">
        <?php if($section == 'code') { ?>

        <form class="form-login" method="POST">
        <h2 class="form-login-heading">Recuperation pasword</h2>
        <p style="text-align: center;">code de verification.</p>
        Recuperation de mot de pass pour <?= $_SESSION['recup_mail'] ?>
        <div class="login-wrap">
            <div class="form-group">
            <input type="text" name="verif_code" placeholder="code de verification" autocomplete="off" class="form-control placeholder-no-fix btn-round">
            </div>
          <input class="btn btn-info" type="submit" name="verif_submit" value="Submit">
      </form>

      <?php  } elseif($section=="changemdp"){ ?>

        <form class="form-login"  method="POST">
        <h2 class="form-login-heading">Recuperation pasword</h2>
        <p style="text-align: center;">code de verification.</p>
        Nouveau mot de pass pour <?= $_SESSION['recup_mail'] ?>
        <div class="login-wrap">
            <div class="form-group">
            <input type="password" name="change_mdp" placeholder="nouveau mot de pass" autocomplete="off" class="form-control placeholder-no-fix btn-round">
            <input type="password" name="change_mdpc" placeholder="verification mot de pass" autocomplete="off" class="form-control placeholder-no-fix btn-round">
            </div>
          <input class="btn btn-info" type="submit" name="change_submit" value="Submit">
      </form>

     <?php } else{ ?> 
      <form class="form-login"  method="POST">
        <h2 class="form-login-heading">Recuperation pasword</h2>
        <p style="text-align: center;">Entrez votre adresse e-mail ci-dessous pour réinitialiser votre mot de passe.</p>
        <div class="login-wrap">
            <div class="form-group">
            <input type="email" name="recup_mail" placeholder="Email" autocomplete="off" class="form-control placeholder-no-fix btn-round">
            </div>
          <input class="btn btn-info" type="submit" name="recup_submit" value="Submit">
      </form>
   <?php } ?>
      <?php if(isset($erreur)) { echo'<span style"color-red;">'.$erreur.'</span>';} else{echo"<br />";} ?>
    </div>
  </div>
  
  <script src="lib/jquery/jquery.min.js"></script>
  <script src="lib/bootstrap/js/bootstrap.min.js"></script>
  <!--BACKSTRETCH-->
  <!-- You can use an image of whatever size. This script will stretch to fit in any screen size.-->
  <script type="text/javascript" src="lib/jquery.backstretch.min.js"></script>
  <script>
    $.backstretch("img/login.jpg", {
      speed: 500
    });
  </script>
</body>

</html>
