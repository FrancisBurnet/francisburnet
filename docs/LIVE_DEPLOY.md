# Live Deploy

Use `scripts/deploy-live.ps1` from `X:\SIMPLILEARN\FrancisBurnetCom` to publish the public site to `francisburnet.com`.

## Standard Deploy

Run:

```powershell
Set-Location 'X:\SIMPLILEARN\FrancisBurnetCom'
.\scripts\deploy-live.ps1
```

What it deploys:

- `web\public` to `/httpdocs`
- `web\includes` to `/includes`
- `Incremental Capstones` to `/Incremental Capstones`
- `Projects` to `/Projects`

## First Credentialed Run

If the encrypted local credential file does not exist yet, run:

```powershell
Set-Location 'X:\SIMPLILEARN\FrancisBurnetCom'
.\scripts\deploy-live.ps1 -SaveCredential
```

This stores an encrypted credential at:

```text
C:\Users\franc\.francisburnet-live.credential.clixml
```

That file is machine- and user-scoped through PowerShell credential export. Later deploys can reuse it without prompting again.

## Package Only

To build the archive without uploading it:

```powershell
Set-Location 'X:\SIMPLILEARN\FrancisBurnetCom'
.\scripts\deploy-live.ps1 -PackageOnly
```

## Expected Success Output

Successful runs end with output like:

```text
Created deployment archive: ...
Using saved credential from ...
Uploaded archive to /tmp/...
Live deployment completed successfully.
```

## Post-Deploy Checks

Verify these URLs:

- `https://francisburnet.com/projects.php`
- `https://francisburnet.com/automating-port-operations.php`
- `https://francisburnet.com/assets/demos/automating-port-operations-detector.html`
- `https://francisburnet.com/assets/models/automating-port-operations-transfer/model.json`

## Known Failure Modes

- `Permission denied (password)` means the wrong SSH password was entered for `fb123@plesk.bententerprise.com`.
- `File already exists on remote host` was caused by reusing a fixed archive filename; the script now generates a unique archive name per deploy.
- `Specified path is not a directory` was caused by uploading to a file path with `Set-SFTPItem`; the script now uploads into the remote directory and extracts the uploaded archive by name.