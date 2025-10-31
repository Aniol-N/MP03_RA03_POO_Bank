<?php

namespace ComBank\Transactions;

/**
 * Created by VS Code.
 * User: JPortugal
 * Date: 7/28/24
 * Time: 11:30 AM
 */

use ComBank\Bank\Contracts\BankAccountInterface;
use ComBank\Transactions\Contracts\BankTransactionInterface;

class DepositTransaction extends BaseTransaction implements BankTransactionInterface
{
    public function applyTransaction(BankAccountInterface $bankAccount): float
    {
        return $bankAccount->getBalance() + $this->amount;
    }

    public function getTransactionInfo(BankAccountInterface $bankAccount): string
    {
        return "DEPOSIT_TRANSACTION" . PHP_EOL .
            "Account balance: $" . number_format($bankAccount->getBalance(), 2) . PHP_EOL .
            "Deposit amount: $" . number_format($this->amount, 2) . PHP_EOL .
            "New balance: $" . number_format($bankAccount->getBalance() + $this->amount, 2);
    }
    
    // Alias para compatibilidad
    public function getTransaction(BankAccountInterface $bankAccount): string
    {
        return $this->getTransactionInfo($bankAccount);
    }
}