//? funkcja odblokowująca wysłanie formularza
function formdobry(){
    document.querySelector("#register-btn").classList.replace("btn-disabled", "btn-accept");
    document.querySelector("#register-btn").removeAttribute("disabled")
}

//? funckja blokująca wysłanie formularza
function formzly(){ 
    document.querySelector("#register-btn").classList.replace("btn-accept", "btn-disabled");
    document.querySelector("#register-btn").setAttribute('disabled', '')
}

//? dzialanie formularza rejestracji
document.addEventListener('DOMContentLoaded', () => {
    const usernameInput = document.querySelector('#username');
    const emailInput = document.querySelector('#email');
    const passwordInput = document.querySelector('#password');
    const repeatPasswordInput = document.querySelector('#repeat-password');
    const registerButton = document.querySelector('#register-btn');
    const formInputs = [usernameInput, emailInput, passwordInput, repeatPasswordInput];

    //? tworzy wskaźnik siły hasła
    const strengthIndicator = document.createElement('span');
    strengthIndicator.style.display = 'none'; //? schowany na początku
    strengthIndicator.style.color = '#666';
    strengthIndicator.style.marginTop = '5px';
    passwordInput.parentNode.appendChild(strengthIndicator);

    function updateStrengthIndicator(password) {
        let strength = 0;

        //? sprawdza siłe hasla
        if (password.length >= 8) strength++;
        if (/[A-Z]/.test(password)) strength++;
        if (/[a-z]/.test(password)) strength++;
        if (/\d/.test(password)) strength++;        //? sprawdza cyfry tak samo jak [0-9] ciekawostka
        if (/[\W_]/.test(password)) strength++;     //? znaki specjalne + (underscore)

        //? nadanie styli wskaźnikowi siły hasła
        const strengthLevels = [
                                '<div class="pass-str" style="background-color: #ff4d4d; width: 20%">Bardzo słabe</div>', 
                                '<div class="pass-str" style="background-color: #ff944d; width: 40%">Słabe</div>',
                                '<div class="pass-str" style="background-color: #ffcc00; width: 60%">Średnie</div>',
                                '<div class="pass-str" style="background-color: #ccffcc; width: 80%">Silne</div>', 
                                '<div class="pass-str" style="background-color: #33cc33; width: 100%">Bardzo silne</div>'
                            ];

        if (password.length > 0) {
            strengthIndicator.style.display = 'inline'; //? pojawia sięwskaźnik
            strengthIndicator.innerHTML = strengthLevels[strength - 1];
        } else {
            strengthIndicator.style.display = 'none'; //? schowaj jeśli usunięto z formularza
        }

        return strength;
    }

    function validateForm() {
        const isUsernameValid = usernameInput.value.trim().length > 0;
        const isEmailValid = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(emailInput.value);
        /*               
            ? sprawdza od poczatku                        ^
            ? wawala niepotrzebne spacje lub @            [^\s@]+         ^ oznacza negacje
            ? wymaga dokładnie jednego symbolu @          @
            ? wywala niepotrzebne spacje lub @ (domeny)   [^\s@]+
            ? wymaga kropki w domenie                     \.
            ? wywala spacje i @ z domeny po kropce        [^\s@]+
            ? sprawdza do konca                           $
        */
        const isPasswordValid = passwordInput.value.length >= 8;
        const isPasswordMatch = passwordInput.value === repeatPasswordInput.value;

        const isPasswordStrong = updateStrengthIndicator(passwordInput.value) >= 3;
        //? haslo musi byc przynajmniej srednie zeby mozna było wysłać formularz

        if (isUsernameValid && isEmailValid && isPasswordValid && isPasswordMatch && isPasswordStrong) {
            formdobry();
        } else {
            formzly();
        }
    }

    //? dodaje listener dla każdej zmiany w formularzu
    formInputs.forEach(input => {
        input.addEventListener('input', validateForm);
    });
});
