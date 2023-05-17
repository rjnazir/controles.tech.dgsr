/**
 * Récupération année de l'arrêté de prix
 */
$(function () {
    // Récupération ct_arrete_prix_id
    $('#ct_usage_tarif_ctArretePrix').kyeup(function(event) {
        var _ctArretePrix = $('#ct_usage_tarif_ctArretePrix').val();

        if (!isNaN(_ctArretePrix)) {
            chargerUsgTrfAnnee(_ctArretePrix);
        }
    });
})

function chargerUsgTrfAnnee(arrete)
{
    if(!isNaN(arrete)){
        $('#ct_usage_tarif_usgTrfAnnee').val(arrete);
    }
}