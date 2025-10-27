<?php

namespace ComBank\OverdraftStrategy;
use ComBank\OverdraftStrategy\Contracts\OverdraftInterface;

/**
 * Created by VS Code.
 * User: JPortugal
 * Date: 7/28/24
 * Time: 12:27 PM
 */

class NoOverdraft implements OverdraftInterface
{
    /**
     * Determina si se puede autorizar un sobregiro con el saldo propuesto.
     * 
     * @param float $amount El saldo propuesto (generalmente negativo)
     * @return bool True si se autoriza el sobregiro, false en caso contrario
     */
    public function isGrantOverdraftFunds(float $amount): bool
    {
        // No permite ningún saldo negativo
        return $amount >= 0;
    }
}
