<?php
namespace Front;

use Front\Controller\IndexController;
use Front\Controller\CategoryController;
use Front\Controller\JobController;

use Front\Model\Job;
use Front\Model\Category;
use Zend\Mvc\MvcEvent;
use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\Controller\ControllerManager;

class Module
{
	public function onBootstrap(MvcEvent $e)
	{
		$e->getApplication()->getServiceManager()->get('translator');
		$eventManager        = $e->getApplication()->getEventManager();
		$moduleRouteListener = new ModuleRouteListener();
		$moduleRouteListener->attach($eventManager);
	}
	
	public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'Front\Service\JobService' => 'Front\Service\Factory\JobServiceFactory',
                'Front\Service\CategoryService' => 'Front\Service\Factory\CategoryServiceFactory',
            ),
        );
    }

    public function getControllerConfig() {
        return array(
            'factories' => array(
                'Front\Controller\Category'    => function(ControllerManager $cm) {
                    $sm   = $cm->getServiceLocator();
                    $category = $sm->get('Front\Service\CategoryService');
                    $job = $sm->get('Front\Service\JobService');
                    $controller = new CategoryController($category, $job);
                    return $controller;
                },
                'Front\Controller\Job'    => function(ControllerManager $cm) {
                    $sm   = $cm->getServiceLocator();
                    $category = $sm->get('Front\Service\CategoryService');
                    $job = $sm->get('Front\Service\JobService');
                    $controller = new JobController($category, $job);
                    return $controller;
                },
                'Front\Controller\Index'    => function(ControllerManager $cm) {
                    $sm   = $cm->getServiceLocator();
                    $category = $sm->get('Front\Service\CategoryService');
                    $job = $sm->get('Front\Service\JobService');
                    $controller = new IndexController($category, $job);
                	return $controller;
                },
            ),
        );
    }
}