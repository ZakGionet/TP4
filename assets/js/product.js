
// Ce script permet de générer chaque page selon le produit cliqué à la page des produits.

// Requête au serveur pour les données products.json
var xhr = new XMLHttpRequest();
xhr.onload = function () {
  if (xhr.status === 200) {
    products = JSON.parse(xhr.responseText); // Importer les données JSON dans la variable "products"

    // Fonction permettant de récupérer le paramètre de l'identifiant dans l'URL
    // Adapté de: https://www.sitepoint.com/url-parameters-jquery/, tel que proposé dans l'énoncé du TP
    $.urlParam = function (name) {
      var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
      if (results == null) {
        return null;
      }
      return decodeURI(results[1]) || 0;
    }

    // Récupération de l'ID du produit sélectionné dans l'URL
    var productID = $.urlParam('id')

    // Fonction qui génère le contenu de la page des produits à partir d'une liste de produits ordonnées
    // le produit correspond à l'ID récupéré.
    function generateProductHTML(productList) {

      // index du produit dans les données "products.json"
      var listIndex = productID - 1
      var pageContent = '';

      pageContent += '<h1>' + productList[listIndex].name + '</h1>'
      pageContent += '<div class="row">'
      pageContent += '<div class="col">'
      pageContent += '<img id="product-image" alt="' + productList[listIndex].name + '" src="./assets/img/' + productList[listIndex].image + '">'
      pageContent += '</div>'
      pageContent += '<div class="col">'
      pageContent += '<section>'
      pageContent += '<h2>Description</h2>'
      pageContent += '<p>' + productList[listIndex].description + '</p>'
      pageContent += '</section>'
      pageContent += '<section>'
      pageContent += '<h2>Caractéristiques</h2>'
      pageContent += '<ul>'
      for (var i = 0; i < productList[listIndex].features.length; i++) {
        pageContent += '<li>'
        pageContent += productList[listIndex].features[i]
        pageContent += '</li>'
      }
      pageContent += '</ul>'
      pageContent += '</section><hr>'
      pageContent += '<form class="pull-right" method="GET" action="./product.html">'
      pageContent += '<label for="product-quantity">Quantité:</label>'
      pageContent += '<input class="form-control" id="product-quantity" type="number" value="1" min="1">'
      pageContent += '<button class="btn" title="Ajouter au panier" type="submit" name="id" onclick="ajoutPanier(' + parseInt(productList[listIndex].id) + ')" value="' + productList[listIndex].id + '">'
      pageContent += '<i class="fa fa-cart-plus"></i>&nbsp; Ajouter'
      pageContent += '</button>'
      pageContent += '</form>'
      pageContent += '<p>Prix: <strong>' + productList[listIndex].price + '&thinsp;$</strong></p>'
      pageContent += '</div></div>'

      document.getElementById('productDescription').innerHTML = pageContent;

    }

    // Fonction permettant de valider si l'url réfère à un produit existant. 
    // Si l'url est valide, affichage du produit référé.
    // Sinon, affichage d'un message d'erreur. 
    function validateProductPage() {
      if (productID > products.length || productID <= 0) {
        document.getElementById('productDescription').innerHTML = '<h1>Page non trouvée!</h1>';
      } else {
        generateProductHTML(products)
      }
    }
    validateProductPage()

    // afficher un message de confirmation lorsqu'un item est ajouté au panier. 
    // Adapté de: https://stackoverflow.com/questions/61358620/display-message-after-form-submit-with-javascript
    $("#cartAlert").hide()
    let form = document.getElementsByTagName("form")[0];
    form.addEventListener("submit", (e) => {
      e.preventDefault();
      $("#cartAlert").show().fadeOut(5000)
      setTimeout(function () {
        $("#cartAlert").hide()
      }, 5000);
    });
  }
};

xhr.open('GET', 'data/products.json', true);
xhr.send(null);