<?php
class Config {
    const APP = 'MyApp';
    public static string $env = 'dev';

    public static function info(): string {
        return self::APP . ' in ' . self::$env;     // self:: = ei class
    }
}
echo Config::APP . PHP_EOL;          // constant
echo Config::$env . PHP_EOL;         // static property ($ lage)
echo Config::info() . PHP_EOL;       // static method
echo Config::class . PHP_EOL;        // class er full nam

class Base {
    public function hello(): string { return 'Hello from Base'; }
    public static function create(): static { return new static(); }
}
class Child extends Base {
    public function hello(): string {
        return parent::hello() . ' + Child';        // parent:: = parent class
    }
}
echo (new Child())->hello() . PHP_EOL;
echo get_class(Child::create()) . PHP_EOL;          // static:: (details: Late Static Binding)

// self:: = je class e likha, parent:: = parent class, static:: = je class call korse
// EXERCISE: MathHelper class e const PI + static square($n) banan, :: diye call korun.
