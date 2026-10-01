# CSPM Institucional — 1.2.0

Tema propio para la reconstrucción limpia del Colegio de Psicopedagogos de Misiones. PHP, HTML semántico, CSS y JavaScript vanilla. Probado en LocalWP; no publicado en Donweb.

## Diseño y contenido

- Identidad turquesa, azul y acentos rosa, logo institucional y fotografía de un encuentro.
- Inicio: presentación humana, acceso a autoridades, recursos, servicios y últimas novedades.
- El Colegio: 18 autoridades agrupadas por órgano y documentación del Tribunal.
- Inicio y El Colegio utilizan bloques nativos. Divi Builder se limita al tipo post; no se requiere Brizy.

## Instalación y traslado de contenido

1. Instalar esta carpeta como wp-content/themes/cspm-institucional en una instalación limpia y aislada.
2. Crear o conservar Inicio y El Colegio. Copiar docs/content/inicio.html y docs/content/el-colegio.html en el editor de código de bloques de las páginas correspondientes. Volver al editor visual y guardar.
3. En Ajustes → Lectura, seleccionar Inicio como portada estática y Novedades como página de entradas. La portada muestra el contenido de Inicio y agrega servicios y novedades dinámicas.
4. Asignar menús principal y pie. Conservar los slugs /el-colegio/, /tramites-2/, /matriculados-2/, /biblioteca/, /novedades/ y /contacto/.
5. Los enlaces de bloques son relativos a la raíz. Una instalación WordPress en subdirectorio requiere adaptarlos. Conservar el nombre de la carpeta del tema para sus medios.

Git no actualiza automáticamente las páginas de la base de datos. Los HTML versionados permiten reproducir los bloques; no contienen usuarios, opciones ni la base de datos.

## Recursos y alcance de seguridad

docs/asset-review.json documenta origen relativo y SHA-256 de cuatro PDF públicos y la fotografía recuperada. Se verificó decodificación completa del JPEG y estructura de PDF, buscando JavaScript, acciones automáticas, adjuntos y contenido activo. Se revisaron las primeras páginas de los cuatro PDF. Estos controles no equivalen a una certificación antivirus ni a una auditoría completa de los respaldos.

Los recursos pedagógicos enlazan al Google Drive referenciado por el sitio anterior; disponibilidad y permisos externos pendientes de comprobación. El catálogo PDF incluido es un catálogo de tests. Revisar vigencia documental y autorización de la fotografía antes de producción.

No se incluyen WordPress, Divi, credenciales, SQL, respaldos ni uploads completo. No existe despliegue automático configurado en esta rama. Antes de publicar: revisar el servidor vulnerado, copias de seguridad, contenido y staging. No restaurar íntegramente el sitio comprometido ni eliminar el directorio que aloja Autogestión.

## Validación

PHP: revisión sintáctica de 15 archivos. Navegador: portada en escritorio y 390 px, un H1, imágenes cargadas, sin desbordamiento horizontal; 18 tarjetas de autoridades; bloques abiertos en editor visual sin aviso de contenido inesperado. Prueba de navegación con DOM simulado (no equivale a E2E).

Pendientes: plantilla editorial Divi si se requiere, auditoría completa de accesibilidad, revisión legal/editorial y despliegue de staging.
