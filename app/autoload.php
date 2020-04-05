<?php
define('ROOT_DIRECTORY', realpath(dirname(__DIR__)));
define('INCLUDE_DIRECTORY', ROOT_DIRECTORY);
set_include_path(INCLUDE_DIRECTORY);
spl_autoload_extensions(".php");
spl_autoload_register();




