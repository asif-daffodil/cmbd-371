<?php
class Config {
    final public const VERSION = '1.0';          // final const (PHP 8.1+)
    final public function appName(): string {     // override kora jabe na
        return 'MyApp';
    }
    public function debug(): bool { return false; }
}
class DevConfig extends Config {
    public function debug(): bool { return true; }   // OK
    // public function appName() {}                  // Fatal error: final method
}
echo (new DevConfig())->appName() . PHP_EOL;

final class Money {                // final class: extend kora jabe na
    public function __construct(public readonly int $amount) {}
}
// class Taka extends Money {}     // Fatal error

// Kokhon final? Security-sensitive ba immutable class (Money, Token) jekhane inheritance e behaviour bhenge jete pare.
// EXERCISE: ekta final class PasswordHasher banan, tarpor extend kore dekhun ki error ashe.
