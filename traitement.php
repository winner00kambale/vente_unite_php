<?php

include('connexion.php');

if(isset($_POST['nom']) && isset($_POST['postnom']) && isset($_POST['prenom']) && isset($_POST['sexe']) && isset($_POST['quartier']) && isset($_POST['avenue']) && isset($_POST['telephone'])){
$nom=$_POST['nom'];
$postnom=$_POST['postnom'];
$prenom=$_POST['prenom'];
$sexe=$_POST['sexe'];
$quartier=$_POST['quartier'];
$avenue=$_POST['avenue'];
$tel=$_POST['telephone'];

$stmt=$con->prepare("INSERT INTO client(nom,postnom,prenom,sexe,quartier,avenu,telephone) VALUES (:nom,:post,:pren,:sexe,:quart,:av,:tel)");
$stmt->execute([
'nom' =>$nom,
'post' =>$postnom,
'pren' =>$prenom,
'sexe' =>$sexe,
'quart' =>$quartier,
'av'=>$avenue,
'tel'=>$tel
]);
header('location:clients.php');
// echo("inserted successfull");
}
if(isset($_POST['nom']) && isset($_POST['postnom']) && isset($_POST['prenom']) && isset($_POST['sexe']) && isset($_POST['adresse']) && isset($_POST['shop']) && isset($_POST['telephone'])){
    $nom=$_POST['nom'];
    $postnom=$_POST['postnom'];
    $prenom=$_POST['prenom'];
    $sexe=$_POST['sexe'];
    $adresse=$_POST['adresse'];
    $shop=$_POST['shop'];
    $tel=$_POST['telephone'];
    
    $stmt=$con->prepare("INSERT INTO fournisseur(nom,postnom,prenom,sexe,adresse,shop,telephone) VALUES (:nom,:post,:pren,:sexe,:adresse,:shop,:tel)");
    $stmt->execute([
    'nom' =>$nom,
    'post' =>$postnom,
    'pren' =>$prenom,
    'sexe' =>$sexe,
    'adresse' =>$adresse,
    'shop'=>$shop,
    'tel'=>$tel
    ]);
    header('location:fournisseur.php');
    // echo("inserted successfull");
    }

    if(isset ($_POST['designation'])){
        $designation=$_POST['designation'];
        $stmt=$con->prepare("INSERT INTO `categorie`(`designation`) VALUES (:designation)");
        $stmt->execute([
            'designation' =>$designation,
        ]);
        header('location:produit.php');
    }
    if(isset($_POST['designationP']) && isset($_POST['nombreP']) && isset($_POST['montantP']) && isset($_POST['fournisseurP'])){
        $designation=$_POST['designationP'];
        $nombre=$_POST['nombreP'];
        $montant=$_POST['montantP'];
        $fournisseur=$_POST['fournisseurP'];
        // $date=$_POST['date'];
        $stmt=$con->prepare("CALL sp_produit(:designation,:nombre,:montant,:fournisseur)");
        $stmt->execute([
        'designation' =>$designation,
        'nombre' =>$nombre,
        'montant' =>$montant,
        'fournisseur' =>$fournisseur,
        // 'date' =>$date,
        ]);
        header('location:produit.php');
        }
        
        if(isset($_POST['designationP']) && isset($_POST['nombreP'])){
            $designation=$_POST['designationP'];
            $nombre=$_POST['nombreP'];
            $stmt=$con->prepare("CALL sp_stock(:designation,:nombre)");
            $stmt->execute([
            'designation' =>$designation,
            'nombre' =>$nombre,
            ]);
            header('location:produit.php');
            }
        if(isset($_POST['vclient']) && isset($_POST['vdesignation']) && isset($_POST['vnombre']) && isset($_POST['vmontant'])){
            $client=$_POST['vclient'];
            $designation=$_POST['vdesignation'];
            $nombre=$_POST['vnombre'];
            $montant=$_POST['vmontant'];
            // $date=$_POST['vdate'];
            try{
                $stmt=$con->prepare("CALL sp_vente(:client,:designation,:nombre,:montant)");
                 $stmt->execute([
                'client' =>$client,
                'designation' =>$designation,
                'nombre' =>$nombre,
                'montant' =>$montant,
                // 'date' =>$date,
            ]);
            }
            catch(Exception $e) {
                echo 'Message: ' .$e->getMessage();
              }
              header('location:vente.php');
            }
                if(isset($_POST['pclient']) && isset($_POST['pmontant']) && isset($_POST['agent'])){
                    $client=$_POST['pclient'];
                    $pmontant=$_POST['pmontant'];
                    $agent=$_POST['agent'];
                    // $pdate=$_POST['pdate'];
                    $stmt=$con->prepare("CALL sp_paye(:client,:pmontant,:agent)");
                    $stmt->execute([
                        'client' =>$client,
                        'pmontant' =>$pmontant,
                        'agent' =>$agent,
                        // 'pdate' =>$pdate,                           
                    ]);
                    header('location:payement.php');
                    }
                    if(isset($_POST['nombre_sec'])){ 
                        $nbr=$_POST['nombre_sec'];
                        $stmt=$con->prepare("CALL sp_securite(:nbr)");
                        $stmt->execute([
                            'nbr' =>$nbr,  
                        ]);
                        header('location:paramettre.php');
                    }
                    if(isset($_POST['nom']) && isset($_POST['username']) && isset($_POST['password']) && isset($_POST['acces']) && isset($_POST['mail'])){
                        $nom=$_POST['nom'];
                        $username=$_POST['username'];
                        $pass = $_POST['password'];
                        $role=$_POST['acces'];
                        if(!filter_var($_POST['mail'],FILTER_VALIDATE_EMAIL)){
                            die("l'adresse mail est incorecte");
                        }
                        $stmt=$con->prepare("INSERT INTO `users`(`nom`, `username`, `passwords`, `acces`, `mail`) VALUES (:nom,:username,:pass,:acces,:mail)");
                        $stmt->bindValue(":nom",$nom,PDO::PARAM_STR);
                        $stmt->bindValue(":username",$username,PDO::PARAM_STR);
                        $stmt->bindValue(":pass",$pass,PDO::PARAM_STR);
                        $stmt->bindValue(":acces",$role,PDO::PARAM_STR);
                        $stmt->bindValue(":mail",$_POST['mail'],PDO::PARAM_STR);
                        $stmt->execute();
                        header('location:paramettre.php');
                        }else{
                            die('Tous les champs sont obligatoires svp');
                        }

    