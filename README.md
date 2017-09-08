# todo
Create .htaccess file in main directory with this text:

AddDefaultCharset utf-8

RewriteEngine on
RewriteBase /

RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d

RewriteRule ^(.*)$ index.php
