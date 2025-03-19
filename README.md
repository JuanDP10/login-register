# 🛡️ LOGIN & REGISTER - Sistema de Autenticación con PWA

## 📌 Descripción  
**LOGIN & REGISTER** es un sistema de autenticación basado en PHP, JavaScript y MySQL, con soporte para **Progressive Web App (PWA)**, permitiendo el uso sin conexión y mejorando la experiencia del usuario con validaciones avanzadas.  

---

## 🚀 Características  
✅ **Autenticación Segura** - Registro e inicio de sesión con validaciones robustas  
✅ **Progressive Web App (PWA)** - Soporte sin conexión con **Service Worker**  
✅ **Diseño Responsivo** - Interfaz adaptable a cualquier dispositivo  
✅ **Manejo de Formularios con AJAX** - Validaciones en tiempo real sin recargar la página  
✅ **Notificaciones de Conexión** - Alertas cuando el usuario pierde o recupera conexión  

---

## 🏗️ Estructura del Proyecto  
```
📂 login-register/
│── 📂 css/                     # Archivos de estilos
│   ├── styles.css
│
│── 📂 images/                  # Imágenes del proyecto
│   ├── hero-bg.jpg
│   ├── icon.png
│
│── 📂 js/                      # Archivos JavaScript
│   ├── script.js               # Funcionalidad principal
│   ├── service-worker.js       # Service Worker para PWA
│
│── 📂 php/                     # Código backend en PHP
│   ├── config.php              # Configuración de la base de datos
│   ├── login.php               # Lógica de inicio de sesión
│   ├── register.php            # Lógica de registro de usuarios
│   ├── logout.php              # Cierre de sesión
│   ├── dashboard.php           # Panel principal después de iniciar sesión
│
│── index.html                  # Página principal con el formulario de login/register
│── manifest.json               # Archivo de configuración de PWA
│── sistema_usuarios.sql        # Base de datos en formato SQL
```

---

## ⚙️ Instalación y Configuración  

### 1️⃣ **Clonar el Repositorio**  
```bash
git clone https://github.com/JuanDP10/login-register.git
cd login-register-pwa
```

### 2️⃣ **Configurar la Base de Datos**  
- Importar el archivo `sistema_usuarios.sql` en MySQL  
- Editar `php/config.php` con los datos de tu servidor MySQL  

### 3️⃣ **Configurar el Servidor Local**  
Si usas **XAMPP**, mueve la carpeta `login-register` a `htdocs` y activa **Apache + MySQL**.  

### 4️⃣ **Probar el Proyecto**  
Abre en tu navegador:  
```
http://localhost/login-register/
```

---

## 🎯 Uso  
1️⃣ **Registrar un usuario nuevo** desde la pestaña "Registrarse".  
2️⃣ **Iniciar sesión** con los datos ingresados.  
3️⃣ Acceder al **Dashboard** tras autenticarse.  
4️⃣ Si pierdes conexión, los datos se guardarán y se enviarán automáticamente cuando vuelva la red.  

---

## 📲 Progressive Web App (PWA)  
Para instalar como PWA en tu dispositivo:  
- En **Chrome/Edge**, abre la página y haz clic en `Instalar App`.  
- En **Android**, pulsa en `Añadir a pantalla de inicio`.  

---

## 🛠️ Tecnologías Utilizadas  
🔹 **Frontend:** HTML, CSS, JavaScript
🔹 **Backend:** PHP, MySQL  
🔹 **PWA:** Service Workers
🔹 **Herramientas:** XAMPP, GitHub  

---

## 📝 Licencia  
Este proyecto está bajo la licencia **MIT**. 

---

## 📞 Contacto  
✉️ **Correo:** pinillamontoyajuandiego@gmail.com  
🐙 **GitHub:** [JuanDP10](https://github.com/JuanDP10)  


