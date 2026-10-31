<?php
class Visitor {
    public static int $total = 0;          // class er shob object er majhe shared
    public string $name;

    public function __construct(string $name) {
        $this->name = $name;
        self::$total++;                    // static e self:: / ClassName::
    }
    public static function getTotal(): int {
        return self::$total;               // static method e $this nai
    }
}

new Visitor('A');
new Visitor('B');
new Visitor('C');
echo Visitor::getTotal() . PHP_EOL;        // 3
echo Visitor::$total . PHP_EOL;            // 3

// Utility/helper class
class Str {
    public static function slug(string $s): string {
        return strtolower(trim(preg_replace('/[^A-Za-z0-9]+/', '-', $s), '-'));
    }
}
echo Str::slug('Hello World PHP!') . PHP_EOL;   // hello-world-php

// Singleton pattern (static er common use)
class DB {
    private static ?DB $instance = null;
    private function __construct() { echo "DB connected\n"; }
    public static function get(): DB {
        return self::$instance ??= new DB();
    }
}
DB::get();
DB::get();     // "DB connected" ekbar-i print hoy
var_dump(DB::get() === DB::get());   // true

// EXERCISE: IdGenerator class banan, static next() jeta 1,2,3... return kore.
