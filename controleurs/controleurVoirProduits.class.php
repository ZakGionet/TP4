<?php
    // *****************************************************************************************
	// Description   : Contrôleur Produits
	//                 
    // *****************************************************************************************
	include_once("controleurs/controleur.abstract.class.php");

	class VoirProduits extends Controleur  {
        private array $tableauProduits = array();

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
				
            if (isset($_GET['description'])) {
                $tableauProduits = ProductDAO::findByDescription("WHERE description LIKE '%".$_GET['description']."%'");
                
            }
            else {
                $tableauProduits = ProductDAO::findAll();
            }
			return "products.php";
		}

        public function getTableauProduits() {
            return $this->tableauProduits;
        }

	}	
    
    
	
?>