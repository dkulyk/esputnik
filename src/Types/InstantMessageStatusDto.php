<?php

namespace ESputnik\Types;

use ESputnik\ESObject;

class InstantMessageStatusDto extends ESObject
{
    /**
     * @var int
     */
    public $id;

    /**
     * @var string
     */
    public $status;

    /**
     * @var string
     */
    public $requestId;

    /**
     * @var boolean
     */
    public $failed;

    /**
     * @var boolean
     */
    public $delivered;
}
