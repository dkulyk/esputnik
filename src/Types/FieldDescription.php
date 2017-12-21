<?php
declare(strict_types=1);

namespace ESputnik\Types;

use ESputnik\ESObject;

/**
 * Class FieldDescription
 *
 * @property string        $type
 * @property boolean       $required
 * @property boolean       $readonly
 * @property AllowedValues $allowedValues
 *
 * @link http://esputnik.com.ua/api/ns0_fieldDescription.html
 */
class FieldDescription extends ESObject
{
    protected static $types = array(
        'textfield',
        'combobox',
        'checkboxlist',
        'textarea',
        'date',
        'number',
        'datetime',
        'decimal'
    );
    /**
     * @var string
     */
    protected $type;

    /**
     * @var AllowedValues
     */
    protected $allowedValues;

    /**
     * @var boolean
     */
    protected $required = false;

    /**
     * @var boolean
     */
    protected $readonly = false;

    /**
     * @param AllowedValues $allowedValues
     */
    public function setAllowedValues($allowedValues): void
    {
        $this->allowedValues = $allowedValues instanceof AllowedValues
            ? $allowedValues
            : new AllowedValues($allowedValues);
    }
}
