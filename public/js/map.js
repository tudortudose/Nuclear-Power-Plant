let add_button = document.getElementsByClassName("add-plant")[0];
let add_button_pressed = false;
let create_plant = document.getElementsByClassName("create-plant-container")[0];
let place_it = document.getElementsByClassName("place-it")[0];
let can_place = false;
let map;

let searchInput = document.getElementById("searchInput");
let searchBtn = document.getElementById("searchBtn");

var modal = document.getElementById("reactor_modal");
var span = document.getElementsByClassName("close")[0];
let modal_name = document.getElementById("modal_input1");
let modal_reactorCount = document.getElementById("modal_input2");
let modal_reactorPower = document.getElementById("modal_input3");
let modal_id = document.getElementById("modal_input4");
let modal_authorId = document.getElementById("modal_input5");
let modal_edit_save = document.getElementById("modal_edit_save");
let modal_config = document.getElementById("modal_config");
let modal_delete = document.getElementById("modal_delete");

let modal_invalidName = document.getElementById("modal_invalidName");
let modal_invalidReactorCount = document.getElementById("modal_invalidReactorCount");
let modal_invalidReactorPower = document.getElementById("modal_invalidReactorPower");

let name = document.getElementById("input2");
let reactorCount = document.getElementById("input3");
let reactorPower = document.getElementById("input4");
let image = document.getElementById("input5");

let invalidName = document.getElementById("invalidName");
let invalidReactorCount = document.getElementById("invalidReactorCount");
let invalidReactorPower = document.getElementById("invalidReactorPower");

let altitudeErrorInfoWindow = null;

let markerList = [];
let infoWindowList = [];
let currentUpdMarker;
let currentUpdInfoWindow;

display_pps();

function getUpdateParams() {
    let params = "id=";
    params += modal_id.value;
    params += "&";

    params += "name=";
    params += modal_name.value;
    params += "&";

    params += "reactorCount=";
    params += modal_reactorCount.value;
    params += "&";

    params += "reactorPower=";
    params += modal_reactorPower.value;

    return params;
}

function updatePpConstruction() {
    currentUpdMarker.title = modal_name.value;
    currentUpdInfoWindow.setOptions({
        content: "My power " + modal_name.value,
    })
}

function sendUpdateRequest() {
    var xhr = new XMLHttpRequest();
    xhr.withCredentials = false;

    xhr.addEventListener("readystatechange", function() {
        if (this.readyState === 4) {
            console.log(this.responseText);
            updatePpConstruction();
        }
    });

    xhr.open("UPDATE", "http://localhost/NuclearGitProject/Nuclear-Power-Plant/powerplants/update?" + getUpdateParams(), true);

    xhr.send();
}

function verifyModalPpName() {
    var xhr = new XMLHttpRequest();
    xhr.withCredentials = false;

    xhr.addEventListener("readystatechange", function() {
        if (this.readyState === 4) {
            let response = this.responseText;
            if (response == "false") {
                sendUpdateRequest();
            } else {
                if (JSON.parse(this.responseText).id == modal_id.value) {
                    sendUpdateRequest();
                } else {
                    modal_invalidName.innerHTML = 'This name already exists!';
                }
            }
        }
    });

    xhr.open("GET", "http://localhost/NuclearGitProject/Nuclear-Power-Plant/powerplants/getByName?name=" + modal_name.value);

    xhr.send();
}

function verifyModalInput() {
    let ok = 1;
    modal_invalidName.innerHTML = '';
    modal_invalidReactorCount.innerHTML = '';
    modal_invalidReactorPower.innerHTML = '';
    if (modal_name.value == '') {
        console.log("aici")
        modal_invalidName.innerHTML = 'This field is required!';
        console.log('here')
        ok = 0;
    }
    if (modal_reactorCount.value == '') {
        modal_invalidReactorCount.innerHTML = 'This field is required!';
        ok = 0;
    }
    if (modal_reactorPower.value == '') {
        modal_invalidReactorPower.innerHTML = 'This field is required!';
        ok = 0;
    }
    if (ok == 0) return false;

    if (isNaN(parseFloat(modal_reactorCount.value))) {
        modal_invalidReactorCount.innerHTML = 'This should be a number!';
        ok = 0;
    }

    if (isNaN(parseFloat(modal_reactorPower.value))) {
        modal_invalidReactorPower.innerHTML = 'This should be a number!';
        ok = 0;
    }
    if (ok == 0) return false;

    verifyModalPpName();
}


