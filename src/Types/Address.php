<?php
declare(strict_types=1);

namespace ESputnik\Types;

use ESputnik\ESObject;

/**
 * Class Address
 *
 * @property string $region
 * @property string $town
 * @property string $address
 * @property string $postcode
 *
 * @link http://esputnik.com.ua/api/el_ns0_address.html
 */
class Address extends ESObject
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
