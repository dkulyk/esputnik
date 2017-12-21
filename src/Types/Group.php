<?php
declare(strict_types=1);

namespace ESputnik\Types;

use ESputnik\ESException;
use ESputnik\ESputnik;
use ESputnik\ESObject;

/**
 * Class Group
 *
 * @property int    $id
 * @property string $name
 * @property string $type
 *
 * @link http://esputnik.com.ua/api/el_ns0_group.html
 */
class Group extends ESObject
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
     * @param int      $offset
     * @param int      $limit
     * @param ESputnik $id optional
     *
     * @return Contacts|Contact[]
     * @throws ESException
     */
    public function getContacts($offset = 0, $limit = 500, ESputnik $id = null)
    {
        if ($id === null) {
            $id = ESputnik::instance();
        }
        return $id->getGroupContacts($this, $offset, $limit);
    }

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
            'Static',
            'Dynamic',
            'Combined'
        );

        if (!\in_array($type, $values, true)) {
            throw new ESException('Property type must be one of ' . \implode(', ', $values) . ' values.');
        }

        $this->type = $type;
    }
}
