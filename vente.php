<?php
session_start();
include('connexion.php');
$rqt=$con->query('SELECT * FROM `affichage_vente` ORDER BY id_vente DESC');
$resultat=$rqt->fetchAll();
$client=$con->query('select * from client order by id_cli DESC');
$categorie=$con->query('select * from categorie');
$stock=$con->query('select * from stock');
$panier=$con->query('select * from panier');
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
          <div class="col-lg-7 col-md-7 col-sm-12">
           
          <h4>Rapport vente</h4>
          <table class="table table-striped table-hover table-sm table-bordered">
                <thead>
                  <th style="text-align:center;background:#2E323A;color:white;">#</th>
                  <th style="text-align:center;background:#2E323A;color:white;">client</th>
                  <th style="text-align:center;background:#2E323A;color:white;">produit</th>
                  <th style="text-align:center;background:#2E323A;color:white;">nombre</th>
                  <th style="text-align:center;background:#2E323A;color:white;">montant</th>
                  <th style="text-align:center;background:#2E323A;color:white;">date jour</th>
                </thead>
                <tbody>
                <?php 
                  foreach($resultat as $pro){ ?>
                  <tr>
                  <td style="text-align:center;"><?php echo($pro['id_vente']) ?></td>
                  <td style="text-align:center;"><?php echo($pro['postnom']) ?></td>
                  <td style="text-align:center;"><?php echo($pro['designation']) ?></td>
                  <td style="text-align:center;"><?php echo($pro['nombre']) ?></td>
                  <td style="text-align:center;"><?php echo($pro['montant']) ?></td>
                  <td style="text-align:center;"><?php echo($pro['date_vente']) ?></td>
                  </tr>
                 <?php } ?>
                </tbody>
            </table>
            </div>
          <!-- /col-lg-6 -->
          <div class="col-lg-5 col-md-5 col-sm-12">
            <div style="background:white;padding:5px;border-radius:7px;">
            <button class="btn btn-info btn-round" style="margin-left: 250px;" data-toggle="modal" data-target="#myModal">+ Vente</button>
            <a class="btn btn-danger btn-round" href="fpdf/tutorial/rapport.php">Imprimer</a>
              <h4>Stock des articles</h4>
            <table class="table table-striped table-hover table-sm table-bordered">
                <thead>
                  <th style="text-align:center;background:#2E323A;color:white;">#</th>
                  <th style="text-align:center;background:#2E323A;color:white;">Article</th>
                  <th style="text-align:center;background:#2E323A;color:white;">Quantite Stock</th>
                  </thead>
                <tbody>
                <?php 
                  foreach($stock as $stk){ ?>
                  <tr>
                  <td style="text-align:center;"><?php echo($stk['id']) ?></td>
                  <td style="text-align:center;"><?php echo($stk['article']) ?></td>
                  <td style="text-align:center;"><?php echo($stk['quantite']) ?></td>
                  </tr>
                 <?php } ?>
                 
                </tbody>
            </table>
            <br>
            <a class="btn btn-danger btn-round" style="margin-left: 250px;" href="fpdf/tutorial/facture.php">Facture</a>
            <h4>Panier</h4>
            <table class="table table-striped table-hover table-sm table-bordered">
                <thead>
                  <th style="text-align:center;">#</th>
                  <th style="text-align:center;">client</th>
                  <th style="text-align:center;">article</th>
                  <th style="text-align:center;">nombre</th>
                  <th style="text-align:center;">montant</th>
                </thead>
                <tbody>
                <?php 
                  foreach($panier as $pan){ ?>
                  <tr>
                  <td style="text-align:center;"><?php echo($pan['id']) ?></td>
                  <td style="text-align:center;"><?php echo($pan['client']) ?></td>
                  <td style="text-align:center;"><?php echo($pan['article']) ?></td>
                  <td style="text-align:center;"><?php echo($pan['nombre']) ?></td>
                  <td style="text-align:center;"><?php echo($pan['montant']) ?></td>
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

<!-- modal-star -->
        
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Ajouter Vente</h4>
                    </div>
                    <div class="modal-body">
                        <form action="traitement.php" method="POST">
                        <div class="form-goup">
                              <label for="client">client</label>
                              <select name="vclient" id="client" class="form-control btn-round">
                                    <option value=""></option>
                                    <?php while($cli=$client->fetch()){ ?>
                                       <option value="<?php echo($cli['postnom']); ?> "><?php echo($cli['postnom']); ?></option>
                                     <?php } ?>
                              </select> 
                              <div class="form-goup"> 
                              <label for="designation">designation</label>
                                <select name="vdesignation" id="designation" class="form-control btn-round">
                                    <option value=""></option>
                                    <?php while($cat=$categorie->fetch()){ ?>
                                    <option value="<?php echo($cat['designation']); ?> "><?php echo($cat['designation']); ?></option>
                                <?php } ?>
                                </select>
                                </div> 
                                <div class="form-goup">
                                <label for="nombre">Nombre</label>
                                <input type="number" name="vnombre" id="nombre" min="0" oninput="this.value=Math.abs(this.value)" class="form-control btn-round"> 
                                </div>
                                <div class="form-goup">
                                <label for="prix">Montant</label>
                                <input type="number" name="vmontant" id="montant" min="0" oninput="this.value=Math.abs(this.value)" class="form-control btn-round"> 
                                </div> <br>
                                <!-- <div class="form-group">
                                <label for="date">Date jour</label>
                                <input type="date" name="vdate" id="date" class="form-control btn-round"> 
                                </div> -->
                                <input type="submit" value="Ajouter" class="btn btn-info btn-round">
                            </div> 
                            
                        </form>

                    </div>
                </div>

            </div>
        </div>
         <!-- modal-end -->
    
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
