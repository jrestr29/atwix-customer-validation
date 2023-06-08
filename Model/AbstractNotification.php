<?php
/**
 * @author Jose Restrepo
 */
declare(strict_types=1);

namespace Atwix\CustomerValidation\Model;

use Magento\Customer\Api\Data\CustomerInterface;
abstract class AbstractNotification
{
    /**
     * @param CustomerInterface $customer
     * @return mixed
     */
    abstract function notify(CustomerInterface $customer);
}
