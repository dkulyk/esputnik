<?php
declare(strict_types=1);

namespace ESputnik\Types;

use ESputnik\ESException;
use ESputnik\ESObject;

/**
 * Class Contacts
 *
 * @mixin Contact[]
 * @property int       $totalCount
 * @property Contact[] $contacts
 */
class Contacts extends ESObject implements \Countable, \ArrayAccess, \Iterator
{
    /**
     * @var int
     */
    protected $totalCount = 0;

    /**
     * @var Contact[]
     */
    protected $contacts = [];

    /**
     * @param Contact[] $contacts
     */
    public function setContacts($contacts)
    {
        $this->contacts = \array_map(function ($contact) {
            return $contact instanceof Contact ? $contact : new Contact($contact);
        }, $contacts);
    }

    /**
     * @inheritdoc
     */
    public function jsonSerialize()
    {
        return $this->contacts;
    }

    /**
     * @inheritdoc
     */
    public function count()
    {
        return \count($this->contacts);
    }

    /**
     * @inheritdoc
     */
    public function offsetExists($offset)
    {
        return \array_key_exists($offset, $this->contacts);
    }

    /**
     * @inheritdoc
     */
    public function offsetGet($offset)
    {
        return $this->contacts[$offset];
    }

    /**
     * @inheritdoc
     */
    public function offsetSet($offset, $value)
    {
        throw new ESException('Set value to contacts not implemented.');
    }

    /**
     * @inheritdoc
     */
    public function offsetUnset($offset)
    {
        throw new ESException('Unset value from contacts not implemented.');
    }

    /**
     * @inheritdoc
     */
    public function current()
    {
        return \current($this->contacts);
    }

    /**
     * @inheritdoc
     */
    public function next()
    {
        \next($this->contacts);
    }

    /**
     * @inheritdoc
     */
    public function key()
    {
        return \key($this->contacts);
    }

    /**
     * @inheritdoc
     */
    public function valid()
    {
        return \current($this->contacts) !== false;
    }

    /**
     * @inheritdoc
     */
    public function rewind()
    {
        \reset($this->contacts);
    }
}
