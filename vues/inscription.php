<?php if (!isset($controleur))
    header("Location: ..\index.php"); ?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>OnlineShop - Création de compte</title>
    <link rel="stylesheet" type="text/css" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
    <link rel="stylesheet" type="text/css" href="./assets/css/style.css">
    <script type="text/javascript" src="./assets/js/jquery-3.6.1.min.js"></script>
    <style>
        /* Styles personnalisés */
        .signup-container {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            background-color: #f9f9f9;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .signup-container h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        .signup-container label {
            font-size: 14px;
            color: #666;
        }

        .signup-container input,
        .signup-container select {
            width: 100%;
            padding: 10px;
            margin: 10px 0 20px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .signup-container input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px;
            font-size: 16px;
            border-radius: 4px;
            cursor: pointer;
        }

        .signup-container input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
    <header>
        <div class="header-container">
            <?php include("vues/inclusions/entete.inc.php"); 
             include "vues/inclusions/fonctions.inc.php";
         
             afficherMenu($controleur);
            ?>
       
        </div>
    </header>

    <main>
        <div class="signup-container">
            <h2>Créer un compte</h2>
            <form method="post" action="?action=creerCompte">
                <label for="firstName">Prénom :</label>
                <input type="text" id="firstName" name="firstName" required placeholder="Entrez votre prénom">

                <label for="lastName">Nom :</label>
                <input type="text" id="lastName" name="lastName" required placeholder="Entrez votre nom">

                <label for="email">Email :</label>
                <input type="email" id="email" name="email" required placeholder="Entrez votre email">

                <label for="password">Mot de passe :</label>
                <input type="password" id="password" name="password" required placeholder="Entrez votre mot de passe">

                <label for="phone">Téléphone :</label>
                <input type="text" id="phone" name="phone" placeholder="Entrez votre numéro de téléphone">

                <label for="address">Adresse :</label>
                <input type="text" id="address" name="address" placeholder="Entrez votre adresse">
               
                <!-- Champ pour le rôle (visible uniquement pour les administrateurs) -->
                <?php if ($controleur->isAdmin()): ?>
                    <label for="role">Rôle :</label>
                    <select id="role" name="role">
                        <option value="3">Client</option>
                        <option value="2">Vendeur</option>
                        <option value="1">Admin</option>
                    </select>
                <?php else: ?>
                    <input type="hidden" name="role" value="3">
                <?php endif; ?>

                <input type="submit" value="Créer un compte">
            </form>

        </div>
    </main>

    <footer>
        <?php include("vues/inclusions/pied.inc.php"); ?>
    </footer>
</body>

</html>