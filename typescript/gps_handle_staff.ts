import {} from "googlemaps";

let map : google.maps.Map;
let customerMarker : google.maps.Marker;
let staffMarker : google.maps.Marker;
let geocoder : google.maps.Geocoder;
let directionService : google.maps.DirectionsService;
let directionRender : google.maps.DirectionsRenderer;
let polyline : google.maps.Polyline;

function initMap(){
    map = new google.maps.Map(document.getElementById("map") as HTMLElement,{
        center:{lat:0,lng:0},
        zoom:16,
        streetViewControl:false,
        mapTypeId:google.maps.MapTypeId.ROADMAP
    });

    directionService = new google.maps.DirectionsService();
    geocoder = new google.maps.Geocoder();
    directionRender = new google.maps.DirectionsRenderer({map:map});
}

function setCustomerLocation():void{
    let location = $("#location").text() as string;
    geocoder.geocode({address:location},markCustomerPosition);
}

function markCustomerPosition(result : google.maps.GeocoderResult[],status:google.maps.GeocoderStatus) : void{
    let location = result[0].geometry.location;
    if(customerMarker == null){
        customerMarker = new google.maps.Marker({
            position:location,
            map:map,
            title:"Customer Location"
        });
    }else{
        customerMarker.setPosition(location);
    }
}

function markStaffPosition(position : Position){
    let currentLocation = new google.maps.LatLng(position.coords.latitude,position.coords.longitude);
    let delivery_id = $("#delivery_id").val();

    if(staffMarker == null){
        staffMarker = new google.maps.Marker({
            position:currentLocation,
            map:map,
            title:"Staff Location"
        });
    }else{
        staffMarker.setPosition(currentLocation);
    }

    $.ajax("../php/updateStaffLocation.php",{
        method:"post",
        data:{
            delivery_id:delivery_id,
            longitude:position.coords.longitude,
            latitude:position.coords.latitude
        }
    })
}

function checkPoint(){
    if(polyline==null){
        calcRoute();
    }else{
        if (google.maps.geometry.poly.isLocationOnEdge(staffMarker.getPosition() as google.maps.LatLng, polyline, 10e-1)) {
            calcRoute();
        }
    }
}

function calcRoute() {
    if(staffMarker != null && customerMarker != null){
        let start = staffMarker.getPosition() as google.maps.LatLng;
        let end = customerMarker.getPosition() as google.maps.LatLng;
        let request : google.maps.DirectionsRequest = {
            origin: start,
            destination: end,
            travelMode: google.maps.TravelMode.DRIVING,
            optimizeWaypoints: true,
            unitSystem:google.maps.UnitSystem.METRIC,
            provideRouteAlternatives: true,
            avoidFerries: true,

        };
        directionService.route(request, (result, status) => {
            if (status == 'OK') {
                //directionRender.setDirections(result);
                map.setCenter(start);
                let iconsetngs = {
                    path: google.maps.SymbolPath.FORWARD_CLOSED_ARROW
                };

                polyline = new google.maps.Polyline({
                    path: [],
                    strokeOpacity: 0.8,
                    strokeColor: '#FF0000',
                    strokeWeight: 3,
                    icons: [{
                        icon: iconsetngs,
                        repeat:'60px',
                        offset: '100%'}]
                  });
                let bounds = new google.maps.LatLngBounds();
        
        
                let legs = result.routes[0].legs;
                for (let i = 0; i < legs.length; i++) {
                    let steps = legs[i].steps;
                    for (let j = 0; j < steps.length; j++) {
                        let nextSegment = steps[j].path;
                        for (let k = 0; k < nextSegment.length; k++) {
                            polyline.getPath().push(nextSegment[k]);
                            bounds.extend(nextSegment[k]);
                        }
                    }
                }
        
                polyline.setMap(map);
            }
        });
    }
}

$(function(){
    initMap();
    setCustomerLocation();
    update();
});

function update():void{
    if(navigator.geolocation){
        navigator.geolocation.getCurrentPosition(markStaffPosition);
    } else {
      $("map").html("Geolocation is not supported by this browser.");
    }
    setTimeout(checkPoint,1000);
    setTimeout(update,10000);
}

