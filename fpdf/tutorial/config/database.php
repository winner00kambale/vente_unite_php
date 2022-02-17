<?php

try{
	$db = new PDO("mysql:host=localhost;dbname=bibliotheque", "root","");
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

} catch(PDOExeption $e){
	die('Erreur : '.$e->getMessage());
}
require 'user.class.php';
$user=new USER($db);

