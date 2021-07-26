const form = document.querySelector(".typing-area"),
incoming_id = form.querySelector(".incoming_id").value,
inputField = form.querySelector(".input-field"),
sendBtn = form.querySelector("button"),
chatBox = document.querySelector(".chat-box");

form.onsubmit = (e)=>{
    e.preventDefault();
}

inputField.focus();
inputField.onkeyup = ()=>{
    if(inputField.value != ""){
        sendBtn.classList.add("active");
    }else{
        sendBtn.classList.remove("active");
    }
}

sendBtn.onclick = ()=>{
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php/insert-chat.php", true);
    xhr.onload = ()=>{
      if(xhr.readyState === XMLHttpRequest.DONE){
          if(xhr.status === 200){
              inputField.value = "";
              scrollToBottom();
          }
      }
    }
    let formData = new FormData(form);
    xhr.send(formData);
}
chatBox.onmouseenter = ()=>{
    chatBox.classList.add("active");
}

chatBox.onmouseleave = ()=>{
    chatBox.classList.remove("active");
}

setInterval(() =>{
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php/get-chat.php", true);
    xhr.onload = ()=>{
      if(xhr.readyState === XMLHttpRequest.DONE){
          if(xhr.status === 200){
            let data = xhr.response;
            chatBox.innerHTML = data;
            if(!chatBox.classList.contains("active")){
                scrollToBottom();
              }
          }
      }
    }
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("incoming_id="+incoming_id);
}, 500);

setInterval(() =>{
    let req = new XMLHttpRequest();
    req.open("POST", "php/get-status.php", true);

    function laststatus(lastid) {
        let req2 = new XMLHttpRequest();
        req2.open("POST", "php/get-status.php", true);
        req2.onload = ()=>{
            if(req2.readyState === XMLHttpRequest.DONE){
                if(req2.status === 200){
                    if(parseInt(lastid) !== parseInt(req2.response)) {
                        if(parseInt(lastid) > 1) {
                            console.log('New Message');
                            this.sound = document.createElement("audio");
                            this.sound.src = 'notification.mp3';
                            this.sound.setAttribute("preload", "auto");
                            this.sound.setAttribute("controls", "none");
                            this.sound.style.display = "none";
                            document.body.appendChild(this.sound);
                            this.sound.play();
                        }
                    }

                    // console.log(lastid);
                    // console.log(req2.response);
                }
            }
        }
        req2.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        req2.send("incoming_id="+incoming_id);
    }

    req.onreadystatechange = function() {
      if(req.readyState === XMLHttpRequest.DONE){
          if(req.status === 200){
              var lastid = parseInt(req.response);
              setTimeout( function () {
                laststatus(lastid);
            }, 1000);
          }
      }
    }

    req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    req.send("incoming_id="+incoming_id);
}, 1000);

function scrollToBottom(){
    chatBox.scrollTop = chatBox.scrollHeight;
}

setInterval(() =>{
    let xhr = new XMLHttpRequest();
    xhr.open("GET", "php/update-status.php", true);
    xhr.send();
}, 10000);