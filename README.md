
# Laravel 9.x - Quick Start (Laravel 9.x + Docker)

## Rodar o Laravel

Clone Repositório
```sh
git clone https://github.com/lavra/laravel-9-quick-start.git laravel9
```
```sh
cd laravel9/
```
Remova o versionamento
```sh
rm -rf .git/
```
Crie o Arquivo .env
```sh
cp .env.example .env
```
Atualize as variáveis de ambiente do arquivo .env
```dosini
APP_NAME="Full Cycle"
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=code_micro_videos
DB_USERNAME=root
DB_PASSWORD=root

CACHE_DRIVER=redis
QUEUE_CONNECTION=redis
SESSION_DRIVER=redis

REDIS_HOST=redis
REDIS_PASSWORD=null
REDIS_PORT=6379
```sh
Suba os containers do projeto
```sh
docker-compose up -d
```sh
Acesse o container app
```sh
docker-compose exec app bash
```
Instalar as dependências do projeto
```sh
composer install
```
Instalar o Mockery em dev
```sh
composer require --dev mockery/mockery
```
Gerar a key do projeto Laravel
```sh
php artisan key:generate
```
Implementar tests/src/Core no *autoload composer.json*
```sh
"psr-4": {
            "App\\": "app/",
            "Core\\": "src/Core",
            ---------
        }            
```

Acesse o projeto
[http://localhost:8000](http://localhost:8000)
