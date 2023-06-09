<?php
/**
 * @author Jose Restrepo
 */
declare(strict_types=1);

namespace Atwix\CustomerValidation\Plugin\Customer\Block\Widget;

class Name
{
    /**
     * @param \Atwix\CustomerValidation\Block\Widget\Name $subject
     * @return $this
     */
    public function beforeToHtml(
        \Atwix\CustomerValidation\Block\Widget\Name $subject
    ) {
        $subject->setTemplate('Atwix_CustomerValidation::customer/widget/name.phtml');
        return $this;
    }
}
