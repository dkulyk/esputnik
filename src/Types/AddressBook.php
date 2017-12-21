<?php
declare(strict_types=1);

namespace ESputnik\Types;

use ESputnik\ESObject;

/**
 * Class AddressBook
 *
 * @property int          $addressBookId
 * @property string       $name
 * @property FieldGroup[] $fieldGroups
 *
 * @link http://esputnik.com.ua/api/el_ns0_addressBook.html
 */
class AddressBook extends ESObject
{
    /**
     * @var int
     */
    protected $addressBookId;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var FieldGroup[]
     */
    protected $fieldGroups = array();

    /**
     * @param FieldGroup[] $groups
     */
    public function setFieldGroups(array $groups)
    {
        //Несоответствие со описанием на сайте, костыль
        if (array_key_exists('name', $groups)) {
            $groups = array($groups);
        }

        $this->fieldGroups = array_map(function ($group) {
            return $group instanceof FieldGroup ? $group : new FieldGroup($group);
        }, $groups);
    }
}
