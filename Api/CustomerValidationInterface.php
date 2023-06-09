<?php
/**
 * @author Jose Restrepo
 */
declare(strict_types=1);

namespace Atwix\CustomerValidation\Api;

interface CustomerValidationInterface
{
    /**
     * @param string $firstname
     * @return bool
     */
    public function validateFirstname(string $firstname):bool;
}
