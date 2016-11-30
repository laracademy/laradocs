# Configuration

To get Laradocs up and running, just like any Laravel project you will need to edit the `.env` file that is shipped with the project.

> Missing .env file?

If for some reason the .env file is missing you can copy the `.env.example` file and name it `.env`

## Environment Variables

The `.env` file is used to control how Laravel will function. Inside this file you can find the settings for the database.

### Database Settings

Laradocs uses a database to hold all of the information.

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

## Site Settings

Some settings can be controlled online through the administration portal. You will need an account to modify these values and if you are unsure of how to do this please see the **User Configuration** section.

|Setting|Description|
|--|--|
|Site Name|The name of the website|
|Site Theme|The bootstrap theme to use for the website|
|Github Username|Your Github username if you plan on pulling files in from github|
|Github Access Token|The token used to connect to Github|
