<?php
/**
 * @author Jose Restrepo
 */
declare(strict_types=1);

namespace Atwix\CustomerValidation\Observer;

use Atwix\CustomerValidation\Model\Notification\Email as EmailNotification;
use Atwix\CustomerValidation\Model\Notification\Log as LogNotification;
use Magento\Customer\Api\Data\CustomerInterface;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\ObjectManagerInterface;
use Psr\Log\LoggerInterface;

class CustomerRegistration implements ObserverInterface
{
    const NOTIFY_DESTINATIONS = [
        EmailNotification::class,
        LogNotification::class
    ];

    /**
     * @var ObjectManagerInterface
     */
    private $objectManager;
    /**
     * @var LoggerInterface
     */
    private $_logger;

    /**
     * @param ObjectManagerInterface $objectManager
     */
    public function __construct(
        ObjectManagerInterface $objectManager,
        LoggerInterface $_logger
    ) {
        $this->objectManager    = $objectManager;
        $this->_logger          = $_logger;
    }

    /**
     * Notifies customer registration to desired destinations
     *
     * @param Observer $observer
     * @return $this|void
     */
    public function execute(Observer $observer)
    {
        /* @var CustomerInterface $customer */
        $customer = $observer->getCustomer();

        foreach (self::NOTIFY_DESTINATIONS as $destination) {
            try {
                $this->objectManager->create($destination)
                    ->notify($customer);
            } catch (\Error $e) {
                $this->_logger->critical(
                    'Not possible to notify on `' . $destination . '`, ERROR: ' . $e->getMessage()
                );
            }
        }

        return $this;
    }
}
