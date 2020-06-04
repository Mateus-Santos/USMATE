<?php
/* Start Session */
if(!session_id()) session_start();
/* Start illuminate database */
$conf = require_once __DIR__ . "/../app/database.php";
if($conf['baseModel'] == 'illuminate'){

    $capsule = new Illuminate\Database\Capsule\Manager;

    if($conf['driver'] == 'mysql'){
        $capsule->addConnection([
            'driver'    => 'mysql',
            'host'      => $conf['mysql']['host'],
            'database'  => $conf['mysql']['database'],
            'username'  => $conf['mysql']['user'],
            'password'  => $conf['mysql']['pass'],
            'charset'   => $conf['mysql']['charset'],
            'collation' => $conf['mysql']['collation'],
            'prefix'    => '',
        ]);

    }elseif($conf['driver'] == 'sqlite'){
        $capsule->addConnection([
            'driver'    => 'mysql',
            'database'  => __DIR__ . "/../storage/database/" . $conf['sqlite']['database']
        ]);

        $capsule->bootEloquent();
    }


}
/* Start routes */
$routes = require_once __DIR__ . "/../app/routes.php";
$route = new \Core\Route($routes);