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
 * Class Event
 *
 * @property string $eventTypeKey
 * @property string $keyValue
 * @property Parameter[] $parameters
 * @property string[string] $parametersArray
 */
class Event extends Object
{
    /**
     * @var string
     */
    protected $eventTypeKey;

    /**
     * @var string
     */
    protected $keyValue;

    /**
     * @var Parameter[]
     */
    protected $parameters = array();

    /**
     * @param Parameter[] $parameters
     */
    public function setParameters(array $parameters)
    {
        $this->parameters = array_map(function ($parameter) {
            return $parameter instanceof Parameter ? $parameter : new Parameter($parameter);
        }, $parameters);
    }

    /**
     * Add parameter
     *
     * @param string $name
     * @param string $value
     */
    public function addParameter($name, $value)
    {
        $this->parameters[] = new Parameter(array('name' => $name, 'value' => $value));
    }

    /**
     * Get parameters as array
     *
     * @return string[]
     */
    public function getParametersArray()
    {
        return array_reduce($this->parameters, function (array $result, Parameter $parameter) {
            $result[$parameter->name] = $parameter->value;
            return $result;
        }, array());
    }

    /**
     * Set parameters as array
     *
     * @param string[] $parameters
     */
    public function setParametersArray(array $parameters)
    {
        $this->parameters = array();
        foreach ($parameters as $name => $value) {
            $this->parameters[] = new Parameter(array(
                'naem'  => $name,
                'value' => $value
            ));
        }
    }
}