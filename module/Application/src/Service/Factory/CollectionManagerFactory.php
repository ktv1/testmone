<?php
namespace Application\Service\Factory;

use Application\Service\CollectionManager;
use Zend\ServiceManager\Factory\FactoryInterface;

class CollectionManagerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $entityManager = $container->get('doctrine.entitymanager.orm_default');

        return new CollectionManager($entityManager);
    }
}