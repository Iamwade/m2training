<?php

namespace Training\Test\Plugin\Block\Product\View;

class Description extends \Magento\Catalog\Block\Product\View\Description
{
    public function beforeToHtml(
        \Magento\Catalog\Block\Product\View\Description $subject
    ){

        // ??? setDescription - это магический метод? и как он работает?
        $test = $subject->getProduct()->setDescription('Test description');
    }
}

