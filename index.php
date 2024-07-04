<?php
define('BASE_PATH', "/clince/");


spl_autoload_register(function ($classes){
    require __DIR__ . "/app/controllers/" . $classes . ".php"  ;
}) ;
require __DIR__ . "/vendor/Mysqlidb/MysqliDb.php" ;
require __DIR__ . "/config/config.php" ;

$config = require __DIR__ . "/config/config.php" ;
$db = new MysqliDb(
    $config['host'],
    $config['username'],
    $config['password'],
    $config['dbname']
) ;
$patcon=new PatController ($db);
$request = $_SERVER["REQUEST_URI"];
// var_dump($request);
switch ($request) :
    case BASE_PATH :
        echo "d";
    break ;
    case BASE_PATH . 'pat/addpat':
        $patcon->addpat();
        echo "dd";
        break;
        
endswitch ;