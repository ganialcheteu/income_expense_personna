//--------------------------------for register validation---------------------------------------

// ***** email and password validation have been done in formLoginValidation *****

let userName = document.getElementById("name");
let errorName = document.getElementById("errorName");
let role = document.getElementById("role");
let errorRole = document.getElementById("errorRole");
let checkbox = document.getElementById("checkbox");
let CheckboxLabel = document.getElementById("checkboxLabel");

// checkbox.addEventListener('click',() => {
// !checkbox.checked ?
// });

//name field validation function
function validatedName() {
    const regexName = /^[a-zA-Z\s]{2,}$/i;
    let userNameTrim = userName.value.trim();
    if (userNameTrim === "") {
        errorName.textContent = "Name required";
        return false;
    } else if (userNameTrim.length < 2) {
        errorName.textContent = "Name must be least than 2 characters";
        return false;
    } else if (!regexName.test(userNameTrim)) {
        errorName.textContent = "Name must be correct, no special characters";
        return false;
    } else {
        errorName.textContent = "";
        return true;
    }
}

//dynamically input validate and border modified
userName.addEventListener("input", () => {
    // validatedName();
    validatedName()
        ? (userName.style.borderColor = "#00ff00")
        : (userName.style.borderColor = "#dc3545");
});
checkbox.addEventListener("click", () => {
    if (checkbox.checked) {
        CheckboxLabel.style.color = "black";
    }
});
// validation successful ? check and validate form
registerForm.addEventListener("submit", (event) => {
    const isValidEmail = validatedEmail();
    const isValidPassword = validatedPassword();
    const isValidName = validatedName();
    if (
        !isValidEmail ||
        !isValidPassword ||
        !isValidName ||
        !checkbox.checked
    ) {
        event.preventDefault();
        if (!isValidName) {
            userName.style.borderColor = "#dc3545";
        }
        if (!isValidPassword) {
            password.style.borderColor = "#dc3545";
        }
        if (!isValidEmail) {
            email.style.borderColor = "#dc3545";
        }
        if (!checkbox.checked) {
            CheckboxLabel.classList.remove("text-muted");
            CheckboxLabel.style.color = "#dc3545";
        }
    }
});
