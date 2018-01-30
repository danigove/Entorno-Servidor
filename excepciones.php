<?php
// declare(strict_types=1);
try {
    //$x = strlen();
    4/0;
    throw new TypeError("Error horrible");
    echo "Se ha saltado la excepción";
} catch (Exception $e) {
    echo "Se ha provocado el siguiente error: " . $e->getMessage() . PHP_EOL;
} catch (TypeError $e){
    echo "Error de typeo" . PHP_EOL;
}
