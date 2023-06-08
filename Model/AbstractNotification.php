<?php
/**
 * @author Jose Restrepo
 */
declare(strict_types=1);

namespace Atwix\CustomerValidation\Model;

use Atwix\CustomerValidation\Model\Config as ConfigModel;
use Magento\Customer\Api\Data\CustomerInterface;
abstract class AbstractNotification
{
    /**
     * @var Config
     */
    protected $_config;

    /**
     * @param Config $config
     */
    public function __construct(
        ConfigModel $config
    ) {
        $this->_config = $config;
    }

    /**
     * @param CustomerInterface $customer
     * @return mixed
     */
    abstract function notify(CustomerInterface $customer);
}
