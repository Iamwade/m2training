<?php

namespace Training\Test\App\Router;

class NoRouteHandler implements \Magento\Framework\App\Router\NoRouteHandlerInterface
{
    public function process(\Magento\Framework\App\RequestInterface $request)
    {
        $moduleName = 'cms';
        $actionPath = 'index';
        $actionName = 'index';

        $request->setModuleName($moduleName)
            ->setControllerName($actionPath)
            ->setActionName($actionName);
        return true;
    }
}

