<?php
class Animal {
    public function __construct(protected string $name) {}
    public function speak(): string { return "{$this->name} makes a sound"; }
    public function info(): string  { return "Animal: {$this->name}"; }
}
class Dog extends Animal {
    // override: same name, compatible signature
    public function speak(): string { return "{$this->name} says Woof!"; }

    // parent:: diye parent er version-o call kora jay
    public function info(): string { return parent::info() . " (Dog)"; }
}

$d = new Dog('Tommy');
echo $d->speak() . PHP_EOL;  // Tommy says Woof!
echo $d->info()  . PHP_EOL;  // Animal: Tommy (Dog)

// Signature rule: parameter type widen kora jay, return type narrow kora jay
class A { public function get(int $x): iterable { return [$x]; } }
class B extends A { public function get(int|string $x): array { return [$x]; } } // OK

// EXERCISE: Cat class banan, speak() override korun, info() e parent:: use korun.
