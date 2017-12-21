<?php
declare(strict_types=1);

namespace ESputnik\Types;

use ESputnik\ESObject;

/**
 * Class EmailMessage
 *
 * @property integer  $id
 * @property string   $name
 * @property string   $from
 * @property string   $subject
 * @property string   $htmlText
 * @property string[] $tags
 *
 * @link http://esputnik.com.ua/api/el_ns0_emailMessage.html
 */
class EmailMessage extends ESObject
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $from;

    /**
     * @var string
     */
    protected $subject;

    /**
     * @var string
     */
    protected $htmlText;

    /**
     * @var string[]
     */
    protected $tags = array();
}
