<?php
if (getenv('OPENSHIFT_APP_NAME')) {
  $container->setParameter('database_path', getenv("OPENSHIFT_DATA_DIR") . "/coa.sqlite");
}
