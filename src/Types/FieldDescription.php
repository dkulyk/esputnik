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
 * Class FieldDescription
 *
 * @property string $type
 * @property boolean $required
 * @property boolean $readonly
 * @property AllowedValues $allowedValues
 */
class FieldDescription extends Object
{
    static protected $types = array(
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
     * @return AllowedValues
     */
    public function setAllowedValues($allowedValues)
    {
        $this->allowedValues = $allowedValues instanceof AllowedValues ? $allowedValues : new AllowedValues($allowedValues);
    }
}