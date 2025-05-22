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
- `index.php` – Página principal con el formulario de entrada de texto
- `backend/` – Lógica del servidor
  - `service/` – Servicios PHP que procesan el texto
    - `funciones.php` – Contiene toda la lógica: recoger, limpiar, contar y ordenar
    - `stop_words.php`- Lista de palabras vacías (STOP_WORDS)
- `assets/` – Archivos estáticos para el diseño e interfaz de usuario
   - `style.css` - Estilos CSS para la apariencia de la página
- `test`– Carpeta con pruebas automatizadas 
  - `funcionesTest.php` – Pruebas unitarias para funciones principales 
  - `funcionesMock.php` - Mock para pruebas o simulaciones
- `composer.json` - Configuración de dependencias 
- `composer.lock`- versión bloqueada de dependencias
- `phpunit.xml`- Configuración de PHPUnit 
- `.gitignore`- Archivos ignorados por Git
- `.git/hooks/pre-push` - Hook para evitar push si fallan los tests
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
   http://localhost/ProyectoDespliegue/index.php

   ```
## ✅ Ejecutar los tests

```bash
vendor/bin/phpunit --coverage text
```

## 🛡️ Pre-push hook

Este proyecto incorpora un hook personalizado en `.git/hooks/pre-push` que impide hacer `git push` si las pruebas unitarias fallan.

Asegúrate de darle permisos de ejecución:

```bash
chmod +x .git/hooks/pre-push
```

