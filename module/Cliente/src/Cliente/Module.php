<?php
namespace Cliente;

use LosBase\Module\AbstractModule;
use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

class Module extends AbstractModule
{

    public function onBootstrap(MvcEvent $e)
    {

        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);

        //print "<pre>"; print_r($moduleRouteListener);
        //die();
    }

}
