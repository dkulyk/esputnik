<?php
/**
 * This file is part of ESputnik API connector
 *
 * @package ESputnik
 * @license MIT
 * @author Dmytro Kulyk <lnkvisitor.ts@gmail.com>
 */

namespace ESputnik\Types;

use ESputnik\Object;

/**
 * Class Version
 *
 * @property string $version
 * @property string $protocolVersion
 */
class Version extends Object
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