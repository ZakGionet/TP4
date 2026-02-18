<!-- On redirige vers l'inde du site si on essaie d'avoir une accès direct -->
<?php if (!isset($controleur)) header("Location: ..\index.php"); ?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>OnlineShop - Produit</title>
  <link rel="stylesheet" type="text/css" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
  <link rel="stylesheet" type="text/css" href="./assets/css/style.css">
  <script type="text/javascript" src="./assets/js/jquery-3.6.1.min.js"></script>
  <script type="text/javascript" src="./assets/js/jquery-3.6.1.min.js"></script>
</head>
<body onload="initialisation()">
  <header>
    <div class="header-container">
    <?php
				include ("vues/inclusions/entete.inc.php");
        include("vues/inclusions/fonctions.inc.php");
        afficherMenu($controleur);
			?>
    </div>
  </header>
  <main>
    <article id="productDescription">
      <!-- Description générée par le script "product.js". -->
    </article>

    <div id="cartAlert">Le produit a été ajouté au panier.</div>
  </main>
  <footer>
  <?php
				include ("vues/inclusions/pied.inc.php");
			?>
  </footer>
  <script type="text/javascript" src="./assets/js/product.js"></script>
  <script type="text/javascript" src="./assets/js/panier.js"></script>
  <script type="text/javascript" src="./assets/js/shopping-cart.js"></script>
</body>
</html>