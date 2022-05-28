#!/bin/bash

# Local Mysql DB Conection
MYSQL_HOST='localhost'
MYSQL_USER='root'
MYSQL_PASS='xxxx'

# Name of Test Database
DB_NAME='test'

# Restauration of structure and data from gzipped separated files, with take elapsed time
time {
    echo "[INFO] Restore $DB_NAME ..."
    mysql -h $MYSQL_HOST -u $MYSQL_USER -p$MYSQL_PASS -BNe "DROP DATABASE IF EXISTS $DB_NAME" 2>&1 | grep -v 'Warning'
    mysql -h $MYSQL_HOST -u $MYSQL_USER -p$MYSQL_PASS -BNe "CREATE DATABASE $DB_NAME" 2>&1 | grep -v 'Warning'
    echo -e "\t Restore structure ..."
    zcat 1.db.struct.sql.gz | mysql -h $MYSQL_HOST -u $MYSQL_USER -p$MYSQL_PASS $DB_NAME 2>&1 | grep -v 'Warning'
    echo -e "\t Restore data ..."
    zcat 2.db.data.sql.gz | mysql -h $MYSQL_HOST -u $MYSQL_USER -p$MYSQL_PASS $DB_NAME 2>&1 | grep -v 'Warning'
}
