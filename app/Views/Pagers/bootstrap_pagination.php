<?php $pager->setSurroundCount(1) ?>

<nav aria-label="Page navigation" class="mt-4">
    <ul class="pagination pagination-sm justify-content-center">
        
        <?php if ($pager->hasPrevious()) : ?>
            <li class="page-item">
                <a class="page-link border-0 shadow-sm rounded-3 me-1" href="<?= $pager->getFirst() ?>" aria-label="First">
                    <span aria-hidden="true">First</span>
                </a>
            </li>
            <li class="page-item">
                <a class="page-link border-0 shadow-sm rounded-3 me-2" href="<?= $pager->getPrevious() ?>" aria-label="Previous">
                    <i class="fas fa-chevron-left" style="font-size: 0.8rem;"></i>
                </a>
            </li>
        <?php endif ?>

        <?php foreach ($pager->links() as $link) : ?>
            <li class="page-item <?= $link['active'] ? 'active' : '' ?>">
                <a class="page-link border-0 shadow-sm rounded-3 mx-1 <?= $link['active'] ? '' : 'text-dark' ?>" href="<?= $link['uri'] ?>">
                    <?= $link['title'] ?>
                </a>
            </li>
        <?php endforeach ?>

        <?php if ($pager->hasNext()) : ?>
            <li class="page-item">
                <a class="page-link border-0 shadow-sm rounded-3 ms-2" href="<?= $pager->getNext() ?>" aria-label="Next">
                    <i class="fas fa-chevron-right" style="font-size: 0.8rem;"></i>
                </a>
            </li>
            <li class="page-item">
                <a class="page-link border-0 shadow-sm rounded-3 ms-1" href="<?= $pager->getLast() ?>" aria-label="Last">
                    <span aria-hidden="true">Last</span>
                </a>
            </li>
        <?php endif ?>

    </ul>
</nav>