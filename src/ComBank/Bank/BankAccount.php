<?php

namespace ComBank\Bank;

/**
 * Created by VS Code.
 * User: JPortugal
 * Date: 7/27/24
 * Time: 7:25 PM
 */

use ComBank\Exceptions\BankAccountException;
use ComBank\Exceptions\InvalidArgsException;
use ComBank\Exceptions\ZeroAmountException;
use ComBank\OverdraftStrategy\NoOverdraft;
use ComBank\Bank\Contracts\BankAccountInterface;
use ComBank\Exceptions\FailedTransactionException;
use ComBank\Exceptions\InvalidOverdraftFundsException;
use ComBank\OverdraftStrategy\Contracts\OverdraftInterface;
use ComBank\Support\Traits\AmountValidationTrait;
use ComBank\Transactions\Contracts\BankTransactionInterface;
use SebastianBergmann\Type\VoidType;

class BankAccount implements BankAccountInterface
{
    use AmountValidationTrait;
    private $balance;
    private $status;
    private $overdraft;

    // constructor
    public function __construct(float $newBalance = 0.0)
    {
        $this->balance = $newBalance;
        $this->status = BankAccount::STATUS_OPEN;
    }
    
    public function getBalance():float{
        
        return $this->balance;
    }

    public function closeAccount(){
        $this->status = BankAccountInterface::STATUS_CLOSED;
    }
    public function reopenAccount(){
        $this->status = BankAccountInterface::STATUS_OPEN;
        
    }
}
