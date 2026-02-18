<!DOCTYPE html>

<html lang="fr">
<head>
    <title>Test Product</title>
    <meta charset="utf-8" />
  <style>
        /* Style pour les tables avec bordures */
body {
	background-color:#DDDDDD;
}
table {
	border:2px blue solid;
	border-collapse:collapse;
}
th,td {
	padding:10px 20px 10px 20px;
	text-align:center;
}
th {
	background-color:#4444CC;
	color:white;
	border:2px black solid;
}
td {
	background-color:#DDDDFF;
	color:#000022;
	border:2px black solid;
}
    </style>
</head>
<body>
   

    <!---- Création d'un employé ---->
    <h1>Fichier de test pour la classe Product</h1>
    <?php
        include_once "../product.class.php";
        include_once "../feature.class.php";
      //  use OnlineShop\Product;
      $chemin_fichier_image="../../assets/img/apple-tv.png";
        $product = new Product(1, "Apple TV", 249.99,    $chemin_fichier_image, "computers", 
        " L'Apple TV est un appareil conçu par Apple qui permet la communication sans fil entre un ordinateur et un téléviseur. 
        Il est disponible depuis fin mars 2007 dans sa première version.
        L'appareil ressemble alors par sa forme à un Mac mini, 
        bien qu'il ne fasse que la moitié de sa hauteur. 
        Il communique par réseau sans fil ou Ethernet, 
        avec un appareil iOS ou avec un ordinateur 
        (sous Mac OS X ou sous Windows) par le biais du logiciel iTunes, 
        permettant ainsi de diffuser le contenu vidéo 
        et audio sur le téléviseur, via éventuellement un amplificateur audio-vidéo.
         (<a href='https://fr.wikipedia.org/wiki/Apple_TV' target='_blank'>Wikipédia</a>)",

         0);

         $product->addFeature( new Feature(1,1,"Processeur Apple A8"));
         $product->addFeature( new Feature(2,1,"Mémoire vide de 2Go"));
         $product->addFeature( new Feature(3,1,"Stockage de 32 ou 64 Go en mémoire flash"));
         $product->addFeature( new Feature(4,1,"Connectivités: USB Type-C, HDMI, récepteur infrarouge"));
         $product->addFeature( new Feature(5,1,"Réseau: Wi-Fi (802.11a/b/g/n/ac), 10/100 Ethernet, Bluetooth, AirPlay"));

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
                <td>toString()</td>
                <td><?php echo $product; ?></td>
            </tr>
            <tr>
                <td>getId()<br/>getName()<br/> getPrice()<br/>
                getCategory()<br/> getQuantity()<br/>
            </td>
                <td>
                    <?php
                     echo $product->getId() . "<br/>";
                     echo $product->getName() . "<br/>";
                     echo $product->getPrice() . "<br/>";
                     echo $product->getCategory() . "<br/>";
                     echo $product->getQuantity() . "<br/>";
                    ?>
                </td>
            </tr>
            <tr>
                <td>getDescription()</td>
                <td>
                    <?php
                     echo $product->getDescription() . "<br/>";
                    ?>
                </td>
            </tr>
            <tr>
                <td>getImage()</td>
                
                   
             <td><?php echo '<img src="' .$product->getImage(). '">' ;?></td>
                
            </tr>
            <tr>
				<td>getFeatures()</td>
				<td>
					<?php
						// Obtenez le tabelau des extras
						$tab=$product->getFeatures();
						// Affichez les éléments un par un séparés par des <br />
						foreach ($tab as $feature) {
							echo $feature."<br/>";
						}
					?>
				</td>
			</tr>
            <tr>
                <td>Modification du prix<br/>setPrice(500)<br/> et quantite setQuantity(10)</td>
                <td>
                    <?php
                    $product->setPrice(500);
                    echo  $product->getPrice(). "<br/>";
                    $product->setQuantity(10); 
                    echo  $product->getQuantity();
                    
                    ?>
                </td>
            </tr>
        </tbody>
    </table>
    <br/>

    <!---- Retour au fichier d'accueil -->
    <h2><a href="../../controleurFrontal.php">Retour à la page d'accueil</a></h2>
</body>
</html>
