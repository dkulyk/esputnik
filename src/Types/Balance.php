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
class Balance extends Object
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