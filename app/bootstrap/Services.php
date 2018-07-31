<?php

namespace App\Bootstrap;


use Illuminate\Database\Capsule\Manager as Capsule;

class Services
{

    private $di;

    public function __construct($di)
    {
        $this->di = $di;
        $this->loader();
    }

    public function loader()
    {
        $methods = get_class_methods($this);
        foreach ($methods as $m) {
            if (strpos($m, 'set_') === 0) {
                $this->$m();
            }
        }
    }

    public function set_db()
    {
        $config = $this->di->get('config')->db->toArray();
        $capsule = new Capsule;
        $capsule->addConnection([
            'driver'    => 'mysql',
            'host'      => $config['host'],
            'database'  => $config['dbname'],
            'username'  => $config['user'],
            'password'  => $config['pass'],
            'charset'   => $config['chaset'],
            'prefix'    => $config['prefix'],
            'collation' => 'utf8mb4_general_ci',
        ]);
        $capsule->setAsGlobal();
        $capsule->bootEloquent();
    }

}
