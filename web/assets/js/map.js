var map;



//initialize map
function initMap() {

  var paris = {
    lat: 48.85661400000001,
    lng: 2.3522219000000177
  }

  var content = '<h1>Paris, France</h1>';

  map = new google.maps.Map(document.getElementById('map'), {
    center: paris,
    zoom: 8
  });

  var infos = new google.maps.InfoWindow({
    content: content
  });

  var marker = new google.maps.Marker({
    position: paris,
    map: map
  });

  marker.addListener('click', function() {
    infos.open(map, marker);
  });
}
