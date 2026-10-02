# CSPM Institucional — 1.4.1

Actualización sobre 1.3.1 (rediseño, staging).

## Cambios en 1.4.1

- **PDF incluidos** en `assets/documents/`: Estatuto, Ley I – N.º 131, Modelo de plan de tratamiento, Consentimiento informado 2026 y Consentimiento informado (modelo general, nuevo en el listado).
- **Buenas prácticas profesionales:** bloque con texto, frase destacada e imagen (`assets/images/buenas-practicas.jpg`, pie "Imagen ilustrativa"). El estilo reutiliza el de la portada (bordes redondeados, franja degradada de la marca). Para cambiar o quitar la imagen, editar la clave `image` del grupo en `inc/documents.php`.
- **Pendiente:** `alcances-del-titulo-res-2473-84.pdf` (Resolución 2.473/84). Hasta subirlo, su tarjeta muestra "Documento en preparación".

## Cambios en 1.4.0

- **Cache busting automático:** los CSS y el JS se solicitan con `?ver=1.4.0-<hash del archivo>`. La URL cambia solo cuando el archivo cambia, de modo que cada despliegue se ve de inmediato aunque haya caché del navegador, LiteSpeed o Cloudflare.
- **Footer:** logo blanco (`assets/images/logo-blanco.png`, generado a partir del logo a color). Se puede reemplazar desde Personalizar > CSPM — Opciones del Tema > Logo del pie y botón Autogestión.
- **Menú:** botón **Autogestión** a la derecha del menú (URL: https://autogestion.colegiopspmisiones.com.ar/). URL y texto se editan en el mismo apartado del Personalizador; con la URL vacía el botón se oculta. En móvil aparece al final del panel desplegable.
- **Documentación:** nueva plantilla de página "Documentación" (`page-templates/documentacion.php`). El listado vive en `inc/documents.php` (no depende del contenido de la base de datos). Reúne: Alcances del título, Estatuto, Ley I – N.º 131, Código de Ética, Modelo de plan de tratamiento y Consentimiento informado 2026.
- `.cpanel.yml` sin cambios: copia todo el contenido del repositorio al tema del staging con `cp -R *` y no borra archivos. Los archivos de `docs/` también se copian (son inofensivos).

## PDF de Documentación

Viven en `assets/documents/` con estos nombres exactos. Estado:

| Archivo | Estado |
|---|---|
| codigo-de-etica.pdf | incluido |
| estatuto.pdf | incluido |
| ley-i-n-131.pdf | incluido |
| modelo-plan-de-tratamiento.pdf | incluido |
| consentimiento-informado-2026.pdf | incluido |
| consentimiento-informado.pdf | incluido |
| alcances-del-titulo-res-2473-84.pdf | **falta** (original: /wp-content/uploads/2024/05/Res.-2473-Nacion.pdf) |

Para descargar el que falta: `docs/descargar-documentos.ps1` (Windows, deja los archivos en el repositorio local) o `docs/descargar-documentos.sh` (Terminal de cPanel, escribe directo en el tema del staging, fuera del repositorio). También se puede descargar a mano del sitio original y subir a `assets/documents/` con ese nombre.

## Configuración en WordPress (una sola vez por sitio)

1. Páginas > Añadir nueva: título "Documentación", plantilla **Documentación** (panel lateral). El texto que se escriba en el editor se muestra como introducción; si queda vacío se usa un texto por defecto.
2. Apariencia > Menús: agregar la página Documentación. Opcional, como submenú, enlaces personalizados a `/documentacion/#estatuto`, `#alcances-del-titulo`, `#ley-i-n-131`, `#codigo-de-etica`, `#modelo-plan-de-tratamiento` y `#consentimiento-informado-2026`.
3. Personalizar > CSPM — Opciones del Tema > Logo del pie y botón Autogestión: opcionalmente elegir "logo blanco" de la biblioteca de medios.
4. Revisar la cabecera entre 1024 y 1280 px de ancho: con más de 8 ítems de menú más el botón puede no caber en una línea.

## Publicar el código mediante GitHub y cPanel

1. Respaldar el tema actual fuera de public_html.
2. Descomprimir el ZIP. Subir el CONTENIDO de la carpeta cspm-institucional a la raíz del repositorio colegiopspmis/web (style.css y .cpanel.yml en la raíz, no dentro de otra carpeta). Incluir el archivo oculto .cpanel.yml.
3. Confirmar los cambios en main. En cPanel, repositorio Tema Staging CSPM: Update from Remote y luego Deploy HEAD Commit.
4. Verificar que HEAD y Last Deployed SHA coincidan. En WordPress > Herramientas > Salud del sitio > Información > Tema activo, comprobar 1.4.1.

## Completar las páginas (paso separado del despliegue)

Autoridades ya fue creada vacía por el usuario. Pegar docs/content/autoridades.html en el cuerpo del editor de código de bloques de ESA página; volver al editor visual y revisar antes de publicar. No usar Divi ni crear otra página duplicada.

Después de verificar Autoridades, actualizar El Colegio usando docs/content/el-colegio.html como fuente, conservando cualquier edición posterior del usuario y las revisiones. Agregar Autoridades al menú de WordPress. Revisar institucionalmente los textos antes de publicar en producción.

No reemplazar Inicio completo con docs/content/inicio.html: el usuario cambió su fotografía en WordPress. Ese archivo es una referencia y puede contener una imagen anterior de una actividad externa. Conservar el contenido actual y editar únicamente los enlaces que deban apuntar a /autoridades/.

Las fotos de integrantes siguen pendientes. Este ZIP no importa base de datos ni sincroniza LocalWP con staging. Divi Builder es externo al tema y se reserva para entradas.

## Alcance de validación

Se comprueban integridad ZIP, coherencia de versiones y sintaxis PHP. No equivale a una auditoría de seguridad completa ni a una prueba visual de la instalación. El paquete no se desplegó automáticamente. Conservar autenticación del staging.
