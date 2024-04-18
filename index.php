<?php

require_once __DIR__ . '/bootstrap.php';

require_once __DIR__ . '/src/Controller/ApiController.php';

$controller = new ApiController($entityManager);
$controller->handleRequest();
?>