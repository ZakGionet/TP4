<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Tests pour la classe UserDAO</title>
    <meta charset="utf-8" />

    <style>
        body {
            background-color: #DDDDDD;
            margin: 0;
            display: flex;
            justify-content: center; /* Centre verticalement le conteneur */
            align-items: center;    /* Centre horizontalement le conteneur */
            height:225vh;          /* Utilise toute la hauteur de l'écran */
        }

        .container {
            text-align: center; /* Centre le texte dans le conteneur */
        }

        h1 {
            margin-bottom: 20px; /* Ajoute de l'espace entre le titre et le tableau */
            font-family: Arial, sans-serif;
            color: #333333;
        }

        table {
            border: 2px blue solid;
            border-collapse: collapse;
            margin: 0 auto; /* Centrage horizontal pour garantir la compatibilité */
        }

        th,
        td {
            padding: 10px 20px;
            text-align: center;
        }

        th {
            background-color: #4444CC;
            color: white;
            border: 2px black solid;
        }

        td {
            background-color: #DDDDFF;
            color: #000022;
            border: 2px black solid;
        }
    </style>
</head>

<body>
<div class="container"> 
    <h1>Tests pour la classe UserDAO</h1>

    <?php
    // Inclus les fichiers nécessaires
    include_once("../../modele/user.class.php");
    include_once('../../modele/role.class.php');
    include_once('../../modele/DAO/userDAO.class.php');
    ?>

    <!---- Utilisation et affichage des méthodes -->
    <table>
        <thead>
            <tr>
                <th>Méthode</th>
                <th>Résultat</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <h2>Méthode findById</h2>
                </td>
                <td>
                    <?php
                    echo "<h3>Recherche de l'utilisateur avec l'ID 1 (existe):</h3>";
                    // Remplacez null par l'appel de la méthode
                    $unUser = null;
                    echo "<ul><li>Utilisateur 1: " . ($unUser ? $unUser : "n'existe pas") . "</li></ul>";

                    echo "<h3>Recherche de l'utilisateur avec l'ID 999 (n'existe pas):</h3>";
                  // Remplacez null par l'appel de la méthode
                    $unUser = null;
                    echo "<ul><li>Utilisateur 999: " . ($unUser ? $unUser : "n'existe pas") . "</li></ul>";
                    ?>
                </td>
            </tr>
            <tr>
                <td>
                    <h2>Méthode findAll</h2>
                </td>
                <td>
                    <?php
                    echo "<h3>Liste de tous les utilisateurs:</h3>";
                // Remplacez [] par l'appel de la méthode
                    $tabUsers = [];
                    echo "<ul>";
                    foreach ($tabUsers as $user) {
                        echo "<li>$user</li>";
                    }
                    echo "</ul>";
                    ?>
                </td>
            </tr>
            <tr>
                <td>
                    <h2>Méthode findByEmail</h2>
                </td>
                <td>
                    <?php
                    echo "<h3>Recherche de l'utilisateur avec l'email :sophia.taylor@example.com (existe):</h3>";
                   // Remplacez null par l'appel de la méthode
                    $unUser = null;
                    echo "<ul><li>Utilisateur : " . ($unUser ? $unUser : "n'existe pas") . "</li></ul>";

                    echo "<h3>Recherche de l'utilisateur avec l'email sophia999.taylor@example.com (n'existe pas):</h3>";
                 // Remplacez null par l'appel de la méthode
                    $unUser = null;
                    echo "<ul><li>Utilisateur : " . ($unUser ? $unUser : "n'existe pas") . "</li></ul>";
                    ?>
                </td>
            </tr>
            <tr>
                <td>
                    <h2>Méthode existsByEmail</h2>
                </td>
                <td>
                    <?php
                    echo "<h3>Vérifie l'existance de l'email :sophia.taylor@example.com (existe):</h3>";
                // Remplacez false par l'appel de la méthode
                    $test = false;
                    echo "<ul><li>L'email: " . ($test? "existe déjà" : "n'existe pas") . "</li></ul>";

                    echo "<h3>Vérifie l'existance de l'email sophia999.taylor@example.com (n'existe pas):</h3>";
                 // Remplacez false par l'appel de la méthode
                    $test = false;
                    echo "<ul><li>L'email: " . ($test? "existe" : "n'existe pas") . "</li></ul>";
                    ?>
                </td>
            </tr>
            <tr>
                <td>
                    <h2>Méthode save</h2>
                </td>
                <td>
                    <?php
                    echo "<h3>Insertion d'un nouvel utilisateur :</h3>";

                    // Création d'un rôle
                    $role = new Role(3, "Customer");

                    // Création d'un nouvel utilisateur
                    $nouveauUser = new User(null, 'Test', 'User', 'test10.user@example.com', 'plainpassword10', '1234567890', '123 Test St', $role);

                    // Récupération de l'email et du mot de passe en clair
                    $email = $nouveauUser->getEmail();
                    $plainTextPassword = $nouveauUser->getPassword();
                    // Remplacez false par l'appel de la méthode
                    $test = false;
                    // Vérification si l'utilisateur existe déjà
                    if ($test) {
                        echo "L'utilisateur avec l'email ", $nouveauUser->getEmail(), " existe déjà.";
                    } else {
                        try {
                            // Hachage du mot de passe avant l'insertion
                            $nouveauUser->setPassword(password_hash($plainTextPassword, PASSWORD_BCRYPT));

                            // Enregistrement dans la base de données
                           // Remplacez false par l'appel de la méthode
                            $testSave = false;

                            if ($testSave) {
                                echo "<ul><li>Insertion réussie. ID généré : " . $nouveauUser->getId() . "</li></ul>";

                                // Vérification des données insérées
                         // Remplacez null par l'appel de la méthode
                                $userInsere = null;
                                echo "<ul><li>Utilisateur inséré : " . ($userInsere ? $userInsere : "n'existe pas") . "</li></ul>";
                            } else {
                                echo "<ul><li>Insertion échouée.</li></ul>";
                            }
                        } catch (PDOException $e) {
                            echo "Erreur inattendue : " . $e->getMessage();
                        }
                    }
                    ?>
                </td>
            </tr>

            <tr>
                <td>
                    <h2>Méthode update</h2>
                </td>
                <td>
                    <?php

                    // Utiliser l'email de l'utilisateur nouvellement créé pour la mise à jour
                    $email = $nouveauUser->getEmail(); // Email de l'utilisateur nouvellement inséré
                 // Remplacez null par l'appel de la méthode
                    $nouveauUserAuthentifie = null; // Recherche de l'utilisateur par email
                    
                    if ($nouveauUserAuthentifie !== null) {
                        echo "<h3>Modification de l'utilisateur authentifié :</h3>";

                        // Charger l'utilisateur authentifié dans $nouveauUser
                        $nouveauUserAuthentifie->setFirstName('Updated');
                        $nouveauUserAuthentifie->setLastName('User Updated');
                        $nouveauUserAuthentifie->setPhone('9876543210');

                        // Appeler la méthode update
                        // Remplacez false par l'appel de la méthode
                        $testUpdate = false;

                        if ($testUpdate) {
                            echo "<ul><li>Modification réussie pour l'utilisateur avec ID : " . $nouveauUserAuthentifie->getId() . "</li></ul>";

                            // Vérification des modifications
                    // Remplacez null par l'appel de la méthode
                            $userModifie = null;
                            echo "<ul><li>Utilisateur modifié : " . ($userModifie ? $userModifie : "n'existe pas") . "</li></ul>";
                        } else {
                            echo "<ul><li>Modification échouée.</li></ul>";
                        }
                    } else {
                        echo "<h3>L'utilisateur avec l'email ", $email, " n'existe pas pour une mise à jour.</h3>";
                    }

                    ?>
                </td>
            </tr>

            <tr>
                <td>
                    <h2>Méthode delete</h2>
                </td>
                <td>
                    <?php

                    // Utiliser l'email de l'utilisateur nouvellement créé pour la suppression
                    $email = $nouveauUser->getEmail(); // Email de l'utilisateur nouvellement inséré
                   // Remplacez null par l'appel de la méthode
                    $nouveauUserAuthentifie = null; // Recherche de l'utilisateur par email
                    
                    if ($nouveauUserAuthentifie !== null) {
                        echo "<h3>Suppression de l'utilisateur authentifié :</h3>";

                        // Appeler la méthode delete
                     // Remplacez false par l'appel de la méthode
                        $testDelete = false;

                        if ($testDelete) {
                            echo "<ul><li>Suppression réussie pour l'utilisateur avec ID : " . $nouveauUserAuthentifie->getId() . "</li></ul>";

                            // Vérification de la suppression
                         // Remplacez null par l'appel de la méthode
                            $userSupprime = null;
                            echo "<ul><li>Utilisateur supprimé : " . ($userSupprime ? $userSupprime : "n'existe plus") . "</li></ul>";
                        } else {
                            echo "<ul><li>Suppression échouée.</li></ul>";
                        }
                    } else {
                        echo "<h3>L'utilisateur avec l'email ", $email, " n'existe pas pour une suppression.</h3>";
                    }

                    ?>
                </td>
            </tr>


        </tbody>
    </table>
    <br />
</div>
</body>

</html>