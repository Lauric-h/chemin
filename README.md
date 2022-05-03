# Chemin
Chemin (French for trail) is a side-project where I can add and track my training.
[See the full specs and roadmap here](https://hackmd.io/@fjNFD8fpTAqHBnrRIQFRMQ/rkb-mTeQc).

## Usage

### Requirements

- PHP 8.1
- Composer
- Symfony CLI
- Docker
- Docker-compose
- Nodejs & npm

Check with
```bash
symfony check:requirements
```

### Start dev environment

```bash
docker-compose up -d
npm install
npm run build
symfony serve -d
```

## Symfony - Chemin
The Symfony project will be the main projet, displaying the views and calling the other two services.
- Chemin - Fit decoder (Java)
- Chemin - Report generator (Go)

### Architecture
![](https://i.imgur.com/bp4Hv0b.png)

![](https://i.imgur.com/eoNbWAz.png)

### Features
- Authentication
- View the past, present and future sport sessions
    - Calendar view
    - List view
- View a single sport session
- Edit a single sport session
- Filter the view by week, by training plan
- Add a training plan
- Upload a FIT file
- See reports comparing planned and done sessions

### Tech
- PHP / Symfony
- PostgreSQL
- Bootstrap
- Docker/Docker-Compose
- PHP CS Fixer
- PHP Stan
