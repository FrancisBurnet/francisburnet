param(
    [string]$HostName = 'plesk.bententerprise.com',
    [string]$UserName = 'fb123',
    [string]$RemoteUploadDir = '/tmp',
    [string]$RemoteExtractRoot = '/',
    [string]$ArchivePath = (Join-Path $env:TEMP ('francisburnet-live-{0}.zip' -f [guid]::NewGuid().ToString('N'))),
    [string]$CredentialPath = (Join-Path $env:USERPROFILE '.francisburnet-live.credential.clixml'),
    [switch]$SaveCredential,
    [switch]$PackageOnly
)

Set-StrictMode -Version Latest
$ErrorActionPreference = 'Stop'

function New-LiveCredential {
    param(
        [Parameter(Mandatory = $true)]
        [string]$UserName,

        [Parameter(Mandatory = $true)]
        [string]$HostName,

        [Parameter(Mandatory = $true)]
        [string]$CredentialPath,

        [switch]$SaveCredential
    )

    if ($CredentialPath -and (Test-Path -LiteralPath $CredentialPath)) {
        $storedCredential = Import-Clixml -LiteralPath $CredentialPath
        if ($storedCredential -isnot [pscredential]) {
            throw "Stored credential is invalid: $CredentialPath"
        }

        if ($storedCredential.UserName -ne $UserName) {
            throw "Stored credential user '$($storedCredential.UserName)' does not match requested user '$UserName'."
        }

        Write-Host "Using saved credential from $CredentialPath"
        return $storedCredential
    }

    $securePassword = Read-Host -Prompt "Enter SSH password for $UserName@$HostName" -AsSecureString
    $credential = [pscredential]::new($UserName, $securePassword)

    if ($SaveCredential) {
        $credentialDirectory = Split-Path -Parent $CredentialPath
        if ($credentialDirectory -and !(Test-Path -LiteralPath $credentialDirectory)) {
            New-Item -ItemType Directory -Path $credentialDirectory -Force | Out-Null
        }

        $credential | Export-Clixml -LiteralPath $CredentialPath
        Write-Host "Saved encrypted credential to $CredentialPath"
    }

    return $credential
}

function Copy-DeployPayload {
    param(
        [Parameter(Mandatory = $true)]
        [string]$Source,

        [Parameter(Mandatory = $true)]
        [string]$Destination
    )

    if (!(Test-Path -LiteralPath $Source)) {
        throw "Deploy source does not exist: $Source"
    }

    $parentDir = Split-Path -Parent $Destination
    if ($parentDir -and !(Test-Path -LiteralPath $parentDir)) {
        New-Item -ItemType Directory -Path $parentDir -Force | Out-Null
    }

    Copy-Item -LiteralPath $Source -Destination $Destination -Recurse -Force
}

$repoRoot = Split-Path -Parent $PSScriptRoot
$stagingRoot = Join-Path $env:TEMP 'francisburnet-live-staging'
$archiveFileName = Split-Path -Leaf $ArchivePath
$remoteArchivePath = ($RemoteUploadDir.TrimEnd('/') + '/' + $archiveFileName)

$payloads = @(
    @{ Source = (Join-Path $repoRoot 'web\public'); Target = 'httpdocs' },
    @{ Source = (Join-Path $repoRoot 'web\includes'); Target = 'includes' },
    @{ Source = (Join-Path $repoRoot 'Incremental Capstones'); Target = 'Incremental Capstones' },
    @{ Source = (Join-Path $repoRoot 'Projects'); Target = 'Projects' }
)

if (Test-Path -LiteralPath $stagingRoot) {
    Remove-Item -LiteralPath $stagingRoot -Recurse -Force
}

New-Item -ItemType Directory -Path $stagingRoot -Force | Out-Null

foreach ($payload in $payloads) {
    $destinationPath = Join-Path $stagingRoot $payload.Target
    Copy-DeployPayload -Source $payload.Source -Destination $destinationPath
}

if (Test-Path -LiteralPath $ArchivePath) {
    Remove-Item -LiteralPath $ArchivePath -Force
}

if (!(Get-Command tar.exe -ErrorAction SilentlyContinue)) {
    throw 'tar.exe is required to build the live deployment archive.'
}

& tar.exe -a -c -f $ArchivePath -C $stagingRoot 'httpdocs' 'includes' 'Incremental Capstones' 'Projects'

if (!(Test-Path -LiteralPath $ArchivePath)) {
    throw "Deployment archive was not created: $ArchivePath"
}

Write-Host "Created deployment archive: $ArchivePath"
Write-Host 'Archive includes:'
$payloads | ForEach-Object { Write-Host ('- ' + $_.Target) }

if ($PackageOnly) {
    return
}

Import-Module Posh-SSH -ErrorAction Stop
$credential = New-LiveCredential -UserName $UserName -HostName $HostName -CredentialPath $CredentialPath -SaveCredential:$SaveCredential

$sftpSession = $null
$sshSession = $null

try {
    $sftpSession = New-SFTPSession -ComputerName $HostName -Credential $credential -AcceptKey
    Set-SFTPItem -SessionId $sftpSession.SessionId -Path $ArchivePath -Destination $RemoteUploadDir
    Write-Host "Uploaded archive to $remoteArchivePath"

    $sshSession = New-SSHSession -ComputerName $HostName -Credential $credential -AcceptKey
    $deployCommand = "unzip -oq '$remoteArchivePath' -d '$RemoteExtractRoot' && rm -f '$remoteArchivePath'"
    $deployResult = Invoke-SSHCommand -SessionId $sshSession.SessionId -Command $deployCommand

    if ($deployResult.ExitStatus -ne 0) {
        $remoteError = ($deployResult.Error | Out-String).Trim()
        if (!$remoteError) {
            $remoteError = ($deployResult.Output | Out-String).Trim()
        }
        throw "Remote deploy failed with exit status $($deployResult.ExitStatus): $remoteError"
    }

    Write-Host 'Live deployment completed successfully.'
}
finally {
    if ($sftpSession) {
        Remove-SFTPSession -SessionId $sftpSession.SessionId | Out-Null
    }

    if ($sshSession) {
        Remove-SSHSession -SessionId $sshSession.SessionId | Out-Null
    }
}

