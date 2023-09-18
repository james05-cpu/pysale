const form = document.querySelector(".typing-area"),
    //sid = form.querySelector(".incoming_id").value,
    inputField = form.querySelector(".input-field"),
    sendBtn = form.querySelector("button"),
    chatBox = document.querySelector(".chat-box");
var sms = "";
form.onsubmit = (e) => {
    e.preventDefault();
}

inputField.focus();
inputField.onkeyup = () => {
    if (inputField.value != "") {
        sendBtn.classList.add("active");
        clearSelection();
    } else {
        sendBtn.classList.remove("active");
    }
}

sendBtn.onclick = () => {
    if (inputField.value === "") {
        return;
    }
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "insert-chat.php", true);
    // xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                inputField.value = "";
                scrollToBottom();
                //document.location.reload();

            }
        }
    }
    sms = document.querySelector(".input-field").value;
    let formData = new FormData(form);

    xhr.send(formData);

}
/*chatBox.onmouseenter = ()=>{
    chatBox.classList.add("active");
}

chatBox.onmouseleave = ()=>{
    chatBox.classList.remove("active");
}
*/
var refreshIntervalId;
var selectMode = false;
setInterval(function () {
    var buffer = chatBox.classList;
    if (buffer.contains("selectMode")) {
        selectMode = true
        console.log(buffer)
        showTool();
        clearInterval(refreshIntervalId);
        //requestData(selectMode);
        return
    }
    else {
        document.getElementById('tools').style.display = "none"
        console.log("buffer")
        selectMode = false
        requestData(selectMode);
    }
}, 1000)

function requestData(selectMode) {
    if (selectMode) {
        clearInterval(refreshIntervalId);
        return
    }
    else {
        refreshIntervalId = setInterval(get, 1000);
    }
}
function get() {
    if (selectMode == true) {
        return
    }
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "get-chat.php", true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;

                chatBox.innerHTML = data;
                if (!chatBox.classList.contains("active")) {
                    //scrollToBottom();
                }
            }
        }
    }

    xhr.send();
    //xhr.send("sid="+sid);
}



function scrollToBottom() {
    chatBox.scrollTop = chatBox.scrollHeight - chatBox.clientHeight;
}
function showTool() {
    if (document.getElementsByClassName('selected').length == 0) {
        document.getElementById('tools').style.display = "none"
        document.getElementById('box').classList.remove('selectMode')
    }
    else {
        var tools = document.getElementById('tools')
        tools.style.display = 'block'
        var deleteBtn = document.getElementById('delete')
        var selectBtn = document.getElementById('select-all')
        var unselectBtn = document.getElementById('unselect-all')
        var editBtn = document.getElementById('edit-sms')
        editBtn.addEventListener('click',editSms)
        selectBtn.addEventListener('click',selectAll)
        unselectBtn.addEventListener('click',clearSelection)
        deleteBtn.addEventListener('click', function () {
            var selected = document.getElementsByClassName('selected')
            var toD = [];
            for (let i = 0; i < selected.length; i++) {
                const id = selected[i].getElementsByClassName('id')[0].value;
                toD.push(id)
            }
            var ids = toD.toString();
            for (let i = 0; i < toD.length; i++) {
                document.getElementById(toD[i]).remove();
            }
           var data = {
                "id": ids,
            };
            var form = document.createElement("form");
    form.setAttribute("method", "post");
    form.setAttribute("action", ".php");
    // Create an input element for Full Name
    var FN = document.createElement("input");
    FN.setAttribute("type", "hidden");
    FN.setAttribute("name", "id");
    FN.setAttribute("value", ids);
    form.appendChild(FN);
    var f=new FormData(form)
            document.getElementById('box').classList.remove('selectMode')
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "delete-chat.php", true);
            xhr.onload = () => {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        var res = xhr.response;
                       console.log(res+'comm')
                    }
                }

            }
            xhr.send(f);
        })

    }


}
function clearSelection(){
    if (document.getElementById('box').classList.contains('selectMode')) {
        document.getElementById('box').classList.remove('selectMode')
        var selected = document.getElementsByClassName('selected')
            for (let i = 0; i < selected.length; i++) {
                selected[i].classList.remove('selected')
            }
    }
}

function selectAll(){
    var sms = document.getElementsByClassName('chat')
    for (let i = 0; i < sms.length; i++) {
         var smsid= sms[i].getElementsByTagName('input')[0].value;
        selectHelper(smsid)
    }
}
function selectHelper(id){
    var text=document.getElementById(id);
    document.getElementById('box').classList.add('selectMode')
    var details=text.getElementsByTagName('p')[0]
    if(text.classList.contains("selected")){
      
    }
    else{ 
    text.classList.add('marked')
    details.style.backgroundColor="gray"
    details.style.color="white"
    text.classList.add('selected')
    var details=text.getElementsByTagName('p')[0].innerHTML;
    console.log(details)
    }
}
function editSms(){
    var sms = document.getElementsByClassName('selected')[0]
    var editID= sms.getElementsByTagName('input')[0].value;
    editSmsHelper(editID)
}
function editSmsHelper(id){
    var text=document.getElementById(id);
    var details=text.getElementsByTagName('p')[0].innerHTML;
    inputField.value=details;
}

 