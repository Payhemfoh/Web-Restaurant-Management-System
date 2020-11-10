import {} from "googlemaps";
import { errorModal } from "./errorFunction";

let map : google.maps.Map;
let customerMarker : google.maps.Marker;
let geocoder : google.maps.Geocoder;

$(function(){
    initMap();
    setStaffPosition();
});

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
            title:"Your Location",
            animation:google.maps.Animation.BOUNCE
        });
    }else{
        customerMarker.setPosition(location);
        customerMarker.setAnimation(google.maps.Animation.BOUNCE);
    }

    setTimeout(()=>customerMarker.setAnimation(null),500);
}

function setStaffPosition() : void{
    $.ajax("../php/deliveryStatus_process.php",{
        method:"post",
        data:{

        },
        success:(data)=>{}
    })
}