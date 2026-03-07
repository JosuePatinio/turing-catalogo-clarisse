<?php 
require_once 'includes/auth_check.php'; 
// Si no es admin lo manda al login
admin_only(); 

include 'includes/header.php'; 
?>

<div class="form-container">
    <h3 style="color: var(--verde-medio);">Agregar Nuevo Producto</h3>
    <input type="text" id="nombre" placeholder="Nombre del producto">
    <textarea id="descripcion" placeholder="Descripción breve"></textarea>
    <input type="number" id="precio" placeholder="Precio (ej. 199.99)">
    <input type="number" id="stock" placeholder="Cantidad en stock">
    <input type="text" id="imagen_url" placeholder="URL de la imagen (ej: https://tusitio.com/foto.jpg)">
    
    <label for="id_categoria">Rango de Edad:</label>
    <select id="id_categoria">
        <option value="1">0-3 meses</option>
        <option value="2">3-6 meses</option>
        <option value="3">6-12 meses</option>
    </select>
    
    <button onclick="guardarProducto()" class="btn btn-primary" style="width: 100%; margin-top: 15px;">Guardar Producto</button>
</div>

<script>
function guardarProducto() {
    // }validar que los campos no esten vacios
    const nombre = document.getElementById('nombre').value;
    const precio = document.getElementById('precio').value;

    if(!nombre || !precio) {
        alert("Por favor rellena los campos básicos (Nombre y Precio)");
        return;
    }

    const producto = {
        nombre: nombre,
        descripcion: document.getElementById('descripcion').value,
        precio: precio,
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
    })
    .catch(error => {
        console.error('Error:', error);
        alert("Hubo un error al conectar con la API");
    });
}
</script>

<?php include 'includes/footer.php'; ?>