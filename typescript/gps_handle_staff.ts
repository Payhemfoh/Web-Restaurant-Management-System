import {} from "googlemaps";

let map : google.maps.Map;
let customerMarker : google.maps.Marker;
let staffMarker : google.maps.Marker;
let geocoder : google.maps.Geocoder;

$(function(){
    initMap();
    update();
});

function update():void{
    setStaffPosition();
    setTimeout(update,60000);
}

function initMap():void{
    geocoder = new google.maps.Geocoder();
    map = new google.maps.Map(document.getElementById("map") as HTMLElement,{
            center:{lat:0,lng:0},
            zoom:16,
            streetViewControl:false,
            mapTypeId:google.maps.MapTypeId.ROADMAP
        });
    
    let location = $("#location").text() as string;

    geocoder.geocode({address:location},markCustomerPosition);
    
}

function markCustomerPosition(result : google.maps.GeocoderResult[],status:google.maps.GeocoderStatus) : void{
    let location = result[0].geometry.location;
    map.setCenter(location);
    
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

function setStaffPosition() : void{
    if(navigator.geolocation){
        navigator.geolocation.getCurrentPosition(markStaffPosition);
    } else {
      $("map").html("Geolocation is not supported by this browser.");
    }
}

function markStaffPosition(position : Position){
    let currentLocation = new google.maps.LatLng(position.coords.latitude,position.coords.longitude);
    let delivery_id = $("#delivery_id").val();

    if(staffMarker == null){
        staffMarker = new google.maps.Marker({
            position:currentLocation,
            map:map,
            title:"Your Location"
        });
    }else{
        staffMarker.setPosition(currentLocation);
    }
    map.setCenter(currentLocation);

    $.ajax("../php/updateStaffLocation.php",{
        method:"post",
        data:{
            delivery_id:delivery_id,
            longitude:position.coords.longitude,
            latitude:position.coords.latitude
        }
    })
}