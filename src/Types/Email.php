<?php
declare(strict_types=1);

namespace ESputnik\Types;

use ESputnik\ESObject;

class Email extends ESObject
{
    /**
     * @var string
     */
    protected $from;

    /**
     * @var string
     */
    protected $subject;

    /**
     * @var string
     */
    protected $htmlText;

    /**
     * @var string
     */
    protected $plainText;

    /**
     * @var array<string>
     */
    protected $emails = [];

    /**
     * @var array<string>
     */
    protected $tags = [];

    /**
     * @var int
     */
    protected $campaignId;
    /**
     * @var string
     */
    protected $externalRequestId;

    /**
     * @var bool
     */
    protected $skipPersonalisation;

    /**
     * @param string $email
     *
     * @return \ESputnik\Types\Email
     */
    public function addEmail(string $email): self
    {
        $this->emails[] = $email;

        return $this;
    }

    /**
     * @param string $tag
     *
     * @return \ESputnik\Types\Email
     */
    public function addTag(string $tag): self
    {
        $this->tags[] = $tag;

        return $this;
    }
}
