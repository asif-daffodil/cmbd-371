<?php
ob_start();
require_once 'header.php';

if (!isset($_SESSION['user'])) {
    header("Location: sign-in.php");
    exit();
}

$profileName = (string) ($_SESSION['user']['name'] ?? '');
$profileEmail = (string) $_SESSION['user']['email'];
$profileError = '';
$profileSuccess = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $profileName = trim($_POST['name'] ?? '');
    $profileEmail = trim($_POST['email'] ?? '');
    $currentEmail = (string) $_SESSION['user']['email'];

    if ($profileName === '') {
        $profileError = 'Please enter your name.';
    } elseif (!filter_var($profileEmail, FILTER_VALIDATE_EMAIL)) {
        $profileError = 'Please enter a valid email address.';
    } else {
        $checkStmt = mysqli_prepare($conn, "SELECT email FROM users WHERE email = ? AND email <> ?");

        if (!$checkStmt) {
            $profileError = 'Your profile could not be updated. Please try again.';
        } else {
            mysqli_stmt_bind_param($checkStmt, "ss", $profileEmail, $currentEmail);
            $checkExecuted = mysqli_stmt_execute($checkStmt);
            mysqli_stmt_store_result($checkStmt);
            $emailExists = mysqli_stmt_num_rows($checkStmt) > 0;
            mysqli_stmt_close($checkStmt);

            if (!$checkExecuted) {
                $profileError = 'Your profile could not be updated. Please try again.';
            } elseif ($emailExists) {
                $profileError = 'That email address is already in use.';
            } else {
                $updateStmt = mysqli_prepare($conn, "UPDATE users SET name = ?, email = ? WHERE email = ?");

                if (!$updateStmt) {
                    $profileError = 'Your profile could not be updated. Please try again.';
                } else {
                    mysqli_stmt_bind_param($updateStmt, "sss", $profileName, $profileEmail, $currentEmail);
                    $updated = mysqli_stmt_execute($updateStmt);
                    mysqli_stmt_close($updateStmt);

                    if ($updated) {
                        $_SESSION['user']['name'] = $profileName;
                        $_SESSION['user']['email'] = $profileEmail;
                        $profileSuccess = 'Your profile has been updated.';
                    } else {
                        $profileError = 'Your profile could not be updated. Please try again.';
                    }
                }
            }
        }
    }
}
?>
<section aria-labelledby="profile-card-title" class="flex min-h-screen flex-col items-center justify-center bg-neutral-100 px-4 py-16 dark:bg-neutral-950">
    <div class="w-full max-w-sm">
        <div class="rounded-2xl bg-white p-6 shadow-xs ring-1 ring-neutral-950/10 sm:p-8 dark:bg-neutral-900 dark:ring-neutral-800">
            <span class="flex size-10 items-center justify-center rounded-xl bg-neutral-950 text-white dark:bg-neutral-50 dark:text-neutral-950">
                <i class="fa-solid fa-user-pen size-4" aria-hidden="true"></i>
            </span>
            <h1 id="profile-card-title" class="mt-6 text-2xl font-semibold tracking-tight text-neutral-950 dark:text-neutral-50">Edit profile</h1>
            <p class="mt-2 text-sm text-neutral-600 dark:text-neutral-400">Update your account name and email address.</p>

            <?php if ($profileError !== '') { ?>
                <div role="alert" class="mt-6 rounded-lg bg-red-50 p-3 text-[13px] text-red-700 ring-1 ring-red-600/20 ring-inset dark:bg-red-500/10 dark:text-red-400 dark:ring-red-500/20"><?= htmlspecialchars($profileError, ENT_QUOTES, 'UTF-8') ?></div>
            <?php } elseif ($profileSuccess !== '') { ?>
                <div role="status" class="mt-6 rounded-lg bg-green-50 p-3 text-[13px] text-green-700 ring-1 ring-green-600/20 ring-inset dark:bg-green-500/10 dark:text-green-400 dark:ring-green-500/20"><?= htmlspecialchars($profileSuccess, ENT_QUOTES, 'UTF-8') ?></div>
            <?php } ?>

            <form id="profile-card-form" class="mt-6 space-y-4" action="" method="post">
                <div>
                    <label for="profile-card-name" class="mb-1.5 block text-sm font-medium text-neutral-950 dark:text-neutral-50">Full name</label>
                    <input id="profile-card-name" name="name" type="text" autocomplete="name" required value="<?= htmlspecialchars($profileName, ENT_QUOTES, 'UTF-8') ?>" class="block h-10 w-full rounded-lg bg-neutral-100 px-3 text-sm text-neutral-950 outline-1 -outline-offset-1 outline-neutral-200 hover:outline-neutral-300 focus:outline-2 focus:-outline-offset-2 focus:outline-zinc-950 dark:bg-neutral-900 dark:text-neutral-50 dark:outline-neutral-700 dark:hover:outline-neutral-600 dark:focus:outline-zinc-50" />
                </div>
                <div>
                    <label for="profile-card-email" class="mb-1.5 block text-sm font-medium text-neutral-950 dark:text-neutral-50">Email</label>
                    <input id="profile-card-email" name="email" type="email" autocomplete="email" required value="<?= htmlspecialchars($profileEmail, ENT_QUOTES, 'UTF-8') ?>" class="block h-10 w-full rounded-lg bg-neutral-100 px-3 text-sm text-neutral-950 outline-1 -outline-offset-1 outline-neutral-200 hover:outline-neutral-300 focus:outline-2 focus:-outline-offset-2 focus:outline-zinc-950 dark:bg-neutral-900 dark:text-neutral-50 dark:outline-neutral-700 dark:hover:outline-neutral-600 dark:focus:outline-zinc-50" />
                </div>
                <button type="submit" id="profile-card-submit" class="mt-2 inline-flex h-10 w-full cursor-pointer items-center justify-center rounded-lg bg-zinc-950 px-4 text-sm font-medium text-white shadow-xs transition-colors duration-150 hover:bg-zinc-800 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-zinc-950 active:translate-y-px dark:bg-zinc-50 dark:text-zinc-950 dark:hover:bg-zinc-200 dark:focus-visible:outline-zinc-50">Save changes</button>
            </form>
        </div>
        <p class="mt-6 flex flex-wrap justify-center gap-x-4 gap-y-2 text-center text-sm text-neutral-600 dark:text-neutral-400">
            <a href="./profile-picture.php" class="rounded-sm font-medium text-zinc-950 underline decoration-zinc-950/30 underline-offset-4 hover:decoration-current focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-zinc-950 dark:text-zinc-50 dark:decoration-zinc-50/30 dark:focus-visible:outline-zinc-50">Update profile picture</a>
            <a href="./change-password.php" class="rounded-sm font-medium text-zinc-950 underline decoration-zinc-950/30 underline-offset-4 hover:decoration-current focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-zinc-950 dark:text-zinc-50 dark:decoration-zinc-50/30 dark:focus-visible:outline-zinc-50">Change password</a>
        </p>
    </div>
</section>
<?php
require_once 'footer.php';
?>
