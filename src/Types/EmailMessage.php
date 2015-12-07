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
 * Class EmailMessage
 *
 * @property integer $id
 * @property string $name
 * @property string $from
 * @property string $subject
 * @property string $htmlText
 * @property string[] $tags
 *
 * @link http://esputnik.com.ua/api/el_ns0_emailMessage.html
 */
class EmailMessage extends Object
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