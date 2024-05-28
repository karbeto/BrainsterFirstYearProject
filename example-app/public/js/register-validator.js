document.addEventListener('DOMContentLoaded', () => {
    const passwordField = document.getElementById('password');
    const confirmPasswordField = document.getElementById('confirm_password');
    const passwordRequirements = document.getElementById('passwordRequirements');
    const submitButton = document.querySelector('button[type="submit"]');

    const requirements = {
        charLength: document.getElementById('charLength'),
        number: document.getElementById('number'),
        uppercase: document.getElementById('uppercase'),
        specialChar: document.getElementById('specialChar')
    };

    const patterns = {
        charLength: /.{8,}/,
        number: /\d/,
        uppercase: /[A-Z]/,
        specialChar: /[!@#$%^&*()-_=+[{\]};:'",.<>?/|\\]/
    };

    function validatePassword() {
        const value = passwordField.value;
        let isValid = true;

        Object.keys(patterns).forEach(key => {
            if (patterns[key].test(value)) {
                requirements[key].classList.remove('invalid');
                requirements[key].classList.add('valid');
            } else {
                requirements[key].classList.remove('valid');
                requirements[key].classList.add('invalid');
                isValid = false; 
            }
        });

        return isValid;
    }

    function validateConfirmPassword() {
        const password = passwordField.value;
        const confirmPassword = confirmPasswordField.value;

        if (password !== confirmPassword) {
            confirmPasswordField.setCustomValidity("Passwords do not match");
            return false;
        } else {
            confirmPasswordField.setCustomValidity("");
            return true;
        }
    }

    function enableSubmitButton() {
        submitButton.disabled = false;
    }

    function disableSubmitButton() {
        submitButton.disabled = true;
    }

    function showPasswordRequirements() {
        passwordRequirements.classList.remove('hidden');
    }

    function hidePasswordRequirements() {
        passwordRequirements.classList.add('hidden');
    }

    function updateSubmitButton() {
        if (validatePassword() && validateConfirmPassword()) {
            enableSubmitButton();
        } else {
            disableSubmitButton();
        }
    }

    passwordField.addEventListener('focus', () => {
        showPasswordRequirements();
    });

    passwordField.addEventListener('blur', () => {
        if (passwordField.value === '') {
            hidePasswordRequirements();
        }
    });

    passwordField.addEventListener('input', () => {
        validatePassword();
        updateSubmitButton();
    });

    confirmPasswordField.addEventListener('input', () => {
        validateConfirmPassword();
        updateSubmitButton();
    });

    document.querySelector('form').addEventListener('submit', (event) => {
        if (!validatePassword() || !validateConfirmPassword()) {
            event.preventDefault(); 
        } else {
            disableSubmitButton(); 
        }
    });

        const passwordInput = document.getElementById('password');
        const confirmPasswordInput = document.getElementById('confirm_password');
        const passwordMatchError = document.getElementById('passwordMatchError');
        const submitBtn = document.getElementById('submitBtn');
    
        function checkPasswordMatch() {
            if (passwordInput.value !== confirmPasswordInput.value) {
                passwordMatchError.classList.remove('hidden');
                submitBtn.disabled = true;
            } else {
                passwordMatchError.classList.add('hidden');
                submitBtn.disabled = false;
            }
        }
    
        passwordInput.addEventListener('input', checkPasswordMatch);
        confirmPasswordInput.addEventListener('input', checkPasswordMatch);
});
