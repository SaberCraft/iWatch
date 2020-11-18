// Update Wilaya names.
$.getJSON( "themes/json/wilaya.json", function( json ) {
    let templateWilaya = '<option value="-----">إختر الولاية</option>';
    json.forEach(element => {
        templateWilaya += `<option data-codewilaya="${element.code}" value="${element.ar_name}">${element.ar_name}</option>`;
    });
    $('#wilaya').html(templateWilaya);
   });
 
 
// Update City names.
$('#wilaya').change(function(){
    $.getJSON( "themes/json/city.json", function( json ) {
        let templateCity = '';
        let currentWilaya = $('#wilaya option:selected').data('codewilaya');
        console.log(json);
        json.forEach(element => {
            if (currentWilaya == element.county_code.slice(0,2)) {
                templateCity += `<option data-codecity="${element.code}" value="${element.ar_name}">${element.ar_name}</option>`;
            }
        });
        $('#city').html(templateCity);
       });
});