modal_edit_save.addEventListener("click", () => {
    if (modal_edit_save.innerHTML == "Edit") {
        modal_edit_save.innerHTML = "Save";
        modal_name.readOnly = false;
        modal_reactorCount.readOnly = false;
        modal_reactorPower.readOnly = false;
        console.log("yey");
    } else {
        /*
        modal_edit_save.innerHTML = "Edit";
        modal_name.readOnly = true;
        modal_reactorCount.readOnly = true;
        modal_reactorPower.readOnly = true;
        console.log("bau");*/
        verifyModalInput();
    }
});

span.addEventListener("click", () => {
    modal.style.display = "none";
});

searchBtn.addEventListener("click", () => {
    let searchText = searchInput.value;
    console.log(searchText);
    for (let i = 0; i < markerList.length; i++) {
        if (markerList[i].title == searchText) {

            map.setOptions({
                center: markerList[i].position,
                zoom: 7
            });
            infoWindowList[i].open(map, markerList[i]);
        }
    }
});

add_button.addEventListener("click", () => {
    if (add_button_pressed)
        create_plant.style.visibility = "hidden";
    else
        create_plant.style.visibility = "visible";
    add_button_pressed = !add_button_pressed;
});

place_it.addEventListener("click", () => {
    verifyInput();
});

function verifyPpName() {
    var xhr = new XMLHttpRequest();
    xhr.withCredentials = false;

    xhr.addEventListener("readystatechange", function() {
        if (this.readyState === 4) {
            let response = this.responseText;
            if (response == "false") {
                can_place = true;
                create_plant.style.visibility = "hidden";
                add_button_pressed = false;
            } else {
                invalidName.innerHTML = 'This name already exists!';
            }
        }
    });

    xhr.open("GET", "http://localhost/NuclearGitProject/Nuclear-Power-Plant/powerplants/getByName?name=" + name.value);

    xhr.send();
}

function verifyInput() {
    let ok = 1;
    invalidName.innerHTML = '';
    invalidReactorCount.innerHTML = '';
    invalidReactorPower.innerHTML = '';
    if (name.value == '') {
        invalidName.innerHTML = 'This field is required!';
        console.log('here')
        ok = 0;
    }
    if (reactorCount.value == '') {
        invalidReactorCount.innerHTML = 'This field is required!';
        ok = 0;
    }
    if (reactorPower.value == '') {
        invalidReactorPower.innerHTML = 'This field is required!';
        ok = 0;
    }
    if (ok == 0) return false;

    if (isNaN(parseFloat(reactorCount.value))) {
        console.log(parseFloat(reactorCount.value));
        invalidReactorCount.innerHTML = 'This should be a number!';
        ok = 0;
    }

    if (isNaN(parseFloat(reactorPower.value))) {
        invalidReactorPower.innerHTML = 'This should be a number!';
        ok = 0;
    }
    if (ok == 0) return false;

    verifyPpName();
}

function display_pps() {
    var xhr = new XMLHttpRequest();
    xhr.withCredentials = false;

    xhr.addEventListener("readystatechange", function() {
        if (this.readyState === 4) {
            var results = JSON.parse(this.responseText);

            results.forEach(e => {
                console.log("author:" + e.author_id);
                constructPowerPlant(e.latitude, e.longitude, e.name);
            });
        }
    });

    xhr.open("GET", "http://localhost/NuclearGitProject/Nuclear-Power-Plant/powerplants/getAll");

    xhr.send();
}

function constructPowerPlant(lat, lng, ppName) {
    const marker = new google.maps.Marker({
        position: { lat: lat, lng: lng },
        map,
        draggable: false,
        title: ppName,
        icon: {
            url: "http://localhost/NuclearGitProject/Nuclear-Power-Plant/public/img/plant.png",
            scaledSize: new google.maps.Size(40, 35)
        },
        animation: google.maps.Animation.DROP
    });

    const infowindow = new google.maps.InfoWindow({
        content: "My power " + ppName,
    });

    marker.addListener("click", () => {
        infowindow.open(map, marker);
    });

    marker.addListener("dblclick", () => {
        currentUpdMarker = marker;
        currentUpdInfoWindow = infowindow;
        loadPpInfoModal(ppName);
    });

    markerList.push(marker);

    infoWindowList.push(infowindow);
}

