<form method="POST" action="index.php?controller=Archive&amp;action=start" enctype="multipart/form-data">
    <link rel="stylesheet" href="./form.css">


    <p>
        <label for="img">Image</label>
        <input id="img" type="file" name="img">


    </p>
    <p>
        <?php if (isset($errors['img'])): ?>
            <?= $errors['img'] ?>
        <?php endif; ?>

    </p>

    <input type="submit" />
</form>

<div id="imgarchive">
    <?php foreach ($array ?? [] as $img): ?>
        <img src="<?= '/img/' . htmlspecialchars((string) $img) ?>" alt="Image">
    <?php endforeach; ?>
</div>