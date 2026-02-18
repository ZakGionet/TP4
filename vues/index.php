<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <title>OnlineShop - Accueil</title>
  <link rel="stylesheet" type="text/css" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
  <link rel="stylesheet" type="text/css" href="./assets/css/style.css">
  <script type="text/javascript" src="./assets/js/jquery-3.6.1.min.js"></script>
</head>

<body onload="initialisation()">
  <header>
    <div class="header-container">
      <?php
      include("vues/inclusions/entete.inc.php");
    include("vues/inclusions/fonctions.inc.php");
     afficherMenu($controleur);
?>

    </div>
  </header>
  <main>
    <article>
      <img alt="home" src="./assets/img/home.png" id="home-img">
      <h1>Le site n&deg;1 pour les achats en ligne!</h1>
      <p>Découvrez nos différents produits au meilleur prix.</p>
      <a class="btn" href="?action=voirProduits">En savoir plus <i class="fa fa-angle-double-right"></i></a>
    </article>
  </main>
  <footer>

    <?php
    include("vues/inclusions/pied.inc.php");
    ?>
  </footer>
  <script type="text/javascript" src="./assets/js/panier.js"></script>
</body>

</html>