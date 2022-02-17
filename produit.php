<?php
session_start();
include('connexion.php');
$categorie=$con->query('select * from categorie');
$fournisseur=$con->query('select * from fournisseur');

$rqt=$con->query('SELECT * FROM `aff_prod` ORDER by id_pro DESC');
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
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
    <?php 
    // if(isset($_GET['p'])){
    //   echo("<script> 
    //   Swal.fire('inserer avec succes');
    //   </script> ");
    // }
    ?>
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
            <div style="background:white;z-index: 0;border-radius:7px;">
           <h3>Approvisionnement</h3>
            <form style="padding:5px;" action="traitement.php" method="POST" >
            <div class="form-goup">
              <label for="designation">Designation</label>
              <select name="designationP" id="designation" class="form-control btn-round">
                <!-- <option value=""></option> -->
                <?php while($cat=$categorie->fetch()){ ?>
                  <option value="<?php echo($cat['designation']); ?> "><?php echo($cat['designation']); ?></option>
            <?php } ?>
              </select>
            </div> <br>
            <div class="form-goup">
              <label for="nombre">Nombre</label>
              <input type="number" name="nombreP" id="nombre" min="0" oninput="this.value=Math.abs(this.value)" class="form-control btn-round"> 
            </div> <br>
            <div class="form-goup">
              <label for="prix">Montant</label>
              <input type="number" name="montantP" id="montant" min="0" oninput="this.value=Math.abs(this.value)" class="form-control btn-round"> 
            </div> <br>
            <div class="form-goup">
              <label for="fournisseur">Fournisseur</label>
              <select name="fournisseurP" id="fournisseur" class="form-control btn-round">
              <option value=""></option>
                <?php while($four=$fournisseur->fetch()){ ?>
                  <option value="<?php echo($four['prenom']); ?> "><?php echo($four['prenom']); ?></option>
            <?php } ?>
              </select>
            </div> <br>
            <!-- <div class="form-group">
              <label for="date">Date jour</label>
              <input type="date" name="date" id="date" class="form-control btn-round"> 
            </div> -->
           <div class="form-group">
           <input type="submit" class="btn btn-info m-5 btn-round" value="Enregistrer" class="form-control btn-round">
           </div>
            </form>
            <button class="btn btn-info btn-round" style="margin-left: 250px;margin-bottom:10px" data-toggle="modal" data-target="#myModal">+ Categorie</button>
          </div>
          </div>
          <!-- /col-lg-6 -->
          <div class="col-lg-8 col-md-8 col-sm-12">
            <table class="table table-striped table-hover table-sm table-bordered">
                <thead>
                  <th style="text-align:center;background:#2E323A;color:white;">#</th>
                  <th style="text-align:center;background:#2E323A;color:white;">designation</th>
                  <th style="text-align:center;background:#2E323A;color:white;">nombre</th>
                  <th style="text-align:center;background:#2E323A;color:white;">montant</th>
                  <th style="text-align:center;background:#2E323A;color:white;">fournisseur</th>
                  <th style="text-align:center;background:#2E323A;color:white;">date jour</th>
                  <th style="text-align:center;background:#2E323A;color:white;">paramettre</th>
                </thead>
                <tbody>
                 <?php 
                  foreach($resultat as $pro){ ?>
                  <tr>
                  <td style="text-align:center;"><?php echo($pro['id_pro']) ?></td>
                  <td style="text-align:center;"><?php echo($pro['designation']) ?></td>
                  <td style="text-align:center;"><?php echo($pro['nombre']) ?></td>
                  <td style="text-align:center;"><?php echo($pro['montant']) ?></td>
                  <td style="text-align:center;"><?php echo($pro['Fournisseur']) ?></td>
                  <td style="text-align:center;"><?php echo($pro['Date_jour']) ?></td>
                  <td style="text-align:center;">
                  <button type="button" class="btn btn-info edit">Modifier</button>
                  </td>
                  </tr>
                 <?php } ?>
                 
                </tbody>
            </table>
           
          </div>
          <!-- /col-lg-6 -->
        </div>
        
        <!--/ row -->

      </section>
      <!-- /wrapper -->
    </section>
    <!--main content end-->

<!-- modal-star categorie -->
        
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Ajouter Categorie</h4>
                    </div>
                    <div class="modal-body">
                        <form action="traitement.php" method="POST">
                        <div class="form-goup">
                              <label for="designation">Designation</label>
                              <input type="text" name="designation" id="designation" class="form-control btn-round"> 
                            </div> <br>
                            <input type="submit" class="btn btn-info">
                        </form>

                    </div>
                </div>

            </div>
        </div>
         <!-- modal-end -->

         <!-- modal modification -->

         <div class="modal fade" id="Modalmodif" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="ModalLabel">Modifier approvisionnement</h4>
                    </div>
                    <div class="modal-body">
                    <form action="" method="POST">
        <input type="hidden" name="id" id="id">
            <div class="form-goup">
              <label for="designation">Designation</label>
              <input type="text" name="designation" id="mod_designation" class="form-control btn-round"> 
            </div>
            <div class="form-goup">
              <label for="nombre">Nombre</label>
              <input type="number" name="nombre" id="mod_nombre" class="form-control btn-round"> 
            </div>
            <div class="form-goup">
              <label for="prix">Montant</label>
              <input type="number" name="montant" id="mod_montant" class="form-control btn-round"> 
            </div>
            <div class="form-goup">
              <label for="fournisseur">Fournisseur</label>
              <input type="text" name="fournisseur" id="mod_fournisseur" class="form-control btn-round"> 
            </div>
            <div class="form-group">
              <label for="date">Date jour</label>
              <input type="date" name="date" id="mod_date" class="form-control btn-round"> 
            </div>
           <div class="form-group">
           <input type="submit" class="btn btn-info m-5 btn-round" value="Modifier" class="form-control btn-round">
           </div>
            </form>

                    </div>
                </div>

            </div>
        </div>
    
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
        $('#mod_designation').val(data[1]);
        $('#mod_nombre').val(data[2]);
        $('#mod_montant').val(data[3]);
        $('#mod_fournisseur').val(data[4]);
        $('#mod_date').val(data[5]);     
      });
    });
  </script>
</body>

</html>
