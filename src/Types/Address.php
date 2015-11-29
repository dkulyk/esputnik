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
 * Class Address
 *
 * @property string $region
 * @property string $town
 * @property string $address
 * @property string $postcode
 */
class Address extends Object
{
    /**
     * @var string
     */
    protected $region;

    /**
     * @var string
     */
    protected $town;

    /**
     * @var string
     */
    protected $address;

    /**
     * @var string
     */
    protected $postcode;
}