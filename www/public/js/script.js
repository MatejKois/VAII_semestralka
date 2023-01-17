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

function evaluatePassword(formName, inputName) {
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

            switch (passwordStrength) {
                case passwordWeak:
                    inputField.style.backgroundColor = "orangered";
                    break;
                case passwordMediocre:
                    inputField.style.backgroundColor = "yellow";
                    break;
                case passwordStrong:
                    inputField.style.backgroundColor = "yellowgreen";
                    break;
                case passwordVeryStrong:
                    inputField.style.backgroundColor = "lime";
                    break;
            }
        });
    }
}
