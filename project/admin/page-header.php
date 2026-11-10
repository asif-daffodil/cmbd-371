<header class="flex h-14 shrink-0 items-center gap-2 border-b border-neutral-200 px-4 sm:px-6 dark:border-neutral-800">
    <nav aria-label="Breadcrumb" class="min-w-0">
        <ol class="flex items-center gap-1.5 text-sm">
            <li>
                <a href="all-products.php" class="rounded-sm text-neutral-600 transition-colors hover:text-neutral-950 dark:text-neutral-400 dark:hover:text-neutral-50">Admin</a>
            </li>
            <li aria-hidden="true">
                <i class="fa-solid fa-chevron-right size-3 shrink-0 text-neutral-400 dark:text-neutral-600"></i>
            </li>
            <li class="min-w-0">
                <span aria-current="page" class="block truncate font-medium text-neutral-950 dark:text-neutral-50">
                    <?= htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8') ?>
                </span>
            </li>
        </ol>
    </nav>
</header>
