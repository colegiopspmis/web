# Actualización CSPM Institucional 1.5.0

## Cambios

- Portada: bloque inicial con foto y botones → línea divisoria → Novedades → Un Colegio que acompaña y recursos → accesos rápidos → contacto.
- Novedades se inserta una única vez después del bloque existente con clase cspm-identity-hero. Las publicaciones siguen viniendo de WordPress, ordenadas por fecha, hasta seis.
- Botones principales turquesa #28b6bc con texto azul oscuro para mantener contraste. Autogestión azul #0068b4 con texto blanco. Títulos y texto general mantienen sus colores.
- Bordes, iconos y separadores incorporan la paleta azul/turquesa. Los controles de los listados adoptan estos colores cuando se muestran con el tema.
- Enlaces oficiales de Instagram, Facebook y YouTube visibles en el pie y en Contacto. WhatsApp +54 9 376 490-6540 en pie y portada; en Contacto se añade si ese número no está ya en su contenido.

## Actualizar en staging

Este ZIP es un **tema**, no un plugin.

1. Guardar una copia del tema actual o conservar el ZIP anterior para poder volver atrás.
2. WordPress → **Apariencia → Temas → Añadir nuevo → Subir tema**.
3. Seleccionar cspm-institucional-1.5.0.zip y elegir **Reemplazar el actual con el subido**. Conservar CSPM Institucional activo.
4. Purgar la caché del sitio si existe y recargar la portada.
5. Verificar orden de las secciones, colores, redes, WhatsApp y versión 1.5.0 en los detalles del tema.

No borrar páginas, reinstalar el plugin ni reimportar Inicio. La foto elegida, los textos editados, menús, noticias y listados se conservan en WordPress. El paquete no modifica la base de datos ni incluye los CSV del padrón.

Si se despliega mediante Git/cPanel, sincronizar el contenido de la carpeta cspm-institucional con la raíz del repositorio del tema, incluyendo los nuevos archivos inc/home-layout.php, inc/communication.php y template-parts/home-news.php. Luego actualizar desde remoto y desplegar HEAD en cPanel. Evitar una carpeta cspm-institucional anidada dentro del tema. La configuración .cpanel.yml conserva el destino del staging acordado.

## Redes

Valores oficiales predeterminados:

- Instagram: https://www.instagram.com/colegiopspmisiones/
- Facebook: https://www.facebook.com/colegiopspmisiones/
- YouTube: https://www.youtube.com/@colegiopspmisiones6629
- WhatsApp: https://wa.me/5493764906540

Los enlaces sociales no vacíos guardados previamente en **Apariencia → Personalizar → CSPM — Opciones del Tema → Redes Sociales** tienen prioridad. Revisar allí si aparece otra dirección. Si el campo está vacío, se usa el enlace oficial. Se agregaron enlaces, no publicaciones embebidas ni scripts externos de redes sociales.

## Compatibilidad de portada

La ubicación de Novedades usa la clase del bloque inicial que ya trae el diseño: cspm-identity-hero. Funciona también si ese bloque está dentro de otro grupo. Si una página reemplazó esa estructura por HTML libre u otro constructor, Novedades aparece al final del contenido editable como alternativa; verificar la clase del bloque inicial para recuperar el orden solicitado. No reemplazar la portada completa con el archivo de ejemplo porque eso perdería las ediciones y foto elegidas.

## Verificación

24 archivos PHP sin errores de sintaxis. Prueba con el parser de bloques de WordPress y plantillas del tema: Novedades aparece una sola vez entre Hero y Un Colegio que acompaña; comprobado también el caso sin Hero y la retirada del filtro temporal. Vista local de escritorio y a 390 px sin desbordamiento horizontal. Verificados los colores calculados y destinos de las redes y WhatsApp. Las noticias de la vista local eran ejemplos; no se publicaron.

Falta comprobar en WordPress real de staging con su contenido y caché. No se modificó el sitio remoto, ni el plugin 1.2.0, ni las bases de profesionales.
