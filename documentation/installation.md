# Installation

## Server Requirements

Laradocs has a few system requirements. All of these requirements are satisfied if you are already running **Laravel 5.3**.

* PHP >= 5.6.4
* OpenSSL PHP Extension
* PDO PHP Extension
* Mbstring PHP Extension
* Tokenizer PHP Extension
* XML PHP Extension

## Installing Laradocs

Laradocs utilitizes [Composer](https://getcomposer.org/) to manage its dependencies. So, before using Laradocs, make sure you have Composer installed on your machine.

### Via Github via Clone

First you will need to have [Git](http://https://git-scm.com/) installed on your machine. You will need to clone the repository with the following command:

```
git clone https://github.com/tutelagesystems/laradocs.git
```

### Via Zipfile

You can download any of the releases from the (Releases)[https://github.com/tutelagesystems/laradocs/releases] tab on Github.

Extract the entire contents of this directory into the folder of your choice.

### Installation

Once all files have been copied in you will need run `Composer` to install of the dependencies. You can do this with `composer install`

After composer has finished you will want to create a `.env` file. You can do this easily by copying the `.env.example` and renaming it to `.env`

Next you will want to use `php artisan key:generate` to generate a new key for the project.

Finally you will need to edit the `.env` file and provide the correct database credentials for your system.


## Configuration

All of the configuration files for Laradocs are stored in the `config` directory.

### Directory Permissions

After installing Laradocs, you may need to configure some permissions. Directories within the `storage` and the `bootstrap/cache` directories should be writable by your webserver. This is a Laravel requirement and it will not run if they are not.

### Database

The database configuration comes from the `.env` file located within your application.