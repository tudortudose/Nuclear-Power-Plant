let add_button = document.getElementsByClassName("add-plant")[0];
let add_button_pressed = false;
let create_plant = document.getElementsByClassName("create-plant-container")[0];
let place_it = document.getElementsByClassName("place-it")[0];
let can_place = false;

add_button.addEventListener("click", () => {
    if (add_button_pressed)
        create_plant.style.visibility = "hidden";
    else
        create_plant.style.visibility = "visible";
    add_button_pressed = !add_button_pressed;
});

place_it.addEventListener("click", () => {
    can_place = true;
    create_plant.style.visibility = "hidden";
    add_button_pressed = false;
});

function initMap() {
    map = new google.maps.Map(document.getElementById('map'), {
        center: { lat: 46.247974047191015, lng: 26.7737612614087 },
        zoom: 13,
        mapId: '451dc5b4c648ff34',
        draggable: true
    });

    map.addListener("click", (mapsMouseEvent) => {
        if (can_place == true) {
            can_place = false;

            //console.log(JSON.stringify(mapsMouseEvent.latLng.toJSON(), null, 2));
            //marker.setMap(null);

            const marker = new google.maps.Marker({
                position: mapsMouseEvent.latLng,
                map,
                draggable: true,
                title: "Power plant!",
                icon: {
                    url: "http://localhost/NuclearGitProject/Nuclear-Power-Plant/public/img/plant.png",
                    scaledSize: new google.maps.Size(50, 45)
                },
                animation: google.maps.Animation.DROP
            });

            const infowindow = new google.maps.InfoWindow({
                content: "My power"
            });

            marker.addListener("click", () => {
                infowindow.open(map, marker);

                var xhr = new XMLHttpRequest();
                xhr.withCredentials = false;

                xhr.addEventListener("readystatechange", function() {
                    if(this.readyState === 4) {
                        var response = JSON.parse(this.responseText).current.condition.text;
                        alert(response);
                    }
                    });
                
                    console.log(mapsMouseEvent.latLng.lat()+","+mapsMouseEvent.latLng.lng());
                    xhr.open("GET", "http://api.weatherapi.com/v1/current.json?key=ecfaaa0d77c544219a3100819221706&q="
                    +mapsMouseEvent.latLng.lat()+","+mapsMouseEvent.latLng.lng()+"&aqi=yes");
                
                    xhr.send();

            });
            marker.addListener("dblclick", () => {
                window.location.href = "http://localhost/NuclearGitProject/Nuclear-Power-Plant/Pages/about";
            });
        }
    });
}