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
     * @var bool
     */
    protected $email = true;

    /**
     * @param string|mixed $jsonParam
     *
     * @return ParametrizedLocator
     */
    public function setJsonParam($jsonParam): ParametrizedLocator
    {
        $this->jsonParam = is_string($jsonParam)
            ? $jsonParam
            : json_encode($jsonParam, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

        return $this;
    }

    /**
     * @param bool $email
     *
     * @return ParametrizedLocator
     */
    public function setEmail(bool $email): ParametrizedLocator
    {
        $this->email = $email;

        return $this;
    }
}
