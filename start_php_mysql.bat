@echo off

set package_dir=%cd%
set mariadb_dir=%package_dir%\mariadb
set php_dir=%package_dir%\php
set db_dir=%package_dir%\db
set web_dir=%package_dir%\www

rem MariaDB
start "" "%mariadb_dir%\bin\mysqld.exe" --console --datadir="%db_dir%"  --character-set-server=utf8 --collation-server=utf8_general_ci  --init_connect="SET NAMES 'utf8'"

rem Web
echo Web root: "%web_dir%"
"%php_dir%\php" -S localhost:80 -t "%web_dir%"
