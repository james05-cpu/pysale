var Buttons = document.getElementsByClassName('decline')
    for (var i = 0; i < Buttons.length; i++) {
        var button = Buttons[i]
        button.addEventListener('click', dcln)
    }  

var Buttons = document.getElementsByClassName('accept')
    for (var i = 0; i < Buttons.length; i++) {
        var button = Buttons[i]
        button.addEventListener('click', acep)
    }  
var Buttons = document.getElementsByClassName('cancel')
    for (var i = 0; i < Buttons.length; i++) {
        var button = Buttons[i]
        button.addEventListener('click', cnl)
    }  

function cnl(event){
 var clicked = event.target
    var obj = clicked.parentElement;
var oidEl = obj.getElementsByClassName('oid')[0];
var oid=oidEl.value;
const url="delo.php?oid="+oid;
window.location=url;
}

function dcln(event){
 var clicked = event.target
    var obj =clicked.parentElement;
var oidEl = obj.getElementsByClassName('oid')[0];
var oid=oidEl.value;
const url="dclo.php?oid="+oid;
window.location=url;
}

function acep(event){
 var clicked = event.target
    var obj =clicked.parentElement;
var oidEl = obj.getElementsByClassName('oid')[0];
var oid=oidEl.value;
const url="acep.php?oid="+oid;
window.location=url;
}
