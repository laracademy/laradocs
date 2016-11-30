# Installation

## Server Requirements

Laradocs like Laravel has a few system requirements, and these are all because of the framework itself. If you can run **Laravel 5.3** then you can run Laradocs. Please ensure that your environment meets the following:

* PHP >= 5.6.4
* OpenSSL PHP Extension
* PDO PHP Extension
* Mbstring PHP Extension
* Tokenizer PHP Extension
* XML PHP Extension
* Composer

## Installing Laradocs

Installing Laradocs is extremely simple and you can do it one of two ways. Please pick the method that best fits your needs.

### Github

To install Laradocs from Github you will need to utilize [Git](http://https://git-scm.com/) to pull down the project with the clone command `git clone https://github.com/tutelagesystems/laradocs.git`

### Zip File

With each release Laradocs the code will be tagged with a specific version. You can grab the latest version on the [Releases](https://github.com/tutelagesystems/laradocs/releases) tab.

You will need to extract all of the files within the zip into a directory then install the dependencies with **Composer**

## Installing Dependencies

Laradocs like Laravel uses multiple dependencies to do the job. Once you have install Laradocs you will need to run [Composer](https://getcomposer.org/) to install these dependencies. You can run `composer install` to get the process started.

## Directory Permissions

After installing Laradocs, you may need to configure some permissions. Directories within the `storage` and the `bootstrap/cache` directories should be writable by your webserver. This is a Laravel requirement and it will not run if they are not.

### Database

The database configuration comes from the `.env` file located within your application.