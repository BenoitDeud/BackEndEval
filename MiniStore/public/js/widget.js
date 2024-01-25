// Initialiser le widget après le chargement complet de la page
$(document).ready(function () {
    // Charge le widget dans la DIV d'id "Zone_Widget" avec les paramètres indiqués
    $("#Zone_Widget").MR_ParcelShopPicker({
      //

      // Paramétrage de la liaison avec la page.
      //
      // Selecteur de l'élément dans lequel est envoyé l'ID du Point Relais (ex: input hidden)
      Target: "#Target_Widget",
      // Selecteur de l'élément dans lequel est envoyé l'ID du Point Relais pour affichage
      TargetDisplay: "#TargetDisplay_Widget",
      // Selecteur de l'élément dans lequel sont envoysé les coordonnées complètes du point relais
      TargetDisplayInfoPR: "#TargetDisplayInfoPR_Widget",
      //
      // Paramétrage du widget pour obtention des point relais.
      //
      // Le code client Mondial Relay, sur 8 caractères (ajouter des espaces à droite)
      // BDTEST est utilisé pour les tests => un message d'avertissement apparaît
      Brand: "BDTEST  ",
      // Pays utilisé pour la recherche: code ISO 2 lettres.
      Country: "FR",
      // Code postal pour lancer une recherche par défaut
      PostCode: "59000",
      // Mode de livraison (Standard [24R], XL [24L], XXL [24X], Drive [DRI])
      ColLivMod: "24R",
      // Nombre de Point Relais à afficher
      NbResults: "7",
      //
      // Paramétrage d'affichage du widget.
      //
      // Afficher les résultats sur une carte?
      ShowResultsOnMap: true,
      // Afficher les informations du point relais à la sélection sur la carte?
      DisplayMapInfo: true,
      // Responsive: true => le widget s'adapte à la largeur de la page
      Responsive: true,
      // Fonction de callback déclenché lors de la selection d'un Point Relais
      OnParcelShopSelected:
        // Fonction de traitement à la sélection du point relais.
        // Remplace les données de cette page par le contenu de la variable data.
        // data: les informations du Point Relais
        function (data) {
          $("#cb_ID").html(data.ID);
          $("#cb_Nom").html(data.Nom);
          $("#cb_Adresse").html(data.Adresse1 + ' ' + data.Adresse2);
          $("#cb_CP").html(data.CP);
          $("#cb_Ville").html(data.Ville);
          $("#cb_Pays").html(data.Pays);

          $("#cb_Nom2").val(data.Nom);

          // Update the new form fields
          if ($("#relayDelivery").is(":checked")) {
            $("#name").val(data.Nom);
            $("#address").val(data.Adresse1 + " " + data.Adresse2);
            $("#postalCode").val(data.CP);
            $("#city").val(data.Ville);
          }
        }
    });

    $('#homeDelivery').change(function () {
      if (this.checked) {
        var mainElement = $('main');
        $('#name').val(mainElement.data('nom') + ' ' + mainElement.data('prenom'));
        $('#address').val(mainElement.data('adresse'));
        $('#postalCode').val(mainElement.data('code-postal'));
        $('#city').val(mainElement.data('ville'));
      }
    });
});