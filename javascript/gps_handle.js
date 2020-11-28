var map;
var customerMarker;
var staffMarker;
var geocoder;
var directionService;
var directionRender;
var polyline;
$(function () {
    initMap();
    update();
});
function update() {
    setStaffPosition();
    checkPoint();
    setTimeout(update, 1000);
}
function initMap() {
    geocoder = new google.maps.Geocoder();
    directionService = new google.maps.DirectionsService();
    directionRender = new google.maps.DirectionsRenderer({ map: map });
    map = new google.maps.Map(document.getElementById("map"), {
        center: { lat: 0, lng: 0 },
        zoom: 16,
        streetViewControl: false,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    });
    var location = $("#location").text();
    geocoder.geocode({ address: location }, markCustomerPosition);
}
function markCustomerPosition(result, status) {
    var location = result[0].geometry.location;
    map.setCenter(location);
    if (customerMarker == null) {
        customerMarker = new google.maps.Marker({
            position: location,
            map: map,
            title: "Your Location",
            animation: google.maps.Animation.BOUNCE
        });
    }
    else {
        customerMarker.setPosition(location);
        customerMarker.setAnimation(google.maps.Animation.BOUNCE);
    }
    setTimeout(function () { return customerMarker.setAnimation(null); }, 500);
}
function markStaffPosition(position) {
    if (staffMarker == null) {
        staffMarker = new google.maps.Marker({
            position: position,
            map: map,
            title: "Staff Location"
        });
    }
    else {
        staffMarker.setPosition(position);
    }
}
function setStaffPosition() {
    var delivery_id = $("#delivery_id").val();
    $.ajax("../php/getStaffLocation.php", {
        method: "post",
        dataType: "json",
        data: {
            id: delivery_id
        },
        success: function (data) {
            if (data.longitude != null && data.latitude != null) {
                markStaffPosition(new google.maps.LatLng(data.latitude, data.longitude));
            }
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
