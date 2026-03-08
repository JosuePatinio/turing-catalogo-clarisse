<?php if(isset($_GET['error'])): ?>
    <div class="alerta-auth">
        <?php 
            if($_GET['error'] === 'auth_required'){
                echo '<i class="fa-solid fa-lock"></i> <strong> Debes iniciar sesión para acceder al catálogo</strong>';
            } else{}
        ?>
    </div>
<?php endif; ?>
<?php include 'includes/head.php';?>

<div class="form-container">
    <h2>Iniciar Sesión</h2>
    <input type="text" id="username" placeholder="Usuario">
    <input type="password" id="password" placeholder="Contraseña">
    <button onclick="login()" class="btn btn-primary" style="width: 100%; margin-top: 15px;">Entrar</button>
    <p id="mensaje" style="color: red; text-align: center; margin-top: 10px;"></p>
</div>

<script>
    // limpieza automatica al detectar un cierre de sesion 
    document.addEventListener("DOMContentLoaded", function() {
        const urlParams = new URLSearchParams(window.location.search);
        
        if (urlParams.get('logout') === 'success') {
            // Borrar los datos del frontend
            localStorage.removeItem('usuario');
            localStorage.clear();
            
            // Limpiar la URL 
            window.history.replaceState({}, document.title, window.location.pathname);
        }
    });

    //inicio de sesion
    function login() {
        const user = document.getElementById('username').value;
        const pass = document.getElementById('password').value;

        if (!user || !pass) {
            document.getElementById('mensaje').innerText = "Por favor, ingresa usuario y contraseña.";
            return;
        }

        fetch('../backend/api/login.php', {
            method: 'POST',
            body: JSON.stringify({ username: user, password: pass }),
            headers: { 'Content-Type': 'application/json' }
        })
        .then(res => res.json())
        .then(data => {
            if(data.status === "success") {
                // Guardar usuario en frontend
                localStorage.setItem('usuario', JSON.stringify(data.user));
                
                // Redirigir por rol
                if(data.user.rol === 'admin') {
                    window.location.href = 'admin.php';
                } else {
                    window.location.href = 'index.php';
                }
            } else {
                document.getElementById('mensaje').innerText = data.message;
            }
        })
        .catch(error => {
            console.error("Error en la solicitud:", error);
            document.getElementById('mensaje').innerText = "Error de conexión con el servidor.";
        });
    }
</script>