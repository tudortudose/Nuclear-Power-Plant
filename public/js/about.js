let about_card_toggle = document.getElementsByClassName('about_card_toggle');

sendMail("tudor", "Titlu mail", "Continut mail");

function sendMail(to, title, message) {
    var xhr = new XMLHttpRequest();
    xhr.withCredentials = false;

    xhr.addEventListener("readystatechange", function() {
        if (this.readyState === 4) {
            let response = this.responseText;
            console.log("response " + response);
        }
    });

    let params = "to=";
    params += to;
    params += '&';

    params += "title=";
    params += title;
    params += '&';

    params += "message=";
    params += message;

    console.log("params " + params);
    xhr.open("POST", "http://localhost/NuclearGitProject/Nuclear-Power-Plant/EMails/sendMail?" + params);

    xhr.send();
}

Array.from(about_card_toggle).forEach(function(element) {
    element.onclick = function() {
        element.parentElement.classList.toggle('active');
    }
});