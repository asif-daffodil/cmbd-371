<?php
class Session {
    public function __construct(
        public string $user,
        private string $token,
        public ?PDO $db = null,       // resource-like, serialize kora jay na
    ) {}

    // PHP 7.4+ preferred
    public function __serialize(): array {
        return ['user' => $this->user, 'token' => $this->token];   // db bad
    }
    public function __unserialize(array $d): void {
        $this->user  = $d['user'];
        $this->token = $d['token'];
        $this->db    = null;          // reconnect korte hobe
    }
}

$s = new Session('asif', 'abc123');
$str = serialize($s);
echo $str . PHP_EOL;

$obj = unserialize($str, ['allowed_classes' => [Session::class]]);
echo $obj->user . PHP_EOL;

// Purono style: __sleep() (kon property save hobe), __wakeup() (load er por)

// !!! SECURITY: user input kokhono unserialize() korben na (Object Injection).
// Dorkar hole allowed_classes => false dien, ba json_encode/json_decode use korun.
$safe = unserialize($str, ['allowed_classes' => false]);   // __PHP_Incomplete_Class

// EXERCISE: ekta Cart object serialize kore file e save korun, abar load korun.
