<?php
declare(strict_types=1);

namespace ESputnik\Types;

use ESputnik\ESObject;

/**
 * Class Version
 *
 * @property string $version
 * @property string $protocolVersion
 *
 * @link http://esputnik.com.ua/api/el_ns0_version.html
 */
class Version extends ESObject
{
    /**
     * @var string
     */
    protected $version;

    /**
     * @var string
     */
    protected $protocolVersion;
}
