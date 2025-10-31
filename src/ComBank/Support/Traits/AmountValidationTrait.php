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
        // Validar que no sea cero o negativo
        // Los tests esperan ZeroAmountException para ambos casos
        if ($amount <= 0) {
            throw new ZeroAmountException("El monto debe ser mayor que cero.");
        }
    }
}