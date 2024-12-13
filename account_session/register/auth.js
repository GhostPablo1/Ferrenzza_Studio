
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
    
        // Ocultar los íconos al cargar la página si los campos están vacíos inicialmente
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
          }, 3000);
        }
      });