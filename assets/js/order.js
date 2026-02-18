
// script qui est utile pour la page du formulaire de commande.


$(document).ready(function () {
  
  // Validation du formulaire avec les differents criteres
  $( "#order-form" ).validate({
      rules: {
          firstname: {
              required : true,
              minlength: 2
          },   
          lastname: {
              required : true,
              minlength: 2
          },
          email: {
              required: true,
              email: true
          },
          phone: {
              required: true,
              phoneUS: true
          },
          creditcard: {
              required: true,
              creditcard: true
          },
          creditcardexpiry: {
              required: true,
              expiry: {
              }
          },
        },
    });
    
    // Validation de la date d'expiration de la carte de crédit avec regEx.
    jQuery.validator.addMethod("expiry", function(value, element) {
        return this.optional(element) || /^(0[1-9]|1[0-2])\/?([0-9]{2})$/.test(value);
    }, "La date d'expiration de votre carte de crédit est invalide");
}); 

// Fonction qui permet de stocker en localStorage la variable qui correspond au numéro
// de la commande. Ce chiffre augmente si le formulaire est valide donc seulement lorsque
// le "paiement" est effectué.
function nbOrder(){
    var numero = localStorage.getItem("nbOrder");
    if($( "#order-form" ).valid() == true){
    if (numero!=null){
      numero = parseInt(numero);
    } else{
      numero = 1;
    }
    numero++;
    localStorage.setItem("nbOrder", numero);
    }
  }