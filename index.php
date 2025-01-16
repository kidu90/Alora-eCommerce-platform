<?php
session_start();

require_once 'functions.php';

// Define the route based on the URL parameter, default to 'home'
$route = isset($_GET['route']) ? $_GET['route'] : 'home';

// Routing logic
switch ($route) {
    case 'home':
        require 'home.php';
        break;

    case 'about':
        require 'about.php';
        break;

    case 'shop':
        require 'shop.php';
        break;

    case 'contact':
        require 'contact.php';
        break;

    case 'subscription':
        require 'subscription.php';
        break;

    case 'login':
        require 'login.php';
        break;

    case 'profile':
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?route=login');
            exit();
        } else {
            require 'profile.php';
        }
        break;

    case 'cart':
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?route=login');
            exit();
        } else {
            require 'cart.php';
        }
        break;

    case 'register':
        require 'register.php';
        break;

    case 'logout':
        session_destroy();
        header('Location: index.php?route=home');
        exit();
        break;

    case 'single_product':
        // Ensure the product ID is provided in the URL
        if (!isset($_GET['id']) || empty(trim($_GET['id']))) {
            header('Location: '); // Redirect to a 404 page
            exit();
        }
        require 'single_product.php';
        break;

    default:
        require '404.php';
        break;
}
