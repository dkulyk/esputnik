<?php
declare(strict_types=1);

namespace ESputnik;

use ReflectionClass;
use ReflectionProperty;

/**
 * Class Object
 */
class ESObject implements \JsonSerializable
{
    /**
     * Object constructor.
     *
     * @param array $data
     *
     * @throws ESException
     */
    public function __construct(array $data = array())
    {
        foreach ($data as $field => $value) {
            $this->__set($field, $value);
        }
    }

    /**
     * @param string $property
     *
     * @return mixed
     * @throws ESException
     */
    public function __get($property)
    {
        $method = 'get' . ucfirst($property);
        if (method_exists($this, $method)) {
            return $this->$method();
        }
        if (property_exists($this, $property)) {
            return $this->$property;
        }
        throw new ESException('Don`t get undefined property \'' . $property . '\'');
    }

    /**
     * @param string $property
     * @param mixed  $value
     *
     * @throws ESException
     */
    public function __set($property, $value)
    {
        $method = 'set' . ucfirst($property);
        if (method_exists($this, $method)) {
            $this->$method($value);
            return;
        }

        if (property_exists($this, $property)) {
            $this->$property = $value;
            return;
        }
        throw new ESException('Don`t set undefined property \'' . $property . '\'');
    }

    /**
     * @inheritdoc
     */
    public function jsonSerialize()
    {
        $class = new ReflectionClass($this);
        $properties = $class->getProperties(ReflectionProperty::IS_PROTECTED | ReflectionProperty::IS_PUBLIC);
        $json = array();
        foreach ($properties as $property) {
            if ($property->isStatic()) {
                continue;
            }
            $json[$property->name] = $this->{$property->name};
        }
        return $json;
    }
}
