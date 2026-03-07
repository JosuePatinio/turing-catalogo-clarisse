<?php 
if (session_status() === PHP_SESSION_NONE) { session_start(); } 
include 'includes/head.php';
?>


<header>
    <div class="top-bar">
        <div class="top-bar-left">
            <span><i class="fa-solid fa-phone"></i> +52 123 456 7890</span>
            <span class="separator">|</span>
            <span><i class="fa-solid fa-truck-fast"></i> Envío gratis en pedidos mayores a $999</span>
        </div>
        
        <div class="top-bar-right">
            <div class="social-links">
                <a href="#" title="Facebook"><i class="fa-brands fa-facebook-f"></i></a>
                <a href="#" title="Instagram"><i class="fa-brands fa-instagram"></i></a>
                <a href="#" title="TikTok"><i class="fa-brands fa-tiktok"></i></a>
            </div>
            <span class="separator">|</span>
            <div id="auth-section">
                <?php if(isset($_SESSION['username'])): ?>
                    <span class="user-welcome"">Bienvenido, <strong><?= htmlspecialchars($_SESSION['username']) ?></strong></span>
                    <?php if($_SESSION['rol'] === 'admin'): ?>
                        <a href="admin.php" class="btn btn-primary" style="padding: 5px 10px; font-size: 0.7rem;">Panel Admin</a>
                    <?php endif; ?>
                    <a href="../backend/api/logout.php" class="login-link"><i class="fa-solid fa-right-from-bracket"></i> Salir</a>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <nav class="main-nav">
        <div class="logo">
            <a href="index.php">Clarisse</a>
        </div>
        <ul class="nav-links">
            <li><a href="index.php">Inicio</a></li>
            <li><a href="#catalogo">Lo más Top</a></li>
            <li><a href="#">Productos con más stock</a></li>
            <li><a href="#">Contáctanos</a></li>
        </ul>
    </nav>
</header>

