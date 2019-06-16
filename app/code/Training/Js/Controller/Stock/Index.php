<?php

namespace Training\JS\Controller\Stock;

class Index extends \Magento\Framework\App\Action\Action
{
    /**
     * @var \Magento\Framework\Controller\Result\JsonFactory
     */
    private $jsonResultFactory;

    /**
     * @var \Magento\Catalog\Api\ProductRepositoryInterface
     */
    private $productRepository;

    /**
     * @var \Magento\Framework\Registry
     */
    protected $registry;

    /**
     * Index constructor.
     * @param \Magento\Framework\App\Action\Context $context
     * @param \Magento\Framework\Controller\Result\JsonFactory $jsonResultFactory
     * @param \Magento\Catalog\Api\ProductRepositoryInterface $productRepository
     * @param \Magento\Framework\Registry $registry
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\Controller\Result\JsonFactory $jsonResultFactory,
        \Magento\Catalog\Api\ProductRepositoryInterface $productRepository
    ) {
        $this->jsonResultFactory = $jsonResultFactory;
        $this->productRepository = $productRepository;
        parent::__construct($context);
    }

    public function execute()
    {
        $productId = $this->getRequest()->getPost('productId');
        $result = $this->jsonResultFactory->create();
        $result->setData(json_encode($this->getStockItem($productId)));
        return $result;
    }

    public function getStockItem($productId)
    {
        $product = $this->productRepository->getById($productId);

        $product->getPriceInfo()->getPrice('final_price')->getValue();
        $stock = [
            'stock' => $product->getQuantityAndStockStatus()['qty'],
        ];
        return $stock;
    }
}
