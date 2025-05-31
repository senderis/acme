Acme Widget Co - Interview Test
===============================

### Configure Docker
```
cd docker
```
- open .env file 
- edit your platform and project path in the .env file.

```
TIMEZONE=Europe/Madrid
PROJECT_NAME=acme
PROJECT_PATH=/projects/interview/acme
VERSION=1.0.0
```
### Setup application

Setup will:
- build the docker container
- install packages with composer
- and start the container.

```
cd docker
make setup
```

## Docker makefile commands

- make build        - build containers
- make build all    - build all containers
- make composer     - run composer
- make down         - stop and remove containers
- make help         - available make commands for docker
- make mount        - mount a container
- make php-cs-fixer - run php-cs-fixer
- make phpstan      - run phpstan
- make phpunit      - run phpunit
- make setup        - install application
- make uninstall    - uninstall application
- make up           - start docker containers


## Testing

Tests are in the tests/Unit folder

```make test```

## Code quality tools

I verified the code with phpstan and formatted with php-cs-fixer.

```
make php-cs-fixer
make phpstan

If need to run something that not in makefile
use ```make mount/php``` you will landed in the application folder and able
to execute it in the container like ```vendor/bin/phpunit```
