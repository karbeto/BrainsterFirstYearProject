document.addEventListener('DOMContentLoaded', () => {
    const passwordField = document.getElementById('password');
    const passwordRequirements = document.getElementById('passwordRequirements');

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
        specialChar: /[!@#$%^&*(),.?":{}|<>]/
    };

    passwordField.addEventListener('focus', () => {
        passwordRequirements.classList.remove('hidden');
    });

    passwordField.addEventListener('blur', () => {
        if (passwordField.value === '') {
            passwordRequirements.classList.add('hidden');
        }
    });

    passwordField.addEventListener('input', () => {
        const value = passwordField.value;

        Object.keys(patterns).forEach(key => {
            if (patterns[key].test(value)) {
                requirements[key].classList.remove('invalid');
                requirements[key].classList.add('valid');
            } else {
                requirements[key].classList.remove('valid');
                requirements[key].classList.add('invalid');
            }
        });
    });
});
