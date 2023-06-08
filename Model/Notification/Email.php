<?php
/**
 * @author Jose Restrepo
 */
declare(strict_types=1);

namespace Atwix\CustomerValidation\Model\Notification;

use Atwix\CustomerValidation\Helper\Store\Data as StoreHelper;
use Atwix\CustomerValidation\Model\Config as ConfigModel;
use Atwix\CustomerValidation\Model\AbstractNotification;
use Magento\Framework\Mail\Template\TransportBuilder;
use Magento\Customer\Api\Data\CustomerInterface;
use Psr\Log\LoggerInterface;

class Email extends AbstractNotification
{
    const EMAIL_TEMPLATE = 'customer_registration_information_email';

    /**
     * @var StoreHelper
     */
    private $storeHelper;
    /**
     * @var TransportBuilder
     */
    private $transportBuilder;

    public function __construct(
        StoreHelper $storeHelper,
        TransportBuilder $transportBuilder,
        ConfigModel $config,
        LoggerInterface $_logger
    ) {
        parent::__construct(
            $config,
            $_logger
        );

        $this->storeHelper      = $storeHelper;
        $this->transportBuilder = $transportBuilder;
    }

    /**
     * @param CustomerInterface $customer
     * @return void
     * @throws \Magento\Framework\Exception\LocalizedException
     * @throws \Magento\Framework\Exception\MailException
     */
    public function notify(CustomerInterface $customer)
    {
        $templateOptions = [
            'area'  => \Magento\Framework\App\Area::AREA_FRONTEND,
            'store' => $this->storeHelper->getStore()->getId()
        ];

        $templateVars = [
            'firstname' => $customer->getFirstname(),
            'lastname'  => $customer->getLastname(),
            'email'     => $customer->getEmail()
        ];

        $from = [
            'email' => $this->_config->getGeneralContactEmailAddress(),
            'name' => $this->_config->getGeneralContactEmailName()
        ];

        $to = [$this->_config->getSupportEmailAddress()];
        $to = ['josda6486@gmail.com'];

        $transport = $this->transportBuilder->setTemplateIdentifier(self::EMAIL_TEMPLATE)
            ->setTemplateOptions($templateOptions)
            ->setTemplateVars($templateVars)
            ->setFrom($from)
            ->addTo($to)
            ->getTransport();
        $transport->sendMessage();

        return $this;
    }
}
