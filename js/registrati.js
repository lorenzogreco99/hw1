function checkName(event) {
    const input = event.currentTarget;
    
    if (input.value.length > 0) {
        input.parentNode.parentNode.classList.remove('errori');
    } else {
        input.parentNode.parentNode.classList.add('errori');
    }
    
}

function jsonCheckUsername(json) {
    console.log(json);
    // Controllo il campo exists ritornato dal JSON
    if (!json) {
        document.querySelector('#username').classList.remove('errori');
    } else {
        document.querySelector('#nomeutente').textContent = "Nome utente già utilizzato";
        document.querySelector('#username').classList.add('errori');
    }
}

function jsonCheckEmail(json) {
    if (!json) {
        document.querySelector('#email').classList.remove('errori');
    } else {
        document.querySelector('#email_r').textContent = "Email già utilizzata";
        document.querySelector('#email').classList.add('errori');

    }
}

function fetchResponse(response) {
    if (!response.ok) return null;
    return response.json();
}

function checkUsername() {
    const input = document.querySelector('input[name="username"]');

    if(!/^[a-zA-Z0-9_]{1,15}$/.test(input.value)) {
        input.parentNode.parentNode.querySelector('span').textContent = "Sono ammesse lettere, numeri e underscore. Max. 15";
        input.parentNode.parentNode.classList.add('errori');
    } else {
        fetch("check_username.php?q="+encodeURIComponent(input.value)).then(fetchResponse).then(jsonCheckUsername);
    }    
}

function checkEmail() {
    const emailInput = document.querySelector('input[name="email"]');
    if(!/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(String(emailInput.value).toLowerCase())) {
        document.querySelector('#email_r').textContent = "Email non valida";
        document.querySelector('#email').classList.add('errori');
    } else {
        fetch("check_email.php?q="+encodeURIComponent(String(emailInput.value).toLowerCase())).then(fetchResponse).then(jsonCheckEmail);
    }
}

function checkPassword() {
    const passwordInput = document.querySelector('#password input');
    if (passwordInput.value.length >= 8) {
        document.querySelector('#password').classList.remove('errori');
    } else {
        document.querySelector('#password').classList.add('errori');
    }
}

function checkConfirmPassword() {
    const confirmPasswordInput = document.querySelector('#password_conf input');
    if (confirmPasswordInput.value === document.querySelector('#password input').value) {
        document.querySelector('#password_conf').classList.remove('errori');
    } else {
        document.querySelector('#password_conf').classList.add('errori');
    }

}



const name = document.querySelector('input[name="name"]').addEventListener('blur', checkName);
document.querySelector('input[name="surname"]').addEventListener('blur', checkName);
document.querySelector('input[name="username"] ').addEventListener('blur', checkUsername);
document.querySelector('input[name="email"]').addEventListener('blur', checkEmail);
document.querySelector('input[name="password"]').addEventListener('blur', checkPassword);
document.querySelector('input[name="password_conf"]').addEventListener('blur', checkConfirmPassword);