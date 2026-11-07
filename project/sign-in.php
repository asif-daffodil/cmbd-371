<?php
ob_start();
require_once 'header.php';

if (isset($_SESSION['user'])) {
    header("Location: ./");
    exit();
}

$loginError = false;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $storedPassword = $row['password'];
    $userFound = !!$row;
    mysqli_free_result($result);

    if ($userFound && password_verify($password, $storedPassword)) {
        $_SESSION['user'] = $row;
        header("Location: ./");
        exit();
    } else {
        $loginError = true;
    }
}

?>
<section aria-labelledby="login-card-title" class="flex min-h-screen flex-col items-center justify-center bg-neutral-100 px-4 py-16 dark:bg-neutral-950">
    <div class="w-full max-w-sm">
        <div class="rounded-2xl bg-white p-6 shadow-xs ring-1 ring-neutral-950/10 sm:p-8 dark:bg-neutral-900 dark:ring-neutral-800">
            <span class="flex size-10 items-center justify-center rounded-xl bg-neutral-950 text-white dark:bg-neutral-50 dark:text-neutral-950">
                <i class="fa-solid fa-layer-group size-4" aria-hidden="true"></i>
            </span>
            <h1 id="login-card-title" class="mt-6 text-2xl font-semibold tracking-tight text-neutral-950 dark:text-neutral-50">Sign in to Lumora</h1>
            <p class="mt-2 text-sm text-neutral-600 dark:text-neutral-400">Welcome back. Enter your details to continue.</p>

            <div class="my-6 flex items-center gap-3">
                <span class="h-px grow bg-neutral-200 dark:bg-neutral-800"></span>
                <span class="text-xs text-neutral-600 dark:text-neutral-400">or</span>
                <span class="h-px grow bg-neutral-200 dark:bg-neutral-800"></span>
            </div>

            <form id="login-card-form" class="space-y-4" action="" method="post">
                <div id="login-card-error" role="alert" <?= $loginError ? '' : 'hidden' ?> class="flex gap-2.5 rounded-lg bg-red-50 p-3 text-[13px] text-red-700 ring-1 ring-red-600/20 ring-inset dark:bg-red-500/10 dark:text-red-400 dark:ring-red-500/20">
                    <svg class="mt-0.5 size-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <circle cx="12" cy="12" r="10" />
                        <line x1="12" x2="12" y1="8" y2="12" />
                        <line x1="12" x2="12.01" y1="16" y2="16" />
                    </svg>
                    <p>That email and password don't match. Try again or reset your password.</p>
                </div>
                <div>
                    <label for="login-card-email" class="mb-1.5 block text-sm font-medium text-neutral-950 dark:text-neutral-50">Email</label>
                    <input id="login-card-email" name="email" type="email" autocomplete="email" required placeholder="maya@lumora.com" class="block h-10 w-full rounded-lg bg-neutral-100 px-3 text-sm text-neutral-950 outline-1 -outline-offset-1 outline-neutral-200 placeholder:text-neutral-600 hover:outline-neutral-300 focus:outline-2 focus:-outline-offset-2 focus:outline-zinc-950 dark:bg-neutral-900 dark:text-neutral-50 dark:outline-neutral-700 dark:placeholder:text-neutral-400 dark:hover:outline-neutral-600 dark:focus:outline-zinc-50" />
                </div>
                <div>
                    <div class="mb-1.5 flex items-center justify-between gap-4">
                        <label for="login-card-password" class="text-sm font-medium text-neutral-950 dark:text-neutral-50">Password</label>
                        <a href="#" class="rounded-sm text-sm text-neutral-600 transition-colors duration-150 hover:text-neutral-950 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-zinc-950 dark:text-neutral-400 dark:hover:text-neutral-50 dark:focus-visible:outline-zinc-50">Forgot password?</a>
                    </div>
                    <div class="relative">
                        <input id="login-card-password" name="password" type="password" autocomplete="current-password" required class="block h-10 w-full rounded-lg bg-neutral-100 pr-11 pl-3 text-sm text-neutral-950 outline-1 -outline-offset-1 outline-neutral-200 hover:outline-neutral-300 focus:outline-2 focus:-outline-offset-2 focus:outline-zinc-950 aria-[invalid=true]:outline-red-600 dark:bg-neutral-900 dark:text-neutral-50 dark:outline-neutral-700 dark:hover:outline-neutral-600 dark:focus:outline-zinc-50 dark:aria-[invalid=true]:outline-red-500" />
                        <button type="button" id="login-card-toggle" data-password-toggle aria-label="Show password" aria-pressed="false" aria-controls="login-card-password" class="group absolute inset-y-0 right-0 flex w-10 cursor-pointer items-center justify-center rounded-r-lg text-neutral-600 transition-colors duration-150 hover:text-neutral-950 focus-visible:outline-2 focus-visible:-outline-offset-2 focus-visible:outline-zinc-950 dark:text-neutral-400 dark:hover:text-neutral-50 dark:focus-visible:outline-zinc-50">
                            <svg data-password-show class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0" />
                                <circle cx="12" cy="12" r="3" />
                            </svg>
                            <svg data-password-hide class="size-4" style="display: none" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <path d="M10.733 5.076a10.744 10.744 0 0 1 11.205 6.575 1 1 0 0 1 0 .696 10.747 10.747 0 0 1-1.444 2.49" />
                                <path d="M14.084 14.158a3 3 0 0 1-4.242-4.242" />
                                <path d="M17.479 17.499a10.75 10.75 0 0 1-15.417-5.151 1 1 0 0 1 0-.696 10.75 10.75 0 0 1 4.446-5.143" />
                                <path d="m2 2 20 20" />
                            </svg>
                        </button>
                    </div>
                </div>
                <button type="submit" id="login-card-submit" class="group mt-2 inline-flex h-10 w-full cursor-pointer items-center justify-center gap-2 rounded-lg bg-zinc-950 px-4 text-sm font-medium text-white shadow-xs transition-colors duration-150 hover:bg-zinc-800 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-zinc-950 active:translate-y-px disabled:cursor-not-allowed disabled:opacity-60 dark:bg-zinc-50 dark:text-zinc-950 dark:hover:bg-zinc-200 dark:focus-visible:outline-zinc-50" name="log123">
                    <svg class="hidden size-4 animate-spin group-aria-busy:block motion-reduce:animate-none" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M21 12a9 9 0 1 1-6.219-8.56" />
                    </svg>
                    <span id="login-card-submit-label">Sign in</span>
                </button>
            </form>
        </div>
        <p class="mt-6 text-center text-sm text-neutral-600 dark:text-neutral-400">New to Lumora? <a href="#" class="rounded-sm font-medium text-zinc-950 underline decoration-zinc-950/30 underline-offset-4 transition-colors duration-150 hover:decoration-current focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-zinc-950 dark:text-zinc-50 dark:decoration-zinc-50/30 dark:focus-visible:outline-zinc-50">Create an account</a></p>
    </div>
</section>
<?php
require_once 'footer.php';
?>