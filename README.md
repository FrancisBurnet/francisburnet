# FrancisBurnet

This folder is the production-oriented root for the FrancisBurnet capstone site.

## Purpose

- Host the PHP website that presents the capstone portfolio
- Keep copied capstone source materials inside the same deployable root
- Provide one place for site code, docs, scripts, and datasets used for publishing

## Local Structure

- `web/public` - public PHP entry points and public assets
- `web/includes` - shared PHP includes and configuration
- `Incremental Capstones` - copied source notebooks, datasets, and artifacts grouped by program
- `scripts` - local helper scripts
- `docs` - setup and deployment notes
- `requirements.txt` - Python dependencies for future execution hooks

## Local URL

Preferred Herd URL:

```text
https://francisburnet.test
```

Fallback local server:

```powershell
.\scripts\serve-with-herd.ps1
```

See `docs/HERD_SETUP.md` for the link command and runtime notes.

## Capstone Coverage

- Applied Data Science with Python: Capstones 1 to 4 plus combined submission assets
- Machine Learning Using Python: Capstone Sessions 5 to 8
- Deep Learning Specialization: Capstone Sessions 9 to 12

## Notes

- This root is prepared for publish-oriented organization.
- The PHP site is scaffolded and can now be extended to surface the copied capstone assets directly.
- The source-control target for this project is `https://github.com/FrancisBurnet/francisburnet`.
- Capstone 1 Colab launch defaults are wired in source control and point at the public GitHub notebook path on the `main` branch.
- Public-facing notebook and site copy are written as Francis Burnet presenting the work directly.