<?php

namespace ComBank\Bank;

use ComBank\Exceptions\BankAccountException;
use ComBank\Exceptions\FailedTransactionException;
use ComBank\Exceptions\InvalidOverdraftFundsException;
use ComBank\Bank\Contracts\BankAccountInterface;
use ComBank\OverdraftStrategy\Contracts\OverdraftInterface;
use ComBank\Support\Traits\AmountValidationTrait;
use ComBank\Transactions\Contracts\BankTransactionInterface;

class BankAccount implements BankAccountInterface
{
    use AmountValidationTrait;

    private float $balance;
    private string $status;
    private ?OverdraftInterface $overdraft;

    public function __construct(float $newBalance = 0.0)
    {
        // Validar que el balance inicial no sea negativo
        if ($newBalance < 0) {
            throw new BankAccountException("El balance inicial no puede ser negativo.");
        }
        
        $this->balance = $newBalance;
        $this->status = BankAccountInterface::STATUS_OPEN;
        $this->overdraft = null;
    }

    public function transaction(BankTransactionInterface $bankTransaction): void
    {
        if (!$this->isOpen()) {
            throw new BankAccountException("No se puede operar: la cuenta está cerrada.");
        }

        try {
            $newBalance = $bankTransaction->applyTransaction($this);
            $this->setBalance($newBalance);
        } catch (InvalidOverdraftFundsException $e) {
            throw new FailedTransactionException("Transacción fallida: fondos insuficientes.", 0, $e);
        }
    }

    public function isOpen(): bool
    {
        return $this->status === BankAccountInterface::STATUS_OPEN;
    }

    public function closeAccount(): void
    {
        if (!$this->isOpen()) {
            throw new BankAccountException("La cuenta ya está cerrada.");
        }
        $this->status = BankAccountInterface::STATUS_CLOSED;
    }

    public function reopenAccount(): void
    {
        if ($this->isOpen()) {
            throw new BankAccountException("La cuenta ya está abierta.");
        }
        $this->status = BankAccountInterface::STATUS_OPEN;
    }

    public function getBalance(): float
    {
        return $this->balance;
    }

    public function setBalance(float $balance): void
    {
        $this->balance = $balance;
    }

 public function getOverdraft(): ?OverdraftInterface
    {
        return $this->overdraft;
    }

    public function applyOverdraft(?OverdraftInterface $overdraft): void
    {
        $this->overdraft = $overdraft;
    }
}