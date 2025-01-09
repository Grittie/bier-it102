# bier :)

## Getting Started
- Install PHP, this can be done by going to the [official PHP website](https://www.php.net/downloads.php)
- With php you also need to install php-xml, that can be installed with this command `sudo apt-get install php-xml`
- Install `sudo apt-get install php-curl`
- Install `sudo apt install php-cli unzip`
- install `curl https://raw.githubusercontent.com/creationix/nvm/master/install.sh | bash`
- Restart the command line so all the changes get applied
- Now open the project in VSCode
- In VSCode open the terminal and install composer `sudo apt install composer`
- After this is installed, use `composer update` and `composer install`, this will now install all the required packages
- Now use `npm i` to install all the dependencies
- In the web folder, copy the .env-example file into a .env and fill in the correct values
    - Change the `APP_NAME` to `beertracker`
    - Change the `DB_DATABASE` to `beertracker`
    - Change the `DB_USERNAME` to your db username
    - Change the `DB_PASSWORD` to your db password
- You will need to have MySQL running on your localhost. If this is not the case then download and install the latest [mysql-installer-community](https://dev.mysql.com/downloads/installer/)
- After installing, you will get the option to install the MySQL Server.
- Now you should have both `MySQL Workbench` and `MySQL Server`
- Now go to your MySQL Workbench and create a connection with your database. 
    - `Hostname`: `127.0.0.1`
    - `Port`: `3306`
    - `Username`: your username
    - `Password`: your password
- Create a new Schema called `beertracker`
- Now go to VSCode, and execute: `php artisan migrate:fresh --seed`, this should fill up the database.