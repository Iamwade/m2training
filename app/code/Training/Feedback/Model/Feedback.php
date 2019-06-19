<?php

namespace Training\Feedback\Model;

use Magento\Framework\Model\AbstractModel;

class Feedback extends AbstractModel
{

    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;
    /**
     * Model construct that should be used for object initialization
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(\Training\Feedback\Model\ResourceModel\Feedback::class);
    }

}
