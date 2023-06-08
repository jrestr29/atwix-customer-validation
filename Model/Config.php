<?php
/**
 * @author Jose Restrepo
 */
declare(strict_types=1);

namespace Atwix\CustomerValidation\Model;

use Atwix\CustomerValidation\Helper\Store\Data as StoreHelper;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;

class Config
{
    /**
     * @var ScopeConfigInterface
     */
    private $scopeConfig;
    /**
     * @var StoreHelper
     */
    private $storeHelper;

    /**
     * @param StoreHelper $storeHelper
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        StoreHelper $storeHelper,
        ScopeConfigInterface $scopeConfig
    ) {
        $this->scopeConfig = $scopeConfig;
        $this->storeHelper = $storeHelper;
    }

    /**
     * Returns email address stores on `Customer Support` field for `Store`
     * @return string
     */
    public function getSupportEmailAddress(): string
    {
        $emailAddressPath = 'trans_email/ident_support/email';
        return $this->getConfigValue($emailAddressPath);
    }

    /**
     * @param string $path
     * @return string
     */
    protected function getConfigValue(string $path): string
    {
        $result = $this->scopeConfig->getValue(
            $path,
            ScopeInterface::SCOPE_STORE,
            $this->storeHelper->getStore()->getId()
        );

        return $result;
    }

}
