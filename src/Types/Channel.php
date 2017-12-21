<?php
declare(strict_types=1);

namespace ESputnik\Types;

use ESputnik\ESException;
use ESputnik\ESObject;

/**
 * Class Channel
 *
 * @property string $type
 * @property string $value
 *
 * @link http://esputnik.com.ua/api/el_ns0_channel.html
 */
class Channel extends ESObject
{
    /**
     * @var string
     */
    protected $type;

    /**
     * @var string
     */
    protected $value;

    /**
     * Set the type value
     *
     * @param string $type
     *
     * @throws ESException
     */
    public function setType($type): void
    {
        static $values = array(
            'email',
            'sms'
        );

        if (!\in_array($type, $values, true)) {
            throw new ESException('Property type must be one of ' . implode(', ', $values) . ' values.');
        }

        $this->type = $type;
    }
}
