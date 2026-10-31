<?php
class Counter { public int $n = 0; }

// Object variable e "handle" thake, pura object na.
$a = new Counter();
$b = $a;           // same object er handle copy hoy
$b->n = 10;
echo $a->n . PHP_EOL;   // 10 (same object)
var_dump(spl_object_id($a) === spl_object_id($b)); // true

// Function e pass korle-o object modify hoy
function inc(Counter $c): void { $c->n++; }
inc($a);
echo $a->n . PHP_EOL;   // 11

// Kintu handle replace korle bahire effect porbe na
function reset1(Counter $c): void { $c = new Counter(); }
reset1($a);
echo $a->n . PHP_EOL;   // 11 (change hoy nai)

// & diye reference pass korle handle-o replace hoy
function reset2(Counter &$c): void { $c = new Counter(); }
reset2($a);
echo $a->n . PHP_EOL;   // 0

// EXERCISE: array of objects foreach e modify korun, tarpor foreach (&$x) diye compare korun.
