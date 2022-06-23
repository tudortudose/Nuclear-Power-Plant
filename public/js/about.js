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

var btn1 = document.getElementById("reactor_btn1");
var btn2 = document.getElementById("reactor_btn2");
var btn3 = document.getElementById("reactor_btn3");

btn1.onclick = function(){
    sendMail("u.alexandra.maria@gmail.com",document.getElementById("about_card_title_input1").value, document.getElementById("about_card_email_input1").value+" : "+document.getElementById("about_card_message_input1").value);
}

btn2.onclick = function(){
    sendMail("pricoptudor2001@gmail.com",document.getElementById("about_card_title_input2").value, document.getElementById("about_card_email_input2").value+" : "+document.getElementById("about_card_message_input2").value);
}

btn3.onclick = function(){
    sendMail("tudorel_31@yahoo.com",document.getElementById("about_card_title_input3").value, document.getElementById("about_card_email_input3").value+" : "+document.getElementById("about_card_message_input3").value);
}

Array.from(about_card_toggle).forEach(function(element) {
    element.onclick = function() {
        element.parentElement.classList.toggle('active');
    }
});