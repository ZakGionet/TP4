<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>OnlineShop - Déconnexion</title>
    <link rel="stylesheet" type="text/css" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
    <link rel="stylesheet" type="text/css" href="./assets/css/style.css">
    <script type="text/javascript" src="./assets/js/jquery-3.6.1.min.js"></script>
    <style>
        /* Styles personnalisés pour la page de déconnexion */
        .deconnexion-container {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            background-color: #f9f9f9;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            text-align: center;
        }

        .deconnexion-container h2 {
            color: #333;
            margin-bottom: 20px;
        }

        .deconnexion-container p {
            font-size: 16px;
            color: #555;
            margin-bottom: 20px;
        }

        .deconnexion-container input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 4px;
            cursor: pointer;
        }

        .deconnexion-container input[type="submit"]:hover {
            background-color: #45a049;
        }

        .erreur {
            border: 2px red solid !important;
            border-radius: 8px;
            background-color: #FFDDDD !important;
            color: red;
            padding: 10px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
<header>
    <div class="header-container">
        <?php include("vues/inclusions/entete.inc.php"); 
         include("vues/inclusions/fonctions.inc.php");
         afficherMenu($controleur);
        ?>
      
    </div>
</header>

<main>
    <div class="deconnexion-container">
        <h2>Déconnexion</h2>
        <p>Êtes-vous sûr(e) de vouloir vous déconnecter ?</p>
        
        <?php
        include_once "vues/inclusions/fonctions.inc.php";
        afficherErreurs($controleur->getMessagesErreur());
        ?>
        
        <form method="post" action="?action=seDeconnecter">
            <input type="hidden" name="deconnexion" value="oui" />
            <input type="submit" value="Se déconnecter" />
        </form>
    </div>
</main>

<footer>
    <?php include("vues/inclusions/pied.inc.php"); ?>
</footer>
</body>
</html>
