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
 * Class FieldInfo
 *
 * @property int $id
 * @property string $name
 * @property FieldDescription $description
 */
class FieldInfo extends Object
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