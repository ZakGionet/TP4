<?php
    // *****************************************************************************************
	// Description   : Contrôleur spécifique pour toutes les actions non-valides qui rammène à la
	//                 page d'accueil
    // *****************************************************************************************
	include_once("controleurs/controleur.abstract.class.php");

	class Confirmation extends Controleur  {
		
		// ******************* Constructeur vide
		public function __construct() {
			//appel du constructeur parent
			parent::__construct();
		}
		

		// ******************* Méthode exécuter action
		// implémenter la méthde executerAction
		// retournez la page d'accueil
		public function executerAction():string
		{
		
			return "confirmation.php";
		}

		


		
	}	
	
?>