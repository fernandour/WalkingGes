@echo off

mysql -u root -e "	CREATE USER 'walking'@'localhost' IDENTIFIED BY 'walking1234';"
mysql -u root -e "	GRANT ALL PRIVILEGES ON * . * TO 'walking'@'localhost';"

exit