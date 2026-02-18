
<!-- On redirige vers l'inde du site si on essaie d'avoir une accès direct -->
<?php if (!isset($controleur)) header("Location: ..\index.php"); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>OnlineShop - Commande</title>
  <link rel="stylesheet" type="text/css" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
  <link rel="stylesheet" type="text/css" href="./assets/css/style.css">
</head>
<body onload="initialisation()">
  <script type="text/javascript" src="./assets/js/jquery-3.6.1.min.js"></script>
  <script type="text/javascript" src="./assets/js/jquery.validate.min.js"></script>
  <script type="text/javascript" src="./assets/js/additional-methods.min.js"></script>
  <script type="text/javascript" src="./assets/js/messages_fr.min.js"></script>
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
    <article>
      <h1>Commande</h1>
 <!-- On fait appel à la fonction qui produit le bon numéro de commande-->
      <form id="order-form" action="./index.php?action=confirmation" method="POST" onsubmit="nbOrder()">
  
      <section>
          <h2>Contact</h2>
          <div class="row">
            <div class="col">
              <div class="form-group">
                <label for="first-name">Prénom</label>
                <!--On stocke la valeur du nom et prenom dans une variable en localStorage lorsqu'un changement est effectué dans le formulaire-->
                <input class="form-control" type="text" id="firstname" name="firstname" placeholder="Prénom" onchange="localStorage.firstname=this.value" required>
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <label for="last-name">Nom</label>
                <input class="form-control" type="text" id="lastname" name="lastname" placeholder="Nom" onchange="localStorage.lastname=this.value" required>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <div class="form-group">
                <label for="email">Adresse courriel</label>
                <input class="form-control" type="email" id="email" name="email" placeholder="Adresse courriel" required>
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <label for="phone">Téléphone</label>
                <input class="form-control" type="tel" id="phone" name="phone" placeholder="###-###-####" required>
              </div>
            </div>
          </div>
        </section>
        <section>
          <h2>Paiement</h2>
          <div class="row">
            <div class="col">
              <div class="form-group">
                <label for="credit-card">Numéro de carte de crédit</label>
                <input class="form-control" type="text" id="creditcard" name="creditcard" placeholder="•••• •••• •••• ••••" required>
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <label for="credit-card-expiry">Expiration (mm/aa)</label>
                <input class="form-control" type="text" id="creditcardexpiry" name="creditcardexpiry" placeholder="mm/aa" required>
              </div>
            </div>
          </div>
        </section>
        <button class="btn pull-right" type="submit">Payer <i class="fa fa-angle-double-right"></i></button>
      </form>
    </article>
  </main>
  <footer>
  <?php
				include ("vues/inclusions/pied.inc.php");
			?>
  </footer>
  <script type="text/javascript" src="./assets/js/panier.js"></script>
  <script type="text/javascript" src="./assets/js/order.js"></script>
</body>
</html>
