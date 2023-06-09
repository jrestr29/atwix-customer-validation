<?php
/**
 * @author Jose Restrepo
 */
declare(strict_types=1);

namespace Atwix\CustomerValidation\Model\Customer;

use Atwix\CustomerValidation\Api\CustomerValidationInterface;

class CustomerValidation implements CustomerValidationInterface
{
    /**
     * @param string $firstName
     * @return bool
     */
    public function validateFirstname(string $firstName): bool
    {
        $result = true;

        if ($this->hasWhiteSpaces($firstName)) {
            $result = false;
        }

        return $result;
    }

    /**
     * @param string $firstName
     * @return bool
     */
    private function hasWhiteSpaces(string $firstName): bool
    {
        $regExp = '/\s/';
        return (bool)preg_match($regExp, $firstName);
    }
}
