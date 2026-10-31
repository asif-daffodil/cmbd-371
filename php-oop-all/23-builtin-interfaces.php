<?php
class Collection implements ArrayAccess, Countable, IteratorAggregate, JsonSerializable, Stringable {
    public function __construct(private array $items = []) {}

    // ArrayAccess: $c['a']
    public function offsetExists(mixed $o): bool { return isset($this->items[$o]); }
    public function offsetGet(mixed $o): mixed   { return $this->items[$o] ?? null; }
    public function offsetSet(mixed $o, mixed $v): void {
        if ($o === null) $this->items[] = $v; else $this->items[$o] = $v;
    }
    public function offsetUnset(mixed $o): void  { unset($this->items[$o]); }

    public function count(): int { return count($this->items); }                       // count($c)
    public function getIterator(): Iterator { return new ArrayIterator($this->items); } // foreach
    public function jsonSerialize(): mixed { return $this->items; }                    // json_encode
    public function __toString(): string { return implode(', ', $this->items); }       // Stringable
}

$c = new Collection(['a' => 'Apple']);
$c['b'] = 'Banana';
$c[] = 'Cherry';
echo $c['a'] . PHP_EOL;
echo count($c) . PHP_EOL;
foreach ($c as $k => $v) echo "$k => $v\n";
echo json_encode($c) . PHP_EOL;
echo $c . PHP_EOL;
var_dump(isset($c['b']), $c instanceof Traversable);

// EXERCISE: Collection e map(callable) method jog korun.
