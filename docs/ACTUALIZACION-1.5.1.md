# Actualización 1.5.1 — Portada y sincronización

- Portada limitada a las tres entradas publicadas más recientes, ordenadas por fecha descendente. Las entradas fijadas no amplían ni alteran esa selección.
- Texto blanco en botones turquesa, incluidos los controles del padrón y obras sociales cuando se usa el tema. Autogestión conserva azul #0068b4 con texto blanco.
- Integra también todos los cambios de 1.5.0: Novedades después del Hero, redes sociales, WhatsApp y paleta institucional.

## Fuente de actualización

El repositorio GitHub del tema y el ZIP 1.5.1 deben contener el mismo código. Las páginas, fotos elegidas, noticias, menús y listados permanecen en la base de datos de WordPress; no se reimportan.

En cPanel → Git Version Control → repositorio del tema → Pull or Deploy:
1. Update from Remote.
2. Comprobar que la rama sea main y que el último commit corresponda a 1.5.1.
3. Deploy HEAD Commit.
4. Purgar caché si existe y comprobar versión 1.5.1 en WordPress, texto blanco y un máximo de tres noticias en portada.

La ruta de despliegue sigue siendo /home/colegpsp/public_html/staging-cspm/site/wp-content/themes/cspm-institucional. La tarea comprueba que ya existen el tema y la raíz WordPress antes de copiar. No despliega en el dominio de producción.

Si se instala temporalmente por ZIP, usar Apariencia → Temas → Añadir nuevo → Subir tema → Reemplazar. No desinstalar ni cambiar de tema. No actualizar el plugin de listados para este ajuste.

No se añaden CSS personalizados en WordPress: todos los cambios quedan en el tema. Los colores responden a la elección solicitada; no se declara una certificación de accesibilidad.
