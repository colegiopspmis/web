# CSPM Institucional — 1.3.1

Entrega de mantenimiento sobre el ZIP 1.3.0 proporcionado por el usuario.

## Cambios

- Versión 1.3.1 coherente en style.css, functions.php y VERSION; los CSS y JS se solicitan con esa versión.
- .cpanel.yml apunta al tema del staging confirmado: /home/colegpsp/public_html/staging-cspm/site/wp-content/themes/cspm-institucional.
- El despliegue comprueba que existe el tema y WordPress, copia los archivos indicados sin borrar y excluye .git. No modifica páginas, menús, usuarios ni medios de WordPress.
- Se conservan los archivos y recursos de 1.3.0, incluyendo autoridades.html y el-colegio.html separados. No se incorporaron recursos del respaldo antiguo.

## Publicar el código mediante GitHub y cPanel

1. Respaldar el tema actual fuera de public_html.
2. Descomprimir el ZIP. Subir el CONTENIDO de cspm-institucional a la raíz del repositorio colegiopspmis/web: style.css y .cpanel.yml deben quedar en la raíz, no dentro de otra carpeta. Incluir el archivo oculto .cpanel.yml. No subir solamente este ZIP: cPanel no lo descomprime automáticamente.
3. Confirmar los cambios en main. En cPanel, repositorio Tema Staging CSPM: Update from Remote y luego Deploy HEAD Commit.
4. Verificar HEAD y Last Deployed SHA coincidentes. En WordPress > Herramientas > Salud del sitio > Información > Tema activo, comprobar 1.3.1 y la ruta anterior. Revisar portada y páginas desde HTTPS.

## Completar las páginas (paso separado del despliegue)

Autoridades ya fue creada vacía por el usuario. Pegar docs/content/autoridades.html en el cuerpo del editor de código de bloques de ESA página; volver al editor visual y revisar antes de publicar. No usar Divi ni crear otra página duplicada.

Después de verificar Autoridades, actualizar El Colegio usando docs/content/el-colegio.html como fuente, conservando cualquier edición posterior del usuario y las revisiones. Agregar Autoridades al menú de WordPress. Revisar institucionalmente los textos antes de publicar en producción.

No reemplazar Inicio completo con docs/content/inicio.html: el usuario cambió su fotografía en WordPress. Ese archivo es una referencia y puede contener una imagen anterior de una actividad externa. Conservar el contenido actual y editar únicamente los enlaces que deban apuntar a /autoridades/.

Las fotos de integrantes siguen pendientes. Este ZIP no importa base de datos ni sincroniza LocalWP con staging. Divi Builder es externo al tema y se reserva para entradas.

## Alcance de validación

Se comprueban integridad ZIP, coherencia de versiones y sintaxis PHP. No equivale a una auditoría de seguridad completa ni a una prueba visual de la instalación. El paquete no se desplegó automáticamente. Conservar autenticación del staging.
