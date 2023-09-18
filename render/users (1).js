
const proinfo=[];
/*ar Buttons = document.getElementsByClassName('update-btn')
    for (var i = 0; i < Buttons.length; i++) {
        var button = Buttons[i]
        button.addEventListener('click', up)
    }  
function up(event){
 var button = event.target
    var obj = button.parentElement.parentElement;
var pidEl = obj.getElementsByClassName('productname')[0];
var pid=pidEl.innerText;
var priceEl = obj.getElementsByClassName('price')[0];
var price=priceEl.value;
var desEl = obj.getElementsByClassName('des')[0];
var des=desEl.value;
*/
/*proinfo.push(pid)
proinfo.push(price)
proinfo.push(des)
var data="altp.php?name="+pid+"&prc="+price+"&des="+des;
    let xhr = new XMLHttpRequest();
    xhr.open("GET", data, true);
   //xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onload = ()=>{
      if(xhr.readyState === XMLHttpRequest.DONE){
          if(xhr.status === 200){

          }
      }
    }
  xhr.send();

}*/

 var Buttons = document.getElementsByClassName('delete-btn')
    for (var i = 0; i < Buttons.length; i++) {
        var button = Buttons[i]
        button.addEventListener('click', del)
    }  
function del(event){
var button = event.target
var obj = button.parentElement.parentElement;
var nameEl = obj.getElementsByClassName('productname')[0];
var pid=nameEl.innerText;
var url="delp.php?productname="+pid;

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

