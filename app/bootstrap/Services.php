<?php

namespace App\Bootstrap;

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
        //dd($this->di->get('config')->db->toArray());
    }

}
