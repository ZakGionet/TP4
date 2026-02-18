// Ce scirpt permet de gérer le panier d'achats avec les diverses fonctions voulues.

// Cette section permet de gérer un tableau en Array et est inspiré de cette vidéo:
// https://www.youtube.com/watch?v=pRkHOD_nkH4&ab_channel=DigitalFox

// On prend les données dans le fichier cart.json pour former un tableau qu'on stocke en localStorage.
fetch("./data/cart.json")
    .then(function (response) {
        return response.json();
    })

    .then(function (data) {
        localStorage.setItem("tabProduits", JSON.stringify(data));
        if (!localStorage.getItem("cart")) {
            localStorage.setItem("cart", "[]");
        }
    });

// On stocke les variables, transformées en tableaux, stockées en localStorage dans des variables globales qui seront utiles
var produits = JSON.parse(localStorage.getItem("tabProduits"));
var cart = JSON.parse(localStorage.getItem("cart"));

// Cette fonction permet d'ajouter une entrée dans le tableau cart et stocker le nouveau tableau en localStorage.
function ajoutProduitCart(idProduit) {
    var produit = produits.find(function (produit) {
        return produit.id == idProduit;
    });

    if (cart.lenght == 0) {

        cart.push(produit);

    } else {

        var temp = cart.find(element => element.id == idProduit);
        if (temp === undefined) {
            cart.push(produit);
        }

    }

    localStorage.setItem("cart", JSON.stringify(cart));
}

// Cette fonction permet de retirer une entrée dans le tableau cart et stocker le nouveau tableau en localStorage.
function enleverProduitCart(idProduit) {

    var bool = confirm("Voulez vous supprimer le produit du panier?")
    if (bool == true) {
        var newCart = JSON.parse(localStorage.getItem("cart")).filter(item => item.id != idProduit);
        localStorage.setItem("cart", JSON.stringify(newCart));
        var sommeItems = 0;
        for (var i = 0; i < JSON.parse(localStorage.getItem("cart")).length; i++) {

            nbItem = JSON.parse(localStorage.getItem("cart"))[i].quantity;
            sommeItems += nbItem
        }
        localStorage.setItem("panier", sommeItems);
        panierAJour();
    }
    location.reload();
    validateShoppingCart();
    conditionDisabled();
}

// Cette fonction permet de faire en sorte que la quantité voulu d'un objet change sans créer une nouvelle entrée
// si elle existe déjà.
function ajoutQuantite(idProduit, quantity) {
    for (var produit of cart) {
        if (produit.id == idProduit) {
            produit.quantity = quantity + produit.quantity;
        }
    }
    localStorage.setItem("cart", JSON.stringify(cart));
}

// Fin de la section inspiré de la vidéo


// Cette fonction permet de remettre le compteur d'items à 1 lors d'un ajout d'item depuis sa page de produit et additionne à la valeur 
// du panier pour montrer la nouvelle valeur affichée dans le badge.
function ajoutPanier(id) {
    localStorage.setItem("nbArticle", document.getElementById("product-quantity").value);
    localStorage.setItem("panier", parseInt(localStorage.getItem("nbArticle")) + + parseInt(localStorage.getItem("panier")));
    // + parseInt(localStorage.getItem("panier"))
    ajoutCart(id, parseInt(localStorage.getItem("nbArticle")));
    panierAJour();
    localStorage.setItem("nbArticle", document.getElementById("product-quantity").value);
}

// Fonction qui réunit deux fonctions afin de faciliter les appels. 
function ajoutCart(id, quantity) {
    ajoutProduitCart(id);
    ajoutQuantite(id, quantity);
    panierAJour();
}


// Cette fonction permet de générer l'affichage de la page du panier d'achat afin d'afficher le tableau en fonction
// des produits contenus dans le tableau cart en localStorage.
function generateShoppingCartHTML(cart) {
    var pageContent = '';

    pageContent += '<table id="affichagePanier" class="table shopping-cart-table">'
    pageContent += '<h1>Panier</h1>'
    pageContent += '<thead>'
    pageContent += '<tr>'
    pageContent += '<th></th>'
    pageContent += '<th>Produit</th>'
    pageContent += '<th>Prix unitaire</th>'
    pageContent += '<th>Quantité</th>'
    pageContent += '<th>Prix</th>'
    pageContent += '</tr>'
    pageContent += '</thead>'
    pageContent += '<tbody>'

    for (var i = 0; i < cart.length; i++) {
        pageContent += '<tr>'
        pageContent += '<td><button title="Supprimer" onclick="enleverProduitCart(' + cart[i].id + ')"><i class="fa fa-times"></i></button></td>'

        pageContent += '<td><a href="?action=choisirProduit&id=' + cart[i].id + '">' + cart[i].name + '</a></td>';

        pageContent += '<td>' + cart[i].price + '&thinsp;$</td>'
        pageContent += '<td>'
        pageContent += '<div class="row">'
        pageContent += '<div class="col">'
        pageContent += '<button title="Retirer" id="' + cart[i].id + '" [disabled]="conditionDisabled(' + cart[i].id + ')" onclick="diminuerQuantite(' + cart[i].id + ')"><i class="fa fa-minus"></i></button>'
        pageContent += '</div>'
        pageContent += '<div class="col">' + cart[i].quantity + '</div>'
        pageContent += '<div class="col">'
        pageContent += '<button title="Ajouter" onclick="augmenterQuantite(' + cart[i].id + ')"><i class="fa fa-plus"></i></button>'
        pageContent += '</div>'
        pageContent += '</div>'
        pageContent += '</td>'
        pageContent += '<td>' + (cart[i].price * cart[i].quantity).toFixed(2) + '&thinsp;$</td>'
        pageContent += '</tr>'
    }

    pageContent += '</tbody>'
    pageContent += '</table>'
    pageContent += '<p class="shopping-cart-total">Total: <strong>' + prixTotal(JSON.parse(localStorage.getItem("cart"))).toFixed(2) + '&thinsp;$</strong></p>'
    pageContent += '<a class="btn pull-right" href="?action=commande">Commander <i class="fa fa-angle-double-right"></i></a>'
    pageContent += '<button class="btn" id="remove-all-items-button" onclick="suppression()"><i class="fa fa-trash-o"></i>&nbsp; Vider le panier</button>'


    document.getElementById("shopping").innerHTML = pageContent;

}

