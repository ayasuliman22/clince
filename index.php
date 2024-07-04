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

$res = new resController($db) ;
$doc = new docController($db) ;


switch ($request) :
    case BASE_PATH :
        echo "d";
    break ;
    case BASE_PATH . "doc/add" :
        $doc -> addDoc() ;
    break ;
    case BASE_PATH . "res/add?id=" . $_GET["id"] :
        $res -> add($_GET['id']) ;
    break ;
    case BASE_PATH . "res/show?id=" . $_GET["id"] :
        $res -> show($_GET['id']) ;
    break ;
endswitch ;