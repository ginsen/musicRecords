# musicRecords
Proof web with approach DDD

## Install
    cd /var/www/
    git clone https://github.com/ginsen/musicRecords.git
    cd ./musicRecords
    composer install

## Configuring the Database 

The database connection information is stored as an environment variable called `DATABASE_URL`. 
You can find and customize this inside .env:

    # .env
    
    # customize this line!
    DATABASE_URL="mysql://db_user:db_password@127.0.0.1:3306/db_name"
    
    # to use sqlite:
    # DATABASE_URL="sqlite:///%kernel.project_dir%/var/app.db"

Now that your connection parameters are setup, you can create the `db_name` database, 
load schema database and load some fixtures registers to show this demo.

Run this commands:

    # create database
    php bin/console doctrine:database:create
    
    # load schema database
    php php bin/console doctrine:database:create
    
    # load fixtures registers
    php bin/console doctrine:fixtures:load

## Run virtual web server

    php bin/console server:run

Open your browser and navigate to `http://localhost:8000/`

## Run Unit test

Launch in your terminal this command:

    bin/phpunit
