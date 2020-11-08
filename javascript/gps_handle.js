var map;
$(function () {
    initMap();
});
function initMap() {
    map = new google.maps.Map(document.getElementById("map"), {
        center: { lat: 0, lng: 0 },
        zoom: 15
    });
    getLocation(showPosition);
    getLocation(markCurrentPosition);
}
function getLocation(func) {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(func);
    }
    else {
        console.log("Geolocation is not supported by this browser");
    }
}
function showPosition(position) {
    var point = { lat: position.coords.latitude,
        lng: position.coords.longitude };
    map.setCenter(point);
}
function markCurrentPosition(position) {
    var location = {
        lat: position.coords.latitude,
        lng: position.coords.longitude
    };
    var marker = new google.maps.Marker({
        position: location,
        map: map,
        title: "Your Current Location"
    });
}
