<?php
namespace Front\Service\Factory;

use Front\Service\JobService;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class JobServiceFactory implements FactoryInterface
{
    /**
     * (non-PHPdoc)
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     * @return Front\Service\JobService
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $entityManager = $serviceLocator->get('Doctrine\ORM\EntityManager');
        $userRepository = $entityManager->getRepository('Front\Entity\Job');

        return new JobService($entityManager, $userRepository);
    }
}