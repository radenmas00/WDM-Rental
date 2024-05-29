<?php $paginator->setMaxPagesToShow(5); ?>
<!-- <nav aria-label="...">
    <ul class="pagination">
        <li class="page-item disabled active">
            <a class="page-link" href="#" tabindex="-1"><?php echo $paginator->getTotalItems(); ?> item found.</a>
        </li>
        <li class="page-item disabled active">
            <a class="page-link" href="#" tabindex="-1">Showing <?php echo $paginator->getCurrentPageFirstItem(); ?> -  <?php echo $paginator->getCurrentPageLastItem(); ?></a>
        </li>
    </ul>
</nav> -->
<nav aria-label="Page navigation example">
    <ul class="pagination">
        
        <?php if ($paginator->getPrevUrl()): ?>
        <li class="page-item"><a class="page-link" href="<?php echo $paginator->getPrevUrl(); ?>"><i
                    class="icofont-rounded-left"></i> Previous </a>
        </li>
        <?php elseif ($paginator->getTotalItems() > 12 ) :  ?>
        <li class="page-item disabled">
            <span class="page-link"><i class="icofont-rounded-left"></i> Previous</span>
        </li>
        <?php endif; ?>

        <?php foreach ($paginator->getPages() as $page): ?>
        <?php if ($page['url']): ?>
        <li <?php echo $page['isCurrent'] ? 'class="page-item active"' : ''; ?>>
            <a class="page-link" href="<?php echo $page['url']; ?>"><?php echo $page['num']; ?></a>
        </li>
        <?php else: ?>
        <li class="page-item disabled"><span><?php echo $page['num']; ?></span></li>
        <?php endif; ?>
        <?php endforeach; ?>

        <?php if ($paginator->getNextUrl()): ?>
        <li class="page-item"><a class="page-link" href="<?php echo $paginator->getNextUrl(); ?>"> Next <i
                    class="icofont-rounded-right"></i></a></li>
        <?php elseif ($paginator->getTotalItems() > 12 ) :  ?>
        <li class="page-item disabled">
            <span class="page-link">Next <i class="icofont-rounded-right"></i> </span>
        </li>
        <?php endif; ?>
    </ul>
</nav>