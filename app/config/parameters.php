<?php
if (getenv('OPENSHIFT_APP_NAME')) {
  $container->setParameter('database_host', getenv("OPENSHIFT_MYSQL_DB_HOST"));
  $container->setParameter('database_port', getenv("OPENSHIFT_MYSQL_DB_PORT"));
  $container->setParameter('database_user', getenv("OPENSHIFT_MYSQL_DB_USERNAME"));
  $container->setParameter('database_password', getenv("OPENSHIFT_MYSQL_DB_PASSWORD"));
}
