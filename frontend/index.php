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
    <h1>Amor en cada costura</h1>
    <p>La mejor calidad en ropa para tu bebé, desde recién nacidos hasta el primer año.</p>
    <a href="#catalogo" class="btn btn-primary">Ver catálogo</a>
    
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
<div id="productos-lista" class="contenedor"> </div>

<section class="beneficios">
    <div class="beneficio-item">
        <h4>Algodón Orgánico</h4>
        <p>Suave con la piel de tu bebé y el planeta.</p>
    </div>
    <div class="beneficio-item">
        <h4>Entrega Rápida</h4>
        <p>Recibe tu pedido en menos de 48 horas.</p>
    </div>
    <div class="beneficio-item">
        <h4>Calidad Garantizada</h4>
        <p>Prendas duraderas para cada aventura.</p>
    </div>
    <div class="beneficio-item">
        <h4>Calidad Garantizada</h4>
        <p>Prendas duraderas para cada aventura.</p>
    </div>


</section>

<section class="circulos">
    <div class="circulo-item">
        <div class="avatar"></div>
        <p>"Excelente calidad."</p>
        <strong>- María G.</strong>
    </div>
    <div class="circulo-item">
        <div class="avatar"></div>
        <p>"Los diseños son hermosos."</p>
        <strong>- Carlos R.</strong>
    </div>
    <div class="circulo-item">
        <div class="avatar"></div>
        <p>"Envío muy veloz."</p>
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
                        <div class="tarjeta-producto">
                            <img src="${p.imagen_url}" alt="${p.nombre}" class="producto-img">
                            <h3>${p.nombre}</h3>
                            <p class="precio">$${p.precio}</p>
                            <small>Etapa: ${p.rango_edad}</small>
                        </div>
                    `;
                });
            })
            .catch(error => console.error('Error:', error));
    }
    document.addEventListener('DOMContentLoaded', () => filtrarProductos('todos'));
</script>

<?php include 'includes/footer.php'; ?>