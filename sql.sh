#!/bin/bash

if [ ! -n $1 ]; then
	echo "1"
	echo "Usage : ./sql.sh [export | import] database"
	exit 0
fi

if [ ! -n $2 ]; then
	echo "2"
	echo "Usage : ./sql.sh [export | import] database"
	exit 0
fi

if [ $1 = "export" ]; then
	echo "Exporting DataBase ..."
	mysqldump --databases -u root -p $2 > $2.sql
elif [ $1 = "import" ]; then
	echo "Importing DataBase ..."
	mysql -u root -p $2 < $2.sql
else
	echo "Usage : ./sql.sh [export | import] database"
fi
echo "Done"

