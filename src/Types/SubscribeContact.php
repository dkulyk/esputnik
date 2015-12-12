<?php
/**
 * This file is part of ESputnik API connector
 *
 * @package ESputnik
 * @license MIT
 * @author Dmytro Kulyk <lnkvisitor.ts@gmail.com>
 */

namespace ESputnik\Types;

use ESputnik\ESException;
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

    /**
     * @param Contact $contact
     */
    public function setContact(Contact $contact)
    {
        $this->contact = $contact;
    }

    /**
     * @param string $dedupeOn
     * @throws ESException
     */
    public function setDedupeOn($dedupeOn)
    {
        static $values = array(
            'email',
            'sms'
        );

        if (!in_array($dedupeOn, $values)) {
            throw new ESException('Property type must be one of ' . implode(', ', $values) . ' values.');
        }

        $this->dedupeOn = $dedupeOn;
    }

    /**
     * @param (string|Group)[] $groups
     */
    public function setGroups(array $groups)
    {
        $this->groups = array_map(function ($group) {
            if ($group instanceof Group) {
                return $group->name;
            }
            return (string)$group;
        }, $groups);
    }
}