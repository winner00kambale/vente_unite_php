<?php
session_start();
include('connexion.php');
$rqt=$con->query('SELECT * FROM `caisse`');
$resultat=$rqt->fetchAll();
$payement=$con->query('SELECT * FROM `aff_payement` ORDER BY Numero DESC');
$client=$con->query('select * from client');
$agent=$con->query('select * from users');
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
        <div class="row mt" style="background:white;border-radius:7px;">
        <div class="col-lg-2 col-md-2 col-sm-12">
        </div>
          <div class="col-lg-5 col-md-5 col-sm-12">
          <div style="padding:5px;border-radius:7px;">
          <h4>Rapport payement</h4>
          <form action="traitement.php" method="POST">
                <div class="form-group">
                    <label for="client">client</label>
                    <select name="pclient" id="pclient" class="form-control btn-round">
                             <option value=""></option>
                                    <?php while($cli=$client->fetch()){ ?>
                                       <option value="<?php echo($cli['postnom']); ?> "><?php echo($cli['postnom']); ?></option>
                                     <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="montant">montant</label>
                    <input type="number" name="pmontant" id="pmontant" min="0" oninput="this.value=Math.abs(this.value)" class="form-control btn-round" >  
                </div>
                <div class="form-group">
                    <label for="agent">agent</label>
                    <select name="agent" id="agent" class="form-control btn-round">
                             <option value=""></option>
                                    <?php while($ag=$agent->fetch()){ ?>
                                       <option value="<?php echo($ag['nom']); ?> "><?php echo($ag['nom']); ?></option>
                                     <?php } ?>
                    </select>
                </div>
                <!-- <div class="form-group">
                    <label for="pdate">date paiement</label>
                    <input type="date" name="pdate" id="pdate" class="form-control btn-round" >  
                </div> -->
                <input type="submit" value="Enregistrer" class="btn btn-info btn-round">
          </form>

          </div>
          
            </div>
            <div style="padding-top: 120px;" class="col-lg-3 col-md-3 col-sm-12">
            <h4>Rapport en Caise</h4>
          <table class="table table-striped table-hover table-sm table-bordered">
              <thead>
              <th style="text-align:center;background:red;color:white;">Solde caisse</th>
              <th style="text-align:center;background:#2E323A;color:white;">Devise</th>
              </thead>
              <tbody>
                <?php 
                  foreach($resultat as $caisse){ ?>
                  <tr>
                  <td style="text-align:center;font-size: 25px;"><?php echo($caisse['montant']) ?></td>
                  <td style="text-align:center;font-size: 25px;">USD</td>
                  </tr>
                 <?php } ?>
                </tbody>
            </table>
            
            </div>
          <div class="col-lg-2 col-md-2 col-sm-12">
              
          </div>
          </div>
        
        <!--/ row -->

        <div class="row mt">
            <div class="col-lg-1 col-md-1 col-sm-12"></div>
            <div class="col-lg-10 col-md-10 col-sm-12">
        <table class="table table-striped table-hover table-sm table-bordered"> 
            <thead>
            <th style="text-align:center;background:#2E323A;color:white;">#</th>
            <th style="text-align:center;background:#2E323A;color:white;">client</th>
            <th style="text-align:center;background:#2E323A;color:white;">montant</th>
            <th style="text-align:center;background:#2E323A;color:white;">date paiement</th>
            <th style="text-align:center;background:#2E323A;color:white;">utilisateur</th>
            </thead>
            <tbody>
                <?php 
                  foreach($payement as $paye){ ?>
                  <tr>
                  <td style="text-align:center;"><?php echo($paye['Numero']) ?></td>
                  <td style="text-align:center;"><?php echo($paye['Client']) ?></td>
                  <td style="text-align:center;"><?php echo($paye['montant']) ?></td>
                  <td style="text-align:center;"><?php echo($paye['datepaye']) ?></td>
                  <td style="text-align:center;"><?php echo($paye['nom']) ?></td>
                  </tr>
                 <?php } ?>
                </tbody>         
        </table>
            </div>
            <div class="col-lg-1 col-md-1 col-sm-12"></div>
        </div>

      </section>
      <!-- /wrapper -->
    </section>
    <!--main content end-->


    
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
 
</body>

</html>