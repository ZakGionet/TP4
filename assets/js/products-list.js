document.addEventListener("DOMContentLoaded", function () {
  // Récupérer les produits injectés par PHP
  const phpProductsElement = document.getElementById("php-products");
  let products = [];
  if (phpProductsElement) {
      products = JSON.parse(phpProductsElement.textContent); // Récupération des produits injectés par PHP
  }

  // Fonction qui génère le contenu de la page des produits à partir d'une liste de produits ordonnés
  function generateProductsHTML(productsList) {
      let pageContent = '';

      for (let i = 0; i < productsList.length; i++) {
          pageContent += '<div class="product">';
          pageContent += '<a href="?action=choisirProduit&id=' + productsList[i].id + '" title="En savoir plus...">';
          pageContent += '<h2>' + productsList[i].name + '</h2>';
          pageContent += '<img alt="' + productsList[i].name + '" src="./assets/img/' + productsList[i].image + '">';
          pageContent += '<p class="price"><small>Prix</small> ' + productsList[i].price.toFixed(2) + '&thinsp;$</p>';
          pageContent += '</a>';
          pageContent += '</div>';
      }

      document.getElementById('products-list').innerHTML = pageContent;
      document.getElementById('products-count').innerHTML = productsList.length + ' produits';
  }

  // Fonction pour classer en ordre croissant
  function sortAscending(property) {
      return function (a, b) {
          return (a[property] < b[property]) ? -1 : (a[property] > b[property]) ? 1 : 0;
      };
  }

  // Fonction pour classer en ordre décroissant
  function sortDescending(property) {
      return function (a, b) {
          return (a[property] > b[property]) ? -1 : (a[property] < b[property]) ? 1 : 0;
      };
  }

  // Fonction pour classer les noms en ordre croissant
  function sortAscendingName(property) {
      return function (a, b) {
          return (a[property].toLocaleLowerCase() < b[property].toLocaleLowerCase()) ? -1 : (a[property].toLocaleLowerCase() > b[property].toLocaleLowerCase()) ? 1 : 0;
      };
  }

  // Fonction pour classer les noms en ordre décroissant
  function sortDescendingName(property) {
      return function (a, b) {
          return (a[property].toLocaleLowerCase() > b[property].toLocaleLowerCase()) ? -1 : (a[property].toLocaleLowerCase() < b[property].toLocaleLowerCase()) ? 1 : 0;
      };
  }

  // Initialisation de la page avec les produits injectés par PHP
  let refreshedProductList = [...products]; // Tous les produits
  refreshedProductList.sort(sortAscending("price")); // Tri par défaut : prix croissant
  generateProductsHTML(refreshedProductList); // Génération initiale

  // Fonction pour la mise à jour des paramètres de tri et filtrage
  function productsFiltering() {
      // Initialisation des paramètres par défaut
      let productCategory = "all";
      let productCriteria = "priceAscending";

      // Mise à jour de la catégorie sélectionnée
      document.querySelectorAll('#product-categories button').forEach(button => {
          button.addEventListener('click', function () {
              document.querySelectorAll('#product-categories button').forEach(btn => btn.classList.remove('selected'));
              this.classList.add('selected');
              productCategory = this.id;
              updateProductList();
          });
      });

      // Mise à jour du critère de tri sélectionné
      document.querySelectorAll('#product-criteria button').forEach(button => {
          button.addEventListener('click', function () {
              document.querySelectorAll('#product-criteria button').forEach(btn => btn.classList.remove('selected'));
              this.classList.add('selected');
              productCriteria = this.id;
              updateProductList();
          });
      });

      // Fonction pour mettre à jour la liste des produits affichés
      function updateProductList() {
          // Filtrage par catégorie
          if (productCategory === 'computers') {
              refreshedProductList = products.filter(item => item.category === 'computers');
          } else if (productCategory === 'cameras') {
              refreshedProductList = products.filter(item => item.category === 'cameras');
          } else if (productCategory === 'consoles') {
              refreshedProductList = products.filter(item => item.category === 'consoles');
          } else if (productCategory === 'screens') {
              refreshedProductList = products.filter(item => item.category === 'screens');
          } else {
              refreshedProductList = [...products];
          }

          // Tri selon le critère
          if (productCriteria === "nameAscending") {
              refreshedProductList.sort(sortAscendingName("name"));
          } else if (productCriteria === "nameDescending") {
              refreshedProductList.sort(sortDescendingName("name"));
          } else if (productCriteria === "priceAscending") {
              refreshedProductList.sort(sortAscending("price"));
          } else if (productCriteria === "priceDescending") {
              refreshedProductList.sort(sortDescending("price"));
          }

          // Génération de la liste mise à jour
          generateProductsHTML(refreshedProductList);
      }
  }

  // Lancer le filtrage des produits
  productsFiltering();
});
