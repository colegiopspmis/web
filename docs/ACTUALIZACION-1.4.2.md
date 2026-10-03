# CSPM 1.4.2 — 3 de octubre de 2026

Base: ZIP 1.4.1 entregado por el usuario. No se reemplaza por las versiones anteriores.

## Cambios preparados

- Cuatro fotos suministradas incluidas en assets/images/autoridades con nombres estables, sin modificar los originales. Recorte visual circular de 128px mediante CSS, grilla 4/2/1 columnas y corrección del contenedor interno de bloques de WordPress.
- Compatibilidad de las cuatro URLs antiguas /wp-content/uploads/*-scaled.jpg: se reemplazan al renderizar Autoridades por las fotos incluidas. No se sobrescriben otras fotos elegidas en Medios. Los bloques nuevos ya contienen las rutas correctas. La base de datos no se modifica.
- El Colegio: texto exacto solicitado en docs/content/el-colegio.html. Debe pegarse en WordPress (ver pasos siguientes).
- Se omiten al renderizar los encabezados duplicados que coinciden con el título de Autoridades, El Colegio o Documentos, conservando el H1 de la plantilla. Los bloques de referencia ya no duplican el H1.
- /documentos/ usa el catálogo del tema cuando conserva la plantilla por defecto; también puede seleccionarse explícitamente Documentación. Las URLs se construyen desde la ubicación del tema. El título de la página se muestra una sola vez si el cuerpo usa encabezados nativos.
- Portada: escala del título, espacios y altura máxima de la imagen más contenidos, sin sustituir la foto elegida en WordPress. El enlace de referencia a autoridades apunta a /autoridades/.
- Rivadavia 1436 se conserva. No se cambia Autogestión ni sus opciones.
- Ruta cPanel restringida al tema de staging; sin borrados ni importación de respaldos.

## Aplicación

1. Respaldar tema y base de datos actuales del staging. Subir el contenido de cspm-institucional a la raíz del repositorio, incluyendo .cpanel.yml. No subir solo el ZIP ni anidar una carpeta adicional.
2. Update from Remote y Deploy HEAD Commit. Comprobar 1.4.2 en Salud del sitio y coincidencia de commits en cPanel.
3. Abrir Autoridades. Las fotos antiguas con las cuatro rutas detectadas se corrigen automáticamente en el frontend. Para que el editor también muestre las nuevas fotos, reemplazar su cuerpo por docs/content/autoridades.html solo si no hay ediciones posteriores que conservar; de lo contrario seleccionar cada foto o cambiar únicamente esas cuatro URLs. Conservar título y slug.
4. Editar El Colegio con bloques nativos. Reemplazar únicamente el párrafo institucional por el texto solicitado o usar docs/content/el-colegio.html si se desea toda esa estructura. No requiere Divi.
5. Editar Documentos y elegir la plantilla Documentación. Dejar en el cuerpo solo una introducción en párrafos; no repetir el título ni pegar otra copia del catálogo. Actualizar y probar cada botón PDF por HTTPS.
6. No volver a pegar Inicio completo: conservar la imagen cambiada por el usuario. Cambiar su enlace anterior /el-colegio/#autoridades por /autoridades/ si aún existe.

## PDF

Los nueve PDF del ZIP se conservaron y son legibles por el analizador. No hace falta duplicarlos en Medios mientras se mantengan en assets/documents y el despliegue incluya assets. Falta alcances-del-titulo-res-2473-84.pdf: el listado mostrará Documento en preparación hasta recibir una copia válida. No se descargó de forma automática del sitio antiguo.

Si un PDF falla tras desplegar: copiar la URL del botón y comprobar en cPanel que el archivo existe en public_html/staging-cspm/site/wp-content/themes/cspm-institucional/assets/documents. Registrar el error HTTP o la pantalla exacta. No retirar la protección del staging para solucionarlo. Una redirección al login, un 404 y un PDF ilegible requieren soluciones distintas.

## Validación y límites

21 archivos PHP con sintaxis válida; cuatro JPEG completamente decodificados; nueve PDF analizados sin las claves activas buscadas (JS, Launch, OpenAction, AA y archivos embebidos). Esto no equivale a certificación antivirus ni a revisión de vigencia legal. Integridad ZIP comprobada.

Vista previa estática de Autoridades probada con contenedor interno de WordPress: cuatro fotos cargadas en escritorio, 128px, y sin desbordamiento horizontal; distribución de una columna a 390px. No sustituye una prueba en WordPress. Falta comprobar editor, catálogo y enlaces PDF en staging después del despliegue. No se modificó el servidor ni su base de datos.
