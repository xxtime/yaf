<?php

class Bootstrap extends Yaf_Bootstrap_Abstract
{

    public function _initLoader(Yaf_Dispatcher $dispatcher)
    {
        include APP_PATH . '/vendor/autoload.php';
    }

    public function _initConfig(Yaf_Dispatcher $dispatcher)
    {
        $config = Yaf_Application::app()->getConfig();
        Yaf_Registry::set("config", $config);
    }

    public function _initBootstrap()
    {
        (new \App\Bootstrap\Services($this))->boot();
        (new \App\Bootstrap\Setting($this))->boot();
    }

    public function _initRoute(Yaf_Dispatcher $dispatcher)
    {
        $router = Yaf_Dispatcher::getInstance()->getRouter();
        if (isset($router->routes)) {
            $router->addConfig(Yaf_Registry::get("config")->routes);
        }
    }

    public function _initDefaultName(Yaf_Dispatcher $dispatcher)
    {
        $dispatcher->setDefaultModule("Index")->setDefaultController("Index")->setDefaultAction("index");
    }

    public function _initView(Yaf_Dispatcher $dispatcher)
    {
        // $dispatcher->disableView();
    }

    public function set($name, $value)
    {
        return Yaf_Registry::set($name, $value);
    }

    public function get($name)
    {
        return Yaf_Registry::get($name);
    }

}
