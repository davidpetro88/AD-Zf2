<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use LosBase\Entity\EntityManagerAwareTrait;

class IndexController extends AbstractActionController
{
    use EntityManagerAwareTrait;

    public function indexAction()
    {
        if ($user = $this->identity()) {
            return $this->redirect()->toRoute('dashboard');
        }
        // print "<pre>"; print_r($user);
        // return $this->redirect()->toRoute('dashboard');
    }

    public function dashboardAction()
    {}
}
