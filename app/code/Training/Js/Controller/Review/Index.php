<?php

namespace Training\JS\Controller\Review;

class Index extends \Magento\Framework\App\Action\Action
{
    /**
     * @var \Magento\Framework\Controller\Result\JsonFactory
     */
    private $jsonResultFactory;

    /**
     * Index constructor.
     * @param \Magento\Framework\App\Action\Context $context
     * @param \Magento\Framework\Controller\Result\JsonFactory $jsonResultFactory
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\Controller\Result\JsonFactory $jsonResultFactory
    ) {
        $this->jsonResultFactory = $jsonResultFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $result = $this->jsonResultFactory->create();
        $result->setData(json_encode($this->getRandomReviewData()));
        return $result;
    }

    private function getRandomReviewData(){
        $reviews = [
            [
                'name' => 'Reviewer 1',
                'message' => 'Test1 message Test message Test message Test message Test message Test message Test message Test message Test message '
            ],
            [
                'name' => 'Reviewer 2',
                'message' => 'Test2 message Test message Test message Test message Test message Test message Test message Test message Test message '
            ],
            [
                'name' => 'Reviewer 3',
                'message' => 'Test3 message Test message Test message Test message Test message Test message Test message Test message Test message '
            ],
            [
                'name' => 'Reviewer 4',
                'message' => 'Test4 message Test message Test message Test message Test message Test message Test message Test message Test message '
            ],

        ];

        return $reviews[rand(0, 3)];
    }
}
