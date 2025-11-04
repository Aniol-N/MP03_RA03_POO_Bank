<?php

namespace ComBank\Transactions;

use ComBank\Bank\Contracts\BankAccountInterface;
use ComBank\Transactions\Contracts\BankTransactionInterface;

class DepositTransaction extends BaseTransaction implements BankTransactionInterface
{
    public function applyTransaction(BankAccountInterface $bankAccount): float
    {
        return $bankAccount->getBalance() + $this->amount;
    }

    // Firma compatible con la interfaz
    public function getTransactionInfo(?BankAccountInterface $account = null): string
    {
        // Cuando no se proporciona account, devolver sólo el encabezado
        if ($account === null) {
            return "DEPOSIT_TRANSACTION";
        }

        return "DEPOSIT_TRANSACTION" . PHP_EOL .
            "Account balance: $" . number_format($account->getBalance(), 2) . PHP_EOL .
            "Deposit amount: $" . number_format($this->amount, 2) . PHP_EOL .
            "New balance: $" . number_format($account->getBalance() + $this->amount, 2);
    }
    
    public function getTransaction(BankAccountInterface $bankAccount): string
    {
        return $this->getTransactionInfo($bankAccount);
    }
}