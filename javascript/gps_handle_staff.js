var map;
var customerMarker;
var staffMarker;
var geocoder;
var directionService;
var directionRender;
var polyline;
function initMap() {
    map = new google.maps.Map(document.getElementById("map"), {
        center: { lat: 0, lng: 0 },
        zoom: 16,
        streetViewControl: false,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    });
    directionService = new google.maps.DirectionsService();
    geocoder = new google.maps.Geocoder();
    directionRender = new google.maps.DirectionsRenderer({ map: map });
}
function setCustomerLocation() {
    var location = $("#location").text();
    geocoder.geocode({ address: location }, markCustomerPosition);
}
function markCustomerPosition(result, status) {
    var location = result[0].geometry.location;
    if (customerMarker == null) {
        customerMarker = new google.maps.Marker({
            position: location,
            map: map,
            title: "Customer Location"
        });
    }
    else {
        customerMarker.setPosition(location);
    }
}
function markStaffPosition(position) {
    var currentLocation = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
    var delivery_id = $("#delivery_id").val();
    if (staffMarker == null) {
        staffMarker = new google.maps.Marker({
            position: currentLocation,
            map: map,
            title: "Staff Location"
        });
    }
    else {
        staffMarker.setPosition(currentLocation);
    }
    $.ajax("../php/updateStaffLocation.php", {
        method: "post",
        data: {
            delivery_id: delivery_id,
            longitude: position.coords.longitude,
            latitude: position.coords.latitude
        }
    });
}
function checkPoint() {
    if (polyline == null) {
        calcRoute();
    }
    else {
        if (google.maps.geometry.poly.isLocationOnEdge(staffMarker.getPosition(), polyline, 10e-1)) {
            calcRoute();
        }
    }
}
function calcRoute() {
    if (staffMarker != null && customerMarker != null) {
        var start_1 = staffMarker.getPosition();
        var end = customerMarker.getPosition();
        var request = {
            origin: start_1,
            destination: end,
            travelMode: google.maps.TravelMode.DRIVING,
            optimizeWaypoints: true,
            unitSystem: google.maps.UnitSystem.METRIC,
            provideRouteAlternatives: true,
            avoidFerries: true,
        };
        directionService.route(request, function (result, status) {
            if (status == 'OK') {
                //directionRender.setDirections(result);
                map.setCenter(start_1);
                if (!polyline) {
                    var iconsetngs = {
                        path: google.maps.SymbolPath.FORWARD_CLOSED_ARROW
                    };
                    polyline = new google.maps.Polyline({
                        path: [],
                        strokeOpacity: 0.8,
                        strokeColor: '#FF0000',
                        strokeWeight: 3,
                        icons: [{
                                icon: iconsetngs,
                                repeat: '60px',
                                offset: '100%'
                            }]
                    });
                    var bounds = new google.maps.LatLngBounds();
                    var legs = result.routes[0].legs;
                    for (var i = 0; i < legs.length; i++) {
                        var steps = legs[i].steps;
                        for (var j = 0; j < steps.length; j++) {
                            var nextSegment = steps[j].path;
                            for (var k = 0; k < nextSegment.length; k++) {
                                polyline.getPath().push(nextSegment[k]);
                                bounds.extend(nextSegment[k]);
                            }
                        }
                    }
                    polyline.setMap(map);
                }
                else {
                    polyline.setPath([]);
                    var bounds = new google.maps.LatLngBounds();
                    var legs = result.routes[0].legs;
                    for (var i = 0; i < legs.length; i++) {
                        var steps = legs[i].steps;
                        for (var j = 0; j < steps.length; j++) {
                            var nextSegment = steps[j].path;
                            for (var k = 0; k < nextSegment.length; k++) {
                                polyline.getPath().push(nextSegment[k]);
                                bounds.extend(nextSegment[k]);
                            }
                        }
                    }
                }
            }
        });
    }
}
$(function () {
    initMap();
    setCustomerLocation();
    update();
});
function update() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(markStaffPosition);
    }
    else {
        $("map").html("Geolocation is not supported by this browser.");
    }
    setTimeout(checkPoint, 1000);
    setTimeout(update, 10000);
}
