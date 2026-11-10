<?php
$pageConfigs = [
    'all-products.php' => ['All products', 'Products'],
    'add-product.php' => ['Add product', 'Products'],
    'pending.php' => ['Pending orders', 'Orders'],
    'shipped.php' => ['Shipped orders', 'Orders'],
    'completed.php' => ['Completed orders', 'Orders'],
    'cancelled.php' => ['Cancelled orders', 'Orders'],
    'all-users.php' => ['All users', 'Users'],
    'banned-users.php' => ['Banned users', 'Users'],
];
$currentPage = basename($_SERVER['SCRIPT_NAME'] ?? '');
[$pageTitle, $pageSection] = $pageConfigs[$currentPage] ?? ['Admin', 'Admin'];
?>
<?php require_once __DIR__ . '/header.php'; ?>
<div class="flex min-h-dvh bg-neutral-100 dark:bg-neutral-950">
    <?php require __DIR__ . '/sidebar.php'; ?>
    <main class="flex min-w-0 flex-1 flex-col bg-white lg:my-2 lg:mr-2 lg:rounded-xl lg:shadow-xs lg:ring-1 lg:ring-neutral-950/10 dark:bg-neutral-900 dark:lg:ring-neutral-800">
        <?php require __DIR__ . '/page-header.php'; ?>
        <div class="flex-1 p-4 sm:p-6 lg:p-8">
            <div class="mb-6">
                <p class="text-sm font-medium text-neutral-500 dark:text-neutral-400">
                    <?= htmlspecialchars($pageSection, ENT_QUOTES, 'UTF-8') ?>
                </p>
                <h1 class="mt-1 text-2xl font-semibold tracking-tight text-neutral-950 dark:text-neutral-50">
                    <?= htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8') ?>
                </h1>
            </div>
            <section class="rounded-xl border border-neutral-200 bg-white p-6 dark:border-neutral-800 dark:bg-neutral-900">
                <?php if ($currentPage === 'add-product.php'): ?>
                    <div class="flex items-start gap-3">
                        <i class="fa-solid fa-circle-info mt-0.5 text-neutral-500 dark:text-neutral-400" aria-hidden="true"></i>
                        <div>
                            <h2 class="font-medium text-neutral-950 dark:text-neutral-50">Product form not configured</h2>
                            <p class="mt-1 text-sm text-neutral-600 dark:text-neutral-400">This page is ready for the product form. Product fields and save behavior have not been connected yet.</p>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="py-8 text-center">
                        <i class="fa-solid fa-folder-open text-2xl text-neutral-400 dark:text-neutral-500" aria-hidden="true"></i>
                        <h2 class="mt-3 font-medium text-neutral-950 dark:text-neutral-50">Nothing to display yet</h2>
                        <p class="mt-1 text-sm text-neutral-600 dark:text-neutral-400">There are no <?= htmlspecialchars(strtolower($pageTitle), ENT_QUOTES, 'UTF-8') ?> to show.</p>
                    </div>
                <?php endif; ?>
            </section>
        </div>
    </main>
</div>
<?php require_once __DIR__ . '/footer.php'; ?>
