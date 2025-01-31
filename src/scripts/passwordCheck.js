var passwordInput = document.getElementById('password');
var confirmPasswordInput = document.getElementById('cpass');
var submitButton = document.getElementById('submit');
var editButton = document.getElementById('edit-btn');
var tooltip = document.getElementById('tooltip');
var error = document.getElementById('error');
var togglePassword = document.getElementById('toggle-password');
var requirements = {
    number: /(?=.*\d)/,
    uppercase: /(?=.*[A-Z])/,
    lowercase: /(?=.*[a-z])/,
    special: /(?=.*[!@#$%^&*])/,
    length: /.{8,16}/
};

passwordInput.addEventListener('focus', function() {
    tooltip.style.opacity = '1';
    tooltip.style.display = 'block';
});

passwordInput.addEventListener('blur', function() {
    tooltip.style.opacity = '0';
    tooltip.style.display = 'none';
});

passwordInput.addEventListener('input', function() {
    var value = passwordInput.value;
    for (var key in requirements) {
        var element = document.getElementById(key);
        if (requirements[key].test(value)) {
            element.classList.remove('invalid');
            element.classList.add('valid');
        } else {
            element.classList.remove('valid');
            element.classList.add('invalid');
        }
    }
});

// Confirm Password
confirmPasswordInput.addEventListener('input', checkPasswordMatch);

function checkPasswordMatch() {
    if (passwordInput.value === confirmPasswordInput.value) {
        confirmPasswordInput.style.border = '3px solid green';
        confirmPasswordInput.style.marginBottom = '1em';
        submitButton.disabled = false;
        editButton.disabled = false;
        error.hidden = true;
    } else {
        confirmPasswordInput.style.border = '3px solid red';
        confirmPasswordInput.style.marginBottom = '0';
        submitButton.disabled = true;
        editButton.disabled = true;
        error.hidden = false;
        error.style.marginBottom = '1em';
    }
}
togglePassword.addEventListener('click', function() {
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        togglePassword.src = './src/assets/hide.png';
    } else {
        passwordInput.type = 'password';
        togglePassword.src = './src/assets/show.png';
    }
});