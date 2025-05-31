Acme Widget Co - Interview Test
===============================

Everything works on the `main` branch, and it is merged with the `develop` branch using `--squash`.  
If you are curious about individual commits, please look at the `develop` branch.
Project tested on Linux and Mac using a multi-platform image.

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

This Docker configuration is a simplified version of my everyday setup.  
I have left Make commands for Laravel, Symfony, etc., to save time.  
Other items—such as HTTPS certificate generation, Traefik load balancer, unused volumes, and containers like Nginx, Redis, and profiles—have been removed.

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

This is a normal intended warning by PHPUNIT developers safe to ignore it.
There was 1 PHPUnit test runner warning:

1) Class BaseTest declared in /var/www/html/tests/BaseTest.php is abstract

I prefer to avoid mocking; use whenever possible real units, not mocked ones.

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

- I generally avoid using PHPDoc-style comments at all blocks, as they tend to reduce code readability; instead, I prefer meaningful names. However, in some cases, you may find PHPDoc comments—this is necessary to satisfy the highest PHPStan level, for example:
   /**
    * @var array<Product> $products
    **/
- I use `final` classes and read-only properties whenever possible. If a class needs to be extended in the future, it is easy to remove the `final` keyword, ensuring that all extensions are managed in a controlled way within the team. Read-only properties help prevent bugs and unexpected state changes.
- I used `declare(strict_types=1);` at the top of each PHP file to enforce strict type checking by the PHP runtime.
- I prefer test-driven development whenever possible. However, some companies do not support it, believing that a dedicated QA team is sufficient and that developers should not spend time writing their own tests. In such cases, I write tests only for the more complex parts of the code when necessary to ensure correct results.

## GitHub or GitLab handling

As mentioned above, automated code quality checks are used in the pre-commit hook.

I always check out a task-specific branch from `master`, and sometimes even more branches if the task is difficult. This guarantees I will always have a stable, verified restore point. I like to commit frequently to these branches. When I need to merge to the main branch, I use the `--squash` parameter to eliminate many commits on the main branch and merge them into a single commit. This improves the readability of the main branch.


## 
