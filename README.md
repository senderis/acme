Acme Widget Co - Interview Test
===============================

````markdown
### Configure Docker

1. Change to the `docker` directory:
   ```bash
   cd docker
   ```

2. Open the `.env` file and edit the following variables as needed:
   - `TIMEZONE`
   - `PROJECT_NAME`
   - `PROJECT_PATH`
   - `VERSION`

   Example `.env` content:
   ```
   TIMEZONE=Europe/Madrid
   PROJECT_NAME=acme
   PROJECT_PATH=/projects/interview/acme
   VERSION=1.0.0
   ```

# Launch setup
make setup

## Docker Makefile commands

- `make build`         – Build containers
- `make build all`     – Build all containers
- `make composer`      – Run Composer
- `make down`          – Stop and remove containers
- `make help`          – List available Makefile commands for Docker
- `make mount`         – Mount a container
- `make php-cs-fixer`  – Run php-cs-fixer
- `make phpstan`       – Run phpstan
- `make phpunit`       – Run phpunit
- `make setup`         – Install the application
- `make uninstall`     – Uninstall the application
- `make up`            – Start Docker containers

## Testing

Tests are located in the `tests` folder.

Run all tests with:

```
make test
```

Run with filter:

```
make phpunit/filter CatalogueTest
```

## Code quality tools

The project uses the following tools to ensure code quality:

- **phpstan**: For static analysis and finding potential bugs.
- **php-cs-fixer**: For automatically formatting code according to PSR-12 standards.

Both tools are integrated into the pre-commit Git hook to enforce code quality before each commit.

I have verified the code with phpstan and formatted it using php-cs-fixer.

```
make php-cs-fixer
make phpstan
```

If you need to run something that is not in the Makefile, use `make mount/php`. You will be placed in the application folder inside the container and can execute commands such as `vendor/bin/phpunit`.

## Coding style

- Do not use PHPDoc style comments; I prefer to use meaningful names. In some places, you may find PHPDoc style comments—
the reason is to pass the highest level with PHPStan, you have to use these comments like this:
   /**
    * @var array<Product> $products
    **/
- I use `final` classes and read-only properties whenever possible. If you need to extend a class in the future, it is easy to remove the `final` keyword, and all extension happens in a controlled manner within the team. Read-only properties are also helpful to avoid bugs and unexpected state changes.

## GitHub or GitLab handling

As mentioned above, automated code quality checks are used in the pre-commit hook.

I always check out a task-specific branch from `master`, and sometimes even more branches if the task is difficult. This guarantees I will always have a stable, verified restore point. I like to commit frequently to these branches. When I need to merge to the main branch, I use the `--squash` parameter to eliminate many commits on the main branch and merge them into a single commit. This improves the readability of the main branch.
