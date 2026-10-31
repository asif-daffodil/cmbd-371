<?php
class Model {
    public static function create(): static { return new static(); }   // static = je class call korse
    public static function createSelf(): self { return new self(); }   // self = je class e likha

    public static function who(): string { return self::class; }
    public static function lateWho(): string { return static::class; }

    public static function table(): string {
        return strtolower(static::class) . 's';
    }
}
class User extends Model {}
class Post extends Model {}

echo get_class(User::create()) . PHP_EOL;       // User
echo get_class(User::createSelf()) . PHP_EOL;   // Model (self)
echo User::who() . ' / ' . User::lateWho() . PHP_EOL;   // Model / User
echo User::table() . ' | ' . Post::table() . PHP_EOL;   // users | posts

// Laravel Eloquent e Model::find() ei concept e kaj kore.
// EXERCISE: Model e static function all() banan jeta static::table() use kore.
