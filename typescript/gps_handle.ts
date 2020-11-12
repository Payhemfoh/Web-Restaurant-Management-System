import {} from "googlemaps";

let map : google.maps.Map;
let customerMarker : google.maps.Marker;
let staffMarker : google.maps.Marker;
let geocoder : google.maps.Geocoder;

$(function(){
    initMap();
    update();
});

function update(){
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
            title:"Your Location",
            animation:google.maps.Animation.BOUNCE
        });
    }else{
        customerMarker.setPosition(location);
        customerMarker.setAnimation(google.maps.Animation.BOUNCE);
    }

    setTimeout(()=>customerMarker.setAnimation(null),500);
}

function markStaffPosition(position : google.maps.LatLng) : void{
    if(staffMarker == null){
        staffMarker = new google.maps.Marker({
            position:position,
            map:map,
            title:"Staff Location"
        });
    }else{
        staffMarker.setPosition(position);
    }
}

function setStaffPosition() : void{
    let delivery_id = $("#delivery_id").val();
    $.ajax("../php/getStaffLocation.php",{
        method:"post",
        dataType:"json",
        data:{
            id:delivery_id
        },
        success:(data)=>{
            if(data.longitude != null && data.latitude != null){
                markStaffPosition(new google.maps.LatLng(data.longitude,data.latitude));
            }
        }
    })
}