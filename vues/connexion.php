<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>OnlineShop - Connexion</title>
    <link rel="stylesheet" type="text/css" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
    <link rel="stylesheet" type="text/css" href="./assets/css/style.css">
    <script type="text/javascript" src="./assets/js/jquery-3.6.1.min.js"></script>
    <style>
        /* Styles personnalisés pour la page de connexion */
        .connexion-container {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            background-color: #f9f9f9;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        
        .connexion-container h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }
        
        .connexion-container label {
            font-size: 14px;
            color: #666;
        }
        
        .connexion-container input[type="text"],
        .connexion-container input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0 20px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        
        .connexion-container input[type="submit"] {
            width: 100%;
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px;
            font-size: 16px;
            border-radius: 4px;
            cursor: pointer;
        }
        
        .connexion-container input[type="submit"]:hover {
            background-color: #45a049;
        }
        
        .create-account {
            text-align: center;
            margin-top: 20px;
        }
        
        .create-account a {
            text-decoration: none;
            color: #007BFF;
            font-weight: bold;
        }
        
        .create-account a:hover {
            text-decoration: underline;
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
         include_once "vues/inclusions/fonctions.inc.php";
         afficherMenu($controleur);
         ?>
     
    </div>
</header>

<main>
    <div class="connexion-container">
        <h2>Connexion</h2>
        
        <?php
       
        afficherErreurs($controleur->getMessagesErreur());
        ?>

        <form method="post" action="?action=seConnecter">
            <label for="email">Email :</label>
            <input type="text" id="email" name="email" required placeholder="Entrez votre email">
            
            <label for="password">Mot de passe :</label>
            <input type="password" id="password" name="mot_passe" required placeholder="Entrez votre mot de passe">
            
            <input type="submit" value="Se connecter">
        </form>

        <div class="create-account">
            <p>Pas encore de compte ? <a href="?action=creerCompte">Créer un compte</a></p>
        </div>
    </div>
</main>

<footer>
    <?php include("vues/inclusions/pied.inc.php"); ?>
</footer>
</body>
</html>
