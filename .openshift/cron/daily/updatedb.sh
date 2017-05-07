#!/bin/sh
cd /tmp
curl https://coa.inducks.org/inducks/isv.tgz -o isv.tgz
curl https://coa.inducks.org/inducks/isv/createtables.sql -o createtables.sql
tar xfz isv.tgz
echo "SET names 'utf8'; SOURCE createtables.sql;"|mysql -f -u $OPENSHIFT_MYSQL_DB_USERNAME -h $OPENSHIFT_MYSQL_DB_HOST --password=$OPENSHIFT_MYSQL_DB_PASSWORD --default-character-set=utf8
rm createtables.sql
rm -Rf isv*

