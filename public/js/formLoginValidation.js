// ----------------------------------for user view-------------------------------------
// hide show password toggle
let eyeIcon = document.getElementById("eyeIcon");
// eyeIcon adaptation height
eyeIcon.addEventListener("click", () => {
    if (password.type === "password") {
        eyeIcon.src = "/assets/images/eyeoff.png";
        password.type = "text";
    } else {
        eyeIcon.src = "/assets/images/eyeon.png";
        password.type = "password";
    }
});

//--------------------------------for validation---------------------------------------
//Objets recovery:inputs,error DOM fields

let loginForm = document.getElementById("loginForm");
let email = document.getElementById("email");
let password = document.getElementById("password");
let emailError = document.getElementById("errorEmail");
let passwordError = document.getElementById("errorPassword");

//every field validation function
function validatedEmail() {
    const regex = /^[a-zA-Z0-9-%_]+@[a-zA-Z]{2,}\.[a-zA-Z]{2,}$/i;
    let emailTrim = email.value.trim();

    if (emailTrim === "") {
        emailError.textContent = "Email required";
        return false;
    } else if (!regex.test(emailTrim)) {
        emailError.textContent = "Email format is incorrect";
        return false;
    } else {
        emailError.textContent = "";
        return true;
    }
}

function validatedPassword() {
    let passwordTrim = password.value.trim();
    if (passwordTrim === "") {
        passwordError.textContent = "Password required";
        eyeIcon.style.top = "45%"; // eyeIcon adaptation height
        return false;
    } else if (passwordTrim.length < 8) {
        passwordError.textContent = "Password must be at least 8 characters";
        return false;
    } else if (passwordTrim.length > 35) {
        passwordError.textContent = "Password Can't exceed 35 characters";
        return false;
    } else {
        passwordError.textContent = "";
        return true;
    }
}

//dynamicallyinput validate and border modified
email.addEventListener("input", () => {
    // validatedEmail();
    validatedEmail()
        ? (email.style.borderColor = "#00ff00")
        : (email.style.borderColor = "#dc3545");
});

password.addEventListener("input", () => {
    // validatedPassword();
    validatedPassword()
        ? (password.style.borderColor = "#00ff00")
        : (password.style.borderColor = "#dc3545");
});

// validation successful ? check and validate form
loginForm.addEventListener("submit", (event) => {
    const isValidEmail = validatedEmail();
    const isValidPassword = validatedPassword();
    if (!isValidEmail || !isValidPassword) {
        event.preventDefault();
        if (!isValidEmail) {
            email.style.borderColor = "#dc3545";
        }
        if (!isValidPassword) {
            password.style.borderColor = "#dc3545";
        }
    }
});
