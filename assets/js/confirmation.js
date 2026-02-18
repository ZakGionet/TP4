
// Script des fonctions nécessaires pour la page de confirmation.


// Permet de générer le nom apres que la commande soit passée en utilisant les données du formulaire contenue dans localStorage
function creationNom() {
    localStorage.setItem('name', localStorage.getItem('firstname') + ' ' + localStorage.getItem('lastname'))
    var nomComplet = localStorage.getItem("name");
    document.getElementById("name").innerHTML = nomComplet
    localStorage.setItem("name", "firstname")
    }

// Permet de lire le numéro de la commande afin de l'afficher sur la page de confirmation.
function confirmationNumber(){
      var number = localStorage.getItem("nbOrder");
      document.getElementById("confirmation-number").innerHTML = number
    }

// Permet de vider le panier ainsi que les variables en localStorage nécessaire lorsqu'une commande est effectuée.f
function viderPanier(){
   localStorage.setItem("panier", 0);
   localStorage.setItem("cart", "[]");
   panierAJour();
}