function loadPpInfoModal(ppName) {
    var xhr = new XMLHttpRequest();
    xhr.withCredentials = false;

    xhr.addEventListener("readystatechange", function() {
        if (this.readyState === 4) {
            let response = JSON.parse(this.responseText);

            modal_name.value = response['name'];
            modal_reactorCount.value = response['reactorCount'];
            modal_reactorPower.value = response['reactorPower'];
            modal_id.value = response['id'];
            modal_authorId.value = response['author_id'];
            let modalImg = document.getElementById('modalImg');
            modalImg.src = "http://localhost/NuclearGitProject/Nuclear-Power-Plant/public/ppImgs/" + response['name'] + ".jpg";

            modal.style.display = "block";
        }
    });

    xhr.open("GET", "http://localhost/NuclearGitProject/Nuclear-Power-Plant/powerplants/getByName?name=" + ppName);

    xhr.send();
}

function getInsertParams(alt, lat, lng) {
    let params = "";

    params += 'name=';
    params += name.value;
    params += '&';

    params += 'reactorCount=';
    params += reactorCount.value;
    params += '&';

    params += 'reactorPower=';
    params += reactorPower.value;
    params += '&';

    params += 'altitude=';
    params += alt;
    params += '&';

    params += 'latitude=';
    params += lat;
    params += '&';

    params += 'longitude=';
    params += lng;

    return params;
}

function sendInsertReq(alt, lat, lng) {
    var xhr = new XMLHttpRequest();
    xhr.withCredentials = false;

    xhr.addEventListener("readystatechange", function() {
        if (this.readyState === 4) {
            console.log(this.responseText);
            constructPowerPlant(lat, lng, name.value);
        }
    });

    xhr.open("POST", "http://localhost/NuclearGitProject/Nuclear-Power-Plant/powerplants/insert?" + getInsertParams(alt, lat, lng), true);

    const files = document.querySelector('[name=ppImage]').files;

    const formData = new FormData();
    formData.append('ppImage', files[0]);

    xhr.send(formData);
}

function setAltitude(lat, lng) {
    var xhr = new XMLHttpRequest();
    xhr.withCredentials = false;

    xhr.addEventListener("readystatechange", function() {
        if (this.readyState === 4) {
            let alt = JSON.parse(this.responseText).results[0].elevation;
            console.log("ALtitude is " + alt);
            if (alt == '0') {

                if (altitudeErrorInfoWindow != null) {
                    altitudeErrorInfoWindow.setOptions({
                        position: { lat: lat, lng: lng }
                    });
                    altitudeErrorInfoWindow.open(map);
                } else {
                    altitudeErrorInfoWindow = new google.maps.InfoWindow({
                        content: "You can't place pp on water!",
                        position: { lat: lat, lng: lng }
                    });
                    altitudeErrorInfoWindow.open(map);
                }
            } else {
                if (altitudeErrorInfoWindow != null) {
                    altitudeErrorInfoWindow.close();
                }
                can_place = false;
                sendInsertReq(alt, lat, lng);
            }
        }
    });

    xhr.open("GET", "https://api.open-elevation.com/api/v1/lookup?locations=" +
        lat + "," + lng, true);

    xhr.send();
}

function initMap() {
    map = new google.maps.Map(document.getElementById("map"), {
        zoom: 7,
        center: { lat: 46.247974047191015, lng: 26.7737612614087 },
        mapTypeId: "terrain",
    });
    let infowindow = new google.maps.InfoWindow({});

    infowindow.open(map);
    //infowindow.setPosition({ lat: 46.247974047191015, lng: 26.7737612614087 });
    //infowindow.setContent("<p>Hello</p> <p>this</p> is me  ewas");

    // Add a listener for the click event. Display the elevation for the LatLng of
    // the click inside the infowindow.
    map.addListener("click", (mapsMouseEvent) => {
        if (can_place) {
            setAltitude(mapsMouseEvent.latLng.lat(), mapsMouseEvent.latLng.lng());
        }
    });
}

window.initMap = initMap;