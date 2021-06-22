#!/bin/bash

#Para ejecutar el script deberemos tener la carpeta WalkingGes dentro de /var/www/html
#y ejecutar el script con permisos de administrador

#Damos permisos a la carpeta WalkingGes
chmod -R 777 /var/www/html/WalkingGes

#Creamos un nuevo usuario y le damos privilegios
mysql -u root -e "		uninstall plugin validate_password;
				CREATE USER 'walking'@'localhost' IDENTIFIED BY 'walking1234';
				GRANT ALL PRIVILEGES ON * . * TO 'walking'@'localhost';" 2>errLog
error=$(cat errLog)
rm errLog;
#Comprobamos si ha habido algún error y si le ha habido ejecutamos otra instrucción para crear el usuario
if [ -n "$error" ];
then
	mysql -u root -e "	CREATE USER 'walking'@'localhost' IDENTIFIED BY 'walking1234';
				GRANT ALL PRIVILEGES ON * . * TO 'walking'@'localhost';" 2>errLog
fi

error=$(cat errLog)
rm errLog;
if [ -n "$error" ];
then
	echo "Ha habido algún error al crear el usuario: " $error
fi

#Instalamos la base de datos de nuestro website
mysql -u root -e "	source /var/www/html/WalkingGes/scripts/walkingges.sql;" 2>errLog

error=$(cat errLog)
rm errLog;
#Comprobamos si ha habido algún error al instalar la base de datos
if [ -n "$error" ];
then
	echo "Ha habido algún error al instalar la base de datos"
fi