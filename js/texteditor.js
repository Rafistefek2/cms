let output = document.querySelector("#output")
let buttons = document.querySelectorAll(".tool-btn")

for(let btn of buttons){
    btn.addEventListener('click', ()=>{
        let command = btn.dataset['command']
        
        //? zmiana kolorów
        if(btn.classList.contains("onoff")){
            if (btn.style.backgroundColor === "lightgray") {
                btn.style.backgroundColor = "#f0f0f0";
            } else {
                btn.style.backgroundColor = "lightgray";
            }
        }
        
        if (command === 'createlink') {
            let url = prompt("Wstaw link do tekstu:", "http:\/\/");
            document.execCommand(command, false, url)
        } else {
            //? wykonanie komendy
            document.execCommand(command, false, null)
        }
    })
}