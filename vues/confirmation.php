<!-- On redirige vers l'inde du site si on essaie d'avoir une accès direct -->
<?php if (!isset($controleur)) header("Location: ..\index.php"); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>OnlineShop - Confirmation</title>
  <link rel="stylesheet" type="text/css" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
  <link rel="stylesheet" type="text/css" href="./assets/css/style.css">
  <script type="text/javascript" src="./assets/js/jquery-3.6.1.min.js"></script>
  <script type="text/javascript" src="./assets/js/order.js"></script>
</head>
<!-- On fait appel aux fonctions qui affichent le nom du client, le numéro de la commande et qui vide le panier. -->
<body onload="creationNom() & confirmationNumber() & viderPanier() & initialisation()">
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
    <?php 
    	$prenom = $_POST['firstname'] ?? null;
        $nom = $_POST['lastname'] ?? null;
    ?>
    <article>
    <h1>Merci, <?php echo htmlspecialchars($prenom); ?> <?php echo htmlspecialchars($nom); ?>.</h1>
      <h1>Votre commande est confirmée <span id="name"></span>!</h1>
      <p>Votre numéro de confirmation est le <strong><span id="confirmation-number"></span></strong>.</p>
    </article>
  </main>
  <footer>
  <?php
				include ("vues/inclusions/pied.inc.php");
			?>
  </footer>
    <script type="text/javascript" src="./assets/js/panier.js"></script>
    <script type="text/javascript" src="./assets/js/confirmation.js"></script>
    <script type="text/javascript" src="./assets/js/shopping-cart.js"></script>
</body>
</html>
