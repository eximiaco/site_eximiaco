# Simple WordPress Environment

A quick way to start a project with WordPress using Docker.

## Installation

### Docker

The development environment is managed by [Docker](https://www.docker.com/) using [Docker Compose](https://docs.docker.com/compose/overview/). The _docker-compose.yml_`_ has the definiton of the tools used to run the project. You must have installed the Docker program. If you haven't, you can [get it here](https://www.docker.com/get-docker).

It is recommended maintain the images always updated. Execute the _pull_ and _build_ commands to get the updated images.

    $ docker-compose pull && docker-compose build

### Database

To install the application the database directory must be empty. Ensure that the database directory doesn't exist.

    $ sudo rm -rf database

To create the database, it only need up the database container.

    $ docker-compose up db

Keep this process running. To test if the database was created, open a new terminal tab and execute the below command. The database service can take a while to start. So this command will fail until the service be up.

    $ docker-compose exec db mysql -u project -pproject project

If after some seconds, the database could not be connected. Restart the installation process.

### Dependencies

Download PHP packages, including the WordPress.

    $ docker-compose run --rm composer install

Download Node packages

    $ docker-compose run --rm node npm install

### Theme

Download Bower packages

    $ docker-compose run --rm node bower install

Build the theme

    $ docker-compose run --rm node grunt

## Internationalization

### Make Pot

After source app/profile, the theme language POT file is generated with the command

	$ i18n

### WordPress

Install the WordPress

    $ docker-compose run --rm php bin/install

## Run the server

### PHP 7.2

#### Linux

The website will be served in [http://localhost](http://localhost).

Up the server and the watch task.

    $ docker-compose up server watch

#### Mac

    $ docker-compose -f docker-compose.yml -f docker-compose.mac.yml up server watch

### PHP 5.6

The production server use the PHP 5.6. To up locally a server with this version is necessary uninstall dev PHP packages because Deployer doesn't work in PHP version minor than 7. The images must be built to change the PHP version.

#### Build the images

    $ docker-compose -f docker-compose.yml -f docker-compose.php56.yml build --pull

#### Uninstall packages

    $ composer install --no-dev

#### Up the server

##### Linux

    $ docker-compose -f docker-compose.yml -f docker-compose.php56.yml up server watch

##### Mac

    $ docker-compose -f docker-compose.yml -f docker-compose.php56.yml -f docker-compose.mac.yml up server watch

#### Back to PHP 7.2

    $ composer install
    $ docker-compose build --pull

## PHP Code Standards

The project is configured to validate the quality of the PHP code. It is used the [WordPress Coding Standards](https://make.wordpress.org/core/handbook/best-practices/coding-standards/php/) as base to code validation.

The validation isn't done by the _watch_ service. Because is a PHP execution and for now isn't wrappered by the _node_ image. Execute this command to run the code sniffer:

    $ docker-compose run --rm php phpcs

And to fix some warnings using the _PHP Code Beautifier and Fixer_, execute:

    $ docker-compose run --rm php phpcbf

## Linters

The project is configured to validate the quality of the Stylus and Javascript code

	$ docker-compose run --rm node grunt lint

## Database dump

### Import

A database dump can be found on branch `data`, you can import with the following commands:

	$ git checkout origin/data app/initdb
	$ wp db reset --yes
	$ zcat app/initdb/initdb.sql.gz | wp db import -
