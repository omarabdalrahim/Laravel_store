<?php

 return [
    [
        'icon' => 'nav-icon fas fa-tachometer-alt',
        'route' => 'dashboard',
        'title' => 'Dashboard',
        'active' => 'dashboard',
    ],
    [
        'icon' => 'fas fa-tags nav-icon',
        'route' => 'categories.index',
        'title' => 'Categories',
        'badge' => 'New',
        'active' => 'categories.*',
        'ability' => 'categories.view',
    ],
    [
        'icon' => 'fas fa-box nav-icon',
        'route' => 'products.index',
        'title' => 'Products',
        'active' => 'products.*',
        'ability' => 'products.view',
    ],
    [
        'icon' => 'fas fa-receipt nav-icon',
        'route' => 'categories.index',
        'title' => 'Orders',
        'active' => 'dashboard.orders.*',
        'ability' => 'orders.view',
    ],
    [
        'icon' => 'fas fa-shield nav-icon',
        'route' => 'dashboard',
        'title' => 'Roles',
        'active' => 'dashboard.roles.*',
        'ability' => 'roles.view',
    ],
    [
        'icon' => 'fas fa-users nav-icon',
        'route' => 'dashboard',
        'title' => 'Users',
        'active' => 'dashboard.users.*',
        'ability' => 'users.view',
    ],
    [
        'icon' => 'fas fa-users nav-icon',
        'route' => 'dashboard',
        'title' => 'Admins',
        'active' => 'dashboard.admins.*',
        'ability' => 'admins.view',
    ],

 ];
?>
