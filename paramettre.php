<?php
session_start();
include('connexion.php');
$rqt=$con->query('SELECT * FROM `stock_alerte`');
$alerte=$rqt->fetchAll();
$users=$con->query('SELECT * FROM `users`');

if(!isset($_SESSION['user_id']))
{
    header('location:login.php');
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
  <title>Gestion de vente des unites</title>

  <!-- Favicons -->
  <link href="img/logo.png" rel="icon">
  <link href="img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Bootstrap core CSS -->
  <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!--external css-->
  <link href="lib/font-awesome/css/font-awesome.css" rel="stylesheet" />
  <link rel="stylesheet" type="text/css" href="css/zabuto_calendar.css">
  <link rel="stylesheet" type="text/css" href="lib/gritter/css/jquery.gritter.css" />
  <!-- Custom styles for this template -->
  <link href="style.css" rel="stylesheet">
  <link href="css/style-responsive.css" rel="stylesheet">
  <script src="lib/chart-master/Chart.js"></script>

</head>

<body>
  <section id="container">
    <!-- **********************************************************************************************************************************************************
        TOP BAR CONTENT & NOTIFICATIONS
        *********************************************************************************************************************************************************** -->
    <!--header start-->
    <header class="header " style="background-color:#2E323A;">
      <div class="sidebar-toggle-box">
        <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
      </div>
      <!--logo start-->
      <a href="index.php" class="logo"><b>Gestion de vente <span>des Unites</span></b></a>
      <!--logo end-->
      
      <div class="top-menu">
        <ul class="nav pull-right top-menu">
          <li><a class="logout" href="Logout.php">Logout</a></li>
        </ul>
      </div>
    </header>
    <!--header end-->
    <!-- **********************************************************************************************************************************************************
        MAIN SIDEBAR MENU
        *********************************************************************************************************************************************************** -->
    <!--sidebar start-->
    <aside>
      <div id="sidebar" class="nav-collapse ">
        <!-- sidebar menu start-->
        <ul class="sidebar-menu" id="nav-accordion">
          <p class="centered"><a href="profile.html"><img src="img/logo.PNG" class="img-circle" width="80"></a></p>
          <h5 class="centered">Bien connecté</h5>
          <h5 class="centered"> <span><?php echo($_SESSION['user_name']) ?></span> </h5>
          <hr>
          <li class="mt">
            <a class="active" href="index.php">
              <i class="fa fa-dashboard"></i>
              <span>Dashboard</span>
              </a>
          </li>
          <li class="sub-menu">
            <a href="javascript:;">
              <i class="fa fa-desktop"></i>
              <span>Reception</span>
              </a>
              <ul class="sub">
              <li><a href="clients.php">Client</a></li>
              <li><a href="fournisseur.php">Fournisseur</a></li>
              <li><a href="payement.php">Comptabilite</a></li>
            </ul>
          </li>
          <li class="sub-menu">
            <a href="javascript:;">
              <i class="fa fa-cogs"></i>
              <span>Articles</span>
              </a>
            <ul class="sub">
              <li><a href="produit.php">Nos produits</a></li>
              <li><a href="vente.php">Vente</a></li>
              <?php if($_SESSION['user_acces'] == 'admin') { ?>
              <li><a href="paramettre.php">Paramettre</a></li>
              <?php } ?>
            </ul>
          </li>
        <!-- sidebar menu end-->
      </div>
    </aside>
    <!--sidebar end-->
    <!-- **********************************************************************************************************************************************************
        MAIN CONTENT
        *********************************************************************************************************************************************************** -->
    <!--main content start-->
    
    <section id="main-content">
      <section class="wrapper">
        
        <div class="row mt">
        
          <div class="col-lg-4 col-md-4 col-sm-12" >
            <h3>Stock de securite</h3>
            <form action="traitement.php" method="POST">
            <div class="form-group">
              <input type="number" name="nombre_sec" id="nombre_sec" min="0" oninput="this.value=Math.abs(this.value)" class="form-control btn-round" required/>
            </div>
            <input type="submit" class="btn btn-info btn-round" value="Enregistrer">
          </form> <br>
          <table class="table table-striped table-hover table-sm table-bordered">
            <thead>
            <th style="text-align:center;background:#2E323A;color:white;">#</th>
            <th style="text-align:center;background:#2E323A;color:white;">Quantite</th>
            </thead>
            <tbody>
           <?php foreach($alerte as $stock){ ?>
                  <tr>
                  <td style="text-align:center;"><?php echo($stock['id']) ?></td>
                  <td style="text-align:center;"><?php echo($stock['nombre']) ?></td>
                  </tr>
                 <?php } ?>
            </tbody>
          </table>
          </div>
          <div class="col-lg-2 col-md-2 col-sm-12"></div>
          <!-- /col-lg-6 -->
          <div class="col-lg-5 col-md-5 col-sm-12">
          <h3>Inscripption des utilisateurs</h3>
          <form action="traitement.php" method="POST">
          <div class="form-group">
            <label for="nom">nom</label>
            <input type="text" name="nom" id="nom" class="form-control btn-round">
            <label for="username">username</label>
            <input type="text" name="username" id="username" class="form-control btn-round">
            <label for="password">password</label>
            <input type="password" name="password" id="password" class="form-control btn-round">
            <label for="acces">roles</label>
            <select name="acces" id="acces" class="form-control btn-round">
              <option value=""></option>
              <option value="admin">admin</option>
              <option value="autre">autre</option>
            </select>
            <label for="mail">mail</label>
            <input type="mail" name="mail" id="mail" class="form-control btn-round">
          </div>
          <input type="submit" value="Inscrire" class="btn btn-info btn-round">
          </form>
          <div> <br>
          <table class="table table-striped table-hover table-sm table-bordered">
              <thead>
                <th style="text-align:center;background:#2E323A;color:white;">#</th>
                <th style="text-align:center;background:#2E323A;color:white;">nom</th>
                <th style="text-align:center;background:#2E323A;color:white;">username</th>
                <th style="text-align:center;background:#2E323A;color:white;">password</th>
                <th style="text-align:center;background:#2E323A;color:white;">Email</th>
              </thead>
              <tbody>
              <?php foreach($users as $ligne){ ?>
            <tr>
            <td style="text-align:center;"> <?php echo($ligne['id']) ?> </td>
            <td style="text-align:center;"> <?php echo($ligne['nom']) ?> </td>
            <td style="text-align:center;"> <?php echo($ligne['username']) ?> </td>
            <td style="text-align:center;"> <?php echo($ligne['passwords']) ?> </td>
            <td style="text-align:center;"> <?php echo($ligne['mail']) ?> </td>
            <!-- <td style="text-align:center;">
            <button type="button" class="btn btn-info edit">Modifier</button>
            </td> -->
            </tr>

        <?php } ?>
              </tbody>
            </table>
          </div> 

          </div>
          <!-- /col-lg-6 -->
        </div>
        
        <!--/ row -->

      </section>
      <!-- /wrapper -->
    </section>
    <!--main content end-->

<!-- modal-star categorie -->
        
        
         <!-- modal-end -->

         <!-- modal modification -->

         
    
    <!--footer start-->
    <footer class="site-footer">
      <div class="text-center">
        <p>
          &copy; Copyrights <strong>Winner</strong>. All Rights Reserved
        </p>
        <a href="clients.php#" class="go-top">
          <i class="fa fa-angle-up"></i>
          </a>
      </div>
    </footer>
    <!--footer end-->
  </section>
  <!-- js placed at the end of the document so the pages load faster -->
  <script src="lib/jquery/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>

  <script src="lib/bootstrap/js/bootstrap.min.js"></script>
  <script class="include" type="text/javascript" src="lib/jquery.dcjqaccordion.2.7.js"></script>
  <script src="lib/jquery.scrollTo.min.js"></script>
  <script src="lib/jquery.nicescroll.js" type="text/javascript"></script>
  <script src="lib/jquery.sparkline.js"></script>
  <!--common script for all pages-->
  <script src="lib/common-scripts.js"></script>
 
  <!--script for this page-->
  <script src="lib/sparkline-chart.js"></script>
  <script src="lib/zabuto_calendar.js"></script>
  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
 
  <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" ></script> -->
  
  
</body>

</html>
