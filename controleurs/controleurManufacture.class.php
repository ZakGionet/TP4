<?php
// *****************************************************************************************
// Description   : classe contenant la fonction statiquu qui géère les contrôleurs spécifiques
// *****************************************************************************************
include_once("controleurs/controleurAccueilDefaut.class.php");
include_once("controleurs/controleurVoirPanier.class.php");
include_once("controleurs/controleurContact.class.php");
include_once("controleurs/controleurCommande.class.php");
include_once("controleurs/controleurConfirmation.class.php");


class ManufactureControleur
{
	//  Méthode qui crée une instance du controleur associé à l'action
	//  et le retourne
	public static function creerControleur($action): Controleur
	{
		$controleur = null;
	
		if ($action == "voirPanier") {
			$controleur = new VoirPanier();
		} elseif ($action == "contact") {
			$controleur = new Contact();
		} elseif ($action == "commande") {
			$controleur = new Commande();
		} elseif ($action == "confirmation") {
			$controleur = new Confirmation();
		} 
		elseif ($action == "accueil") {
			$controleur = new AccueilDefaut();
		} else {
			$controleur = new AccueilDefaut();
		}



		return $controleur;
	}
}
