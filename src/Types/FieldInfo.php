<?php
declare(strict_types=1);

namespace ESputnik\Types;

use ESputnik\ESObject;

/**
 * Class FieldInfo
 *
 * @property int              $id
 * @property string           $name
 * @property FieldDescription $description
 *
 * @link http://esputnik.com.ua/api/ns0_fieldInfo.html
 */
class FieldInfo extends ESObject
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
     * @var FieldDescription
     */
    protected $description;

    /**
     * @param FieldDescription $description
     */
    public function setDescription($description)
    {
        $this->description = $description instanceof FieldDescription ? $description : new FieldDescription($description);
    }
}
