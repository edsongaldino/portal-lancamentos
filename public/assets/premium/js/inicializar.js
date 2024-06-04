function inicializar() {
    var coordenadas = {lat: parseFloat($('#latitude').val()), lng: parseFloat($('#longitude').val()) };
   
    var mapa = new google.maps.Map(document.getElementById('estate-map'), {
     zoom: 15,
     center: coordenadas 
   });
   
    var marker = new google.maps.Marker({
     position: coordenadas,
     map: mapa,
     title: 'Meu marcador'
   });
   
}