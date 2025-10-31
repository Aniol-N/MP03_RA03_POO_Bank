<?php

namespace ComBank\OverdraftStrategy\Contracts;

/**
 * Created by VS Code.
 * User: JPortugal
 * Date: 7/27/24
 * Time: 7:44 PM
 */

interface OverdraftInterface
{
    public function isGrantOverdraftFunds(float $amount): bool;
}

class SilverOverdraft implements OverdraftInterface
{
    private const OVERDRAFT_LIMIT = -100.0;

    public function isGrantOverdraftFunds(float $amount): bool
    {
        return $amount >= self::OVERDRAFT_LIMIT;
    }
}