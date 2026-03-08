<?php 
require_once 'includes/auth_check.php';
//Verificacion de login
requerir_login();

include 'includes/header.php'; 
if (isset($_GET['error']) && $_GET['error'] === 'admin_only'): ?>
    <div class="alerta-auth">
        <i class="fa-solid fa-shield-halved"></i>
        <strong>ACCESO DENEGADO:</strong> No tienes permisos para entrar al Panel de Administración.
    </div>
<?php endif;
?>


<section class="banner">
    <h1>Amor que se viste, calidad que se siente</h1>
    <p>En Catalogo Clarisse creamos prendas que abrazan la ternura de tu bebé. 
        Utilizamos telas suaves como el algodón, libres de químicos y pensadas para pieles sensibles.  
        Diseños adorables que acompañan cada etapa, desde recién nacido hasta los primeros pasos.
    </p>
    <p><strong>Porque cuando se trata de tu pequeño, solo lo mejor es suficiente.</strong></p>

    <h2 class="section-title">Etapas</h2>
</section>


<section class="categorias-grid">
    <div class="cat-block" onclick="filtrarProductos('todos')">Todos</div>
    <div class="cat-block" onclick="filtrarProductos(6)">Recién Nacido</div>
    <div class="cat-block" onclick="filtrarProductos(1)">1-3 Meses</div>
    <div class="cat-block" onclick="filtrarProductos(2)">3-6 Meses</div>
    <div class="cat-block" onclick="filtrarProductos(3)">6-9 Meses</div>
    <div class="cat-block" onclick="filtrarProductos(4)">9-12 Meses</div>
    <div class="cat-block" onclick="filtrarProductos(5)">12-18 Meses</div>
</section>>


<h2 class="section-title" id="catalogo style="margin-top: 100px;">Nuestros Productos</h2>
<div id="productos-lista" class="contenedor-productos"> </div>



<h2 class="section-title" style="color: #4ba591; margin-top:50px; font-weight:900;">Nuestros Beneficios</h2>
<section class="beneficios">
    <div class="beneficio-item">
        <div class="icon-circle"><i class="fas fa-leaf"></i></div>
        <h4>Algodón Orgánico</h4>
        <p>Suave con la piel de tu bebé y el planeta.</p>
    </div>
    <div class="beneficio-item">
        <div class="icon-circle"><i class="fas fa-shipping-fast"></i></div>
        <h4>Entrega Rápida</h4>
        <p>Recibe tu pedido en menos de 48 horas.</p>
    </div>
    <div class="beneficio-item">
        <div class="icon-circle"><i class="fas fa-shield-alt"></i></div>
        <h4>Calidad Garantizada</h4>
        <p>Prendas duraderas para cada aventura.</p>
    </div>
    <div class="beneficio-item">
        <div class="icon-circle"><i class="fas fa-sync-alt"></i></div>
        <h4>Calidad Garantizada</h4>
        <p>Prendas duraderas para cada aventura.</p>
    </div>
</section>

<h2 class="section-title" style="color: #4ba591; font-weight:900;">Nuestros Clientes</h2>
<section class="circulos" >
    <div class="circulo-item">
        <div class="avatar" style="background-image: url('https://i.pravatar.cc/200?u=maria')"></div>
        <p>"Los diseños son hermosos y el proceso de compra fue súper sencillo. ¡Recomendado!"</p>
        <strong>- Carlos R.</strong>

    </div>

    <div class="circulo-item">
        <div class="avatar-grande" style="background-image: url('https://i.pravatar.cc/300?u=carlos')"></div>
        <p>"Excelente calidad, la tela es muy suave para mi recién nacido."</p>
        <strong>- María G.</strong>
    </div>

    <div class="circulo-item">
        <div class="avatar" style="background-image: url('https://i.pravatar.cc/200?u=lucia')"></div>
        <p>"Envío muy veloz, llegó al día siguiente de mi pedido. Muy satisfecha."</p>
        <strong>- Lucía M.</strong>
    </div>
</section>

<script>
    // Funcion para cargar productos filtrados por categoria
    function filtrarProductos(idCategoria = 'todos') {
        const lista = document.getElementById('productos-lista');
        lista.innerHTML = '<p>Cargando productos...</p>';

        let url = '../backend/api/get_productos.php';
        if (idCategoria !== 'todos') {
            url += `?id_categoria=${idCategoria}`;
        }
        fetch(url)
            .then(res => res.json())
            .then(data => {
                lista.innerHTML = ''; 
                
                if (data.length === 0) {
                    lista.innerHTML = '<p>No hay productos en esta etapa por el momento.</p>';
                    return;
                }

                data.forEach(p => {
                    lista.innerHTML += `
                        <div class="tarjeta">
                            <div class="producto-img-wrapper">
                                <img src="${p.imagen_url}" alt="${p.nombre}" class="producto-img">
                            </div>
                            <div class="info-cuerpo">
                                <h3 class="nombre-producto">${p.nombre}</h3>
                                <p class="precio">$${p.precio}</p>
                                <small>Etapa: ${p.rango_edad}</small>
                            </div>
                        </div>
                    `;
                });
            })
            .catch(error => console.error('Error:', error));
    }
    document.addEventListener('DOMContentLoaded', () => filtrarProductos('todos'));
</script>

<?php include 'includes/footer.php'; ?>