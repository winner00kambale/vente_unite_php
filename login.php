<?php
session_start();
include('connexion.php');

if(isset($_POST['username']) && isset($_POST['password'])){

    $username=$_POST['username'];
    $password=$_POST['password'];

    $stmt=$con->prepare("SELECT * FROM users WHERE username=:username AND passwords=:password ");
    $stmt->execute([
        'username'=>$username,
        'password'=>$password,
    ]);
    $user=$stmt->fetch();

    if($user){
        $_SESSION['user_id']=$user['id'];
        $_SESSION['user_name']=$user['nom'];
        $_SESSION['user_acces']=$user['acces'];
        header('location:index.php');
    }
    else
    {
        header('location:login.php?error=1');
    }

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="Winner">
  <meta name="keyword" content="winner, gestion, vente, unites, Responsive, Fluid">
  <title>Login</title>

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
  <?php if(isset($_GET['error'])){echo "<div class='alert alert-danger text-white'>Erreur de la connexion verifier votre username et password svp !</div>";} ?>
    <div class="container">
      <form class="form-login" action="login.php" method="POST">
        <h2 class="form-login-heading">Login</h2>
        <div class="login-wrap">
            <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" name="username" placeholder="Username" autofocus>
            </div>
            <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" name="password" placeholder="Password">
            </div>
          <!-- <input type="text" class="form-control" placeholder="User ID" autofocus> -->
          <!-- <br>
          <input type="password" class="form-control" placeholder="Password"> -->
          
          <button class="btn btn-theme btn-block" href="index.php" type="submit"><i class="fa fa-lock"></i> SIGN IN</button>
          <label class="checkbox">
            <!-- <input type="checkbox" value="remember-me"> Remember me -->
            <span class="pull-right">
            <a href="#"> Forgot Password?</a>
            </span>
            </label> <br>
          <hr>
          <!-- <div class="login-social-link centered">
            <p>or you can sign in via your social network</p>
            <button class="btn btn-facebook" type="submit"><i class="fa fa-facebook"></i> Facebook</button>
            <button class="btn btn-twitter" type="submit"><i class="fa fa-twitter"></i> Twitter</button>
          </div> -->
          <div class="registration">
            Don't have an account yet?<br/>
            <a class="" href="#">
              Create an account
              </a>
          </div>
        </div>
        </div>
        <!-- Modal -->
        
        <!-- modal -->
      </form>
    </div>
  </div>
  <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Forgot Password ?</h4>
              </div>
              <div class="modal-body">
                <p>Entrez votre adresse e-mail ci-dessous pour réinitialiser votre mot de passe.</p>
                <form  method="POST">
                <input type="text" name="recup_mail" placeholder="Email" autocomplete="off" class="form-control placeholder-no-fix btn-round"> <br>
               <input class="btn btn-info" type="submit" name="recup_submit" value="Submit">
              </form>
              </div>
            </div>
          </div>
        </div>
  <!-- js placed at the end of the document so the pages load faster -->
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
