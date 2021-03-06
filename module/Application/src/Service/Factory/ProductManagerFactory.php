<?php
namespace Application\Service\Factory;

use Application\Service\ProductManager;
use Zend\ServiceManager\Factory\FactoryInterface;

class ProductManagerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $entityManager = $container->get('doctrine.entitymanager.orm_default');

        return new ProductManager($entityManager);
    }
}