<?php
declare(strict_types=1);

namespace ESputnik\Types;

use ESputnik\ESObject;

class MessageParams extends ESObject
{

    /**
     * @var ParametrizedLocator[]
     */
    protected $recipients = [];

    /**
     * @var int
     */
    protected $campaignId;

    /**
     * @var bool
     */
    protected $allowUnconfirmed = false;

    /**
     * @var string
     */
    protected $fromName = null;

    /**
     * @var bool
     */
    protected $email = true;

    /**
     * @param int $campaignId
     *
     * @return MessageParams
     */
    public function setCampaignId(int $campaignId): MessageParams
    {
        $this->campaignId = $campaignId;

        return $this;
    }

    /**
     * @param bool $allowUnconfirmed
     *
     * @return MessageParams
     */
    public function setAllowUnconfirmed(bool $allowUnconfirmed): MessageParams
    {
        $this->allowUnconfirmed = $allowUnconfirmed;
        return $this;
    }

    /**
     * @param string $fromName
     *
     * @return MessageParams
     */
    public function setFromName(string $fromName): MessageParams
    {
        $this->fromName = $fromName;

        return $this;
    }

    /**
     * @param ParametrizedLocator $recipient
     *
     * @return MessageParams
     */
    public function appendRecipients(ParametrizedLocator $recipient): MessageParams
    {
        $this->recipients[] = $recipient;

        return $this;
    }

    /**
     * @param bool $email
     *
     * @return MessageParams
     */
    public function setEmail(bool $email): MessageParams
    {
        $this->email = $email;

        return $this;
    }
}