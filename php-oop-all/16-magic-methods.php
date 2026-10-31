<?php
class Magic {
    private array $data = [];

    public function __construct()  { echo "constructed\n"; }
    public function __destruct()   { echo "destroyed\n"; }

    public function __set($k, $v)  { $this->data[$k] = $v; }
    public function __get($k)      { return $this->data[$k] ?? "(no $k)"; }
    public function __isset($k)    { return isset($this->data[$k]); }
    public function __unset($k)    { unset($this->data[$k]); }

    public function __call($name, $args)        { return "call: $name(" . implode(',', $args) . ")"; }
    public static function __callStatic($n, $a) { return "static call: $n"; }

    public function __toString(): string { return "Magic(" . json_encode($this->data) . ")"; }
    public function __invoke($x)         { return $x * 2; }
}

$m = new Magic();
$m->name = 'Asif';              // __set
echo $m->name . PHP_EOL;        // __get
var_dump(isset($m->name));      // __isset
unset($m->name);                // __unset
echo $m->missing . PHP_EOL;     // (no missing)
echo $m->doSomething(1, 2) . PHP_EOL;     // __call
echo Magic::build() . PHP_EOL;            // __callStatic
echo $m . PHP_EOL;                        // __toString
echo $m(21) . PHP_EOL;                    // __invoke => 42
// script shesh e __destruct auto cholbe

// EXERCISE: __get diye ekta read-only Settings class banan jeta array theke value dey.
