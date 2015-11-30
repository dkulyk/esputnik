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
use ESputnik\ESputnik;
use ESputnik\Object;

/**
 * Class Group
 *
 * @property int $id
 * @property string $name
 * @property string $type
 */
class Group extends Object
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
    protected $type;

    /**
     * Search from all contacts in the group.
     *
     * @param int $offset
     * @param int $limit
     * @param ESputnik $id optional
     * @return Contacts|Contact[]
     */
    public function getContacts($offset = 0, $limit = 500, ESputnik $id = null)
    {
        if ($id === null) {
            $id = ESputnik::id();
        }
        return $id->getContacts($this, $offset, $limit);
    }

    /**
     * Set the type value
     *
     * @param string $type
     * @throws ESException
     */
    public function setType($type)
    {
        static $values = array(
            'Static',
            'Dynamic',
            'Combined'
        );

        if (!in_array($type, $values)) {
            throw new ESException('Property type must be one of ' . implode(', ', $values) . ' values.');
        }

        $this->type = $type;
    }
}