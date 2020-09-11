# markdown-docs

## Requirements
* Php (see [composer.json](composer.json) to check minimal version)
* [Symfony CLI](https://symfony.com/download)
* [Composer](https://getcomposer.org/download/)
* [Node](https://github.com/nvm-sh/nvm)

## Setup
```bash
$ composer install
$ yarn install 
$ yarn build # or yarn watch to work on assets developement
```

## Start server
```bash
symfony server:start --no-tls
```

## Write your own doc 
Markdown templates are on `templates/doc` directory.

Your files are already available on your server.

Example:
`templates/doc/dummy/foo.md` is available at [dummy/foo](http://localhost:8000/dummy/foo)
