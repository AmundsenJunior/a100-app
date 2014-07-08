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
