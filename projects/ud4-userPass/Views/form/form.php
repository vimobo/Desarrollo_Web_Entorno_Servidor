<form method="POST" action="index.php?controller=contact&amp;action=process">

    <p>
        <label for="username">username</label>
        <input required type="text" placeholder="username..." name="data[username]" id="username" />
    </p>

    <p>
        <label for="password">password</label>
        <input required type="password" placeholder="password..." name="data[password]" id="password" />
    </p>

    <input type="submit" />
</form>

<?php if (!empty($errores)): ?>

    <div class="errores">
        <?php foreach ($errores as $campo => $mensaje): ?>
            <p>
                <?= htmlspecialchars($mensaje, ENT_QUOTES, 'UTF-8') ?>
            </p>
        <?php endforeach; ?>
    </div>

<?php endif; ?>