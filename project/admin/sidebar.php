<?php
$currentPage = basename($_SERVER['SCRIPT_NAME'] ?? '');
$navGroups = [
    'Products' => [
        ['All products', 'all-products.php', 'fa-boxes-stacked'],
        ['Add product', 'add-product.php', 'fa-circle-plus'],
    ],
    'Orders' => [
        ['Pending', 'pending.php', 'fa-clock'],
        ['Shipped', 'shipped.php', 'fa-truck'],
        ['Completed', 'completed.php', 'fa-circle-check'],
        ['Cancelled', 'cancelled.php', 'fa-ban'],
    ],
    'Users' => [
        ['All users', 'all-users.php', 'fa-users'],
        ['Banned', 'banned-users.php', 'fa-user-slash'],
    ],
];
?>
<aside id="sb-app-side" class="flex w-64 shrink-0 flex-col border-r border-neutral-200 bg-neutral-100 dark:border-neutral-800 dark:bg-neutral-950">
    <a href="all-products.php" class="flex h-14 items-center gap-2 border-b border-neutral-200 px-5 text-base font-semibold text-neutral-950 dark:border-neutral-800 dark:text-neutral-50">
        <i class="fa-solid fa-store" aria-hidden="true"></i>
        <span>Admin</span>
    </a>
    <nav aria-label="Admin" class="flex flex-1 flex-col gap-5 overflow-y-auto p-3">
        <?php foreach ($navGroups as $groupName => $items): ?>
            <?php $groupIsActive = in_array($currentPage, array_column($items, 1), true); ?>
            <section>
                <h2 class="px-2.5 pb-1 text-xs font-semibold uppercase tracking-wide text-neutral-500 dark:text-neutral-400">
                    <?= htmlspecialchars($groupName, ENT_QUOTES, 'UTF-8') ?>
                </h2>
                <ul class="flex flex-col gap-0.5">
                    <?php foreach ($items as [$label, $href, $icon]): ?>
                        <?php $isActive = $currentPage === $href; ?>
                        <li>
                            <a href="<?= htmlspecialchars($href, ENT_QUOTES, 'UTF-8') ?>"
                               class="flex h-9 items-center gap-2.5 rounded-lg px-2.5 text-sm font-medium transition-colors <?= $isActive ? 'bg-white text-neutral-950 shadow-xs ring-1 ring-neutral-950/5 dark:bg-neutral-900 dark:text-neutral-50 dark:ring-neutral-800' : 'text-neutral-600 hover:bg-neutral-950/5 hover:text-neutral-950 dark:text-neutral-400 dark:hover:bg-neutral-900 dark:hover:text-neutral-50' ?>"
                               <?= $isActive ? 'aria-current="page"' : '' ?>>
                                <i class="fa-solid <?= htmlspecialchars($icon, ENT_QUOTES, 'UTF-8') ?> size-4 shrink-0" aria-hidden="true"></i>
                                <span class="truncate"><?= htmlspecialchars($label, ENT_QUOTES, 'UTF-8') ?></span>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </section>
        <?php endforeach; ?>
    </nav>
</aside>
