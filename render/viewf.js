 var Buttons = document.getElementsByClassName('view')
    for (var i = 0; i < Buttons.length; i++) {
        var button = Buttons[i]
        button.addEventListener('click', view)
    }  

function view(event){
 var button = event.target
    var seller = button.parentElement;
var userEl = seller.getElementsByClassName('fid')[0];
var user=userEl.value;
var url="shop_gateway.php?sid="+user;
window.location=url;

}

 var Buttons = document.getElementsByClassName('unfollow')
    for (var i = 0; i < Buttons.length; i++) {
        var button = Buttons[i]
        button.addEventListener('click', unfollow)
    }  

function unfollow(event){
 var button = event.target
    var seller = button.parentElement;
var userEl = seller.getElementsByClassName('fid')[0];
var user=userEl.value;
var url="unfollow.php?sid="+user;
window.location=url;

}
 var Buttons = document.getElementsByClassName('follow')
    for (var i = 0; i < Buttons.length; i++) {
        var button = Buttons[i]
        button.addEventListener('click', follow)
    }  

function follow(event){
 var button = event.target
    var seller = button.parentElement;
var userEl = seller.getElementsByClassName('fid')[0];
var user=userEl.value;
   link="follow.php?sid="+user;
   window.location=link;

   }