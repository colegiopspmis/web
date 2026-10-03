# Descarga los PDF del sitio original a la carpeta assets\documents del repositorio local (Windows).
# Uso (PowerShell, desde la raíz del repositorio):  .\docs\descargar-documentos.ps1
# Luego sube los archivos nuevos a GitHub (Add file > Upload files, dentro de assets/documents).
$base = 'https://colegiopspmisiones.com.ar/wp-content/uploads'
$dest = Join-Path $PSScriptRoot '..\assets\documents'
New-Item -ItemType Directory -Force -Path $dest | Out-Null
$files = @(
  @('2024/05/Res.-2473-Nacion.pdf',               'alcances-del-titulo-res-2473-84.pdf'),
  @('2025/04/ESTATUTO.pdf',                       'estatuto.pdf'),
  @('2024/04/LEY-2.pdf',                          'ley-i-n-131.pdf'),
  @('2026/05/MODELO-PLAN-DE-TRATAMIENTO.pdf',    'modelo-plan-de-tratamiento.pdf'),
  @('2026/05/2026-CONSENTIMIENTO-INFORMADO-2.pdf','consentimiento-informado-2026.pdf')
)
foreach ($f in $files) {
  try {
    Invoke-WebRequest -Uri "$base/$($f[0])" -OutFile (Join-Path $dest $f[1]) -ErrorAction Stop
    Write-Host "OK      $($f[1])"
  } catch { Write-Host "FALLÓ   $($f[1])  <-  $base/$($f[0])" }
}
