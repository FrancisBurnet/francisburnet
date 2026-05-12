# Herd PHP Runtime Setup

This project is intended to be deployable from the `FrancisBurnetCom` folder alone.

## Current State

Herd is installed and working on this machine.

Verified local Herd state:

- Herd config root exists at `%USERPROFILE%\.config\herd`
- Herd CLI is available as `herd`
- The linked site can be exposed as `https://francisburnet.test`
- The Herd-linked site currently uses:
   `%USERPROFILE%\.config\herd\bin\php84\php.exe`
- The fallback script-based server currently uses:
   `%USERPROFILE%\.config\herd\bin\php85\php.exe`

## Preferred Local URL

Use this as the main local development URL for the new domain root:

```text
https://francisburnet.test
```

This Herd link must point to:

```text
X:\SIMPLILEARN\FrancisBurnetCom\web\public
```

Do not link the repository root directly for the production-style Herd domain, because this app serves from `web/public`.

## Link This Project In Herd

Run these commands:

```powershell
Set-Location .\web\public
herd link francisburnet --secure
```

To inspect the current linked site later:

```powershell
herd links
herd sites
herd which-php francisburnet
```

## Fallback Local Server

If you need a quick direct PHP server outside Herd routing, from the `FrancisBurnet` folder run:

```powershell
.\scripts\serve-with-herd.ps1
```

Fallback local URL:

```text
http://127.0.0.1:8080
```

Optional custom host or port:

```powershell
.\scripts\serve-with-herd.ps1 -HostName localhost -Port 8081
```

Use the fallback server only for troubleshooting or quick checks. Prefer `https://francisburnet.test` for normal development.

## Deployability Rule

Keep all site code, scripts, content, data copies, assets, and deployment notes inside the `FrancisBurnetCom` folder.

## Notes

- The current app is a PHP site served from `web/public`.
- No database setup is currently required for the working pages that were verified.
- The live assets used by the app are under `web/public/assets`.
- The copied capstone source material lives under `Incremental Capstones` inside this root.

## Next Structural Step

Use the copied capstone source assets already staged inside `FrancisBurnetCom\Incremental Capstones` so the project does not depend on external course folders at deploy time.