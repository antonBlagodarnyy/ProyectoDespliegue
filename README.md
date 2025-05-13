# 🧠 Proyecto Despliegue

Este proyecto es una herramienta sencilla desarrollada en **PHP**, **HTML**, **CSS** y **JavaScript** que permite analizar textos ingresados por el usuario, eliminando stopwords y puntuación, para devolver un listado con la frecuencia de palabras significativas.

---

## 🚀 Tecnologías usadas

- PHP (con XAMPP como servidor local)
- HTML5
- CSS3
- JavaScript (fetch API)
- Git & GitHub
- Visual Studio Code
- Git Bash

---

## 👨‍💻 Equipo de desarrollo

Este proyecto ha sido desarrollado en colaboración por:

- ✨ Antón Blagodarnyy
- ✨ Javier Tobaruela
- ✨ Juan Carlos Márquez

---

## 📁 Estructura de carpetas

- `backend/` – Lógica del servidor
  - `service/` – Servicios PHP que procesan el texto
    - `contarPalabras.php` – Cuenta las palabras relevantes
    - `funciones.php` – Funciones auxiliares (normalizar texto, eliminar stopwords, etc.)
    - `ordenarPalabras.php` – Ordena las palabras por frecuencia
    - `recogerTexto.php` – Recoge y prepara el texto enviado desde frontend
- `frontend/` – Interfaz de usuario
  - `index.php` – Página principal con el formulario de entrada de texto
  - `style.css` - Estilos CSS para la apariencia de la página
- `README.md` – Documentación del proyecto

---

## ⚙️ Cómo desplegar la app en local

Para probar esta aplicación en un entorno local, sigue estos pasos:

1. **Clona el repositorio** en tu equipo:
   ```bash
   git clone https://github.com/antonBlagodarnyy/ProyectoDespliegue.git
   
   ```

2. **Copia la carpeta del proyecto** en el directorio raíz de tu servidor local (XAMPP):
   - En Windows: `C:\xampp\htdocs\ProyectoDespliegue`
   - En macOS/Linux (con XAMPP o similar): `/opt/lampp/htdocs/ProyectoDespliegue`

3. **Inicia el servidor Apache** desde el panel de control de XAMPP.

4. **Accede a la aplicación desde tu navegador**:
   ```
   http://localhost/ProyectoDespliegue/frontend/index.php

   ```


