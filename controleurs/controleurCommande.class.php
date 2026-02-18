<?php
    // *****************************************************************************************
	// Description   : Contrôleur spécifique pour toutes les actions non-valides qui rammène à la
	//                 page d'accueil
    // *****************************************************************************************
	include_once("controleurs/controleur.abstract.class.php");
	class Commande extends Controleur  {
		
		// ******************* Constructeur vide
		public function __construct() {
			//appel du constructeur parent
			parent::__construct();
		}
		

		// ******************* Méthode exécuter action
		// implémenter la méthde executerAction
		// retournez la page order.php
		public function executerAction():string
		{
				
			return "order.php";
		}

		


		
	}	
	
?>