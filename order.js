 var Buttons = document.getElementsByClassName('accept')
    for (var i = 0; i < Buttons.length; i++) {
        var button = Buttons[i]
        button.addEventListener('click', accepted)
    }  
function accepted(event){
 var button = event.target
    var seller = button.parentElement.parentElement;
var oderEl = seller.getElementsByClassName('oid')[0];
var oderid=orderEl.value;
var url="accept.php?oid="+orid;
window.location=url;
}
 var Buttons = document.getElementsByClassName('decline')
    for (var i = 0; i < Buttons.length; i++) {
        var button = Buttons[i]
        button.addEventListener('click', declined)
    }  
function declined(event){
var button = event.target
var seller = button.parentElement.parentElement;
var oderEl = seller.getElementsByClassName('oid')[0];
var oderid=orderEl.value;
var url="declined.php?oid="+orid;
window.location=url;
}

