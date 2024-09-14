document.addEventListener('DOMContentLoaded', function() {
    // Obtener referencias a los botones y contenedores del formulario
    const agregarArticuloBtn = document.getElementById('agregarArticulo');
    const limpiarInputsBtn = document.getElementById('limpiarInputs');
    const articulosContainer = document.getElementById('articulos');
    const subtotalSpan = document.getElementById('subtotal');
    const itbmsSpan = document.getElementById('itbms');
    const totalSpan = document.getElementById('total');

    // Evento para agregar un nuevo artículo al hacer clic en "Agregar otro artículo"
    agregarArticuloBtn.addEventListener('click', function() {
        const nuevoArticulo = document.createElement('div');
        nuevoArticulo.className = 'articulo';
        nuevoArticulo.innerHTML = `
            <input type="text" name="nombre[]" class="nombre-input" placeholder="Nombre del artículo" required>
            <input type="number" name="cantidad[]" class="cantidad-input" placeholder="Cantidad" min="1" required>
            <input type="number" name="precio[]" class="precio-input" placeholder="Precio unitario" step="0.01" min="0" required>
            <button type="button" class="removerArticulo">Eliminar</button>
        `;
        articulosContainer.appendChild(nuevoArticulo);

        // Añadir funcionalidad para eliminar el artículo
        const removerBtn = nuevoArticulo.querySelector('.removerArticulo');
        removerBtn.addEventListener('click', function() {
            articulosContainer.removeChild(nuevoArticulo);
            calcularTotales(); 
        });

        // Actualizar los totales al cambiar los valores de los inputs
        const inputs = nuevoArticulo.querySelectorAll('input');
        inputs.forEach(input => {
            input.addEventListener('input', calcularTotales);
        });
    });

    // Evento para limpiar todos los inputs al hacer clic en "Limpiar campos"
    limpiarInputsBtn.addEventListener('click', function() {
        const inputs = document.querySelectorAll('#articulos input');
        inputs.forEach(input => {
            input.value = '';
        });
        calcularTotales();
    });

    // Función para calcular el subtotal, ITBMS y el total
    function calcularTotales() {
        let subtotal = 0;
        const articulos = document.querySelectorAll('.articulo');
        
        // Recorrer cada artículo y sumar al subtotal
        articulos.forEach(articulo => {
            const cantidad = parseFloat(articulo.querySelector('input[name="cantidad[]"]').value) || 0;
            const precio = parseFloat(articulo.querySelector('input[name="precio[]"]').value) || 0;
            subtotal += cantidad * precio;
        });

        // Calcular ITBMS y el total
        const itbms = subtotal * 0.07;
        const total = subtotal + itbms;

        // Actualizar los campos de subtotal, ITBMS y total en la interfaz
        subtotalSpan.textContent = subtotal.toFixed(2);
        itbmsSpan.textContent = itbms.toFixed(2);
        totalSpan.textContent = total.toFixed(2);
    }

    // Añadir event listeners a los inputs del artículo inicial para calcular totales
    const inputsIniciales = document.querySelectorAll('.articulo input');
    inputsIniciales.forEach(input => {
        input.addEventListener('input', calcularTotales);
    });
});