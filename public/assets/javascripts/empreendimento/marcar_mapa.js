function mapa(latitude, longitude, id) {
 var map;
 var myLatlng = new google.maps.LatLng(latitude, longitude);

 var myOptions = {
   zoom: 15,
   center: myLatlng,
   mapTypeId: google.maps.MapTypeId.ROADMAP
 };

 map = new google.maps.Map(document.getElementById(id), myOptions);

 var marker = new google.maps.Marker({
   draggable: true,
   position: myLatlng,
   map: map,
   title: "Localização do empreendimento"
 });

 google.maps.event.addListener(marker, 'dragstart', function (event) {
 	document.getElementById('marcar_mapa').checked = "checked";
 });

 google.maps.event.addListener(marker, 'dragend', function (event) {
   document.getElementById("lat").value = event.latLng.lat();
   document.getElementById("long").value = event.latLng.lng();
 }); 
}
