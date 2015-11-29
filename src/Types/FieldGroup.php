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
 * Class FieldGroup
 *
 * @property string $name
 * @property FieldInfo[] $fields
 */
class FieldGroup extends Object
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var FieldInfo[]
     */
    protected $fields;

    /**
     * @param FieldInfo[] $fields
     */
    public function setFields(array $fields)
    {
        $this->fields = array_map(function ($field) {
            return $field instanceof FieldInfo ? $field : new FieldInfo($field);
        }, $fields);
    }

    /**
     * @return FieldInfo[int]
     */
    public function fieldsById()
    {
        return array_reduce($this->fields, function ($result, FieldInfo $field) {
            $result[$field->id] = $field;
            return $result;
        }, array());
    }
}