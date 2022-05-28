# Ejemplo restauracion de BD local desde archivos gzipeados de estructura y datos por separado

Antes de ejecutar `restore_mysql_local_db.sh` debe editarlo para modificar los datos de acceso a la BD

# Local Mysql DB Conection
`MYSQL_HOST='localhost'`<br>
`MYSQL_USER='root'`<br>
`MYSQL_PASS='xxxx'`<br>

# Name of Test Database
`DB_NAME='test'`

El ejemplo crea una tabla de usuarios con 2 registros:

```
--
-- Table structure for table `users`
--
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username_index` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--
INSERT INTO `users` VALUES (1,'exampleuser1','$apr1$llKJEzNr$NFKu2uDwvNx6n2qPalkF01');
INSERT INTO `users` VALUES (2,'exampleuser2','$apr1$OTpT.BkV$lHU9Sviy82RqZP5cD.Cuo.');
```