// Cette fonction permet de valider si l'affichage de la page correspond à ce qui devrait être affiché 
// selon le nombre de produits contenus dans le localStorage "panier". 
function validateShoppingCart() {
    if (parseInt(localStorage.getItem("panier")) == 0) {
        document.getElementById("shopping").innerHTML = '<h1>Panier</h1> Aucun produit dans le panier.'
    } else {
        generateShoppingCartHTML(JSON.parse(localStorage.getItem("cart")).sort(sortAscendingName("name")));
        conditionDisabled();
    }
}
validateShoppingCart();

// Cette fonction permet de gérer la suprresion de tous les items du tableau en appuyant sur le bouton correspondant
// et change l'affichage de la page.
function suppression() {
    var bool = confirm("Voulez vous supprimer tous les produits du panier?")
    if (bool == true) {
        localStorage.setItem("panier", 0);
        validateShoppingCart();
        panierAJour();
        localStorage.setItem("cart", "[]");

    }
}

// Cette fonction calcule le prix total du panier et s'adapte lors des changements du panier.
function prixTotal(cart) {
    var somme = 0;
    for (var i = 0; i < cart.length; i++) {
        var prix = cart[i].price * cart[i].quantity;
        somme += prix;
    }
    return somme;
}

// Fonction pour classer en ordre croissant les noms des produits.
// Adapté de: https://stackoverflow.com/questions/12900058/how-can-i-sort-a-javascript-array-of-objects-numerically-and-then-alphabetically
function sortAscendingName(property) { 
    return function (a, b) {
        return (a[property].toLocaleLowerCase() < b[property].toLocaleLowerCase()) ? -1 : (a[property].toLocaleLowerCase() > b[property].toLocaleLowerCase()) ? 1 : 0;
    }
}

// Cette fonction permet de diminuer la quantité d'un produit de 1 lorsqu'on clique sur le bouton associé à la réduction du nombre d'item.
function diminuerQuantite(idProduit) {
    conditionDisabled(idProduit);
    for (var produit of cart) {
        if (produit.id == idProduit) {
            produit.quantity -= 1;
            localStorage.setItem("cart", JSON.stringify(cart));
            var sommeItems = 0;
            for (var i = 0; i < JSON.parse(localStorage.getItem("cart")).length; i++) {

                nbItem = JSON.parse(localStorage.getItem("cart"))[i].quantity;
                sommeItems += nbItem
            }
            localStorage.setItem("panier", sommeItems);

        }
        panierAJour();
    }
    validateShoppingCart();
    conditionDisabled();
}

// Cette fonction permet d'augmenter la quantité d'un produit de 1 en appuyant sur le bouton d'ajout.
function augmenterQuantite(idProduit) {
    for (var produit of cart) {
        if (produit.id == idProduit) {
            produit.quantity += 1;
            localStorage.setItem("cart", JSON.stringify(cart));
            var sommeItems = 0;
            for (var i = 0; i < JSON.parse(localStorage.getItem("cart")).length; i++) {

                nbItem = JSON.parse(localStorage.getItem("cart"))[i].quantity;
                sommeItems += nbItem
            }
            localStorage.setItem("panier", sommeItems);

        }
        panierAJour();
    }
    validateShoppingCart();
    conditionDisabled();
}

// Cette fonction permet d'activer et désactiver le bouton de réduction d'item si la quantité d'item d'un produit
// contenu dans le panier équivaut à 1.
function conditionDisabled() {
    var disableButton = ''
    for (var i = 0; i < cart.length; i++) {
        var button = document.getElementById(cart[i].id);
        if (cart[i].quantity == 1) {
            disableButton = true;
        }
        else {
            disableButton = false;
        }
        if (disableButton) button.disabled = "disabled"
    }
}      
