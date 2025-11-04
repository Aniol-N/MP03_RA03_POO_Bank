<?php

namespace ComBank\Transactions\Contracts;

use ComBank\Bank\Contracts\BankAccountInterface;

interface BankTransactionInterface
{
    public function applyTransaction(BankAccountInterface $account): float;

    public function getTransactionInfo(?BankAccountInterface $account = null): string;

    public function getAmount(): float;
}
