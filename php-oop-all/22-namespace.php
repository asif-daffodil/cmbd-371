<?php
// Ek file e multiple namespace dekhanor jonno bracket syntax
namespace App\Models {
    class User { public function name(): string { return 'Model User'; } }
    function helper(): string { return 'models helper'; }
    const VERSION = '1.0';
}

namespace App\Services {
    class User { public function name(): string { return 'Service User'; } }
}

namespace {   // global namespace
    use App\Models\User;
    use App\Services\User as ServiceUser;      // alias
    use function App\Models\helper;
    use const App\Models\VERSION;

    echo (new User())->name() . PHP_EOL;
    echo (new ServiceUser())->name() . PHP_EOL;
    echo helper() . ' ' . VERSION . PHP_EOL;
    echo \App\Models\User::class . PHP_EOL;    // fully qualified name
    echo strlen('abc') . PHP_EOL;              // global function, \ lage na (fallback)
}

// Real project e: ek file = ek class, folder structure = namespace (PSR-4)
// composer.json:
//   "autoload": { "psr-4": { "App\\": "src/" } }
// src/Models/User.php  ->  namespace App\Models; class User {}
// Tarpor: composer dump-autoload  +  require 'vendor/autoload.php';

// EXERCISE: alada folder e 2ta class banan, PSR-4 autoload diye load korun.
