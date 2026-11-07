<?php
ob_start();
require_once 'header.php';
if (isset($_SESSION['user'])) {
    header("Location: ./");
    exit();
}

if (isset($_POST["reg123"])) {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Check if the email already exists in the database
    $checkEmailQuery = "SELECT * FROM users WHERE email = '$email'";
    $checkEmailResult = mysqli_query($conn, $checkEmailQuery);

    if (mysqli_num_rows($checkEmailResult) > 0) {
        echo "<script>Swal.fire({ icon: 'error', title: 'Email already registered', text: 'Please use a different email address.' });</script>";
    } else {
        // Hash the password before storing it in the database
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Insert the new user into the database
        $insertQuery = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$hashedPassword')";
        if (mysqli_query($conn, $insertQuery)) {
            echo "<script>Swal.fire({ icon: 'success', title: 'Account created', text: 'Your account has been created successfully.', confirmButtonText: 'Go to login', allowOutsideClick: false }).then(() => { window.location.href = 'sign-in.php'; });</script>";
            exit();
        } else {
            echo "<script>Swal.fire({ icon: 'error', title: 'Account creation failed', text: 'Error creating account. Please try again later.' });</script>";
        }
    }
}

?>
<section aria-labelledby="reg-card-title" class="flex min-h-screen flex-col items-center justify-center bg-neutral-100 px-4 py-16 dark:bg-neutral-950">
    <div class="w-full max-w-sm">
        <div class="rounded-2xl bg-white p-6 shadow-xs ring-1 ring-neutral-950/10 sm:p-8 dark:bg-neutral-900 dark:ring-neutral-800">
            <div id="reg-card-start">
                <span class="flex size-10 items-center justify-center rounded-xl bg-neutral-950 text-white dark:bg-neutral-50 dark:text-neutral-950"><i class="fa-solid fa-layer-group text-xl" aria-hidden="true"></i></span>
                <h1 id="reg-card-title" class="mt-6 text-2xl font-semibold tracking-tight text-neutral-950 dark:text-neutral-50">Create your Lumora account</h1>
                <p class="mt-2 text-sm text-pretty text-neutral-600 dark:text-neutral-400">Free for three projects. No card needed.</p>





                <form id="reg-card-form" class="space-y-4" action="" method="post">
                    <div>
                        <label for="reg-card-name" class="mb-1.5 block text-sm font-medium text-neutral-950 dark:text-neutral-50">Full name</label>
                        <input id="reg-card-name" name="name" type="text" autocomplete="name" required="" placeholder="Maya Ortiz" class="block h-10 w-full rounded-lg bg-neutral-100 px-3 text-sm text-neutral-950 outline-1 -outline-offset-1 outline-neutral-200 placeholder:text-neutral-600 hover:outline-neutral-300 focus:outline-2 focus:-outline-offset-2 focus:outline-zinc-950 aria-[invalid=true]:outline-red-600 dark:bg-neutral-900 dark:text-neutral-50 dark:outline-neutral-700 dark:placeholder:text-neutral-400 dark:hover:outline-neutral-600 dark:focus:outline-zinc-50 dark:aria-[invalid=true]:outline-red-500">
                        <p id="reg-card-name-error" hidden="" class="mt-1.5 flex items-center gap-1.5 text-[13px] text-red-700 dark:text-red-400"><i class="fa-solid fa-circle-exclamation size-3.5 shrink-0" aria-hidden="true"></i>Enter your name.</p>
                    </div>
                    <div>
                        <label for="reg-card-email" class="mb-1.5 block text-sm font-medium text-neutral-950 dark:text-neutral-50">Email</label>
                        <input id="reg-card-email" name="email" type="email" autocomplete="email" required="" placeholder="maya@northwind.com" aria-describedby="reg-card-email-msg" class="block h-10 w-full rounded-lg bg-neutral-100 px-3 text-sm text-neutral-950 outline-1 -outline-offset-1 outline-neutral-200 placeholder:text-neutral-600 hover:outline-neutral-300 focus:outline-2 focus:-outline-offset-2 focus:outline-zinc-950 aria-[invalid=true]:outline-red-600 dark:bg-neutral-900 dark:text-neutral-50 dark:outline-neutral-700 dark:placeholder:text-neutral-400 dark:hover:outline-neutral-600 dark:focus:outline-zinc-50 dark:aria-[invalid=true]:outline-red-500">
                        <p id="reg-card-email-msg" aria-live="polite" class="group mt-1.5 flex items-center gap-1.5 text-[13px] text-neutral-600 data-error:text-red-700 dark:text-neutral-400 dark:data-error:text-red-400"><i class="fa-solid fa-circle-exclamation hidden size-3.5 shrink-0 group-data-error:block" aria-hidden="true"></i><span id="reg-card-email-msg-text">We'll send a link to confirm it's you.</span></p>
                    </div>
                    <div>
                        <label for="reg-card-password" class="mb-1.5 block text-sm font-medium text-neutral-950 dark:text-neutral-50">Password</label>
                        <div class="relative">
                            <input id="reg-card-password" name="password" type="password" autocomplete="new-password" required="" minlength="8" pattern="(?=.*\d)(?=.*[A-Za-z]).{8,}" aria-describedby="reg-card-rules" class="block h-10 w-full rounded-lg bg-neutral-100 pr-11 pl-3 text-sm text-neutral-950 outline-1 -outline-offset-1 outline-neutral-200 hover:outline-neutral-300 focus:outline-2 focus:-outline-offset-2 focus:outline-zinc-950 aria-[invalid=true]:outline-red-600 dark:bg-neutral-900 dark:text-neutral-50 dark:outline-neutral-700 dark:hover:outline-neutral-600 dark:focus:outline-zinc-50 dark:aria-[invalid=true]:outline-red-500">
                            <button type="button" id="reg-card-toggle" data-password-toggle aria-label="Show password" aria-pressed="false" aria-controls="reg-card-password" class="group absolute inset-y-0 right-0 flex w-10 cursor-pointer items-center justify-center rounded-r-lg text-neutral-600 transition-colors duration-150 hover:text-neutral-950 focus-visible:outline-2 focus-visible:-outline-offset-2 focus-visible:outline-zinc-950 dark:text-neutral-400 dark:hover:text-neutral-50 dark:focus-visible:outline-zinc-50">
                                <i data-password-show class="fa-solid fa-eye size-4" aria-hidden="true"></i>
                                <i data-password-hide class="fa-solid fa-eye-slash size-4" style="display: none" aria-hidden="true"></i>
                            </button>
                        </div>

                    </div>

                    <button type="submit" id="reg-card-submit" class="group mt-2 inline-flex h-10 w-full cursor-pointer items-center justify-center gap-2 rounded-lg bg-zinc-950 px-4 text-sm font-medium whitespace-nowrap text-white shadow-xs transition-colors duration-150 hover:bg-zinc-800 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-zinc-950 active:translate-y-px disabled:cursor-not-allowed disabled:opacity-60 dark:bg-zinc-50 dark:text-zinc-950 dark:hover:bg-zinc-200 dark:focus-visible:outline-zinc-50" name="reg123">
                        <i class="fa-solid fa-spinner hidden size-4 animate-spin group-aria-busy:block motion-reduce:animate-none" aria-hidden="true"></i>
                        <span id="reg-card-submit-label">Create account</span>
                    </button>
                    <p class="text-xs text-neutral-600 dark:text-neutral-400">By creating an account, you agree to the <a href="#" class="rounded-sm text-neutral-950 underline decoration-neutral-950/30 underline-offset-2 hover:decoration-current focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-zinc-950 dark:text-neutral-50 dark:decoration-neutral-50/30 dark:focus-visible:outline-zinc-50">Terms</a> and <a href="#" class="rounded-sm text-neutral-950 underline decoration-neutral-950/30 underline-offset-2 hover:decoration-current focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-zinc-950 dark:text-neutral-50 dark:decoration-neutral-50/30 dark:focus-visible:outline-zinc-50">Privacy Policy</a>.</p>
                </form>
            </div>

            <div id="reg-card-done" hidden="">
                <span class="flex size-11 items-center justify-center rounded-xl bg-neutral-100 text-neutral-950 dark:bg-neutral-800 dark:text-neutral-50"><i class="fa-solid fa-envelope-circle-check text-xl" aria-hidden="true"></i></span>
                <h1 id="reg-card-done-title" tabindex="-1" class="mt-6 text-2xl font-semibold tracking-tight text-neutral-950 focus:outline-hidden dark:text-neutral-50">Check your email</h1>
                <p class="mt-2 text-sm text-neutral-600 dark:text-neutral-400">We sent a confirmation link to <span id="reg-card-address" class="font-medium break-words text-neutral-950 dark:text-neutral-50">maya@northwind.com</span>. Open it to finish creating your account.</p>
                <div class="mt-8 flex flex-wrap gap-3">
                    <a href="#" class="inline-flex h-10 min-w-fit flex-1 cursor-pointer items-center justify-center gap-2.5 rounded-lg border border-neutral-200 bg-white px-4 text-sm font-medium whitespace-nowrap text-neutral-950 shadow-xs transition-colors duration-150 hover:bg-neutral-50 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-zinc-950 active:translate-y-px dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-50 dark:hover:bg-neutral-800 dark:focus-visible:outline-zinc-50"><i class="fa-brands fa-google size-4" aria-hidden="true"></i>Open Gmail</a>
                    <a href="#" class="inline-flex h-10 min-w-fit flex-1 cursor-pointer items-center justify-center gap-2.5 rounded-lg border border-neutral-200 bg-white px-4 text-sm font-medium whitespace-nowrap text-neutral-950 shadow-xs transition-colors duration-150 hover:bg-neutral-50 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-zinc-950 active:translate-y-px dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-50 dark:hover:bg-neutral-800 dark:focus-visible:outline-zinc-50"><i class="fa-regular fa-envelope size-4" aria-hidden="true"></i>Open Outlook</a>
                </div>
                <div class="mt-8 border-t border-neutral-200 pt-6 text-sm dark:border-neutral-800">
                    <p class="text-neutral-600 dark:text-neutral-400">Didn't get it? Check your spam folder, or <button type="button" id="reg-card-resend" disabled="" class="cursor-pointer rounded-sm font-medium text-zinc-950 underline decoration-zinc-950/30 underline-offset-4 transition-colors duration-150 hover:decoration-current focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-zinc-950 disabled:cursor-not-allowed disabled:text-neutral-600 disabled:no-underline dark:text-zinc-50 dark:decoration-zinc-50/30 dark:focus-visible:outline-zinc-50 dark:disabled:text-neutral-400">resend the link<span id="reg-card-countdown" class="tabular-nums"> in 0:30</span></button>.</p>
                    <p id="reg-card-status" role="status" class="mt-2 text-[13px] text-neutral-600 dark:text-neutral-400"></p>
                    <button type="button" id="reg-card-back" class="mt-4 inline-flex cursor-pointer items-center gap-1.5 rounded-sm text-sm font-medium text-neutral-600 transition-colors duration-150 hover:text-neutral-950 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-zinc-950 disabled:cursor-not-allowed disabled:hover:text-neutral-600 dark:text-neutral-400 dark:hover:text-neutral-50 dark:focus-visible:outline-zinc-50 dark:disabled:hover:text-neutral-400"><i class="fa-solid fa-arrow-left size-4" aria-hidden="true"></i>Use a different email</button>
                </div>
            </div>
        </div>
        <p class="mt-6 text-center text-sm text-neutral-600 dark:text-neutral-400">Already have an account? <a href="#" class="rounded-sm font-medium text-zinc-950 underline decoration-zinc-950/30 underline-offset-4 transition-colors duration-150 hover:decoration-current focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-zinc-950 dark:text-zinc-50 dark:decoration-zinc-50/30 dark:focus-visible:outline-zinc-50">Sign in</a></p>
    </div>
</section>
<?php
require_once 'footer.php';
?>