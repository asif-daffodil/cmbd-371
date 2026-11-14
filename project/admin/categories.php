<?php
mysqli_report(MYSQLI_REPORT_OFF);
ob_start();
require_once __DIR__ . '/header.php';

$pageTitle = 'Categories';
$pageSection = 'Products';
$notice = $_SESSION['category_notice'] ?? '';
unset($_SESSION['category_notice']);
$error = '';
$categories = [];
$editingCategory = null;

if (!$conn) {
    $error = 'Unable to connect to the database. Please check the database configuration.';
} elseif (!mysqli_query(
    $conn,
    'CREATE TABLE IF NOT EXISTS categories (
        id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL UNIQUE,
        created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
    )'
)) {
    error_log('Unable to ensure categories table exists: ' . mysqli_error($conn));
    $error = 'Categories could not be loaded. Please check the database setup.';
} else {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $action = (string) ($_POST['action'] ?? '');

        if ($action === 'create' || $action === 'update') {
            $name = trim((string) ($_POST['name'] ?? ''));
            $id = (int) ($_POST['id'] ?? 0);
            $query = $action === 'create'
                ? 'INSERT INTO categories (name) VALUES (?)'
                : 'UPDATE categories SET name = ? WHERE id = ?';
            $statement = mysqli_prepare($conn, $query);

            if (!$statement) {
                error_log('Unable to prepare category save query: ' . mysqli_error($conn));
                $error = 'The category could not be saved. Please try again later.';
            } else {
                if ($action === 'create') {
                    mysqli_stmt_bind_param($statement, 's', $name);
                } else {
                    mysqli_stmt_bind_param($statement, 'si', $name, $id);
                }
                $saved = mysqli_stmt_execute($statement);
                $duplicate = mysqli_stmt_errno($statement) === 1062;
                $statementError = mysqli_stmt_error($statement);
                mysqli_stmt_close($statement);

                if (!$saved) {
                    if ($duplicate) {
                        $error = 'A category with that name already exists.';
                    } else {
                        error_log('Unable to save category: ' . $statementError);
                        $error = 'The category could not be saved. Please try again later.';
                    }
                } else {
                    $_SESSION['category_notice'] = $action === 'create'
                        ? 'Category added successfully.'
                        : 'Category updated successfully.';
                    ob_end_clean();
                    header('Location: categories.php');
                    exit;
                }
            }
        } elseif ($action === 'delete') {
            $id = (int) ($_POST['id'] ?? 0);
            $statement = mysqli_prepare($conn, 'DELETE FROM categories WHERE id = ?');
            if (!$statement) {
                error_log('Unable to prepare category delete query: ' . mysqli_error($conn));
                $error = 'The category could not be deleted. Please try again later.';
            } else {
                mysqli_stmt_bind_param($statement, 'i', $id);
                $deleted = mysqli_stmt_execute($statement);
                $statementError = mysqli_stmt_error($statement);
                $affectedRows = mysqli_stmt_affected_rows($statement);
                mysqli_stmt_close($statement);

                if (!$deleted) {
                    error_log('Unable to delete category: ' . $statementError);
                    $error = 'The category could not be deleted. It may still be in use.';
                } elseif ($affectedRows === 0) {
                    $error = 'That category no longer exists.';
                } else {
                    $_SESSION['category_notice'] = 'Category deleted successfully.';
                    ob_end_clean();
                    header('Location: categories.php');
                    exit;
                }
            }
        } else {
            $error = 'Choose a valid category action.';
        }
    }

    if (isset($_GET['edit'])) {
        $editId = (int) $_GET['edit'];
        $statement = mysqli_prepare($conn, 'SELECT id, name FROM categories WHERE id = ?');
        if ($statement) {
            mysqli_stmt_bind_param($statement, 'i', $editId);
            if (mysqli_stmt_execute($statement)) {
                mysqli_stmt_bind_result($statement, $categoryId, $categoryName);
                if (mysqli_stmt_fetch($statement)) {
                    $editingCategory = ['id' => $categoryId, 'name' => $categoryName];
                } else {
                    $error = 'That category no longer exists.';
                }
            } else {
                error_log('Unable to load category for editing: ' . mysqli_stmt_error($statement));
                $error = 'The category could not be loaded. Please try again later.';
            }
            mysqli_stmt_close($statement);
        } else {
            error_log('Unable to prepare category edit query: ' . mysqli_error($conn));
            $error = 'The category could not be loaded. Please try again later.';
        }
    }

    $result = mysqli_query($conn, 'SELECT id, name, created_at FROM categories ORDER BY name');
    if ($result) {
        while ($category = mysqli_fetch_assoc($result)) {
            $categories[] = $category;
        }
        mysqli_free_result($result);
    } else {
        error_log('Unable to list categories: ' . mysqli_error($conn));
        $error = 'Categories could not be loaded. Please try again later.';
    }
}
?>
<div class="flex min-h-dvh bg-neutral-100 dark:bg-neutral-950">
    <?php require __DIR__ . '/sidebar.php'; ?>
    <main class="flex min-w-0 flex-1 flex-col bg-white lg:my-2 lg:mr-2 lg:rounded-xl lg:shadow-xs lg:ring-1 lg:ring-neutral-950/10 dark:bg-neutral-900 dark:lg:ring-neutral-800">
        <?php require __DIR__ . '/page-header.php'; ?>
        <div class="flex-1 p-4 sm:p-6 lg:p-8">
            <div class="mb-6">
                <p class="text-sm font-medium text-neutral-500 dark:text-neutral-400">Products</p>
                <h1 class="mt-1 text-2xl font-semibold tracking-tight text-neutral-950 dark:text-neutral-50">Categories</h1>
            </div>

            <?php if ($notice !== '') { ?>
                <div role="status" class="mb-4 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-800 dark:border-green-900 dark:bg-green-950 dark:text-green-200">
                    <?= htmlspecialchars($notice, ENT_QUOTES, 'UTF-8') ?>
                </div>
            <?php } ?>
            <?php if ($error !== '') { ?>
                <div role="alert" class="mb-4 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800 dark:border-red-900 dark:bg-red-950 dark:text-red-200">
                    <?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?>
                </div>
            <?php } ?>

            <section class="mb-6 rounded-xl border border-neutral-200 bg-white p-5 dark:border-neutral-800 dark:bg-neutral-900">
                <h2 class="mb-4 text-lg font-semibold text-neutral-950 dark:text-neutral-50">
                    <?= $editingCategory ? 'Update category' : 'Add a category' ?>
                </h2>
                <form method="post" action="categories.php<?= $editingCategory ? '?edit=' . (int) $editingCategory['id'] : '' ?>" class="flex flex-col gap-3 sm:flex-row sm:items-end">
                    <input type="hidden" name="action" value="<?= $editingCategory ? 'update' : 'create' ?>">
                    <?php if ($editingCategory) { ?>
                        <input type="hidden" name="id" value="<?= (int) $editingCategory['id'] ?>">
                    <?php } ?>
                    <label class="flex-1 text-sm font-medium text-neutral-700 dark:text-neutral-300">
                        Category name
                        <input type="text" name="name" required maxlength="100" value="<?= htmlspecialchars($editingCategory['name'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
                               class="mt-1 block h-10 w-full rounded-lg border border-neutral-300 bg-white px-3 text-neutral-950 outline-none focus:border-neutral-500 focus:ring-2 focus:ring-neutral-200 dark:border-neutral-700 dark:bg-neutral-950 dark:text-neutral-50 dark:focus:ring-neutral-800">
                    </label>
                    <div class="flex gap-2">
                        <button type="submit" class="inline-flex h-10 items-center justify-center rounded-lg bg-neutral-900 px-4 text-sm font-medium text-white hover:bg-neutral-700 dark:bg-neutral-100 dark:text-neutral-900 dark:hover:bg-neutral-300">
                            <?= $editingCategory ? 'Save changes' : 'Add category' ?>
                        </button>
                        <?php if ($editingCategory) { ?>
                            <a href="categories.php" class="inline-flex h-10 items-center justify-center rounded-lg border border-neutral-300 px-4 text-sm font-medium text-neutral-700 hover:bg-neutral-50 dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-800">Cancel</a>
                        <?php } ?>
                    </div>
                </form>
            </section>

            <section class="overflow-hidden rounded-xl border border-neutral-200 bg-white dark:border-neutral-800 dark:bg-neutral-900">
                <div class="border-b border-neutral-200 px-5 py-4 dark:border-neutral-800">
                    <h2 class="font-semibold text-neutral-950 dark:text-neutral-50">All categories <span class="ml-1 text-sm font-normal text-neutral-500">(<?= count($categories) ?>)</span></h2>
                </div>
                <?php if ($categories) { ?>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-sm">
                            <thead class="bg-neutral-50 text-xs uppercase tracking-wide text-neutral-500 dark:bg-neutral-950 dark:text-neutral-400">
                                <tr>
                                    <th scope="col" class="px-5 py-3">Category</th>
                                    <th scope="col" class="px-5 py-3">Created</th>
                                    <th scope="col" class="px-5 py-3 text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-neutral-200 dark:divide-neutral-800">
                                <?php foreach ($categories as $category) { ?>
                                    <tr>
                                        <td class="px-5 py-3 font-medium text-neutral-950 dark:text-neutral-50"><?= htmlspecialchars($category['name'], ENT_QUOTES, 'UTF-8') ?></td>
                                        <td class="whitespace-nowrap px-5 py-3 text-neutral-600 dark:text-neutral-400"><?= htmlspecialchars($category['created_at'], ENT_QUOTES, 'UTF-8') ?></td>
                                        <td class="px-5 py-3">
                                            <div class="flex justify-end gap-3">
                                                <a href="categories.php?edit=<?= (int) $category['id'] ?>" class="font-medium text-neutral-700 underline-offset-4 hover:underline dark:text-neutral-300">Edit</a>
                                                <form method="post" action="categories.php" onsubmit="return confirm('Delete this category?')">
                                                    <input type="hidden" name="action" value="delete">
                                                    <input type="hidden" name="id" value="<?= (int) $category['id'] ?>">
                                                    <button type="submit" class="font-medium text-red-700 underline-offset-4 hover:underline dark:text-red-400">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                <?php } else { ?>
                    <div class="px-5 py-10 text-center">
                        <i class="fa-solid fa-tags text-2xl text-neutral-400 dark:text-neutral-500" aria-hidden="true"></i>
                        <p class="mt-3 font-medium text-neutral-950 dark:text-neutral-50">No categories yet</p>
                        <p class="mt-1 text-sm text-neutral-600 dark:text-neutral-400">Add a category above to get started.</p>
                    </div>
                <?php } ?>
            </section>
        </div>
    </main>
</div>
<?php require_once __DIR__ . '/footer.php'; ?>
