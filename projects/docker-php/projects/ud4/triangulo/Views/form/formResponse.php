<form method="POST" action="index.php?controller=triangulo&amp;action=process">

    <p>
        <label for="height">height</label>
        <input required type="number" placeholder="height..." name="data[height]" id="height" />
    </p>

    <p>
        <label for="width">width</label>
        <input required type="number" placeholder="width..." name="data[width]" id="width" />
    </p>

    <input type="submit" />
</form>

<?php if ($area != 0): ?>
    <p>
        Area : <?=$area?>
    </p>
<?php endif; ?>