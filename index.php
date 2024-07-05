<?php
define('BASE_PATH', "/clince/");


spl_autoload_register(function ($classes) {
    require __DIR__ . "/app/controllers/" . $classes . ".php";
});
require __DIR__ . "/vendor/Mysqlidb/MysqliDb.php";
require __DIR__ . "/config/config.php";

$config = require __DIR__ . "/config/config.php";
$db = new MysqliDb(
    $config['host'],
    $config['username'],
    $config['password'],
    $config['dbname']
);

$request = $_SERVER["REQUEST_URI"];

$patcon = new PatController($db);
$res = new resController($db);
$doc = new docController($db);
$spe = new specController($db);
$feedb = new feedbController($db);
$date = new dateController($db);


switch ($request):
    case BASE_PATH:
        $date->todaysDates();
        break;
    case BASE_PATH . 'pat/addpat':
        $patcon->addpat();
        break;
    case BASE_PATH . 'pat/showall':
        $patcon->showpats();
        break;
    case BASE_PATH . 'pat/search':
        $patcon->searchpatrs($_POST['name']);
        break;
    case BASE_PATH . 'spec/addspec':
        $spe->addspec();
        break;
    case BASE_PATH . 'feedb/add':
        $feedb->addfeedb();
        break;
    case BASE_PATH . "doc/add":
        $doc->addDoc();        
    break ;
    case BASE_PATH . 'admin/login':
        $admin->login();
        break;
endswitch ;

if(!empty(($_GET["id"]))){
    switch ($request) :
    case BASE_PATH .'pat/one?id='.$_GET["id"]:
        $patcon -> onepat($_GET["id"]);
        break;

endswitch;
if (!empty(($_GET["id"]))) {
    switch ($request):
        case BASE_PATH . 'pat/one?id=' . $_GET["id"]:
            $patcon->onepat($_GET["id"]);
            break;
        case BASE_PATH . "res/add?id=" . $_GET["id"]:
            $res->add($_GET['id']);
            break;
        case BASE_PATH . "res/show?id=" . $_GET["id"]:
            $res->show($_GET['id']);
            break;
    endswitch;
} elseif (!empty($_GET["id_doctoe"])) {
    switch ($request):
        case BASE_PATH . 'feedb/feedbdoc?id_doctoe=' . $_GET["id_doctoe"]:
            $feedb->getfeedbyIdDoc($_GET["id_doctoe"]);
            break;
    endswitch;
}
