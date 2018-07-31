<?php

namespace App\Bootstrap;

class Setting
{

    public function __construct($di)
    {
        if (isset($di->get('config')->timezone)) {
            ini_set("date.timezone", $di->get('config')->timezone);
        }

        if (isset($di->get('config')->sandbox)) {
            switch ($di->get('config')->sandbox) {
                case true:
                    $whoops = new \Whoops\Run;
                    $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
                    $whoops->register();
                    error_reporting(E_ALL);
                    break;
                default:
                    header_remove('X-Powered-By');
                    error_reporting(0);
            };
        }
    }

}
