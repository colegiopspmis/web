# cspm-institucional

Tema institucional del **Colegio de Psicopedagogos de Misiones** para WordPress.

## Stack
- PHP 8.3 · WordPress 6.7+ · MariaDB 10.11
- HTML5 semántico · CSS custom properties · JavaScript vanilla
- Sin React, sin Node en producción

## Estructura
```
cspm-institucional/
├── style.css                  ← Header del tema (obligatorio WP)
├── index.php                  ← Plantilla fallback
├── front-page.php             ← Portada personalizada
├── header.php                 ← Cabecera global
├── footer.php                 ← Pie de página + Tidio
├── single.php                 ← Entrada individual (acepta Divi)
├── page.php                   ← Página estática (acepta Brizy whitelist)
├── archive.php                ← Archivo de noticias
├── functions.php              ← Núcleo del tema
├── VERSION                    ← Versión del tema
├── .cpanel.yml                ← Despliegue cPanel Git
├── .gitignore
├── assets/
│   ├── css/main.css           ← CSS principal (design tokens + componentes)
│   ├── js/main.js             ← JS vanilla (menú, scroll, a11y)
│   ├── fonts/                 ← Fuentes locales (opcional)
│   └── images/
│       ├── hero-bg.jpg        ← Imagen de fondo del hero (agregar)
│       └── og-default.jpg     ← Imagen Open Graph por defecto (agregar)
├── inc/
│   ├── customizer.php         ← Opciones del Customizer
│   ├── acf-fields.php         ← Campos ACF para migrar desde Brizy
│   └── nav-walker.php         ← Walker de nav accesible
├── template-parts/
│   ├── content-post.php       ← Tarjeta de entrada
│   └── content-none.php       ← Estado vacío
├── page-templates/            ← Plantillas de página específicas (futuras)
└── languages/                 ← Traducciones .po/.mo
```

## Instalación

1. Subir la carpeta `cspm-institucional/` a `/wp-content/themes/`
2. Activar desde **Apariencia → Temas**
3. Configurar en **Apariencia → Personalizar → CSPM — Opciones del Tema**:
   - Redes sociales (URLs)
   - ID del video YouTube institucional
   - Clave pública de Tidio
4. Asignar el menú **Menú Principal** desde **Apariencia → Menús**
5. Agregar las imágenes `hero-bg.jpg` y `og-default.jpg` en `assets/images/`

## Despliegue CI/CD (cPanel Git Version Control)

Ver [.cpanel.yml](.cpanel.yml). El flujo es:

```
GitHub (rama main) → cPanel Git Version Control → rsync al directorio del tema → WP-CLI flush
```

**No se despliegan:** `wp-config.php`, `/uploads/`, base de datos, ni el sistema de Autogestión.

## Constructores Visuales

| Constructor | Estado | Post Types Permitidos |
|-------------|--------|-----------------------|
| Divi Builder | ✅ Activo (solo contenido) | `post` (entradas heredadas) |
| Brizy | ⏳ Temporal (lista blanca) | `page`: `el-colegio`, `contacto` |
| Gutenberg | 🔴 Desactivado en páginas | — |

## Correcciones de Auditoría Aplicadas

- [x] **H1 en portada**: El nombre de la institución es ahora el H1 principal
- [x] **Jerarquía de encabezados**: H1 → H2 → H3 correcta en todas las plantillas  
- [x] **Title tag**: Página de contacto y portada con títulos correctos
- [x] **Enlace YouTube**: Función `cspm_youtube_url()` genera URL correcta
- [x] **Redirección `/tramites/`**: 301 permanente a `/tramites-2/` en PHP
- [x] **Autogestión protegida**: Redirección a subdominio si WP captura la ruta
- [x] **Ninja Tables**: Activo en `/matriculados-2/` sin interferencia
- [x] **Tidio (psicopebot-simple)**: Integrado por clave pública en Customizer
- [x] **Koha**: Enlace externo correcto con `target="_blank" rel="noopener"`
- [x] **Bloatware eliminado**: Emojis, oEmbed, generator, prefetch de s.w.org
