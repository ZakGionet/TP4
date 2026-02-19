<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Tests pour la classe ProductDAO</title>
    <meta charset="utf-8" />

    <style>
        body {
            background-color: #DDDDDD;
            margin: 0;
            display: flex;
            justify-content: center; /* Centre verticalement le conteneur */
            align-items: center;    /* Centre horizontalement le conteneur */
            height:215vh;          /* Utilise toute la hauteur de l'écran */
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
    <?php
    // Inclus les fichiers nécessaires
    include_once("../../modele/product.class.php");
    include_once('../../modele/DAO/productDAO.class.php');
    ?>

<h1>Tests pour la classe ProductDAO</h1>
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
                <td> <?php
                echo "<h3>Recherche de l'item avec l'ID 1 (existe):</h3>";
                // Remplacez null par l'appel de la méthode
                $unProduit = ProductDAO::findById(1);
                echo "<ul><li>Produit 1: " . ($unProduit ?: 'Pas trouvé') . "</li></ul>";

                echo "<h3>Recherche de l'item avec l'ID 999 (n'existe pas):</h3>";
                    // Remplacez null par l'appel de la méthode
                $unProduit = null;
                echo "<ul><li>Produit 999: " . ($unProduit ? $unProduit : "n'existe pas") . "</li></ul>";
                ?></td>
            </tr>
            <tr>
                <td>
                    <h2>Méthode findAll</h2>
                </td>
                <td>
                    <?php
                    echo "<h3>Liste de tous les produits:</h3>";
                        // Remplacez [] par l'appel de la méthode
                    $tabProduits = ProductDao::findAll();
                    echo "<ul>";
                    foreach ($tabProduits as $produit) {
                        echo "<li>$produit</li>";
                    }
                    echo "</ul>";
                    ?>
                </td>
            </tr>
 
            <tr>
                <td>
                    <h2>Méthode findByDescription</h2>
                </td>


                <td>

                    <?php
                    echo "<h3>Recherche des produits contenant 'vidéo' dans la description:</h3>";
                      // Remplacez [] par l'appel de la méthode
                    $tabProduits = ProductDAO::findByDescription("WHERE description LIKE '%vidéo%'");
                    echo "<ul>";
                    foreach ($tabProduits as $produit) {
                        echo "<li>$produit</li>";
                    }
                    echo "</ul>";
                    ?>


                </td>

            </tr>
            <tr>
                <td>
                    <h2>Méthode save</h2>
                </td>
                <td>
                    <?php
                    echo "<h3>Insertion d'un nouveau produit (ID généré automatiquement):</h3>";
                    $nouveauProduit = new Product(null, 'Produit Test Save', 59.99, 'test.png', 'tests', 'Produit pour tester save', 20);
                    // Remplacez false par l'appel de la méthode
                    $testSave = ProductDAO::save($nouveauProduit);

                    if ($testSave) {
                        echo "<ul><li>Insertion réussie. ID généré : " . $nouveauProduit->getId() . "</li></ul>";
                    } else {
                        echo "<ul><li>Insertion échouée.</li></ul>";
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
                    echo "<h3>Modification du produit inséré :</h3>";

                    $nouveauProduit->setPrice(99.99);
                    $nouveauProduit->setDescription("Description mise à jour");
                    $nouveauProduit->setQuantity(50);
                   // Remplacez false par l'appel de la méthode
                    $testUpdate = ProductDAO::update($nouveauProduit);

                    if ($testUpdate) {
                        echo "<ul><li>Modification réussie pour le produit avec ID : " . $nouveauProduit->getId() . "</li></ul>";
                            // Remplacez null par l'appel de la méthode
                        // Vérification de la modification
                        $produitModifie = ProductDAO::findById($nouveauProduit->getId());
                        echo "<ul><li>Produit modifié : " . ($produitModifie ? $produitModifie : "n'existe pas") . "</li></ul>";
                    } else {
                        echo "<ul><li>Modification échouée.</li></ul>";
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
                    echo "<h3>Suppression du produit inséré :</h3>";
                        // Remplacez false par l'appel de la méthode
                    $testDelete = ProductDAO::delete($produitModifie);

                    if ($testDelete) {
                        echo "<ul><li>Suppression réussie pour le produit avec ID : " . $nouveauProduit->getId() . "</li></ul>";
                            // Remplacez null par l'appel de la méthode
                        // Vérification de la suppression
                        $produitSupprime = $produitModifie;
                        echo "<ul><li>Produit supprimé : " . ($produitSupprime ? $produitSupprime : "n'existe plus") . "</li></ul>";
                    } else {
                        echo "<ul><li>Suppression échouée.</li></ul>";
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