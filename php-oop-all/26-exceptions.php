<?php
// Custom exception
class InsufficientBalance extends Exception {
    public function __construct(public readonly float $needed, ?Throwable $prev = null) {
        parent::__construct("Need $needed more", 100, $prev);
    }
}

class Account {
    public function __construct(private float $balance) {}
    public function withdraw(float $amt): float {
        if ($amt <= 0) throw new InvalidArgumentException('Amount must be positive');
        if ($amt > $this->balance) throw new InsufficientBalance($amt - $this->balance);
        return $this->balance -= $amt;
    }
}

$acc = new Account(500);
foreach ([200, 1000, -5] as $amt) {
    try {
        echo "Left: " . $acc->withdraw($amt) . PHP_EOL;
    } catch (InsufficientBalance $e) {
        echo "Failed: {$e->getMessage()} (code {$e->getCode()})\n";
    } catch (InvalidArgumentException | TypeError $e) {   // multi-catch
        echo "Invalid: " . $e->getMessage() . PHP_EOL;
    } finally {
        echo "-- done --\n";                              // shob shomoy chole
    }
}

// Error vs Exception: duto-i Throwable implement kore
try { intdiv(1, 0); } catch (DivisionByZeroError $e) { echo "Error: " . $e->getMessage() . PHP_EOL; }

// Exception chaining
try {
    try { throw new RuntimeException('DB down'); }
    catch (RuntimeException $e) { throw new LogicException('Service failed', 0, $e); }
} catch (Exception $e) {
    echo $e->getMessage() . ' <- ' . $e->getPrevious()->getMessage() . PHP_EOL;
}

// Global handler
set_exception_handler(fn(Throwable $t) => print("Uncaught: " . $t->getMessage() . PHP_EOL));

// EXERCISE: ValidationException banan jeta errors array hold kore.
