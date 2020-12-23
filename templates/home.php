<?php

require_once __DIR__ . './../autoload.php';

session_start();

$action = isset($_GET['action']) ? $_GET['action'] : null;

switch ($action) {
    case 'hardware-add':
        HardwareController::show();
        break;
        // case 'invoice-show':
        //     InvoiceController::show();
        //     break;
        // case 'login-set':
        //     LoginController::set();
        //     break;
        // case 'login':
        //     LoginController::index();
        //     break;
        // case 'logout':
        //     LoginController::logout();
        //     break;
    default:
        header('Location: home.php?action=hardware-add');
        break;
}
