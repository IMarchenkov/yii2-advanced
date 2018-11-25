<?php $this->registerCssFile('@web/css/widget_documents.css');?>
<p>Documents</p>
<div class="icon-rows">
    <?php foreach ($documents as $file): ?>
        <a href="<?= $file['url'] ?>">
            <?php if (!empty($file['thumbnail'])): ?>
                <img src="<?= $file['thumbnail'] ?>" alt="<?= $file['title'] ?>">
            <?php else: ?>
                <img src="/images/doc.png" alt="<?= $file['title'] ?>">
            <?php endif; ?>
        </a>
    <?php endforeach; ?>
</div>