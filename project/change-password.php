<?php
ob_start();
require_once 'header.php';

if (!isset($_SESSION['user']) || !is_array($_SESSION['user']) || empty($_SESSION['user']['email'])) {
    header("Location: sign-in.php");
    exit();
}

$passwordError = '';
$passwordSuccess = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $currentPassword = $_POST['current_password'] ?? '';
    $newPassword = $_POST['new_password'] ?? '';
    $confirmPassword = $_POST['confirm_password'] ?? '';
    $userEmail = (string) $_SESSION['user']['email'];

    if ($currentPassword === '' || $newPassword === '' || $confirmPassword === '') {
        $passwordError = 'Please complete all password fields.';
    } elseif (!preg_match('/^(?=.*\d)(?=.*[A-Za-z]).{8,}$/', $newPassword)) {
        $passwordError = 'Your new password must be at least 8 characters and include a letter and a number.';
    } elseif ($newPassword !== $confirmPassword) {
        $passwordError = 'The new passwords do not match.';
    } elseif ($newPassword === $currentPassword) {
        $passwordError = 'Your new password must be different from your current password.';
    } else {
        $lookupStmt = mysqli_prepare($conn, "SELECT password FROM users WHERE email = ?");

        if (!$lookupStmt) {
            $passwordError = 'Your password could not be changed. Please try again.';
        } else {
            mysqli_stmt_bind_param($lookupStmt, "s", $userEmail);
            $lookupExecuted = mysqli_stmt_execute($lookupStmt);
            mysqli_stmt_bind_result($lookupStmt, $storedPassword);
            $userFound = $lookupExecuted && mysqli_stmt_fetch($lookupStmt);
            mysqli_stmt_close($lookupStmt);

            if (!$lookupExecuted) {
                $passwordError = 'Your password could not be changed. Please try again.';
            } elseif (!$userFound || !password_verify($currentPassword, $storedPassword)) {
                $passwordError = 'Your current password is incorrect.';
            } else {
                $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
                $updateStmt = mysqli_prepare($conn, "UPDATE users SET password = ? WHERE email = ?");

                if (!$updateStmt) {
                    $passwordError = 'Your password could not be changed. Please try again.';
                } else {
                    mysqli_stmt_bind_param($updateStmt, "ss", $hashedPassword, $userEmail);
                    $updated = mysqli_stmt_execute($updateStmt);
                    mysqli_stmt_close($updateStmt);

                    if ($updated) {
                        $_SESSION['user']['password'] = $hashedPassword;
                        $passwordSuccess = 'Your password has been changed.';
                    } else {
                        $passwordError = 'Your password could not be changed. Please try again.';
                    }
                }
            }
        }
    }
}
?>
<section aria-labelledby="password-card-title" class="flex min-h-screen flex-col items-center justify-center bg-neutral-100 px-4 py-16 dark:bg-neutral-950">
    <div class="w-full max-w-sm">
        <div class="rounded-2xl bg-white p-6 shadow-xs ring-1 ring-neutral-950/10 sm:p-8 dark:bg-neutral-900 dark:ring-neutral-800">
            <span class="flex size-10 items-center justify-center rounded-xl bg-neutral-950 text-white dark:bg-neutral-50 dark:text-neutral-950">
                <i class="fa-solid fa-lock size-4" aria-hidden="true"></i>
            </span>
            <h1 id="password-card-title" class="mt-6 text-2xl font-semibold tracking-tight text-neutral-950 dark:text-neutral-50">Change password</h1>
            <p class="mt-2 text-sm text-neutral-600 dark:text-neutral-400">Choose a new password for your account.</p>

            <?php if ($passwordError !== '') { ?>
                <div role="alert" class="mt-6 rounded-lg bg-red-50 p-3 text-[13px] text-red-700 ring-1 ring-red-600/20 ring-inset dark:bg-red-500/10 dark:text-red-400 dark:ring-red-500/20"><?= htmlspecialchars($passwordError, ENT_QUOTES, 'UTF-8') ?></div>
            <?php } elseif ($passwordSuccess !== '') { ?>
                <div role="status" class="mt-6 rounded-lg bg-green-50 p-3 text-[13px] text-green-700 ring-1 ring-green-600/20 ring-inset dark:bg-green-500/10 dark:text-green-400 dark:ring-green-500/20"><?= htmlspecialchars($passwordSuccess, ENT_QUOTES, 'UTF-8') ?></div>
            <?php } ?>

            <form id="password-card-form" class="mt-6 space-y-4" action="" method="post">
                <div>
                    <label for="password-card-current" class="mb-1.5 block text-sm font-medium text-neutral-950 dark:text-neutral-50">Current password</label>
                    <input id="password-card-current" name="current_password" type="password" autocomplete="current-password" required class="block h-10 w-full rounded-lg bg-neutral-100 px-3 text-sm text-neutral-950 outline-1 -outline-offset-1 outline-neutral-200 hover:outline-neutral-300 focus:outline-2 focus:-outline-offset-2 focus:outline-zinc-950 dark:bg-neutral-900 dark:text-neutral-50 dark:outline-neutral-700 dark:hover:outline-neutral-600 dark:focus:outline-zinc-50" />
                </div>
                <div>
                    <label for="password-card-new" class="mb-1.5 block text-sm font-medium text-neutral-950 dark:text-neutral-50">New password</label>
                    <input id="password-card-new" name="new_password" type="password" autocomplete="new-password" required minlength="8" pattern="(?=.*\d)(?=.*[A-Za-z]).{8,}" aria-describedby="password-card-rules" class="block h-10 w-full rounded-lg bg-neutral-100 px-3 text-sm text-neutral-950 outline-1 -outline-offset-1 outline-neutral-200 hover:outline-neutral-300 focus:outline-2 focus:-outline-offset-2 focus:outline-zinc-950 dark:bg-neutral-900 dark:text-neutral-50 dark:outline-neutral-700 dark:hover:outline-neutral-600 dark:focus:outline-zinc-50" />
                    <p id="password-card-rules" class="mt-1.5 text-[13px] text-neutral-600 dark:text-neutral-400">At least 8 characters, including a letter and a number.</p>
                </div>
                <div>
                    <label for="password-card-confirm" class="mb-1.5 block text-sm font-medium text-neutral-950 dark:text-neutral-50">Confirm new password</label>
                    <input id="password-card-confirm" name="confirm_password" type="password" autocomplete="new-password" required minlength="8" class="block h-10 w-full rounded-lg bg-neutral-100 px-3 text-sm text-neutral-950 outline-1 -outline-offset-1 outline-neutral-200 hover:outline-neutral-300 focus:outline-2 focus:-outline-offset-2 focus:outline-zinc-950 dark:bg-neutral-900 dark:text-neutral-50 dark:outline-neutral-700 dark:hover:outline-neutral-600 dark:focus:outline-zinc-50" />
                </div>
                <button type="submit" id="password-card-submit" class="mt-2 inline-flex h-10 w-full cursor-pointer items-center justify-center rounded-lg bg-zinc-950 px-4 text-sm font-medium text-white shadow-xs transition-colors duration-150 hover:bg-zinc-800 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-zinc-950 active:translate-y-px dark:bg-zinc-50 dark:text-zinc-950 dark:hover:bg-zinc-200 dark:focus-visible:outline-zinc-50">Update password</button>
            </form>
        </div>
        <p class="mt-6 text-center text-sm text-neutral-600 dark:text-neutral-400"><a href="./edit-profile.php" class="rounded-sm font-medium text-zinc-950 underline decoration-zinc-950/30 underline-offset-4 hover:decoration-current focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-zinc-950 dark:text-zinc-50 dark:decoration-zinc-50/30 dark:focus-visible:outline-zinc-50">Back to edit profile</a></p>
    </div>
</section>
<?php
require_once 'footer.php';
?>
