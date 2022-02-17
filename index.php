<?php
session_start();
include('connexion.php');
$stock=$con->query('SELECT id,article,quantite FROM `stock` WHERE quantite <=(SELECT nombre FROM stock_alerte)');

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
    <header class="header"style="background-color:#2E323A;">
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
        <div class="row">
          <div class="col-lg-9 main-chart">
            <!--CUSTOM CHART START -->
            <div class="border-head">
              <h3>Statistique de vente</h3>
            </div>
            <div style="height: 120px;" class="custom-bar-chart">
              <ul  class="y-axis">
                <li style="height: 30px;"><span>10.000</span></li>
                <li style="height: 30px;"><span>7.500</span></li>
                <li style="height: 30px;"><span>5.000</span></li>
                <li style="height: 30px;"><span>2.500</span></li>
                <li style="height: 30px;"><span>0</span></li>
                <!-- <li style="height: 30px;"><span>0</span></li> -->
               </ul>
              <div class="bar">
                <div class="title">JAN</div>
                <div class="value tooltips" data-original-title="8.500" data-toggle="tooltip" data-placement="top">85%</div>
              </div>
              <div class="bar ">
                <div class="title">FEB</div>
                <div class="value tooltips" data-original-title="5.000" data-toggle="tooltip" data-placement="top">50%</div>
              </div>
              <div class="bar ">
                <div class="title">MAR</div>
                <div class="value tooltips" data-original-title="6.000" data-toggle="tooltip" data-placement="top">60%</div>
              </div>
              <div class="bar ">
                <div class="title">APR</div>
                <div class="value tooltips" data-original-title="4.500" data-toggle="tooltip" data-placement="top">45%</div>
              </div>
              <div class="bar">
                <div class="title">MAY</div>
                <div class="value tooltips" data-original-title="3.200" data-toggle="tooltip" data-placement="top">32%</div>
              </div>
              <div class="bar ">
                <div class="title">JUN</div>
                <div class="value tooltips" data-original-title="6.200" data-toggle="tooltip" data-placement="top">62%</div>
              </div>
              <div class="bar">
                <div class="title">JUL</div>
                <div class="value tooltips" data-original-title="7.500" data-toggle="tooltip" data-placement="top">75%</div>
              </div>
            </div>
            <!-- <div id="chartContainer" style="height: 370px; width: 100%;"></div> -->
            <div style="background:white;border-radius:10px;">
              <h3 style="text-align:center;color:red;">Stock d'alerte</h3>
            <table class="table table-striped table-hover table-sm table-bordered">
                <thead>
                  <th style="text-align:center;background:#2E323A;color:white;">#</th>
                  <th style="text-align:center;background:#2E323A;color:white;">Article</th>
                  <th style="text-align:center;background:#2E323A;color:white;">Quantite Disponible</th>
                  </thead>
                <tbody>
                <?php 
                  foreach($stock as $stk){ ?>
                  <tr>
                  <td style="text-align:center;color:red;"><?php echo($stk['id']) ?></td>
                  <td style="text-align:center;color:red;"><?php echo($stk['article']) ?></td>
                  <td style="text-align:center;color:red;"><?php echo($stk['quantite']) ?></td>
                  </tr>
                 <?php } ?>
                 
                </tbody>
            </table>
            </div>
            <!--custom chart end-->
            <div class="row mt">
              <!-- SERVER STATUS PANELS -->
              <div class="col-md-4 col-sm-4 mb">
                <div class="grey-panel pn">
                  <div class="grey-header">
                    <h3>Airtel</h3>
                  </div>
                  <div>
                    <img style="width: 220px ;height: 150px;border-radius:10px;" src="img/airtel.png" alt="airtel image">
                  </div>
                  <p>Users in DRC : 70 %</p>
                </div>
                <!-- /grey-panel -->
              </div>
              <!-- /col-md-4-->
              <div class="col-md-4 col-sm-4 mb">
                <div class="darkblue-panel pn">
                  <div class="darkblue-header">
                    <h3>Vodacom</h3>
                  </div>
                  <div>
                    <img  style="height: 150px;border-radius:10px;" src="img/vodacom.jpg" alt="vodacom image">
                  </div>
                  <p>Users in DRC : 75 %</p>
                  
                </div>
                <!--  /darkblue panel -->
              </div>
              <!-- /col-md-4 -->
              <div class="col-md-4 col-sm-4 mb">
                <!-- REVENUE PANEL -->
                <div class="green-panel pn">
                  <div class="green-header">
                    <h3>Orange</h3>
                  </div>
                  <div>
                    <img  style="height: 150px;border-radius:10px;" src="img/orange.jpg" alt="vodacom image">
                  </div>
                  <p>Users in DRC : 65 %</p>
                </div>
              </div>
              <!-- /col-md-4 -->
            </div>
            
            </div>
          <!-- /col-lg-9 END SECTION MIDDLE -->
          <!-- **********************************************************************************************************************************************************
              RIGHT SIDEBAR CONTENT
              *********************************************************************************************************************************************************** -->
          <div class="col-lg-3 ds">
            <!--COMPLETED ACTIONS DONUTS CHART-->
            <!-- <div class="donut-main"> -->
              
            <!-- CALENDAR-->
            <div style="position:fixed;">
            <h3>Calendier</h3>
            <div id="calendar" class="mb">
              <div class="panel green-panel no-margin">
                <div class="panel-body">
                  <div id="date-popover" class="popover top" style="cursor: pointer;  margin-left: 33%; margin-top: -50px; width: 175px;">
                    <div class="arrow"></div>
                    <h3 class="popover-title"></h3>
                    <div id="date-popover-content" class="popover-content"></div>
                  </div>
                  <div id="my-calendar"></div>
                </div>
              </div>
            </div>
            </div>
            <!-- / calendar -->
          </div>
          <!-- /col-lg-3 -->
        </div>
        <!-- /row -->
      </section>
    </section>
    <!--main content end-->
    <!--footer start-->
    <footer class="site-footer">
      <div class="text-center">
        <p>
          &copy; Copyrights <strong>Winner</strong>. All Rights Reserved
        </p>
        <a href="index.php#" class="go-top">
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
  
  <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
  <!--script for this page-->
  <script src="lib/sparkline-chart.js"></script>
  <script src="lib/zabuto_calendar.js"></script>
 
  <script type="application/javascript">
    $(document).ready(function() {
      $("#date-popover").popover({
        html: true,
        trigger: "manual"
      });
      $("#date-popover").hide();
      $("#date-popover").click(function(e) {
        $(this).hide();
      });

      $("#my-calendar").zabuto_calendar({
        action: function() {
          return myDateFunction(this.id, false);
        },
        action_nav: function() {
          return myNavFunction(this.id);
        },
        ajax: {
          url: "show_data.php?action=1",
          modal: true
        },
        legend: [{
            type: "text",
            label: "Special event",
            badge: "00"
          },
          {
            type: "block",
            label: "Regular event",
          }
        ]
      });
    });

    function myNavFunction(id) {
      $("#date-popover").hide();
      var nav = $("#" + id).data("navigation");
      var to = $("#" + id).data("to");
      console.log('nav ' + nav + ' to: ' + to.month + '/' + to.year);
    }
  </script>
</body>

</html>
