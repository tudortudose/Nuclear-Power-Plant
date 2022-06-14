let about_card_toggle = document.getElementsByClassName('about_card_toggle');

Array.from(about_card_toggle).forEach(function(element){
    element.onclick = function(){
        element.parentElement.classList.toggle('active');
    }
});

