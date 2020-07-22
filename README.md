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

### Run Mysql server:

Please use `MySQL 5.7.30` or higher.

If you don't have then use the following:

```sh
docker run -d -p 3306:3306 --name db -e MYSQL_ROOT_PASSWORD=123 -v $PWD/mysql:/var/lib/mysql mysql:5.7
docker logs -f db
```

Please don't forget to set the DATABASE_URL from `.env` file.

### Create DB and run DB migration:

```sh
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
```

### Add dummy database user:

```sh
php bin/console doctrine:fixtures:load
```

### Open your browser and use the below URL:
`http://localhost:8000/`
