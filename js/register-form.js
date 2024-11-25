function formdobry(){
    document.querySelector("#register-btn").classList.replace("btn-disabled", "btn-accept");
    document.querySelector("#register-btn").removeAttribute("disabled")
}

function formzly(){
    document.querySelector("#register-btn").classList.replace("btn-accept", "btn-disabled");
    document.querySelector("#register-btn").setAttribute('disabled', '')
}

document.addEventListener('DOMContentLoaded', () => {
    const usernameInput = document.querySelector('#username');
    const emailInput = document.querySelector('#email');
    const passwordInput = document.querySelector('#password');
    const repeatPasswordInput = document.querySelector('#repeat-password');
    const registerButton = document.querySelector('#register-btn');
    const formInputs = [usernameInput, emailInput, passwordInput, repeatPasswordInput];

    // Create and append the password strength indicator
    const strengthIndicator = document.createElement('span');
    strengthIndicator.style.display = 'none'; // Initially hidden
    strengthIndicator.style.color = '#666';
    strengthIndicator.style.marginTop = '5px';
    passwordInput.parentNode.appendChild(strengthIndicator);

    function updateStrengthIndicator(password) {
        let strength = 0;

        // Check password strength criteria
        if (password.length >= 8) strength++;
        if (/[A-Z]/.test(password)) strength++;
        if (/[a-z]/.test(password)) strength++;
        if (/\d/.test(password)) strength++;        //? sprawdza cyfry tak samo jak [0-9] ciekawostka
        if (/[\W_]/.test(password)) strength++;     //? znaki specjalne + (underscore)

        // Update the text of the strength indicator
        const strengthLevels = [
                                '<div class="pass-str" style="background-color: #ff4d4d; width: 20%">Bardzo słabe</div>', 
                                '<div class="pass-str" style="background-color: #ff944d; width: 40%">Słabe</div>',
                                '<div class="pass-str" style="background-color: #ffcc00; width: 60%">Średnie</div>',
                                '<div class="pass-str" style="background-color: #ccffcc; width: 80%">Silne</div>', 
                                '<div class="pass-str" style="background-color: #33cc33; width: 100%">Bardzo silne</div>'
                            ];

        if (password.length > 0) {
            strengthIndicator.style.display = 'inline'; // Make it visible
            strengthIndicator.innerHTML = strengthLevels[strength - 1] || 'Too Weak';
        } else {
            strengthIndicator.style.display = 'none'; // Hide if no password
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

    // Add event listeners to inputs
    formInputs.forEach(input => {
        input.addEventListener('input', validateForm);
    });
});