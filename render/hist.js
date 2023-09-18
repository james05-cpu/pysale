 var removeItemButtons = document.getElementsByClassName('hist-item-remove-btn')
    for (var i = 0; i < removeItemButtons.length; i++) {
        var button = removeItemButtons[i]
        button.addEventListener('click', removeItem)
    }

function removeItem(event) {
    var buttonClicked = event.target
var hisItem=buttonClicked.parentElement.parentElement;
var idEl=hisItem.getElementsByClassName('hid')[0];
var id=idEl.value;
var url="delh.php?hid="+id;
let xhr = new XMLHttpRequest();
    xhr.open("GET", url, true);
   //xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onload = ()=>{
      if(xhr.readyState === XMLHttpRequest.DONE){
          if(xhr.status === 200){
document.location.reload();
          }
      }
    }

  xhr.send();
}
var clear=document.getElementsByClassName('hist-item-clear-btn')[0];
var hist=document.getElementsByClassName('hist-item')[0];
clear.addEventListener('click',removeAll)
function removeAll(){
let xhr = new XMLHttpRequest();
    xhr.open("POST", "clh.php", true);
   //xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onload = ()=>{
      if(xhr.readyState === XMLHttpRequest.DONE){
          if(xhr.status === 200){
document.location.reload();
          }
      }
    }

  xhr.send();
}
