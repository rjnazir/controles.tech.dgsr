$(function(){
    $('#ct_reception_ctVehicule_vhcPoidsVide, #ct_reception_ctVehicule_vhcPoidsVide').keyup(function(event) {
        _poids_vide   = $('#ct_reception_ctVehicule_vhcPoidsVide').val();
        _charge_utile = $('#ct_reception_ctVehicule_vhcPoidsVide').val();
        _poids_total  = parseFloat(_poids_vide) + parseFloat(_charge_utile);

        if (!isNaN(_poids_total)) {
            $('#ct_reception_ctVehicule_vhcPoidsVide').val(_poids_total);
            if (_poids_total > 44000) bootbox.alert("Le poids total en charge ne doit pas être supérieur à 44 Tonnes!!");
        } else {
            $('#ct_reception_ctVehicule_vhcPoidsVide').val("");
        }
    });
})