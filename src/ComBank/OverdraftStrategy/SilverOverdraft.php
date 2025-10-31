<?php

namespace ComBank\OverdraftStrategy;

use ComBank\OverdraftStrategy\Contracts\OverdraftInterface;

class SilverOverdraft implements OverdraftInterface
{
    private const OVERDRAFT_LIMIT = -100.0;

    public function isGrantOverdraftFunds(float $amount): bool
    {
        return $amount >= self::OVERDRAFT_LIMIT;
    }
}
