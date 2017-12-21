<?php
declare(strict_types=1);
namespace ESputnik\Types;

use ESputnik\ESObject;

/**
 * Class Balance
 *
 * @property-read double $currentBalance
 * @property-read double $creditLimit
 * @property-read string $currency
 * @property-read int $bonusEmails
 * @property-read int $bonusSmses
 *
 * @link http://esputnik.com.ua/api/el_ns0_balance.html
 */
class Balance extends ESObject
{
    /**
     * @var double
     */
    protected $currentBalance;

    /**
     * @var double
     */
    protected $creditLimit;

    /**
     * @var string
     */
    protected $currency;

    /**
     * @var int
     */
    protected $bonusEmails;

    /**
     * @var int
     */
    protected $bonusSmses;
}
