<?php
trait Logger {
    public function log(string $m): void { echo "[LOG] $m\n"; }
}
trait Timestamp {
    public ?string $createdAt = null;
    public function touch(): void { $this->createdAt = date('Y-m-d H:i:s'); }
    public function log(string $m): void { echo "[TIME] $m\n"; }   // Logger er sathe conflict
}
trait Counts {
    private static int $count = 0;                    // static in trait
    public static function inc(): int { return ++self::$count; }
    abstract public function id(): int;               // abstract in trait
}

class Article {
    use Logger, Timestamp {
        Logger::log insteadof Timestamp;     // conflict resolve
        Timestamp::log as timeLog;           // alias
    }
    use Counts;
    public function id(): int { return 1; }
}

$a = new Article();
$a->log('saved');          // [LOG] saved
$a->timeLog('saved');      // [TIME] saved
$a->touch();
echo $a->createdAt . PHP_EOL;
echo Article::inc() . Article::inc() . PHP_EOL;   // 12

print_r(class_uses($a));

// Trait = code reuse (multiple inheritance er moto), interface = contract.
// EXERCISE: SoftDeletes trait banan (deleted_at, delete(), restore()).
