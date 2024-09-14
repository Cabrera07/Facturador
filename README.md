# 🧾 Generador de Facturas

![alt text](/img/mockup.png)

## 📌 Descripción

Este proyecto consiste en un sistema para la generación automática de facturas en formato PDF. Permite al usuario ingresar detalles de productos como nombre, cantidad y precio, calcula automáticamente el ITBMS (7%) y genera una factura detallada.

## ⭐ Características

- 🛒 **Entrada Dinámica de Productos:** Los usuarios pueden agregar y eliminar productos dinámicamente en el formulario de factura.
- 🧮 **Cálculo Automático de Impuestos y Totales:** El sistema calcula automáticamente el subtotal, el ITBMS y el total general de la factura.
- 📄 **Generación de PDF en Tiempo Real:** Con solo presionar un botón, el usuario puede generar una factura en formato PDF, lista para ser guardada, impresa o enviada.

## 🛠 Tecnologías Utilizadas

- 🌐 HTML
- 🎨 CSS
- ⚙️ JavaScript
- 🐘 PHP
- 📄 TCPDF (para la generación de PDF, ya incluido en el proyecto)
  
## 📂 Estructura de Carpetas

```bash
Facturador/
│
├── css/                    # Contiene los archivos CSS para estilos visuales del formulario.
│   └── style.css           # Archivo principal de estilos CSS.
│
├── img/                    # Directorio para imágenes utilizadas en la interfaz del usuario.
│   ├── favicon.jpeg        # Ícono de la pestaña del navegador.
│   ├── logo.jpg            # Logotipo de la empresa o del proyecto.
│   ├── mockup.png          # Imagen de muestra del diseño o maqueta.
│   └── monitor.jpg         # Imagen adicional usada en el PDF generado.
│
├── js/                     # Scripts de JavaScript para funcionalidades interactivas.
│   └── script.js           # Script principal que maneja la adición y eliminación de productos, y cálculos.
│
├── tcpdf/                  # Biblioteca TCPDF integrada para la generación de documentos PDF.
│   └── [archivos de TCPDF] # Archivos y scripts necesarios de la biblioteca TCPDF.
│
├── facturador.php          # Script PHP que procesa la información del formulario y genera el PDF.
├── index.html              # Página inicial que presenta el formulario para introducir los productos.
└── README.md               # Documentación del proyecto para usuarios y contribuyentes.
```

## 📦 Instalación y Configuración

1. **Instalar XAMPP**:
   - Un servidor local que incluye PHP y MySQL, [descargable aquí](https://www.apachefriends.org/index.html).
2. **Clonar/Descargar el Repositorio:**
   - Asegúrate de colocar los archivos del proyecto en la carpeta `htdocs` de tu instalación de XAMPP.
3. **Iniciar Servidores:**
   - Utiliza el panel de control de XAMPP para iniciar el servidor Apache.

## 🖥️ ¿Cómo Usar?

1. **Acceder a la Aplicación:**
   - En tu navegador, visita `http://localhost/nombre_de_tu_directorio/` para acceder al formulario de factura.
2. **Completar la Información del Producto:**
   - Usa los campos disponibles para ingresar los detalles de los productos (nombre, cantidad, precio).
3. **Generar la Factura:**
   - Haz clic en "Generar Factura" para ver y descargar tu factura en formato PDF.

## 🤝 Contribuciones

¡Las contribuciones son muy bienvenidas! Si te gustaría contribuir a este proyecto, aquí te dejamos algunos pasos a seguir:

### 📥 ¿Cómo Contribuir?

1. **Hacer Fork del Repositorio:** Realiza un fork del repositorio para tener tu propia copia.
2. **Crear una Nueva Rama:** Usa el comando `git switch -c feature-branch` para crear y cambiar a una nueva rama.
3. **Realizar Cambios:** Implementa tus mejoras o características y haz commit de tus cambios con `git commit -m 'Descripción del cambio'`.
4. **Publicar la Rama:** Sube los cambios a tu rama con `git push origin feature-branch`.
5. **Crear un Pull Request:** Desde GitHub, abre un pull request hacia la rama principal del repositorio original.
