#!/bin/sh
cd /tmp
curl -kL https://inducks.org/inducks/isv.tgz -o isv.tgz
curl -kL https://inducks.org/inducks/isv/createtables.sql -o createtables.sql
tar xfz isv.tgz
echo "SET names 'utf8'; SOURCE createtables.sql;"|mysql -f -u $MYSQL_USER -h ${MYSQL_HOST:-localhost} --password=$MYSQL_PASSWORD --default-character-set=utf8
rm createtables.sql
rm -Rf isv*

