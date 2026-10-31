<?php
class ParentClass {
    public $pub = 'public';
    protected $pro = 'protected';
    private $pri = 'private';

    public const A = 'pub const';
    protected const B = 'protected const';       // constant-o visibility pay (PHP 7.1+)
    private const C = 'private const';

    public function showAll(): string {
        return "$this->pub | $this->pro | $this->pri | " . self::A . ' | ' . self::B . ' | ' . self::C;
    }
    // same class er onno object er private-o access kora jay
    public function samePri(ParentClass $other): string { return $other->pri; }
}

class ChildClass extends ParentClass {
    public function childAccess(): string {
        return $this->pub . ' | ' . $this->pro . ' | ' . self::B;
        // $this->pri   -> child e private paoa jabe na
    }
}

$p = new ParentClass();
$c = new ChildClass();
echo $p->showAll() . PHP_EOL;
echo $c->childAccess() . PHP_EOL;
echo $p->samePri(new ParentClass()) . PHP_EOL;

echo $p->pub . PHP_EOL;                           // OK
try { echo ParentClass::B; } catch (Error $e) { echo "Error: " . $e->getMessage() . PHP_EOL; }

// Method visibility-o same rule. Child override e visibility kombaano jay na (public -> private Fatal).
// EXERCISE: ParentClass e protected method add korun, child theke call korun, bahire call kore error dekhun.
