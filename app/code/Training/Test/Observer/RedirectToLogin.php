<?php

namespace Training\Test\Observer;

use Magento\Framework\Event\ObserverInterface;

class RedirectToLogin implements ObserverInterface
{
    private $redirect;
    private $actionFlag;

    public function __construct(
        \Magento\Framework\App\Response\RedirectInterface $redirect,
        \Magento\Framework\App\ActionFlag $actionFlag
    ){
        $this->redirect = $redirect;
        $this->actionFlag = $actionFlag;
    }

    public function execute(\Magento\Framework\Event\Observer $observer){
        $request = $observer->getEvent()->getData('request');
        if($request->getModulename() == 'catalog'
            && $request->getControllerName() == 'product'
            && $request->getActionName() == 'view'
        ){
//      if($request->getFullActionName() == 'catalog_product_view') { \\ alternative way
            $controller = $observer->getEvent()->getData('controller_action');
            $this->actionFlag->set('', \Magento\Framework\App\Action\Action::FLAG_NO_DISPATCH, true);
            $this->redirect->redirect($controller->getResponse(), 'customer/account/login');
        }
    }
}

