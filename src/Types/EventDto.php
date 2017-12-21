<?php
declare(strict_types=1);

namespace ESputnik\Types;

use ESputnik\ESObject;

/**
 * Class Event
 *
 * @property string      $eventTypeKey
 * @property string      $keyValue
 * @property Parameter[] $parameters
 * @property string[string] $parametersArray
 *
 * @link http://esputnik.com.ua/api/el_ns0_eventDto.html
 */
class EventDto extends ESObject
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
    public function setParameters(array $parameters): void
    {
        $this->parameters = \array_map(function ($parameter) {
            return $parameter instanceof Parameter ? $parameter : new Parameter($parameter);
        }, $parameters);
    }

    /**
     * Add parameter
     *
     * @param string $name
     * @param string $value
     */
    public function addParameter($name, $value): void
    {
        $this->parameters[] = new Parameter(['name' => $name, 'value' => $value]);
    }

    /**
     * Get parameters as array
     *
     * @return string[]
     */
    public function getParametersArray(): array
    {
        return \array_reduce($this->parameters, function (array $result, Parameter $parameter) {
            $result[$parameter->name] = $parameter->value;
            return $result;
        }, []);
    }

    /**
     * Set parameters as array
     *
     * @param string[] $parameters
     */
    public function setParametersArray(array $parameters): void
    {
        $this->parameters = [];
        foreach ($parameters as $name => $value) {
            $this->parameters[] = new Parameter([
                'name' => $name,
                'value' => $value
            ]);
        }
    }
}
