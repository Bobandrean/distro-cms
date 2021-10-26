var map, infoWindow;
var markers = new Array();
var markerClusterer = null;
var clusterOptions = {
    imagePath: "https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m",
    gridSize: 30,
    maxZoom: 14,
};
function initialize(){
    map = new google.maps.Map(document.getElementById('map-canvas'), {
        center : {lat: -6.8162897, lng: 106.524212},
        zoom: 11
    });
    infoWindow = new google.maps.InfoWindow;

    //Try HTML5 geolocation
    if(navigator.geolocation){
        navigator.geolocation.getCurrentPosition(function (position){
            var pos = {
                lat: position.coords.latitude,
                lng: position.coords.longitude
            };
            map.setCenter(pos);
        }, function(){
            handleLocationError(true, infoWindow, map.getCenter());
        });
    } else {
        // Browser doesnt support Geolocation
        handleLocationError(false, infoWindow, map.getCenter());
    }

    map.addListener('tilesloaded', function(){
        deleteMarkers();
        var bounds = map.getBounds();

        $.ajax({
            url: url.maps+'/'+bounds.getNorthEast().lat()+'/'+bounds.getNorthEast().lng()+'/'+bounds.getSouthWest().lat()+'/'+bounds.getSouthWest().lng(),
            type: "GET",
            success: function(res){
                if(res.status){
                    setMarkers(map, res.data);
                } else {
                    alert(res.message);
                }
            },
            error: function(res){
                alert('Error');
                console.log(res);
            }
        });
    });
}

function setMarkers(map, points){
    for(var i=0;i<points.length;i++){
        var marker = new google.maps.Marker({
            position: {lat:points[i].latitude, lng:points[i].longitude},
            map: map,
            title: points[i].title,
            contentString: points[i].info
        });
        marker.addListener('click', function(){
            infoWindow.close();
            infoWindow.setContent(this.contentString);
            infoWindow.open(map, this);
        });
        markers.push(marker);
    }
    markerClusterer = new MarkerClusterer(map, markers, clusterOptions);
}

function deleteMarkers(){
    for(var i=0;i<markers.length;i++){
        markers[i].setMap(null);
    }
    markers = new Array();
    if(markerClusterer != null){
        markerClusterer.clearMarkers();
    }
}

function handleLocationError(browserHasGeolocation, infoWindow, pos){
    infoWindow.setPosition(pos);
    infoWindow.setContent(browserHasGeolocation ? 'Error: The Geolocation service failed' : 'Error: Your browser doesn\'t support geolocation');
    infoWindow.open(map);
}

google.maps.event.addDomListener(window, 'load', initialize);
