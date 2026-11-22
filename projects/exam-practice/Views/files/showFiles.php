<?php if (!empty($files)): ?>
    <?php foreach ($files as $file): ?>
        <p>
            <?= $file['fileName'] ?? "" ?>
        </p>
        <p>
            <?= $file['description'] ?? "" ?>
        </p>
        <p>
            <?= $file['category'] ?? "" ?>
        </p>
         <p>
            <?= $file['author'] ?? "" ?>
        </p>

    <?php endforeach; ?>
<?php endif; ?>