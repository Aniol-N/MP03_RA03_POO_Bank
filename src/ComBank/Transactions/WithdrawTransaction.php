<?php

namespace ComBank\Transactions;

use ComBank\Bank\Contracts\BankAccountInterface;
use ComBank\Exceptions\InvalidOverdraftFundsException;
use ComBank\Transactions\Contracts\BankTransactionInterface;

class WithdrawTransaction extends BaseTransaction implements BankTransactionInterface
{
    public function applyTransaction(BankAccountInterface $bankAccount): float
    {
        $currentBalance = $bankAccount->getBalance();
        $newBalance = $currentBalance - $this->amount;
        
        // Verificar si hay suficiente saldo
        if ($newBalance < 0) {
            // Si hay overdraft configurado, intentar usarlo
            $overdraft = $bankAccount->getOverdraft();
            
            if ($overdraft === null || !$overdraft->isGrantOverdraftFunds($newBalance)) {
                throw new InvalidOverdraftFundsException(
                    "Fondos insuficientes para retirar $" . number_format($this->amount, 2)
                );
            }
        }
        
        return $newBalance;
    }

    public function getTransactionInfo(BankAccountInterface $bankAccount): string
    {
        return "WITHDRAW_TRANSACTION" . PHP_EOL .
            "Account balance: $" . number_format($bankAccount->getBalance(), 2) . PHP_EOL .
            "Withdraw amount: $" . number_format($this->amount, 2) . PHP_EOL .
            "New balance: $" . number_format($bankAccount->getBalance() - $this->amount, 2);
    }
    
    // Alias para compatibilidad
    public function getTransaction(BankAccountInterface $bankAccount): string
    {
        return $this->getTransactionInfo($bankAccount);
    }
}