<?php
namespace Application\Controller\Factory;

use Application\Controller\CollectionsController;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;


/**
 * This is the factory for IndexController. Its purpose is to instantiate the
 * controller.
 */
class CollectionsControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $entityManager = $container->get('doctrine.entitymanager.orm_default');

        return new CollectionsController($container);
    }
}