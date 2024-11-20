function formdobry(){  //! do testa!!!!
    document.querySelector("#register-btn").classList.replace("btn-disabled", "btn-accept");
    document.querySelector("#register-btn").removeAttribute("disabled")
}

function formzly(){  //! do testa!!!!
    document.querySelector("#register-btn").classList.replace("btn-accept", "btn-disabled");
    document.querySelector("#register-btn").setAttribute('disabled')
}