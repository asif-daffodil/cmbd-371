<?php
class BankAccount {
    public string $owner;            // jekhane khushi access
    protected float $balance = 0;    // nijer class + child class
    private string $pin = '1234';    // shudhu nijer class

    public function __construct(string $owner) { $this->owner = $owner; }

    public function deposit(float $amt): void { $this->balance += $amt; }
    public function getBalance(): float { return $this->balance; }
    private function checkPin(string $p): bool { return $p === $this->pin; }
    public function verify(string $p): bool { return $this->checkPin($p); }
}

$acc = new BankAccount('Asif');
$acc->deposit(1000);
echo $acc->owner . PHP_EOL;          // public: OK
echo $acc->getBalance() . PHP_EOL;   // getter diye access
var_dump($acc->verify('1234'));      // private method public method er vitor diye

try { echo $acc->balance; }          // protected: bahire error
catch (Error $e) { echo "Error: " . $e->getMessage() . PHP_EOL; }

try { echo $acc->pin; }              // private: bahire error
catch (Error $e) { echo "Error: " . $e->getMessage() . PHP_EOL; }

// Table:
// public     -> everywhere
// protected  -> same class + child class
// private    -> same class only

// EXERCISE: Student class e private $marks rakhun, setMarks() e 0-100 validation dien.
