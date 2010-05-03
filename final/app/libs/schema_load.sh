mysqldump -uroot -p --add-drop-table --no-data n342 | grep ^DROP | mysql -uroot n342 
mysql -uroot -p n342 < app/libs/create.sql