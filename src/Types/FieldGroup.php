<?php
declare(strict_types=1);

namespace ESputnik\Types;

use ESputnik\ESObject;

/**
 * Class FieldGroup
 *
 * @property string      $name
 * @property FieldInfo[] $fields
 *
 * @link http://esputnik.com.ua/api/ns0_fieldGroup.html
 */
class FieldGroup extends ESObject
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
    public function setFields(array $fields): void
    {
        $this->fields = \array_map(function ($field) {
            return $field instanceof FieldInfo ? $field : new FieldInfo($field);
        }, $fields);
    }

    /**
     * @return FieldInfo[]
     */
    public function fieldsById(): array
    {
        return \array_reduce($this->fields, function ($result, FieldInfo $field) {
            $result[$field->id] = $field;
            return $result;
        }, array());
    }
}
