<?php
// bootstrap.php
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

//$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
//$dotenv->load();

require_once "vendor/autoload.php";

// Create a simple "default" Doctrine ORM configuration for Annotations
$isDevMode = true;
$proxyDir = null;
$cache = null;
$useSimpleAnnotationReader = false;
$configuration_orm_metadata = Setup::createAnnotationMetadataConfiguration(
    array(
        __DIR__."/src"
    ),
    $isDevMode,
    $proxyDir,
    $cache,
    $useSimpleAnnotationReader
);

$db_connection_string = array(
    'url' => getenv('CONNECTION_STRING'),
);

// obtaining the entity manager
$entityManager = EntityManager::create(
    $db_connection_string,
    $configuration_orm_metadata
);
