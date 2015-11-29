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
 * @property double $currentBalance
 * @property double $creditLimit
 * @property string $currency
 * @property int $bonusEmails
 * @property int $bonusSmses
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