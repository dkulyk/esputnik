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
 * Class SubscribeContact
 *
 * @property Contact $contact
 * @property string $dedupeOn
 * @property string[] $groups
 * @link http://esputnik.com.ua/api/el_ns0_subscribeContact.html
 */
class SubscribeContact extends Object
{
    /**
     * @var Contact
     */
    protected $contact;

    /**
     * @var string
     */
    protected $dedupeOn;

    /**
     * @var string[]
     */
    protected $groups = array();
}