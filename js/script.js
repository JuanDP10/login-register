document.addEventListener('DOMContentLoaded', function() {
    // 📌 Registro del Service Worker
    if ("serviceWorker" in navigator) {
        window.addEventListener("load", () => {
            navigator.serviceWorker.register("/login-register/js/service-worker.js")
                .then((reg) => console.log("✅ Service Worker registrado", reg))
                .catch((err) => console.log("❌ Error al registrar el Service Worker", err));
        });

        // Notificación cuando la PWA está lista
        navigator.serviceWorker.ready.then(() => {
            console.log("🚀 PWA lista para usarse sin conexión.");
        });
    }

    // 📌 Detectar conexión/desconexión de Internet
    window.addEventListener("offline", () => {
        alert("⚠️ ¡Estás sin conexión! Algunas funciones pueden no estar disponibles.");
    });

    window.addEventListener("online", () => {
        alert("✅ ¡Volviste a estar en línea!");
    });

    // Cambio de pestañas
    const tabButtons = document.querySelectorAll('.tab-btn');
    const tabContents = document.querySelectorAll('.tab-content');
    
    tabButtons.forEach(button => {
        button.addEventListener('click', () => {
            // Desactivar todos los botones y contenidos
            tabButtons.forEach(btn => btn.classList.remove('active'));
            tabContents.forEach(content => content.classList.remove('active'));
            
            // Activar el botón seleccionado y su contenido correspondiente
            button.classList.add('active');
            const tabId = button.getAttribute('data-tab');
            document.getElementById(tabId).classList.add('active');
        });
    });
    
    // Funcionalidad de mostrar/ocultar contraseña
    const passwordToggles = document.querySelectorAll('.password-toggle');
    
    passwordToggles.forEach(toggle => {
        toggle.addEventListener('click', function() {
            const targetId = this.getAttribute('data-target');
            const passwordInput = document.getElementById(targetId);
            const icon = this.querySelector('i');
            
            // Cambiar el tipo de input entre "password" y "text"
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            } else {
                passwordInput.type = 'password';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            }
        });
    });
    
    // Validación de formulario de registro
    const registerForm = document.getElementById('register-form');
    const registerMessage = document.getElementById('register-message');
    
    if (registerForm) {
        registerForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const name = document.getElementById('register-name').value;
            const email = document.getElementById('register-email').value;
            const password = document.getElementById('register-password').value;
            const confirmPassword = document.getElementById('register-confirm-password').value;
            
            // Validación de nombre
            if (name.trim().length < 3) {
                showError(registerMessage, 'El nombre debe tener al menos 3 caracteres.');
                return;
            }
            
            // Validación de email
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                showError(registerMessage, 'Por favor, introduce un correo electrónico válido.');
                return;
            }
            
            // Validación de contraseña
            const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/;
            if (!passwordRegex.test(password)) {
                showError(registerMessage, 'La contraseña debe tener al menos 8 caracteres, una mayúscula, una minúscula y un número.');
                return;
            }
            
            // Validación de confirmación de contraseña
            if (password !== confirmPassword) {
                showError(registerMessage, 'Las contraseñas no coinciden.');
                return;
            }
            
            // Si pasa todas las validaciones, enviar el formulario
            submitForm(registerForm, registerMessage);
        });
    }
    
    // Manejo del formulario de inicio de sesión
    const loginForm = document.getElementById('login-form');
    const loginMessage = document.getElementById('login-message');
    
    if (loginForm) {
        loginForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const email = document.getElementById('login-email').value;
            const password = document.getElementById('login-password').value;
            
            // Validación básica
            if (email.trim() === '' || password.trim() === '') {
                showError(loginMessage, 'Por favor, completa todos los campos.');
                return;
            }
            
            // Si pasa todas las validaciones, enviar el formulario
            submitForm(loginForm, loginMessage);
        });
    }
    
    // Función para mostrar errores
    function showError(element, message) {
        element.textContent = message;
        element.className = 'form-message error';
    }
    
    // Función para enviar formulario con AJAX
    function submitForm(form, messageElement) {
        const formData = new FormData(form);
        
        fetch(form.action, {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                messageElement.textContent = data.message;
                messageElement.className = 'form-message success';
                
                // Redireccionar si es necesario
                if (data.redirect) {
                    setTimeout(() => {
                        window.location.href = data.redirect;
                    }, 1000);
                }
                
                // Limpiar formulario si es de registro
                if (form.id === 'register-form') {
                    form.reset();
                }
            } else {
                showError(messageElement, data.message);
            }
        })
        .catch(error => {
            showError(messageElement, 'Ha ocurrido un error en el servidor.');
            console.error('Error:', error);
        });
    }
});