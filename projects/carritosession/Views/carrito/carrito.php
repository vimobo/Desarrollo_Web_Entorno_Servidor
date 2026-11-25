<h1>Carrito</h1>

<?php if (empty($productos)): ?>
    <p>El carrito está vacío</p>
<?php endif; ?>

<?php foreach ($productos as $key => $value): ?>
    <div>
        <p>
            <?= $key ?>
        </p>
        <p>
            <?= $value ?>
        </p>
    </div>
<?php endforeach; ?>