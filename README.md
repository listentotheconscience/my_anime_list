<p align="center"><img src="https://i.postimg.cc/k5C4krXq/image.png" ></p>


## About MyAnimeList

MAL is my intern project as laravel developer \
This is anime and manga tracker \
You can rate title, add title to your list, comment title

## Frameworks, libraries using

- Laravel
- Laravel Nova
- A few plugins for Laravel and Laravel Nova

## Development Environment

- Docker
- Docker-Compose
- Nginx
- PHP
- PostgreSQL
- Adminer

## Requirements

PHP: 8.0 and higher \
Docker-Compose: 3.5 and higher (in .yml)

## Installation

1. Clone project to your local machine
```bash
$ git clone https://github.com/listentotheconscience/my_anime_list.git
```

2. Install Docker and Docker-Compose \
I use Manjaro Linux, so I use pacman
```bash
# pacman -S docker docker-compose
```

3. Run
```bash
$ docker-compose up -d
```

## Access

- PHP container is accessible by address 172.10.0.6
- Nginx container is accessible by address 172.10.0.5
- PostgreSQL container is accessible by address 172.10.0.7
- Adminer container is accessible by address 172.10.0.10

If you want to change addresses you need to change it in docker-compose.yml
