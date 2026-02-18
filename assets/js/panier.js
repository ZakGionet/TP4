 
// Script utile pour l'affiche du bon chiffre dans le badge du panier


// Cette fonction permet de stocker le nombre d'items contenus dans le panier dans un localStorage et de changer
// le chiffre contenu dans l'en-tête.

function panierAJour(){
var nbItems = parseInt(localStorage.getItem("panier"));
    if (nbItems!= 0){
        document.getElementById("count").innerHTML= '<span class="count"><span id="items"></span></span>';
        document.getElementById("items").innerHTML= nbItems;
      } else{
        nbItems = 0
      }
      if (nbItems == 0){
        document.getElementById("count").innerHTML = "";
      }
      localStorage.setItem("panier", nbItems);
}

// Cette fonction permet une bonne initialisation des variables en localStorage qui nous seront utiles.
function initialisation(){
  if (localStorage.getItem("initialisation") === null){
    localStorage.setItem("panier", 0);
    localStorage.setItem("cart", "[]");
    localStorage.setItem("initialisation", true);
    panierAJour();

panierAJour();
    
    fetch("./data/cart.json")
    .then(function (response) {
        return response.json();
    })

    .then(function (data) {
        localStorage.setItem("tabProduits", JSON.stringify(data));
        if (!localStorage.getItem("cart")) {
            localStorage.setItem("cart", "[]");
        }
        panierAJour();
    });
  }
}

panierAJour();