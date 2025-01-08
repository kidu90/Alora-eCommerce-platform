<?php
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

    case 'register':
        require 'register.php';
        break;


    case 'logout':
        session_destroy();
        header('Location: index.php?route=login'); // Redirect to login after logout
        break;

    default:
        require '404.php';
        break;
}
