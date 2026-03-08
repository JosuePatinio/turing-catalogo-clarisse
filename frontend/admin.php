<?php 
require_once 'includes/auth_check.php'; 
admin_only(); 
include 'includes/header.php'; 
?>

<div class="admin-grid">
    <div class="admin-col">
        <h3 style="color: #1ebe91;">Agregar / Editar Producto</h3>
        <div id="registro-mensaje"></div>
        
        <input type="hidden" id="producto_id" value="">

        <input type="text" id="nombre" placeholder="Nombre del producto">
        <textarea id="descripcion" placeholder="Descripción breve"></textarea>
        <input type="number" id="precio" placeholder="Precio (ej. 199.99)">
        <input type="number" id="stock" placeholder="Cantidad en stock">
        <input type="text" id="imagen_url" placeholder="URL de la imagen">
        
        <label for="id_categoria">Rango de Edad:</label>
        <select id="id_categoria">
            <option value="6">Recién nacido</option>
            <option value="1">1-3 meses</option>
            <option value="2">3-6 meses</option>
            <option value="3">6-9 meses</option>
            <option value="4">9-12 meses</option>
            <option value="5">12-18 meses</option>
        </select>
        
        <button onclick="guardarProducto()" class="btn btn-primary" style="width: 100%; margin-top: 15px;">Guardar Producto</button>
    </div>

    <div class="admin-col">
        <h3 style="color: #4ba591; text-align:center;">Gestionar Inventario</h3>
        <table class="tabla-gestion">
            <thead>
                <tr>
                    <th>Imagen</th>
                    <th>Producto</th>
                    <th>Precio</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="tabla-productos-cuerpo">
                </tbody>
        </table>
    </div>
</div>

<script>
    // Variable para guardar los datos temporalmente y no complicar el HTML
    let productosGlobales = [];

    document.addEventListener("DOMContentLoaded", () => {
        listarProductosGestion();
    });

    // Listar de productos
    function listarProductosGestion() {
        fetch('../backend/api/get_productos.php')
            .then(res => res.json())
            .then(data => {
                productosGlobales = data; // Guardamos la lista completa
                const cuerpo = document.getElementById('tabla-productos-cuerpo');
                cuerpo.innerHTML = "";
                
                data.forEach(p => {
                    cuerpo.innerHTML += `
                        <tr>
                            <td><img src="${p.imagen_url}" class="img-mini" width="50" style="border-radius:5px;"></td>
                            <td>${p.nombre}</td>
                            <td>$${p.precio}</td>
                            <td>
                                <button class="btn btn-primary" onclick="prepararEdicion(${p.id})">Editar</button>
                                <button class="btn" style="background-color: #dc3545; color: white;" onclick="eliminarProducto(${p.id})">Eliminar</button>
                            </td>
                        </tr>
                    `;
                });
            })
            .catch(err => console.error("Error cargando productos:", err));
    }

    // editar
    function prepararEdicion(idBuscado) {
        // Buscamos el producto exacto por ID
        const p = productosGlobales.find(item => item.id == idBuscado);

        if (!p) {
            alert("No se pudo encontrar la información del producto.");
            return;
        }


        document.getElementById('producto_id').value = p.id;
        document.getElementById('nombre').value = p.nombre;
        document.getElementById('descripcion').value = p.descripcion;
        document.getElementById('precio').value = p.precio;
        document.getElementById('stock').value = p.stock;
        document.getElementById('imagen_url').value = p.imagen_url;
        document.getElementById('id_categoria').value = p.id_categoria;

        // Cambiamos el titulo visualmente para avisar al usuario
        document.querySelector('.admin-col h3').innerText = "Editando: " + p.nombre;
        
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }
    // Guardar
    function guardarProducto() {
        const id = document.getElementById('producto_id').value;
        const nombre = document.getElementById('nombre').value;
        const precio = document.getElementById('precio').value;
        const id_categoria = document.getElementById('id_categoria').value;

        if(!nombre || !precio || !id_categoria) {
            alert("Faltan datos básicos (Nombre, Precio o Categoría)");
            return;
        }

        // Si hay ID usamos la ruta de update, si está vacío usamos la de create
        const url = id ? '../backend/api/update_producto.php' : '../backend/api/create_producto.php';

        const producto = {
            id: id,
            nombre: nombre,
            descripcion: document.getElementById('descripcion').value,
            precio: precio,
            stock: document.getElementById('stock').value,
            imagen_url: document.getElementById('imagen_url').value,
            id_categoria: id_categoria
        };

        fetch(url, {
            method: 'POST',
            body: JSON.stringify(producto),
            headers: { 'Content-Type': 'application/json' }
        })
        .then(res => res.json())
        .then(data => {
            mostrarMensaje(data.message, data.status);
            if(data.status === 'success') {
                document.getElementById('producto_id').value = ""; // Limpiar ID
                listarProductosGestion(); // Recargar tabla
            }
        });
    }

    // eliminar
    function eliminarProducto(id) {
        if (!confirm("¿Estás seguro de eliminar este producto?")) return;

        fetch('../backend/api/delete_producto.php', {
            method: 'POST',
            body: JSON.stringify({ id: id }),
            headers: { 'Content-Type': 'application/json' }
        })
        .then(res => res.json())
        .then(data => {
            mostrarMensaje(data.message, data.status);
            listarProductosGestion();
        });
    }

    // mensajes de alerta
    function mostrarMensaje(texto, tipo) {
        const contenedor = document.getElementById('registro-mensaje');
        contenedor.innerHTML = `<div class="alerta alerta-${tipo}">${texto}</div>`;
        setTimeout(() => contenedor.innerHTML = "", 3000);
    }
</script>

<?php include 'includes/footer.php'; ?>