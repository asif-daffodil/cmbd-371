<?php
declare(strict_types=1);   // strict mode: "5" ke int hishabe accept korbe na

function add(int $a, int $b): int { return $a + $b; }
function greet(?string $name = null): string {     // nullable
    return "Hello, " . ($name ?? 'Guest');
}
function show(int|string $id): string {            // union type (PHP 8)
    return "ID: $id";
}
function logMsg(string $m): void { echo $m . PHP_EOL; }   // void return

class User { public function __construct(public string $name) {} }
function welcome(User $u): string { return "Welcome {$u->name}"; }  // class type

echo add(2, 3) . PHP_EOL;
echo greet() . PHP_EOL;
echo show(10) . ' | ' . show('abc') . PHP_EOL;
echo welcome(new User('Asif')) . PHP_EOL;

try {
    echo add("5", 3);          // strict_types e TypeError
} catch (TypeError $e) {
    echo "TypeError: " . $e->getMessage() . PHP_EOL;
}

// Typed property
class Product {
    public int $qty = 0;
    public ?float $price = null;
}
// EXERCISE: strict_types off kore "5" pathan, ki hoy dekhun. Tarpor on kore abar.
