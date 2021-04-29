<?php
/**
 * @author Chibuzor Ogbu <chibuzorogbu@gmail.com>
 * @created 2021-04-27
 * @copyright ©2021. All rights reserved.
 */

require __DIR__.'/vendor/autoload.php';


$runner = new \App\Console($argv);
$runner->run();
