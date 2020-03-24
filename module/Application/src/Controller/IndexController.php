<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;


class IndexController extends AbstractActionController
{
 /*   private $entityManager;

    private $container;

    public function __construct($container)
    {
        $this->entityManager = $container->get('doctrine.entitymanager.orm_default');

        $this->container = $container;
    }*/

    public function indexAction()
    {
/*        $ttt = $this->entityManager->getRepository(TestTable::class)->find(1);
        $api = $this->container->get('Config');
        //print('<pre>');print_r($api['shopify']); die;*/
        return new ViewModel();
    }


}
