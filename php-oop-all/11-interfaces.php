<?php
// Interface = contract. Class-ke ei method gulo implement korte-i hobe.
interface Payable {
    const CURRENCY = 'BDT';              // interface constant
    public function pay(float $amount): string;
}
interface Refundable {
    public function refund(float $amount): string;
}

// ekta class multiple interface implement korte pare
class Bkash implements Payable, Refundable {
    public function pay(float $amount): string {
        return "bKash: $amount " . self::CURRENCY . " paid";
    }
    public function refund(float $amount): string {
        return "bKash: $amount " . self::CURRENCY . " refunded";
    }
}
class Cash implements Payable {
    public function pay(float $amount): string {
        return "Cash: $amount " . self::CURRENCY . " received";
    }
}

// Payable type hint -> je kono Payable object cholbe (polymorphism)
function checkout(Payable $method, float $amount): void {
    echo $method->pay($amount) . PHP_EOL;
}
checkout(new Bkash(), 500);
checkout(new Cash(), 300);

var_dump(new Bkash() instanceof Refundable); // true
var_dump(new Cash() instanceof Refundable);  // false

// EXERCISE: Nagad class banan jeta Payable + Refundable duto-i implement kore.
