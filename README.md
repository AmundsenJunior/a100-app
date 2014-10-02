This is the LiNeaR Solutions implementation of the A100 Apprentice Application form, for the Spring 2014 cohort of the A100 program.

The team, LiNeaR Solutions, is comprised of:
[Solomon Li](https://github.com/soloub)
[Thaddeus Ng](https://github.com/ThaddeusANg)
[Scott Russell](https://github.com/AmundsenJunior)

## .gitignore

`.gitignore` currently excludes the `.DS_Store` and `Thumbs.db` files from Mac and Windows file systems. `admin/cred_ext.php` excludes the external administrative MySQL credentials. To build `cred_ext.php`, consult one of the LiNeaR Solutions team for the credentials, and create the file with the following information:
```
<?php
    DEFINE('DB_USERNAME', 'username');
    DEFINE('DB_PASSWORD', 'password');
    DEFINE('DB_HOST', 'hostname[:port]');
    DEFINE('DB_APP_DATABASE', 'applications_db');
    DEFINE('DB_FORM_DATABASE', 'forms_db');
?>
```
This file should be placed within the admin directory, as it is used by that directory's files, via `include` statements.

## Site Deployment
***The following assumes you've first deployed [the amp-test site](https://github.com/AmundsenJunior/amp-test) to the same machine.***

Clone this repo to local:
```
$ cd ~/dev
$ git clone https://github.com/AmundsenJunior/a100-app.git
```

Create a symbolic link to the site directory in ```/var/www```:
```
$ sudo ln -sT ~/dev/a100-app /var/www/a100-app
```

Copy the amp-test Apache config, and update the pointer for ```DocumentRoot```:
```
$ sudo cp /etc/apache2/sites-available/amp-test /etc/apache2/sites-available/a100-app
$ sudo nano /etc/apache2/sites-available/a100-app
    DocumentRoot /var/www/a100-app
```

Copy the external credentials from your amp-test directory, and update for the two DBs this site uses:
```
$ cp ~/dev/amp-test/db_scripts/cred_ext.php ~/dev/a100-app/admin/cred_ext.php
$ nano ~/dev/a100-app/admin/cred_ext.php
    DEFINE('DB_APP_DATABASE', 'applications_db');
    DEFINE('DB_FORM_DATABASE', 'forms_db');
```

Execute the database build scripts:
```
$ php ~/dev/a100-app/admin/create_app_form_dbs.php
$ php ~/dev/a100-app/admin/create_application_tables.php
$ php ~/dev/a100-app/admin/create_form_tables.php
$ php ~/dev/a100-app/admin/insert_form_data.php
```

Go to http://localhost/phpmyadmin to confirm.

Activate the a100-app site in Apache:
```
$ sudo a2dissite amp-test
$ sudo a2ensite a100-app
$ sudo service apache2 reload
```

Go to http://localhost/ to confirm.
