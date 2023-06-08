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
     * @param ObjectManagerInterface $objectManager
     */
    public function __construct(
        ObjectManagerInterface $objectManager
    ) {
        $this->objectManager = $objectManager;
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
            $this->objectManager->create($destination)
                ->notify($customer);
        }

        return $this;
    }
}
