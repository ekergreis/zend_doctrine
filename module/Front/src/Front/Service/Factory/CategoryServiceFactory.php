<?php
namespace Front\Service\Factory;

use Front\Service\CategoryService;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class CategoryServiceFactory implements FactoryInterface
{
    /**
     * (non-PHPdoc)
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     * @return Front\Service\ApplicationService
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $entityManager = $serviceLocator->get('Doctrine\ORM\EntityManager');
        $userRepository = $entityManager->getRepository('Front\Entity\Category');

        return new CategoryService($entityManager, $userRepository);
    }
}