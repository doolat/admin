<?php
if (isset($_GET['action'])) {
    $action = $_GET['action'];
}else {
    $action = 'index';
}
switch ($action) {
    case 'index':
        $db->isAdmin();
        $db->index($_GET['search'],$_GET['sort']);
        break;
    case 'create':
        $db->isAdmin();
        require_once 'view/create.php';
        break;
    case 'show':
        $db->isAdmin();
        if ($_GET['id']) {
            $user = $db->getUser($_GET['id']);
        }else {
            $user = [];
        }
        require_once 'view/edit.php';
        break;
    case 'add':
        $db->isAdmin();
        $db->addUser();
        break;
    case 'edit':
        $db->isAdmin();
        $db->editUser($_GET['id']);
        break;
    case 'delete':
        $db->isAdmin();
        $db->removeUser($_GET['id']);
        break;
    case 'logout':
        unset($_SESSION['user']);
        require_once 'view/login.php';
        break;
    case 'signin':
        $db->login();
        break;
    case 'describe':
        $db->isAdmin();
        $user = $db->getUser($_GET['id']);
        require_once 'view/describe.php';
        break;
    default:
        require_once 'view/pageNotFound.php';
        break;
}