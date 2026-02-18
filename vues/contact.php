<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>OnlineShop - Contact</title>
  <link rel="stylesheet" type="text/css" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
  <link rel="stylesheet" type="text/css" href="./assets/css/style.css">
  <script type="text/javascript" src="./assets/js/jquery-3.6.1.min.js"></script>
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
    <article>
      <h1>Contact</h1>
      <p>Si vous souhaitez contacter <em>OnlineShop</em>, veuillez utiliser les coordonnées suivantes.</p>
      <section class="row contact-info" aria-label="Informations de contact">
        <div class="col">
          <i class="fa fa-mobile-alt fa-5x"></i><br>
          <a href="tel:5143436602">(514) 340-4711</a>
        </div>
        <div class="col">
          <i class="fa fa-map-marker-alt fa-5x"></i>
          <p class="address">
          2920, chemin de la tour<br>
          Montréal (Québec)<br>
          H3T 1J4
          </p>
        </div>
        <div class="col">
          <i class="fa fa-envelope fa-5x"></i><br>
          <a href="mailto:onlieshop@etsmtl.ca">onlineshop@etsmtl.ca</a>
        </div>
      </section>
    </article>
  </main>
  <footer>
  <?php
				include ("vues/inclusions/pied.inc.php");
			?>
  </footer>
  <script type="text/javascript" src="./assets/js/panier.js"></script>
</body>
</html>
