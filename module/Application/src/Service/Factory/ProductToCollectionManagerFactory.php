<?php
namespace Application\Service\Factory;

use Application\Service\ProductToCollectionManager;
use Zend\ServiceManager\Factory\FactoryInterface;

class ProductToCollectionManagerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $entityManager = $container->get('doctrine.entitymanager.orm_default');

        return new ProductToCollectionManager($entityManager);
    }
}