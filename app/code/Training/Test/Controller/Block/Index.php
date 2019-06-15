<?php

namespace Training\Test\Controller\Block;

class Index extends \Magento\Framework\App\Action\Action
{
    /**
     * @var \Magento\Framework\View\LayoutFactory
     */
    private $layoutFactory;

    /**
     * @var \Magento\Framework\Controller\Result\RawFactory
     */
    private $resultRawFactory;

    /**
     * Index constructor.
     * @param \Magento\Framework\App\Action\Context $context
     * @param \Magento\Framework\View\LayoutFactory $layoutFactory
     * @param \Magento\Framework\Controller\Result\RawFactory $resultRawFactory
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\LayoutFactory $layoutFactory,
        \Magento\Framework\Controller\Result\RawFactory $resultRawFactory
    ) {
        $this->layoutFactory = $layoutFactory;
        $this->resultRawFactory = $resultRawFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $layout = $this->layoutFactory->create();
        $block = $layout->createBlock('Training\Test\Block\Test');
        $html = $block->toHtml();
        return $this->resultRawFactory->create()->setContents($html);
    }
}

