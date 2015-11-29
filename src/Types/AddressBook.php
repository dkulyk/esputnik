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
 * Class AddressBook
 *
 * @property int $addressBookId
 * @property string $name
 * @property FieldGroup[] $fieldGroups
 */
class AddressBook extends Object
{
    static protected $root = 'addressBook';
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