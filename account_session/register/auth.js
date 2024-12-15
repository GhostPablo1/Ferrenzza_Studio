
    document.addEventListener('DOMContentLoaded', function() {
        var contrasenaInput = document.getElementById('password');
        var confirmContrasenaInput = document.getElementById('confirm_password');
        var contrasenaToggle = document.getElementById('password-toggle');
        var confirmContrasenaToggle = document.getElementById('confirm_password-toggle');
    
        contrasenaInput.addEventListener('input', function() {
            togglePasswordIconVisibility(contrasenaInput.value, contrasenaToggle);
        });
    
        confirmContrasenaInput.addEventListener('input', function() {
            togglePasswordIconVisibility(confirmContrasenaInput.value, confirmContrasenaToggle);
        });
    
        togglePasswordIconVisibility(contrasenaInput.value, contrasenaToggle);
        togglePasswordIconVisibility(confirmContrasenaInput.value, confirmContrasenaToggle);
    });
    
    function togglePasswordIconVisibility(value, icon) {
        if (icon) {
            if (value.length > 0) {
                icon.style.display = 'inline-block';
            } else {
                icon.style.display = 'none';
            }
        }
    }
    
    function togglePasswordVisibility(fieldId) {
        var field = document.getElementById(fieldId);
        var icon = document.getElementById(fieldId + '-toggle-icon');
        
        if (field && icon) {
            if (field.type === "password") {
                field.type = "text";
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            } else {
                field.type = "password";
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            }
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        var mensaje = document.querySelector('.mensaje');
        if (mensaje) {
          setTimeout(function() {
            mensaje.style.opacity = '0';
            setTimeout(function() {
              mensaje.remove();
            }, 500);
          }, 4000);
        }
      });

const passwordInput = document.getElementById('password');
const validationMessage = document.getElementById('password-validation');
const confirmPasswordInput = document.getElementById('confirm_password');
const confirmValidationMessage = document.getElementById('confirm_password-validation');

const conditions = [
  { regex: /.{8,}/, message: 'Debe tener al menos 8 caracteres' },
  { regex: /[A-Z]/, message: 'Debe incluir al menos una letra mayúscula' },
  { regex: /[0-9]/, message: 'Debe incluir al menos un número' },
  { regex: /[!@#$%^&*()\-_=+{}\[\]:;"\'<>,.?\/|\\\`~¡¿]/, message: 'Debe incluir al menos un carácter especial' }
];

function validatePassword() {
  const password = passwordInput.value;

  if (!password) {
    validationMessage.textContent = '';
    validationMessage.classList.remove('show', 'valid');
    return;
  }

  const unmetCondition = conditions.find(cond => !cond.regex.test(password));

  if (unmetCondition) {
    validationMessage.textContent = unmetCondition.message;
    validationMessage.classList.add('show');
    validationMessage.classList.remove('valid');
    passwordInput.classList.add('invalid');
    passwordInput.classList.remove('valid');
  } else {
    validationMessage.textContent = '✔ Contraseña válida';
    validationMessage.classList.add('valid', 'show');
    passwordInput.classList.add('valid');
    passwordInput.classList.remove('invalid');
    validateConfirmPassword();
  }
}

function validateConfirmPassword() {
  const password = passwordInput.value;
  const confirmPassword = confirmPasswordInput.value;

  if (!confirmPassword) {
    confirmValidationMessage.textContent = '';
    confirmValidationMessage.classList.remove('valid', 'show');
    confirmPasswordInput.classList.remove('valid', 'invalid');
    return;
  }

  if (password !== confirmPassword) {
    confirmValidationMessage.textContent = 'Las contraseñas no coinciden';
    confirmValidationMessage.classList.add('show');
    confirmValidationMessage.classList.remove('valid');
    confirmPasswordInput.classList.add('invalid');
    confirmPasswordInput.classList.remove('valid');
  } else {
    confirmValidationMessage.textContent = '✔ Las contraseñas coinciden';
    confirmValidationMessage.classList.add('valid', 'show');
    confirmPasswordInput.classList.add('valid');
    confirmPasswordInput.classList.remove('invalid');

    if (passwordInput.classList.contains('valid')) {
    }
  }
}

passwordInput.addEventListener('input', validatePassword);
confirmPasswordInput.addEventListener('input', validateConfirmPassword);
