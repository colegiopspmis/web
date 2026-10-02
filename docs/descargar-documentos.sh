#!/bin/bash
# Descarga a STAGING los PDF del sitio original. Ejecutar en el Terminal de cPanel:
#   bash ~/repositories/<carpeta-del-repo>/docs/descargar-documentos.sh
#
# IMPORTANTE: escribe en la carpeta del tema publicado, NO dentro del repositorio de cPanel
# (si se ensucia el repositorio, cPanel bloquea el siguiente despliegue). Para que los PDF
# también lleguen a producción, súbelos además al repositorio de GitHub en assets/documents/.
# El Código de Ética ya viene en el repositorio (codigo-de-etica.pdf).
set -u
DEST="${1:-/home/colegpsp/public_html/staging-cspm/site/wp-content/themes/cspm-institucional/assets/documents}"
BASE="https://colegiopspmisiones.com.ar/wp-content/uploads"
mkdir -p "$DEST" || exit 1

get() {  # get <ruta-en-uploads> <nombre-final>
  local tmp; tmp="$(mktemp)"
  if curl -fL --retry 2 -sS -o "$tmp" "$BASE/$1" && [ "$(head -c 4 "$tmp")" = "%PDF" ]; then
    mv "$tmp" "$DEST/$2" && chmod 644 "$DEST/$2" && echo "OK      $2"
  else
    rm -f "$tmp"; echo "FALLÓ   $2  <-  $BASE/$1"
  fi
}

get 2024/05/Res.-2473-Nacion.pdf              alcances-del-titulo-res-2473-84.pdf
get 2025/04/ESTATUTO.pdf                      estatuto.pdf
get 2024/04/LEY-2.pdf                         ley-i-n-131.pdf
get 2026/05/MODELO-PLAN-DE-TRATAMIENTO.pdf   modelo-plan-de-tratamiento.pdf
get 2026/05/2026-CONSENTIMIENTO-INFORMADO-2.pdf consentimiento-informado-2026.pdf
