 # shippyPro Challenge
## Get started

- Get docker and docker-compose from the official [website](https://www.docker.com/).

- Copy the .env.dist file into .env
```sh
cp  ./.docker/.env.dist ./.docker/.env
```
- Edit the.env file just copied based on your needs (eg. edit APP_IP e APP_HOST to assign a custom domain name defined in /etc/hosts)

- Build the dockers containers:

```sh
.docker/docker-compose build
```
- Create the docker containers and build the application:
```sh
.docker/docker-compose up
```

- You will find the following services browsering to the given host:
    - APP_HOST:APP_PORT ***Vue Application***.
    - APP_IP:SERVICE_PHPMYADMIN_PORT ***PhpMyAdmin***

