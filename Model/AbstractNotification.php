<?php
/**
 * @author Jose Restrepo
 */
declare(strict_types=1);

namespace Atwix\CustomerValidation\Model;

use Atwix\CustomerValidation\Model\Config as ConfigModel;
use Psr\Log\LoggerInterface;
use Magento\Customer\Api\Data\CustomerInterface;
abstract class AbstractNotification
{
    /**
     * @var Config
     */
    protected $_config;
    /**
     * @var LoggerInterface
     */
    protected $_logger;

    /**
     * @param Config $config
     */
    public function __construct(
        ConfigModel $config,
        LoggerInterface $_logger
    ) {
        $this->_config = $config;
        $this->_logger  = $_logger;
    }

    /**
     * @param CustomerInterface $customer
     * @return mixed
     */
    abstract function notify(CustomerInterface $customer);
}
