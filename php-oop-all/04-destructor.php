<?php
class FileHandler {
    private $handle;

    public function __construct(private string $path) {
        $this->handle = fopen($path, 'w');
        echo "File opened\n";
    }
    public function write(string $text): void { fwrite($this->handle, $text); }

    // object memory theke jawar age auto cholbe (cleanup er jonno)
    public function __destruct() {
        fclose($this->handle);
        echo "File closed\n";
    }
}

$f = new FileHandler(sys_get_temp_dir() . '/demo.txt');
$f->write('Hello');

$f = null;                       // reference remove -> destructor ekhoni cholbe
echo "After null\n";

$g = new FileHandler(sys_get_temp_dir() . '/demo2.txt');
echo "Script ending...\n";
// script shesh hole $g er destructor auto cholbe

// Use: DB connection, file handle, lock release.
// EXERCISE: Logger class banan jeta destruct e "Logger closed" print kore.
