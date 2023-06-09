<?php
/**
 * @author Jose Restrepo
 */
declare(strict_types=1);

namespace Atwix\CustomerValidation\Log;

use Psr\Log\LoggerInterface;

/**
 * Base logger class to extend from dependency injection config depending on module needs or scope
 */
class Logger
{
    /**
     * @var LoggerInterface
     */
    protected $_logger;

    /**
     * @param LoggerInterface $logger
     */
    public function __construct(
        LoggerInterface $logger
    ) {
        $this->_logger = $logger;
    }
}
