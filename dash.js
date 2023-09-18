var del= document.getElementsByClassName("deleteico")
for (var i = 0; i < del.length; i++) {
        var button = del[i]
        button.addEventListener('click', removeChat)
    }
function removeChat(event) {
    var buttonClicked = event.target
   var affected= buttonClicked.parentElement.parentElement;
   var sweep=affected.getElementsByClassName("cid")[0].value;
   var url="delchat.php?cid="+sweep;
      let xhr = new XMLHttpRequest();
    xhr.open("GET", url, true);
  // xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onload = ()=>{
      if(xhr.readyState === XMLHttpRequest.DONE){
          if(xhr.status === 200){
document.location.reload();

          }
      }
    }
  xhr.send();

}