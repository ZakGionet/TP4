<?php if (!isset($controleur)) header("Location: ..\index.php"); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>OnlineShop - Panier</title>
  <link rel="stylesheet" type="text/css" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
  <link rel="stylesheet" type="text/css" href="./assets/css/style.css">
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
 
    <article id="shopping">
      
    </article>
  </main>
  <footer>
  <?php
				include ("vues/inclusions/pied.inc.php");
			?>
  </footer>
  <script type="text/javascript" src="./assets/js/panier.js"></script>
  <script type="text/javascript" src="./assets/js/shopping-cart.js?v=1.0.0"></script>


</body>
</html>
