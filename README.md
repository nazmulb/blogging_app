# Blogging App

Simple blogging app using Symfony framework.

### Setup:

Please clone this repo:

```sh
git clone https://github.com/nazmulb/blogging_app.git
```

Please change directory to this project and install the dependencies with composer and yarn: 

```sh
cd blogging_app
composer install
yarn install
```

### Compile App assets:

```sh
yarn encore dev
```

### Run the App:

```sh
symfony server:start
```

### Create DB and run DB migration:

```sh
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
```

### Open your browser and use the below URL:
`http://localhost:8000/`
