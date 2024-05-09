<?php

use Illuminate\Database\Capsule\Manager as Capsule;
use App\Init;

$capsule = new Capsule;
global $wpdb;

$capsule->addConnection([
    'driver' => 'mysql',
    'host' => DB_HOST,
    'database' => DB_NAME,
    'username' => DB_USER,
    'password' => DB_PASSWORD,
    'charset' => DB_CHARSET,
    'collation' => $wpdb->collate,
    'prefix' => $wpdb->prefix,
]);
$capsule->bootEloquent(); // Database Eloquent 

// Base Instance
Init::getInstance();
