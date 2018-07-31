<?php

namespace App\Bootstrap;

class Setting
{

    private $di;

    public function __construct($di)
    {
        $this->di = $di;
    }

    public function boot()
    {
        if (isset($this->di->get('config')->timezone)) {
            ini_set("date.timezone", $this->di->get('config')->timezone);
        }

        if (isset($this->di->get('config')->sandbox)) {
            switch ($this->di->get('config')->sandbox) {
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
