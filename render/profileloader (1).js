

 var Buttons = document.getElementsByClassName('view')
    for (var i = 0; i < Buttons.length; i++) {
        var button = Buttons[i]
        button.addEventListener('click', view)
    }  

function view(event){
 var button = event.target
    var seller = button.parentElement.parentElement;
var userEl = seller.getElementsByClassName('username')[0];
var user=userEl.value;
var url="shop_gateway.php?sid="+user;
      let xhr = new XMLHttpRequest();
    xhr.open("GET", url, true);
  // xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onload = ()=>{
      if(xhr.readyState === XMLHttpRequest.DONE){
          if(xhr.status === 200){
          }
      }
    }
  xhr.send();
var url="shop_gateway.php?sid="+user;
window.location=url;
/*var xhttp = new XMLHttpRequest();
xhttp.open("GET",url, true);
xhttp.send();*/
}


