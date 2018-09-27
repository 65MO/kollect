<?php
include '../../../global/configbase.php';
include '../../../lib/pdo2.php';
if(isset($_POST['cdnom']) && isset($_POST['nomvar'])) 
{
	$cdnom = $_POST['cdnom'];
	$nomvar = $_POST['nomvar'];
	
	function liste_photo($cdnom)
	{
		$bdd = PDO2::getInstance();
		$bdd->query('SET NAMES "utf8"');
		$req = $bdd->prepare("SELECT COUNT(idphoto) AS nb FROM site.photo WHERE cdnom = :cdnom ") or die(print_r($bdd->errorInfo()));
		$req->bindValue(':cdnom', $cdnom);
		$req->execute();
		$resultat = $req->fetchColumn();
		$req->closeCursor();
		return $resultat;
	}
	/*function espece($cdnom,$nomvar)
	{
		$bdd = PDO2::getInstance();
		$bdd->query('SET NAMES "utf8"');
		$req = $bdd->prepare("SELECT espece, genre FROM $nomvar.liste WHERE cdnom = :cdnom ") or die(print_r($bdd->errorInfo()));
		$req->bindValue(':cdnom', $cdnom);
		$req->execute();
		$resultat = $req->fetch(PDO::FETCH_ASSOC);
		$req->closeCursor();
		return $resultat;
	}*/
	
	$retour['nb'] = liste_photo($cdnom);
	//$sp = espece($cdnom,$nomvar);
	//$retour['espece'] = $sp['espece'];
	//$retour['genre'] = $sp['genre'];
	$retour['time'] = time();
	
	$json = file_get_contents('../../../json/'.$nomvar.'.json');
	$rjson = json_decode($json, true);
	$retour['stade'] = (isset($rjson['saisie']['stade'])) ? $rjson['saisie']['stade'] : '';
		
	echo json_encode($retour);		
}	