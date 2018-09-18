<?php
/**
 * Created by PhpStorm.
 * User: dkulyk
 * Date: 17.09.18
 * Time: 18:53
 */

namespace ESputnik\Types;


use ESputnik\ESObject;

class ParametrizedLocator extends ESObject
{
    /**
     * @var int
     */
    protected $contactId;

    /**
     * @var string
     */
    protected $locator;

    /**
     * @var string
     */
    protected $jsonParam;

    /**
     * @var string;
     */
    protected $externalRequestId;

    /**
     * @param string|mixed $jsonParam
     *
     * @return ParametrizedLocator
     */
    public function setJsonParam($jsonParam): ParametrizedLocator
    {
        $this->jsonParam = is_string($jsonParam) ? $jsonParam : json_encode($jsonParam);

        return $this;
    }
}
