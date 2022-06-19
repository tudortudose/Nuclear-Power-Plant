let add_button = document.getElementsByClassName("add-plant")[0];
let add_button_pressed = false;
let create_plant = document.getElementsByClassName("create-plant-container")[0];
let place_it = document.getElementsByClassName("place-it")[0];
let can_place = false;
let map;

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

let author_id = document.getElementById("input1");
let nume = document.getElementById("input2");
let numar_reactoare = document.getElementById("input3");
let putere_reactor = document.getElementById("input4");
let image = document.getElementById("input5");
display_pps();

function display_pps() {
    var xhr = new XMLHttpRequest();
    xhr.withCredentials = false;

    xhr.addEventListener("readystatechange", function() {
        if (this.readyState === 4) {
            //alert(this.responseText);
            var results = JSON.parse(this.responseText);

            results.forEach(e => {
                console.log("author:" + e.autor_id);

                const marker = new google.maps.Marker({
                    position: { lat: e.latitudine, lng: e.longitudine },
                    map,
                    draggable: true,
                    title: "Power plant!",
                    icon: {
                        url: "http://localhost/NuclearGitProject/Nuclear-Power-Plant/public/img/plant.png",
                        scaledSize: new google.maps.Size(40, 35)
                    },
                    animation: google.maps.Animation.DROP
                });

                marker.addListener("click", () => {
                    infowindow.open(map, marker);
                });

                marker.addListener("dblclick", () => {
                    window.location.href = "http://localhost/NuclearGitProject/Nuclear-Power-Plant/Pages/ppInfo/" + e.nume;
                });

                const infowindow = new google.maps.InfoWindow({
                    content: "My power" + e.nume,
                });
            });


            console.log("response: " + JSON.parse(this.responseText)[0].autor_id);
        }
    });

    xhr.open("GET", "http://localhost/NuclearGitProject/Nuclear-Power-Plant/powerplants/getAll");

    xhr.send();
}

function getInsertParams(alt, lat, lng) {
    let params = "";
    params += 'author_id=';
    params += author_id.value;
    params += '&';

    params += 'nume=';
    params += nume.value;
    params += '&';

    params += 'numar_reactoare=';
    params += numar_reactoare.value;
    params += '&';

    params += 'putere_reactor=';
    params += putere_reactor.value;
    params += '&';

    params += 'altitudine=';
    params += alt;
    params += '&';

    params += 'latitudine=';
    params += lat;
    params += '&';

    params += 'longitudine=';
    params += lng;

    return params;
}

function sendInsertReq(alt, lat, lng) {
    var xhr = new XMLHttpRequest();
    xhr.withCredentials = false;

    xhr.addEventListener("readystatechange", function() {
        if (this.readyState === 4) {
            console.log(this.responseText);

            const marker = new google.maps.Marker({
                position: { lat: lat, lng: lng },
                map,
                draggable: true,
                title: "Power plant!",
                icon: {
                    url: "http://localhost/NuclearGitProject/Nuclear-Power-Plant/public/img/plant.png",
                    scaledSize: new google.maps.Size(40, 35)
                },
                animation: google.maps.Animation.DROP
            });

            marker.addListener("click", () => {
                infowindow.open(map, marker);
            });

            marker.addListener("dblclick", () => {
                window.location.href = "http://localhost/NuclearGitProject/Nuclear-Power-Plant/Pages/ppInfo/" + nume.value;
            });

            const infowindow = new google.maps.InfoWindow({
                content: "My power" + nume.value,
            });
        }
    });

    xhr.open("POST", "http://localhost/NuclearGitProject/Nuclear-Power-Plant/powerplants/insert?" + getInsertParams(alt, lat, lng), true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.send();
}

function setAltitude(lat, lng) {
    var xhr = new XMLHttpRequest();
    xhr.withCredentials = false;

    xhr.addEventListener("readystatechange", function() {
        if (this.readyState === 4) {
            let alt = JSON.parse(this.responseText).results[0].elevation;
            console.log("ALtitude is " + alt);
            sendInsertReq(alt, lat, lng);
        }
    });

    xhr.open("GET", "https://api.open-elevation.com/api/v1/lookup?locations=" +
        lat + "," + lng, true);

    xhr.send();
}


place_it.addEventListener("click", () => {

    console.log("image: " + image.value);
    can_place = true;
});

/*
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
*/

function initMap() {
    map = new google.maps.Map(document.getElementById("map"), {
        zoom: 7,
        center: { lat: 46.247974047191015, lng: 26.7737612614087 },
        mapTypeId: "terrain",
    });
    let infowindow = new google.maps.InfoWindow({});

    infowindow.open(map);
    infowindow.setPosition({ lat: 46.247974047191015, lng: 26.7737612614087 });
    infowindow.setContent("Hello this is me");

    // Add a listener for the click event. Display the elevation for the LatLng of
    // the click inside the infowindow.
    map.addListener("click", (mapsMouseEvent) => {
        if (can_place) {
            can_place = false;
            setAltitude(mapsMouseEvent.latLng.lat(), mapsMouseEvent.latLng.lng());
        }



        /*
        console.log("bau");
        Pt orase nearby

        const xhr = new XMLHttpRequest();
        xhr.withCredentials = true;

        xhr.addEventListener("readystatechange", function() {
            if (this.readyState === this.DONE) {
                var response = JSON.parse(this.responseText);
                //infowindow = new google.maps.InfoWindow({});
                //infowindow.open(map);
                console.log(response);
                infowindow.setPosition({ lat: mapsMouseEvent.latLng.lat(), lng: mapsMouseEvent.latLng.lng() });
                infowindow.setContent("Altitude: " + response);
            }
        });
        let strLat;
        if (mapsMouseEvent.latLng.lng() >= 0) {
            strLat = "+" + mapsMouseEvent.latLng.lng();
        } else {
            strLat = mapsMouseEvent.latLng.lng();
        }


        xhr.open("GET", "https://wft-geo-db.p.rapidapi.com/v1/geo/locations/" +
            mapsMouseEvent.latLng.lat() + strLat + "/nearbyCities?radius=10&limit=10");
        xhr.setRequestHeader("X-RapidAPI-Key", "0967321b4cmshbc723de38d848d9p18451ajsn7314224d06a8");
        xhr.setRequestHeader("X-RapidAPI-Host", "wft-geo-db.p.rapidapi.com");

        xhr.send();
        console.log(mapsMouseEvent.latLng.lat() + "," + mapsMouseEvent.latLng.lng());

        //Pt altitudine
        var xhr = new XMLHttpRequest();
        xhr.withCredentials = false;

        xhr.addEventListener("readystatechange", function() {
            if (this.readyState === 4) {
                var response = JSON.parse(this.responseText).results[0].elevation;
                infowindow = new google.maps.InfoWindow({});
                infowindow.open(map);
                console.log(response);
                infowindow.setPosition({ lat: mapsMouseEvent.latLng.lat(), lng: mapsMouseEvent.latLng.lng() });
                infowindow.setContent("Altitude: " + response);
                //alert(response);
            }
        });

        console.log(mapsMouseEvent.latLng.lat() + "," + mapsMouseEvent.latLng.lng());
        xhr.open("GET", "https://api.open-elevation.com/api/v1/lookup?locations=" +
            mapsMouseEvent.latLng.lat() + "," + mapsMouseEvent.latLng.lng());

        xhr.send();*/


    });
}

window.initMap = initMap;