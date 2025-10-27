<?php

namespace ComBank\Support\Traits;

/**
 * Created by VS Code.
 * User: JPortugal
 * Date: 7/28/24
 * Time: 2:35 PM
 */

use ComBank\Exceptions\InvalidArgsException;
use ComBank\Exceptions\ZeroAmountException;

trait AmountValidationTrait
{
    /**
     * Valida que el monto sea válido para una transacción.
     * 
     * @param float $amount El monto a validar
     * @throws InvalidArgsException Si el monto es negativo
     * @throws ZeroAmountException Si el monto es cero
     */
    public function validateAmount(float $amount): void
    {
        // Validar que no sea cero
        if ($amount == 0) {
            throw new ZeroAmountException("El monto no puede ser cero.");
        }
        
        // Validar que no sea negativo
        if ($amount < 0) {
            throw new InvalidArgsException("El monto no puede ser negativo.");
        }
    }
}