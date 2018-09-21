<?php
declare(strict_types=1);

namespace ESputnik\Types;

use ESputnik\ESObject;

/**
 * Class SendMessageResultDto
 * @package ESputnik\Types
 * @property-read int    $id
 * @property-read string $locator
 * @property-read string $status
 * @property-read string $requestId
 * @property-read string $message
 */
class SendMessageResultDto extends ESObject
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $locator;

    /**
     * @var string
     */
    protected $status;

    /**
     * @var string
     */
    protected $requestId;

    /**
     * @var string
     */
    protected $message;
}
