<!-- On redirige vers l'inde du site si on essaie d'avoir une accès direct -->
<?php if (!isset($controleur)) header("Location: ..\index.php"); ?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <title>OnlineShop - Produits</title>
  <link rel="stylesheet" type="text/css" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
  <link rel="stylesheet" type="text/css" href="./assets/css/style.css">
  <script type="text/javascript" src="./assets/js/jquery-3.6.1.min.js"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

<!-- Formulaire stylisé -->
<style>
    /* Style global pour le formulaire */
    form {
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 20px;
    }

    form label {
        margin-right: 10px;
        font-size: 16px;
        font-weight: bold;
        color: #333;
    }

    form .search-container {
        position: relative;
        display: flex;
        align-items: center;
    }

    form input[type="search"] {
        padding: 10px 40px 10px 15px; /* Espace pour l'icône */
        border: 1px solid #ccc;
        border-radius: 25px;
        font-size: 16px;
        width: 300px;
        outline: none;
    }

    form input[type="search"]:focus {
        border-color: #007BFF; /* Couleur au focus */
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
    }

    form .fa-search {
        position: absolute;
        right: 15px;
        color: #888;
        cursor: pointer;
    }

    form input[type="submit"] {
        margin-left: 10px;
        padding: 10px 20px;
        background-color: #007BFF;
        color: white;
        border: none;
        border-radius: 25px;
        cursor: pointer;
        font-size: 16px;
        transition: background-color 0.3s ease;
    }

    form input[type="submit"]:hover {
        background-color: #0056b3;
    }
</style>
</head>

<body onload="initialisation()">
  <header>
    <div class="header-container">
    <?php
				include ("vues/inclusions/entete.inc.php");
        include "vues/inclusions/fonctions.inc.php";
         
        afficherMenu($controleur);
			?>

    </div>
  </header>
  <main>
    <section class="sidebar" aria-label="Filtres">
      <section>
        <h2>Catégories</h2>
        <div class="btn-group vertical" id="product-categories">
          <button id="cameras">Appareils photo</button>
          <button id="consoles">Consoles</button>
          <button id="screens">Écrans</button>
          <button id="computers">Ordinateurs</button>
          <button id="all" class="selected">Tous les produits</button>
        </div>
      </section>
      <section>
        <h2>Classement</h2>
        <div class="btn-group vertical" id="product-criteria">
          <button id="priceAscending" class="selected">Prix (bas-haut)</button>
          <button id="priceDescending">Prix (haut-bas)</button>
          <button id="nameAscending">Nom (A-Z)</button>
          <button id="nameDescending">Nom (Z-A)</button>
        </div>
      </section>
    </section>
    <article>
      <span class="right-header" id="products-count">
        <!-- Quantité de produits affichés générés par le script "products-list.js". -->
      </span>

      <h1>Produits</h1>
      <form method="post" action="?action=voirProduits&description">
    <label for="description">Rechercher un produit :</label>
    <div class="search-container">
        <input type="search" name="description" id="description" placeholder="Recherche par description...">
        <i class="fa fa-search"></i>
    </div>
    <input type="submit" value="Envoyer">
</form>
      <div class="products" id="products-list">
        <!-- Produits affichés générés par le script "products-list.js". -->
     
        <?php
            // ==================== Utilisation des fonctions d'affichage ===================== 
          
            afficherProduitsHTML($controleur->getTableauProduits());

            ?>
      </div>
      
    </article>
  </main>
  <footer>
  <?php
				include ("vues/inclusions/pied.inc.php");
			?>
  </footer>

  <script type="text/javascript" src="./assets/js/panier.js"></script>
  
  <script type="text/javascript" src="./assets/js/products-list.js?v=1.0.0"></script>

</body>

</html>