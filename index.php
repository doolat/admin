<?php
session_start();
require_once 'model/user.php';

$db = new user();

if (isset($_GET['controller'])) {
    $controller = $_GET['controller'];
}else {
    $controller = '';
}
switch ($controller) {
    case 'user':
        require_once 'controller/index.php';
        break;
    default:
        require_once 'controller/index.php';
        break;
}