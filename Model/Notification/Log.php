<?php
/**
 * @author Jose Restrepo
 */
declare(strict_types=1);

namespace Atwix\CustomerValidation\Model\Notification;

use Atwix\CustomerValidation\Model\AbstractNotification;
use Atwix\CustomerValidation\Model\Config as ConfigModel;
use Magento\Customer\Api\Data\CustomerInterface;
use Psr\Log\LoggerInterface;

class Log extends AbstractNotification
{
    /**
     * @var LoggerInterface
     */
    protected $_logger;

    /**
     * @param ConfigModel $config
     * @param LoggerInterface $_logger
     */
    public function __construct(
        ConfigModel $config,
        LoggerInterface $_logger
    ) {
        parent::__construct(
            $config,
            $_logger
        );

        $this->_logger = $_logger;
    }

    /**
     * @param CustomerInterface $customer
     * @return $this|mixed
     */
    public function notify(CustomerInterface $customer)
    {
        $this->_logger->debug(
            __(
                'User registration completed: Firstname %1, Lastname %2, Email %3',
                $customer->getFirstname(),
                $customer->getLastname(),
                $customer->getEmail()
            )
        );

        return $this;
    }
}
