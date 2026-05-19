# FrancisBurnetCom Folder Map

## Top Level

- `Incremental Capstones/Applied Data Science with Python`
- `Incremental Capstones/Machine Learning Using Python`
- `Incremental Capstones/Deep Learning Specialization`
- `Projects/Deep Learning Specialization`
- `web/public`
- `web/includes`
- `scripts`
- `docs`
- `requirements.txt`

## Website Layer

- `web/public/index.php` - home page
- `web/public/incremental-capstone.php` - capstone hub
- `web/public/projects.php` - published end-project landing page
- `web/public/capstone-1.php` through `web/public/capstone-4.php` - applied data science capstone pages
- `web/public/capstone-session-5.php` through `web/public/capstone-session-12.php` - machine learning and deep learning capstone pages
- `web/public/assets` - live CSS, JavaScript, and images
- `web/includes/config.php` - shared site metadata, capstone registry, and future project registry

## Content Layer

- `Incremental Capstones/Applied Data Science with Python/Capstone 1` through `Capstone 4`
- `Incremental Capstones/Applied Data Science with Python/Capstone_Combined_Submission`
- `Incremental Capstones/Machine Learning Using Python/Capstone Session 5` through `Capstone Session 8`
- `Incremental Capstones/Deep Learning Specialization/Capstone Session 9` through `Capstone Session 12`
- `Projects/Deep Learning Specialization/Automating Port Operations`

## Published Projects Layer

- `Projects/<Program Name>/<Project Name>` - permanent copied source root for each published end-of-class project
- Keep project directions, copied datasets, notebooks, outputs, screenshots, and writeups together in that root
- Treat this as a separate content family from `Incremental Capstones/`

## Deployment Intent

- Keep the website code, capstone source assets, and published project source assets under this one root.
- Point Herd at `web/public`.
- Add future API or automation code under this root so publishing does not depend on the older course folder locations.