<link rel="stylesheet" href="css/styles.css">

<div class="form-container">
    <h2>Iniciar Sesión</h2>
    <input type="text" id="username" placeholder="Usuario">
    <input type="password" id="password" placeholder="Contraseña">
    <button onclick="login()" class="btn btn-primary" style="width: 100%; margin-top: 15px;">Entrar</button>
    <p id="mensaje" style="color: red; text-align: center; margin-top: 10px;"></p>
</div>

<script>
    function login() {
        const user = document.getElementById('username').value;
        const pass = document.getElementById('password').value;

        fetch('../backend/api/login.php', {
            method: 'POST',
            body: JSON.stringify({ username: user, password: pass }),
            headers: { 'Content-Type': 'application/json' }
        })
        .then(res => res.json())
        .then(data => {
            if(data.status === "success") {
                localStorage.setItem('usuario', JSON.stringify(data.user));
                // Redirigir a las nuevas rutas .php
                if(data.user.rol === 'admin') {
                    window.location.href = 'admin.php';
                } else {
                    window.location.href = 'index.php';
                }
            } else {
                document.getElementById('mensaje').innerText = data.message;
            }
        });
    }
</script>
