<?php

include('connexion.php');

if(isset($_POST['id']) && isset($_POST['nom']) && isset($_POST['postnom']) && isset($_POST['prenom']) && isset($_POST['sexe']) && isset($_POST['quartier']) && isset($_POST['avenue']) && isset($_POST['telephone'])){
$id=$_POST['id'];
$nom=$_POST['nom'];
$postnom=$_POST['postnom'];
$prenom=$_POST['prenom'];
$sexe=$_POST['sexe'];
$quartier=$_POST['quartier'];
$avenue=$_POST['avenue'];
$tel=$_POST['telephone'];

$stmt=$con->prepare("UPDATE `client` SET nom=:nom,postnom=:post,prenom=:pren,sexe=:sexe,quartier=:quart,avenu=:av,telephone=:tel WHERE id_cli=:id");
$stmt->execute([
'nom' =>$nom,
'post' =>$postnom,
'pren' =>$prenom,
'sexe' =>$sexe,
'quart' =>$quartier,
'av'=>$avenue,
'tel'=>$tel,
'id' =>$id
]);
header('location:clients.php');
// echo("inserted successfull");
}

if(isset($_POST['id']) && isset($_POST['nom'])&& isset($_POST['postnom'])&& isset($_POST['prenom'])&& isset($_POST['sexe'])&& isset($_POST['adresse'])&& isset($_POST['shop'])&& isset($_POST['telephone'])){
    $id=$_POST['id'];
    $nom=$_POST['nom'];
    $postnom=$_POST['postnom'];
    $prenom=$_POST['prenom'];
    $sexe=$_POST['sexe'];
    $adresse=$_POST['adresse'];
    $shop=$_POST['shop'];
    $tel=$_POST['telephone'];
    
    $stmt=$con->prepare("UPDATE `fournisseur` SET nom=:nom,postnom=:post,prenom=:pren,sexe=:sexe,adresse=:adresse,shop=:shop,telephone=:tel WHERE id_f=:id_f");
    $stmt->execute([
    'nom' =>$nom,
    'post' =>$postnom,
    'pren' =>$prenom,
    'sexe' =>$sexe,
    'adresse' =>$adresse,
    'shop'=>$shop,
    'tel'=>$tel,
    'id_f' =>$id
    ]);
    header('location:fournisseur.php');
    
    }