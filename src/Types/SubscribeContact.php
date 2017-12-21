<?php
declare(strict_types=1);

namespace ESputnik\Types;

use ESputnik\ESException;
use ESputnik\ESObject;

/**
 * Class SubscribeContact
 *
 * @property Contact  $contact
 * @property string   $dedupeOn
 * @property string[] $groups
 * @link http://esputnik.com.ua/api/el_ns0_subscribeContact.html
 */
class SubscribeContact extends ESObject
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
     *
     * @throws ESException
     */
    public function setDedupeOn($dedupeOn): void
    {
        static $values = array(
            'email',
            'sms'
        );

        if (!\in_array($dedupeOn, $values, true)) {
            throw new ESException('Property type must be one of ' . implode(', ', $values) . ' values.');
        }

        $this->dedupeOn = $dedupeOn;
    }

    /**
     * @param string[]|Group[] $groups
     */
    public function setGroups(array $groups): void
    {
        $this->groups = array_map(function ($group) {
            if ($group instanceof Group) {
                return $group->name;
            }
            return (string)$group;
        }, $groups);
    }
}
