<?php

namespace ComBank\Bank\Contracts;

/**
 * Created by VS Code.
 * User: JPortugal
 * Date: 7/27/24
 * Time: 7:26 PM
 */

use ComBank\Exceptions\BankAccountException;
use ComBank\Exceptions\FailedTransactionException;
use ComBank\OverdraftStrategy\Contracts\OverdraftInterface;
use ComBank\Transactions\Contracts\BankTransactionInterface;

interface BankAccountInterface
{
    const STATUS_OPEN = 'OPEN';
    const STATUS_CLOSED = 'CLOSED';


    public function transaction(BankTransactionInterface $transaction): void;

    /**
     * Indica si la cuenta está abierta.
     *
     * @return bool
     */
    public function isOpen(): bool;

    /**
     * Reabre una cuenta cerrada.
     *
     * @throws BankAccountException
     */
    public function reopenAccount(): void;

    /**
     * Cierra la cuenta actual.
     *
     * @throws BankAccountException
     */
    public function closeAccount(): void;

    /**
     * Obtiene el balance actual.
     *
     * @return float
     */
    public function getBalance(): float;

    /**
     * Establece un nuevo balance.
     *
     * @param float $balance
     */
    public function setBalance(float $balance): void;

    /**
     * Obtiene la estrategia de sobregiro asociada.
     *
     * @return OverdraftInterface|null
     */
    public function getOverdraft(): ?OverdraftInterface;

    /**
     * Aplica una nueva estrategia de sobregiro.
     *
     * @param OverdraftInterface $overdraft
     */
    public function applyOverdraft(OverdraftInterface $overdraft): void;
}
