<?php
session_start();
include('connexion.php');

$rqt=$con->query('SELECT * FROM `client`');
$resultat=$rqt->fetchAll();
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
      <a href="index.phpl" class="logo"><b>Gestion de vente <span>des Unites</span></b></a>
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
         <h3>Formulaire des clients</h3>
         <div class="form-group">
          <button class="btn btn-info" data-toggle="modal" data-target="#myModal">Ajouter client</button>    
         </div>

         <table class="table table-striped table-hover table-sm table-bordered">
            <thead>
              <tr>
                <th style="text-align:center;background:#2E323A;color:white;">#</th>
                <th style="text-align:center;background:#2E323A;color:white;">nom</th>
                <th style="text-align:center;background:#2E323A;color:white;">postnom</th>
                <th style="text-align:center;background:#2E323A;color:white;">prenom</th>
                <th style="text-align:center;background:#2E323A;color:white;">sexe</th>
                <th style="text-align:center;background:#2E323A;color:white;">quartier</th>
                <th style="text-align:center;background:#2E323A;color:white;">avenue</th>
                <th style="text-align:center;background:#2E323A;color:white;">telephone</th>
                <th style="text-align:center;background:#2E323A;color:white;">paremettres</th>
                </tr>  
            </thead>
            <tbody>
            <?php foreach($resultat as $ligne){ ?>
            
            <tr>
            <td style="text-align:center;"> <?php echo($ligne['id_cli']) ?> </td>
            <td style="text-align:center;"> <?php echo($ligne['nom']) ?> </td>
            <td style="text-align:center;"> <?php echo($ligne['postnom']) ?> </td>
            <td style="text-align:center;"> <?php echo($ligne['prenom']) ?> </td>
            <td style="text-align:center;"> <?php echo($ligne['sexe']) ?> </td>
            <td style="text-align:center;"> <?php echo($ligne['quartier']) ?> </td>
            <td style="text-align:center;"> <?php echo($ligne['avenu']) ?> </td>
            <td style="text-align:center;"> <?php echo($ligne['telephone']) ?>  </td>
            <td style="text-align:center;">
            <button type="button" id="edit" class="btn btn-info edit">Modifier</button>
            </td>
            </tr>
            
        <?php } ?>
        </tbody>
            
         </table>
 
      </section>
    </section>
    <!--main content end-->

<!-- modal-star -->
        
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Ajouter client</h4>
                    </div>
                    <div class="modal-body">
                        <form action="traitement.php" method="POST">
                            <div class="form-group">
                                <label for="nom">nom</label>
                                <input type="text" name="nom" id="nom" class="form-control btn-round">
                                <label for="postnom">postnom</label>
                                <input type="text" name="postnom" id="prenom" class="form-control btn-round">
                                <label for="prenom">prenom</label>
                                <input type="text" name="prenom" id="prenom" class="form-control btn-round">
                                <label for="sexe">sexe</label>
                                <select name="sexe" id="sexe" class="form-control btn-round">
                                    <option value="m">M</option>
                                    <option value="f">F</option>
                                </select>
                                <label for="quartier">quartier</label>
                                <input type="text" name="quartier" id="quartier" class="form-control btn-round">
                                <label for="avenue">avenue</label>
                                <input type="text" name="avenue" id="avenue" class="form-control btn-round">
                                <label for="telephone">telephone</label>
                                <input type="tel" name="telephone" id="telephone" class="form-control btn-round">
                            </div>
                            <input type="submit" value="Enregistrer" class="btn btn-info btn-round">
                        </form>

                    </div>
                </div>

            </div>
        </div>
         <!-- modal-end -->

         <!-- modal-star modification -->

         <div class="modal fade" id="Modalmodif" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="ModalLabel">modifier client</h4>
                    </div>
                    <div class="modal-body">
                        <form action="modification.php" method="POST">
                            <div class="form-group">
                                <input type="hidden" name="id" id="id" value=""> <br>
                                <label for="nom">nom</label>
                                <input type="text" name="nom" id="mod_nom" value="" class="form-control btn-round">
                                <label for="postnom">postnom</label>
                                <input type="text" name="postnom" id="mod_postnom" value="" class="form-control btn-round">
                                <label for="prenom">prenom</label>
                                <input type="text" name="prenom" id="mod_prenom" value="" class="form-control btn-round">
                                <label for="sexe">sexe</label>
                                <select name="sexe" id="mod_sexe" class="form-control btn-round">
                                    <option value="m">M</option>
                                    <option value="f">F</option> 
                                </select>
                                <label for="quartier">quartier</label>
                                <input type="text" name="quartier" id="mod_quartier" value="" class="form-control btn-round">
                                <label for="avenue">avenue</label>
                                <input type="text" name="avenue" id="mod_avenue" value="" class="form-control btn-round">
                                <label for="telephone">telephone</label>
                                <input type="tel" name="telephone" id="mod_telephone" value="" class="form-control btn-round">
                            </div>
                            <input type="submit" value="Update" class="btn btn-info btn-round">
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
  
  <script>
    $(document).ready(function(){
      $('.edit').on('click',function(){

        $('#Modalmodif').modal('show');

        $tr=$(this).closest('tr');
        var data=$tr.children("td").map(function(){
          return $(this).text();
        }).get();
        console.log(data);

        $('#id').val(data[0]);
        $('#mod_nom').val(data[1]);
        $('#mod_postnom').val(data[2]);
        $('#mod_prenom').val(data[3]);
        $('#mod_sexe').val(data[4]);
        $('#mod_quartier').val(data[5]);
        $('#mod_avenue').val(data[6]);
        $('#mod_telephone').val(data[7]);

      });
    });
  </script>
 
</body>

</html>
