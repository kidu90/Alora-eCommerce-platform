<?php
session_start();

require_once 'functions.php';

$route = isset($_GET['route']) ? $_GET['route'] : 'home';

// Routing logic
switch ($route) {
    case 'home':
        require 'views/home.php';
        break;

    case 'about':
        require 'views/about.php';
        break;

    case 'shop':
        require 'views/shop.php';
        break;

    case 'contact':
        require 'views/contact.php';
        break;

    case 'subscription':
        require 'views/subscription.php';
        break;

    case 'login':
        require 'login.php';
        break;

    case 'profile':
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?route=login');
            exit();
        } else {
            require 'views/profile.php';
        }
        break;

    case 'cart':
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?route=login');
            exit();
        } else {
            require 'views/cart.php';
        }
        break;

    case 'register':
        require 'views/register.php';
        break;

    case 'logout':
        session_destroy();
        header('Location: index.php?route=home');
        exit();
        break;

    case 'single_product':
        if (!isset($_GET['id']) || empty(trim($_GET['id']))) {
            header('Location: '); // Redirect to a 404 page
            exit();
        }
        require 'views/single_product.php';
        break;

    default:
        require 'views/404.php';
        break;
}
