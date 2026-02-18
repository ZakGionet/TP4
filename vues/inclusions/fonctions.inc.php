<?php
/******************************************************************
 	Labo 4 #2-3 : Fonctions d'affichage pour le menu et pour 
	              un produit
	Nom         :                                    
*******************************************************************/  
  
function afficherProduitsHTML(array $unTableau): void {
    echo '<div id="products-list" class="products">'; // Conteneur principal
    foreach ($unTableau as $unProduit) {
        echo '<div class="product">';
        echo '<a href="?action=choisirProduit&id=' . htmlspecialchars((string) $unProduit->getId()) . '" title="En savoir plus...">';
        echo '<h2>' . htmlspecialchars($unProduit->getName()) . '</h2>';
        echo '<img alt="' . htmlspecialchars($unProduit->getName()) . '" src="./assets/img/' . htmlspecialchars($unProduit->getImage()) . '">';
        echo '<p class="price"><small>Prix</small> ' . number_format($unProduit->getPrice(), 2) . '&thinsp;$</p>';
        echo '</a>';
        echo '</div>';
    }
    echo '</div>'; // Fermeture du conteneur

    // Injectez les produits sous forme de JSON
    echo '<script id="php-products" type="application/json">';
    echo json_encode(array_map(fn($p) => [
        'id' => $p->getId(),
        'name' => $p->getName(),
        'price' => $p->getPrice(),
        'image' => $p->getImage(),
        'category' => $p->getCategory(),
    ], $unTableau));
    echo '</script>';
}



//gestion des erreurs pour la connexion
function afficherErreurs($tabMessages)
{
	if (count($tabMessages) > 0) {
		echo "<div class='erreur'>";
		echo "<ul>";
		foreach ($tabMessages as $message) {
			echo "<li>$message</li>";
		}
		echo "</ul>";
		echo "</div>";
	}
}


function afficherMenu($controleur)
{
    $menu = "<nav>
        <ul>
          <li class='active'>
            <a href='?action=voirAccueil'>Accueil</a>
          </li>
          <li>
            <a href='?action=voirProduits'>Produits</a>
          </li>
          <li>
            <a href='?action=contact'>Contact</a>
          </li>
          <li>
            <a class='shopping-cart' href='?action=voirPanier' title='Panier'>
              <span class='fa-stack fa-lg'>
                <i class='fa fa-circle fa-stack-2x fa-inverse'></i>
                <i class='fa fa-shopping-cart fa-stack-1x'></i>
              </span>
              <div id='count'><span class='count'><span id='items'></span></span></div>
            </a>
          </li>";

    $typeActeur = $controleur->getActeur(); // Obtenir le type d'utilisateur

    if ($typeActeur === "visiteur") {
        $menu .= "<li class='option_active'><a href='?action=seConnecter'>Se connecter</a></li>";
    } else {
        // Vérifier si l'utilisateur est connecté
        if (isset($_SESSION['utilisateurConnecte']) && $_SESSION['utilisateurConnecte'] instanceof User) {
            $utilisateurConnecte = $_SESSION['utilisateurConnecte'];
            $nom = htmlspecialchars($utilisateurConnecte->getFirstName());
            $prenom = htmlspecialchars($utilisateurConnecte->getLastName());
            $nomComplet = $nom . " " . $prenom;

            $menu .= "<li style='color:red'>" . $nomComplet . " connecté </li>";
        }
        $menu .= "<li><a href='?action=seDeconnecter'>Se déconnecter</a></li>";
    }

    $menu .= "</ul>
      </nav>";

    echo $menu;
}
?>
