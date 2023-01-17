function validateForm(formName, inputs) {
    let returnVal = true;

    for (let i = 0; i < inputs.length; i++) {
        let val = document.forms[formName][inputs[i]].value;

        if (val == null || val === "") {
            document.forms[formName][inputs[i]].style.borderColor = "red";
            returnVal = false;
        }
    }

    if (!returnVal) {
        alert("Prosím vyplňte všetky polia!");
    }

    return returnVal;
}

function checkValuePositiveInteger(formName, inputName) {
    let val = parseInt(document.forms[formName][inputName].value);

    if (val == null || !Number.isInteger(val) || val < 0) {
        document.forms[formName][inputName].style.borderColor = "red";
        alert("Neplatná hodnota ceny!");
        return false;
    }

    return true;
}

function evaluatePassword(formName, inputName, passwordDivID) {
    const passwordWeak = 1;
    const passwordMediocre = 2;
    const passwordStrong = 3;
    const passwordVeryStrong = 4;

    let inputField = document.forms[formName][inputName];

    if (inputField != null) {
        inputField.addEventListener('input', function () {
            let currentVal = inputField.value;
            let passwordStrength;

            if (currentVal.length < 7) {
                passwordStrength = passwordWeak;
            } else if (currentVal.length < 10) {
                passwordStrength = passwordMediocre;
            } else {
                passwordStrength = passwordStrong;
            }

            let containsLetters = /[a-z]/.test(currentVal);
            let containsNumbers = /[0-9]/.test(currentVal);
            let containsCaps = /[A-Z]/.test(currentVal);
            let containsSymbols = /[`!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?~]/.test(currentVal);

            let optionsSum = 0;
            optionsSum += containsLetters ? 1 : 0;
            optionsSum += containsNumbers ? 1 : 0;
            optionsSum += containsCaps ? 1 : 0;
            optionsSum += containsSymbols ? 1 : 0;

            switch (passwordStrength) {
                case passwordMediocre:
                    if (optionsSum > 3) {
                        passwordStrength = passwordStrong;
                    }
                    break;
                case passwordStrong:
                    if (optionsSum > 3) {
                        passwordStrength = passwordVeryStrong;
                    }
                    break;
            }

            if (optionsSum <= 1) {
                passwordStrength = passwordWeak; //regardless of its length
            }

            const oldP = document.getElementById("p-password-strength");

            if (oldP != null) {
                oldP.parentNode.removeChild(oldP);
            }

            const newP = document.createElement("p");
            newP.id = "p-password-strength";
            newP.style.marginTop = "5px";
            let message;

            switch (passwordStrength) {
                case passwordWeak:
                    inputField.style.backgroundColor = "orangered";
                    message = "Sila hesla: slabé";
                    newP.style.color = "orangered";
                    break;
                case passwordMediocre:
                    inputField.style.backgroundColor = "orange";
                    message = "Sila hesla: stredné";
                    newP.style.color = "orange";
                    break;
                case passwordStrong:
                    inputField.style.backgroundColor = "yellowgreen";
                    message = "Sila hesla: silné";
                    newP.style.color = "yellowgreen";
                    break;
                case passwordVeryStrong:
                    inputField.style.backgroundColor = "lime";
                    message = "Sila hesla: velmi silné";
                    newP.style.color = "lime";
                    break;
            }

            const textNode = document.createTextNode(message);
            newP.appendChild(textNode);

            document.getElementById(passwordDivID).appendChild(newP);
        });
    }
}
