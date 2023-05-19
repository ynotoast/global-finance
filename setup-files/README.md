# How to setup the website in a new enviroment


## Setting up postgres db

1. Install postgres on Linux:
   1. `sudo apt update`
   2. `sudo apt install wget ca-certificates`
   3. `sudo apt install postgresql postgresql-contrib`
   4. `sudo systemctl start postgres.service`
   5. check its running with: `service postgresql status`
2. If you want to install on windows, just install off the web.
3. Create a postgreSQL database with the name `gfdb` and owner of `postgres`
4. Make sure the postgres user has a password of `toast`. (on linux use `sudo passwd postgres` while NOT logged into postgres)
5. Import the database using the `gfdb.backup` file:
   - pgadmin: use the restore function
   - Not sure how to import a .backup file using CLI so search it up and lmk.
  
## Setup PHP 
1. Install PHP
   1. Linux: 
      1. `apt update` 
      2. `sudo apt install php`
      3. You may have to install openssl and php-pgsql, not sure tho. I would say dont worry abt it for now, and see if it works. 
      4. Update `php.ini` file found in `etc/php/obvious from there...`
      5. Restart computer
   2. Windows: 
      1. install off the web
      2. Update enviroment variables (not sure how to do that rn, but its on the web)
      3. Update `php.ini` to enable pgsql extention(s) and openssl
      4. Theres probably more, idk tho so watch a tutorial xxx
   

## Install dependencies
1. in the root directory of the project use command `composer update` to install dependencies
   
## Update environment variables
1. create `.env` file
2. Populate it with the correct data. Use `.env.example` for inspiration.

## VS code extensions to get the "live stuff" working
- [PHP server](https://marketplace.visualstudio.com/items?itemName=brapifra.phpserver)
- [Live server](https://marketplace.visualstudio.com/items?itemName=ritwickdey.LiveServer)


## When you're ready...
1. Open the website by opening the `index.php` file in vscode. 
2. Open the context menu and click "serve project".
3. Press go live at the bottom right.
4. Should be running on localhost port 3000.