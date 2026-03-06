<?php 
require_once 'includes/auth_check.php'; 
admin_only();
include 'includes/header.php'; 
?>

<script>
    // Protección de ruta (ahora con redirección a .php)
    const checkUserStr = localStorage.getItem('usuario');
    if(!checkUserStr) {
        window.location.href = 'login.php';
    }
    const checkUser = JSON.parse(checkUserStr);
    if(checkUser.rol !== 'admin') {
        alert("Acceso denegado");
        window.location.href = 'index.php';
    }
</script>

<div class="form-container">
    <h3 style="color: var(--verde-medio);">Agregar Nuevo Producto</h3>
    <input type="text" id="nombre" placeholder="Nombre del producto">
    <textarea id="descripcion" placeholder="Descripción breve"></textarea>
    <input type="number" id="precio" placeholder="Precio (ej. 199.99)">
    <input type="number" id="stock" placeholder="Cantidad en stock">
    <input type="text" id="imagen_url" placeholder="URL de la imagen (opcional) ej: https://tusitio.com/foto.jpg">
    
    <select id="id_categoria">
        <option value="1">0-3 meses</option>
        <option value="2">3-6 meses</option>
        <option value="3">6-12 meses</option>
    </select>
    
    <button onclick="guardarProducto()" class="btn btn-primary" style="width: 100%; margin-top: 15px;">Guardar Producto</button>
</div>

<script>
function guardarProducto() {
    const producto = {
        nombre: document.getElementById('nombre').value,
        descripcion: document.getElementById('descripcion').value,
        precio: document.getElementById('precio').value,
        stock: document.getElementById('stock').value,
        imagen_url: document.getElementById('imagen_url').value,
        id_categoria: document.getElementById('id_categoria').value
    };

    fetch('../backend/api/create_producto.php', {
        method: 'POST',
        body: JSON.stringify(producto),
        headers: { 'Content-Type': 'application/json' }
    })
    .then(res => res.json())
    .then(data => {
        alert(data.message);
        if(data.status === 'success') {
            location.reload(); 
        }
    });
}
</script>

<?php include 'includes/footer.php'; ?>