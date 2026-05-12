param(
    [string]$HostName = '127.0.0.1',
    [int]$Port = 8080
)

$projectRoot = Split-Path -Parent $PSScriptRoot
$publicRoot = Join-Path $projectRoot 'web\public'
$herdBinRoot = Join-Path $env:USERPROFILE '.config\herd\bin'

if (-not (Test-Path $publicRoot)) {
    Write-Error "Public root not found: $publicRoot"
    exit 1
}

if (-not (Test-Path $herdBinRoot)) {
    Write-Host 'No Herd PHP runtime is installed yet.'
    Write-Host 'Open Herd and complete setup, then install a PHP version in Preferences > PHP.'
    exit 1
}

$phpExecutable = Get-ChildItem -Path $herdBinRoot -Filter php.exe -Recurse -ErrorAction SilentlyContinue |
    Sort-Object FullName -Descending |
    Select-Object -First 1 -ExpandProperty FullName

if (-not $phpExecutable) {
    Write-Host 'Herd is installed, but no php.exe was found under the Herd runtime folder.'
    Write-Host 'Install one PHP version in Herd before running this script.'
    exit 1
}

Write-Host "Using Herd PHP: $phpExecutable"
Write-Host "Serving: $publicRoot"
Write-Host "URL: http://${HostName}:$Port"

& $phpExecutable -d memory_limit=256M -S "${HostName}:$Port" -t $publicRoot