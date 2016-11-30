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

After the cloning has been completed, you will need to use composer to install of the its dependencies. Ensure that you are `inside` the directory that you cloned.

```
composer install
```

### Via Zipfile

You can download any of the releases from the (Releases)[https://github.com/tutelagesystems/laradocs/releases] tab on Github. You will need to extract all of the files that are inside of the zip file and then using [Composer](https://getcomposer.org/) install all of the dependencies.

```
composer install
```

## Configuration

All of the configuration files for Laradocs are stored in the `config` directory.

### Directory Permissions

After installing Laradocs, you may need to configure some permissions. Directories within the `storage` and the `bootstrap/cache` directories should be writable by your webserver. This is a Laravel requirement and it will not run if they are not.

### Application Key

The next thing you should do is set your application key to a random string. If you installed Laradocs using Composer this will be done automatically, if not you can run `php artisan key:generate` to generate a new key.