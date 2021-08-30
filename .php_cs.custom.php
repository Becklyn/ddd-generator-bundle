<?php declare(strict_types=1);

$config = include "vendor-bin/test/vendor/becklyn/php-cs/.php_cs.dist.php";

$config->setRules([
    // This override will prevent that the DddEntityTestMaker classes are marked as @internal and final
    "php_unit_internal_class" => false,
]);

return $config;
