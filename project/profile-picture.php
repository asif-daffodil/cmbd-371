<?php
ob_start();
require_once 'header.php';

if (!isset($_SESSION['user']) || !is_array($_SESSION['user']) || empty($_SESSION['user']['email'])) {
    header("Location: sign-in.php");
    exit();
}

$pictureError = '';
$pictureSuccess = '';
$profilePicture = (string) ($_SESSION['user']['image'] ?? '');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_FILES['image']) || $_FILES['image']['error'] !== UPLOAD_ERR_OK) {
        $uploadError = $_FILES['image']['error'] ?? UPLOAD_ERR_NO_FILE;
        $pictureError = match ($uploadError) {
            UPLOAD_ERR_INI_SIZE, UPLOAD_ERR_FORM_SIZE => 'The image must be no larger than 5 MB.',
            UPLOAD_ERR_NO_FILE => 'Choose an image to upload.',
            default => 'The image could not be uploaded. Please try again.',
        };
    } elseif ($_FILES['image']['size'] > 5 * 1024 * 1024) {
        $pictureError = 'The image must be no larger than 5 MB.';
    } elseif (!is_uploaded_file($_FILES['image']['tmp_name'])) {
        $pictureError = 'The selected file is not a valid upload.';
    } else {
        $imageInfo = getimagesize($_FILES['image']['tmp_name']);
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mimeType = $finfo ? finfo_file($finfo, $_FILES['image']['tmp_name']) : false;
        if ($finfo) {
            finfo_close($finfo);
        }

        $allowedTypes = [
            'image/jpeg' => 'jpg',
            'image/png' => 'png',
            'image/webp' => 'webp',
        ];

        if (!$imageInfo || !$mimeType || !isset($allowedTypes[$mimeType]) || $imageInfo['mime'] !== $mimeType) {
            $pictureError = 'Choose a JPEG, PNG, or WebP image.';
        } elseif ($imageInfo[0] > 5000 || $imageInfo[1] > 5000) {
            $pictureError = 'The image dimensions must be no larger than 5000 by 5000 pixels.';
        } else {
            $uploadDirectory = __DIR__ . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'profiles';
            if (!is_dir($uploadDirectory) && !mkdir($uploadDirectory, 0755, true) && !is_dir($uploadDirectory)) {
                $pictureError = 'The upload folder could not be created. Please contact the site administrator.';
            } else {
                $fileName = bin2hex(random_bytes(16)) . '.' . $allowedTypes[$mimeType];
                $filePath = $uploadDirectory . DIRECTORY_SEPARATOR . $fileName;
                $imagePath = 'uploads/profiles/' . $fileName;

                if (!move_uploaded_file($_FILES['image']['tmp_name'], $filePath)) {
                    $pictureError = 'The image could not be saved. Please try again.';
                } else {
                    $userEmail = (string) $_SESSION['user']['email'];
                    $stmt = mysqli_prepare($conn, "UPDATE users SET image = ? WHERE email = ?");

                    if (!$stmt) {
                        unlink($filePath);
                        $pictureError = 'Your profile picture could not be updated. Please try again.';
                    } else {
                        mysqli_stmt_bind_param($stmt, "ss", $imagePath, $userEmail);
                        $updated = mysqli_stmt_execute($stmt);
                        mysqli_stmt_close($stmt);

                        if ($updated) {
                            $_SESSION['user']['image'] = $imagePath;
                            $profilePicture = $imagePath;
                            $pictureSuccess = 'Your profile picture has been updated.';
                        } else {
                            unlink($filePath);
                            $pictureError = 'Your profile picture could not be updated. Please try again.';
                        }
                    }
                }
            }
        }
    }
}
?>
<section aria-labelledby="picture-card-title" class="flex min-h-screen flex-col items-center justify-center bg-neutral-100 px-4 py-16 dark:bg-neutral-950">
    <div class="w-full max-w-sm">
        <div class="rounded-2xl bg-white p-6 shadow-xs ring-1 ring-neutral-950/10 sm:p-8 dark:bg-neutral-900 dark:ring-neutral-800">
            <span class="flex size-10 items-center justify-center rounded-xl bg-neutral-950 text-white dark:bg-neutral-50 dark:text-neutral-950">
                <i class="fa-solid fa-camera size-4" aria-hidden="true"></i>
            </span>
            <h1 id="picture-card-title" class="mt-6 text-2xl font-semibold tracking-tight text-neutral-950 dark:text-neutral-50">Update profile picture</h1>
            <p class="mt-2 text-sm text-neutral-600 dark:text-neutral-400">Choose a JPEG, PNG, or WebP image up to 5 MB.</p>

            <?php if ($pictureError !== '') { ?>
                <div role="alert" class="mt-6 rounded-lg bg-red-50 p-3 text-[13px] text-red-700 ring-1 ring-red-600/20 ring-inset dark:bg-red-500/10 dark:text-red-400 dark:ring-red-500/20"><?= htmlspecialchars($pictureError, ENT_QUOTES, 'UTF-8') ?></div>
            <?php } elseif ($pictureSuccess !== '') { ?>
                <div role="status" class="mt-6 rounded-lg bg-green-50 p-3 text-[13px] text-green-700 ring-1 ring-green-600/20 ring-inset dark:bg-green-500/10 dark:text-green-400 dark:ring-green-500/20"><?= htmlspecialchars($pictureSuccess, ENT_QUOTES, 'UTF-8') ?></div>
            <?php } ?>

            <?php if ($profilePicture !== '') { ?>
                <div class="mt-6 flex justify-center">
                    <img src="<?= htmlspecialchars($profilePicture, ENT_QUOTES, 'UTF-8') ?>" alt="Current profile picture" class="size-24 rounded-full object-cover ring-1 ring-neutral-200 dark:ring-neutral-700">
                </div>
            <?php } ?>

            <form id="picture-card-form" class="mt-6 space-y-4" action="" method="post" enctype="multipart/form-data">
                <div>
                    <label for="picture-card-image" class="mb-1.5 block text-sm font-medium text-neutral-950 dark:text-neutral-50">Profile picture</label>
                    <input id="picture-card-image" name="image" type="file" accept="image/jpeg,image/png,image/webp" required class="block w-full cursor-pointer rounded-lg bg-neutral-100 text-sm text-neutral-600 outline-1 -outline-offset-1 outline-neutral-200 file:mr-3 file:h-10 file:cursor-pointer file:border-0 file:bg-neutral-200 file:px-3 file:text-sm file:font-medium file:text-neutral-950 hover:outline-neutral-300 focus:outline-2 focus:-outline-offset-2 focus:outline-zinc-950 dark:bg-neutral-900 dark:text-neutral-400 dark:outline-neutral-700 dark:file:bg-neutral-800 dark:file:text-neutral-50 dark:focus:outline-zinc-50" />
                </div>
                <button type="submit" id="picture-card-submit" class="mt-2 inline-flex h-10 w-full cursor-pointer items-center justify-center rounded-lg bg-zinc-950 px-4 text-sm font-medium text-white shadow-xs transition-colors duration-150 hover:bg-zinc-800 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-zinc-950 active:translate-y-px dark:bg-zinc-50 dark:text-zinc-950 dark:hover:bg-zinc-200 dark:focus-visible:outline-zinc-50">Upload picture</button>
            </form>
        </div>
        <p class="mt-6 text-center text-sm text-neutral-600 dark:text-neutral-400"><a href="./edit-profile.php" class="rounded-sm font-medium text-zinc-950 underline decoration-zinc-950/30 underline-offset-4 hover:decoration-current focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-zinc-950 dark:text-zinc-50 dark:decoration-zinc-50/30 dark:focus-visible:outline-zinc-50">Back to edit profile</a></p>
    </div>
</section>
<?php
require_once 'footer.php';
?>
